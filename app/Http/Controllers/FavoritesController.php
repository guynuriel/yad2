<?php

namespace App\Http\Controllers;

use App\Models\Favorites;
// use Illuminate\Support\Facades\DB;
use App\Models\User;
use Barryvdh\Debugbar\Facade as DebugBar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // favorites page
    public function index(Request $request)
    {
        $user = Auth::user()->id;
        $favorites = User::with('favorites')->findOrFail($user)->favorites;

        return view('ads.favorites')->with('ads', $favorites);
        
    }

    // add favorite
    public function like($ad_id)
    {
        $user = Auth::user()->id;
        if(Favorites::where(['user_id'=>$user,'ad_id'=>$ad_id])->exists()){

            $ad = Favorites::where(['user_id'=>$user,'ad_id'=>$ad_id])->delete();
            // dd($ad);

            // $ad->delete();
            return back()->with('favorite', 'deleted');
        }else{
            $favorites = new Favorites;
            $favorites->user_id = Auth::user()->id;
            $favorites->ad_id = $ad_id;
            $favorites->save();
            return back()->with('favorite', 'stored');
        }

    }

}
