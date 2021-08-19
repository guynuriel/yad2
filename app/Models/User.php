<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\User_info;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    // protected $table ="users";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'my_ads' => 'array',
        'like_ads' => 'array'

    ];

    // return user with his own ads
    public function ads(){
        return $this->hasMany(Ads::class);
    }


    // return user with favorite ads
    public function favorites(){
        return $this->belongsToMany(Ads::class,'favorites','user_id','ad_id');
    }

    // return user with info
    public function user_info(){
        return $this->hasOne(User_info::class);
    }
}
