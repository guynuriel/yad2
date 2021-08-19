<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_info extends Model
{

    protected $table = 'user_info';
    protected $foreignKey = 'user_id';
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
