<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    public function extra()
    {
        return $this->hasMany(ProfileExtra::class);
    }

    public function sponsor_ad()
    {
        return $this->hasOne(SponsorAd::class);
    }
}
