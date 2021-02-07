<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\ProfileExtra;
use App\Models\SponsorAd;
use Illuminate\Http\Request;
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
        $request->merge([
            'token' => Str::random('10'),
            'slug' => Str::slug($request->name)
        ]);
        $profile = Profile::create($request->except('_token'));
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
            $profile_extras = ProfileExtra::whereProfileId($profile->id)->oldest()->paginate($count);
            $html = '';
            foreach ($profile_extras as $profile_extra) {
                $img = $profile_extra->approved ? $profile_extra->attachment_url : asset('icons/unavailable.jpg');
                $html .= '<div class="col-xs-6 col-md-3" >';
                $html .= '<img
                onclick="preview(\'' . $img . '\')";
                style = "height: 170px;width: 240px;object-fit: contain"';
                $html .= 'src = "' . ($profile_extra->approved ? $profile_extra->attachment_url : asset('icons/unavailable.jpg')) . '"';
                $html .= 'class="img-responsive zoom" >';
                $html .= '<div style = "margin-left: 10px; margin-right: 10px" >';
                if ($profile_extra->attachment_url == asset('icons/unavailable.jpg')) {
                    $html .= '<img onmouseover="activeIcon(this)" onmouseout="revertIcon(this)"';
                    $html .= 'src="' . asset('website/assets/images/arrow.svg') . '" name="pic"';
                    $html .= 'id="' . $profile_extra->id . '" class="picture" onclick="inp(this)"';
                    $html .= 'height="20px" width="20px" style="float: right">';
                    $html .= '<form id="add_image-' . $profile_extra->id . '" enctype="multipart/form-data"';
                    $html .= 'action="' . route('add_image', [$profile->slug, $profile_extra->id]) . '"';
                    $html .= 'method="POST">';
                    $html .= csrf_field();
                    $html .= '<input class="fileinput" id="fileinput-' . $profile_extra->id . '" type="file"';
                    $html .= 'name="fileinput" style="display:none"';
                    $html .= 'style="visibility: hidden;"/>';
                    $html .= '</form>';
                } else {
                    if (isset(auth()->user()->id)) {
                        $html .= '<a onclick="return confirm(\'Do you want to revert the Image?\')"';
                        $html .= 'href="' . route('admin.decline', $profile_extra->id) . '">';
                        $html .= '<img src="' . asset('website/assets/images/trash.png') . '"';
                        $html .= 'height="20px" width="20px" style="float: right;">';
                        $html .= '</a>';
                    }
                }
                $html .= '<div style="text-align: center">';
                $html .= '<h4 class="txt" style="color: black;margin: 10px 0px 0px 0px">' . $profile->name . '</h4>';
                $html .= '<p>Age ' . $profile_extra->age . ' ' . $profile_extra->year . '</p>';
                $html .= '</div>';
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
        return back();
    }


    public function home_page()
    {
        $pages = Profile::when(\request()->get('q'), function ($q) {
            return $q->where('name', 'like', '%' . \request()->get('q') . '%');
        })->latest()->paginate(8);
        if (\request()->ajax()) {
            $pages = Profile::latest()->paginate(8);
            $html = '';
            foreach ($pages as $page) {
                $attachment = $page->display_image->approved ? $page->display_image->attachment_url : asset('icons/unavailable.jpg');
                $html .= '<div class="col-xs-6 col-md-3">';
                $html .= '<a href="' . route('view', $page->slug) . '">';
                $html .= '<img style="height: 170px;width: 240px;object-fit: contain" class="zoom z"';
                $html .= 'src="' . $attachment . '"';
                $html .= 'class="img-responsive">';
                $html .= '</a>';
                $html .= '<div style="margin-left: 10px;text-align: center" class="z">';
                $html .= '<h4 class="txt" style="color: black;margin: 10px 0 0 0">' . ucfirst($page->name) . '</h4>';
                $html .= '<p>Age ' . ($page->display_image->approved ? $page->display_image->age : $page->extra->count()) . ' of '
                    . $page->extra->count() . ' years</p>';
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
