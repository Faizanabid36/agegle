<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\ProfileExtra;
use App\Models\SponsorAd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:profiles',
            'started_year' => 'required|integer|min:1900'
        ]);
        $ended_year = (integer)!is_null($request->ended_year) ? $request->ended_year : now()->format('Y');
        if ($ended_year < $request->started_year)
            return back()->withErrors(['Ended Date Should be Greater Than Started Date']);
        $request->merge(['token' => Str::random('10'), 'slug' => Str::slug($request->name)]);
        $profile = Profile::create($request->except('_token'));
        $age = $ended_year - $request->started_year;
        for ($x = 1; $x <= $age; $x++)
            ProfileExtra::create([
                'profile_id' => $profile->id,
                'age' => $x,
                'attachment_url' => asset('icons/unavailable.jpg'),
                'created_at' => now()->subSeconds($x),
            ]);
        if (!is_null($request->email)) {
            $details = [
                'name' => ucfirst($request->name),
                'url' => url()->route('delete_profile', [$profile->slug, $profile->token])];

            Mail::to($request->email)->send(new \App\Mail\SendDeleteLinkMail($details));
        }
        return redirect()->route('view', $profile->slug);
    }

    public function create()
    {
        return view('website.create');
    }

    public function view($slug)
    {
        $profile = Profile::whereSlug($slug)->firstOrFail();
        $count = $profile->is_sponsored ? 11 : 12;
        $profile_extras = ProfileExtra::whereProfileId($profile->id)->oldest()->paginate($count);
        if (\request()->ajax()) {
            $profile_extras = ProfileExtra::whereProfileId($profile->id)->latest()->paginate($count);
            $html = '';
            foreach ($profile_extras as $page) {
                $html .= '<div class="col-xs-4 col-md-3">';
                $html .= '<img style="height: 170px;width: 240px;" src="' . $page->attachment_url . '"';
                $html .= 'class="img-responsive">';

                $html .= '<div style="margin-left: 10px; margin-right: 10px">';
                if ($page->attachment_url == asset('icons/unavailable.jpg')) {
                    $html .= '<img onclick="inp(this)" onmouseover="activeIcon(this)" onmouseout="revertIcon(this)"';
                    $html .= 'src="' . asset('website/assets/images/arrow.svg') . '" name="pic"';
                    $html .= 'id="' . $page->id . '" class="picture"';
                    $html .= 'height="20px" width="20px" style="float: right">';
                    $html .= '<form id="add_image-' . $page->id . '" enctype="multipart/form-data"';
                    $html .= 'action="' . route('add_image', [$profile->slug, $page->id]) . '"';
                    $html .= 'method="POST">';
                    $html .= csrf_field();
                    $html .= '<input class="fileinput" id="fileinput-' . $page->id . '" type="file"';
                    $html .= 'name="fileinput" style="display:none"';
                    $html .= 'style="visibility: hidden;"/>';
                    $html .= '</form>';

                }
                $html .= '<h4 class="txt" style="color: black;margin: 10px 0px 0px 0px">' . $profile->name . '</h4>';
                $html .= '<p>Age ' . $page->age . ' ' . ($page->age + (int)$profile->started_year) . '</p>';
                $html .= '</div>';
                $html .= '</div>';
            }
            return compact('profile', 'profile_extras', 'html');
        }
        return view('website.view', compact('profile', 'profile_extras'));
    }

    public function add_image(Request $request, $slug, $age_id)
    {
        $fileName = time() . '.' . $request->fileinput->getClientOriginalExtension();
        $request->fileinput->move(public_path('profile/' . $slug . '/'), $fileName);
        ProfileExtra::whereId($age_id)->update(['attachment_url' => asset('profile/' . $slug . '/' . $fileName)]);
        $age = ProfileExtra::whereId($age_id)->first();
        $profile = Profile::whereId($age->profile_id)->first();
//        dd($profile );
        if (is_null($profile->disp_age) || $profile->disp_age < $age->age)
            Profile::whereId($age->profile_id)->update(['disp_age' => $age->age, 'disp_img' => $age->attachment_url]);
        return back();
    }


    public function home_page()
    {
        $pages = Profile::latest()->paginate(8);
        if (\request()->ajax()) {
            $pages = Profile::latest()->paginate(8);
            $html = '';
            foreach ($pages as $page) {
                $html .= '<div class="col-xs-4 col-md-3">';
                $html .= '<a href="' . route('view', $page->slug) . '">';
                $html .= '<img src="' . $page->extra->first()->attachment_url . '" alt="' . $page->slug . '" class="img-responsive"></a>';
                $html .= '<div style="margin-left: 10px;">';
                $html .= '<h4 class="txt" style="color: black;margin: 10px 0 0 0">'.ucfirst($page->name).'</h4>';
                $html .= '<p>10 of 50 years</p>';
                $html .= '</div>';
                $html .= '</div>';
            }
            return compact('pages','html');
        }
        return view('website.home', compact('pages'));
    }

    public function delete_profile(Request $request, $slug, $token)
    {
        $profile = Profile::whereSlug($slug)->whereToken($token)->firstOrFail();
        Profile::whereId($profile->id)->delete();
        SponsorAd::whereProfileId($profile->id)->delete();
        ProfileExtra::whereProfileId($profile->id)->delete();
    }
}
