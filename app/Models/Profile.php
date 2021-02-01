<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = [];


    public static function boot()
    {
        parent::boot();
        static::created(function ($profile) {
            $ended_year = (integer)!is_null($profile->ended_year) ? $profile->ended_year : now()->format('Y');
            $age = $ended_year - $profile->started_year;
            for ($x = 1; $x <= $age; $x++) {
                ProfileExtra::create([
                    'profile_id' => $profile->id,
                    'age' => $x,
                    'year' => $x + $profile->started_year,
                    'attachment_url' => asset('icons/unavailable.jpg'),
                    'created_at' => now()->subSeconds($x),
                ]);
            }
            $extra = ProfileExtra::whereProfileId($profile->id)->get('id')->first();
            $profile->update(['profile_extras_id' => $extra->id]);
            if (!is_null($profile->email)) {
                $details = [
                    'name' => ucfirst($profile->name),
                    'url' => url()->route('delete_profile', [$profile->slug, $profile->token])
                ];
                Mail::to($profile->email)->send(new \App\Mail\SendDeleteLinkMail($details));
            }
            Cache::forget('suggestions');
        });
    }

    public function extra()
    {
        return $this->hasMany(ProfileExtra::class);
    }

    public function sponsor_ad()
    {
        return $this->hasOne(SponsorAd::class);
    }

    public function display_image()
    {
        return $this->belongsTo(ProfileExtra::class, 'profile_extras_id');
    }

}
