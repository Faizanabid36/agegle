<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\ProfileExtra;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function store(Request $request)
    {
        $ended_year = (integer)!is_null($request->ended_year) ? $request->ended_year : now()->format('Y');
        if ($ended_year < $request->started_year)
            return back()->withError('Ended Date Should be Greater Than Started Date');
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
        return redirect()->route('view', $profile->slug);
    }

    public function create()
    {
        return view('website.create');
    }

    public function view($slug)
    {
        $profile = Profile::whereSlug($slug)->firstOrFail();
        $count = $profile->is_sponsored?11:12;
        $profile_extras = ProfileExtra::whereProfileId($profile->id)->orderBy('created_at', 'ASC')->paginate($count);
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
        $pages = Profile::latest()->paginate(12);
        return view('website.home', compact('pages'));
    }
}
