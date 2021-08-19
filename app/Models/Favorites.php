<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{

    protected $table = "favorites";
    // public function ads(){
    //     return $this->belongsToMany(Ads::class);
    // }
    // public function user(){
    //     return $this->belongsToMany(User::class);
    // }
}
