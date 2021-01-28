<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Profile;
use App\Models\ProfileExtra;
use App\Models\SponsorAd;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('pages.index', compact('pages'));
    }

    public function create()
    {
        return view('pages.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:50',
            'pic' => 'required|max:2048',
            'body_html' => 'required|min:20|max:1000'
        ]);
        $request->merge(['slug' => Str::slug($request->get('title'))]);
        $fileName = $request->get('slug') . '.' . $request->pic->getClientOriginalExtension();
        $request->pic->move(public_path('pages'), $fileName);
        $request->merge(['page_icon' => asset('pages/' . $fileName)]);
        $page = Page::create($request->except(['pic', '_token']));
        return back()->withSuccess('Page Created Successfully');
    }

    public function edit(Request $request,$id)
    {
        $page = Page::find($id);
        return view('pages.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        Page::destroy($id);
        return redirect()->route('admin.pages.index')->withSuccess('Page Deleted Successfully');
    }


    public function profiles()
    {
        $profiles = Profile::paginate(15);
        return view('pages.profiles', compact('profiles'));
    }

    public function delete_profile($id)
    {
        Profile::whereId($id)->delete();
        ProfileExtra::whereProfileId($id)->delete();
        return back()->withSuccess('Profile Deleted Successfully');
    }

    public function add_sponsor($id)
    {
        $profile = Profile::firstOrFail();
        return view('pages.add_sponsor', compact('profile'));
    }

    public function remove_sponsor($id)
    {
        Profile::whereId($id)->update(['is_sponsored' => 0]);
        SponsorAd::whereProfileId($id)->delete();
        return back()->withSuccess('Sponsor Removed Successfully');
    }

    public function store_sponsor(Request $request, $id)
    {
        Profile::whereId($id)->update(['is_sponsored' => 1]);
        $fileName = time() . '.' . $request->pic->getClientOriginalExtension();
        $request->pic->move(public_path('sponsors/' . $id . '/'), $fileName);
        $request->merge(['ad_attachment' => asset('sponsors/' . $id . '/' . $fileName)]);
        SponsorAd::updateOrCreate([
            'profile_id' => $id
        ],
            $request->except('_token', 'pic')
        );
        return back()->withSuccess('Sponsor Added Successfully');
    }
}
