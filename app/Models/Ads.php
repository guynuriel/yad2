<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;
    protected $casts = [
        'images' => 'array',
        'asset_extras' => 'array',
        'contacts' => 'array'
    ];
}
