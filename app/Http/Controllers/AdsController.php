<?php

namespace App\Http\Controllers;

// use Illuminate\Support\Facades\Auth;/ads/favorites
// use Illuminate\Support\Facades\DB;
use App\Models\Ads;
use App\Models\User;
use Barryvdh\Debugbar\Facade as DebugBar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//  return User::with('user_info')->get();
//  Debugbar::info('');

class AdsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'get_images']]); // רק משתמשים מחוברים יוכלו לקבל תוכן מלבד העמודים המפורטים שפתוחים לכולם
    }

    // תצוגת דף הבית
    public function index(Request $request)
    {
        
        $search_params = $this->organize_search_params($request->all());
        // if(Auth::check()){
        //     Debugbar::info( Ads::with('favorites')->where('favorites')->get()->favorites);
        // }

        // search progress
        if (request('search') === 't') {
            $ads = Ads::latest()->get();
            $ads = $this->search_form(Ads::latest(), $search_params);
            $ads = $ads->paginate(8);
        } else {
            $ads = Ads::latest()->paginate(8);
        }

        if (Auth::check()) {

            $user = Auth::user()->id;
            $favorites_ads = User::with('favorites')->findOrFail($user)->favorites;
            foreach ($ads as $ad){
                $added = false;
                foreach($favorites_ads as $favor){
                    if($ad->id == $favor->id){
                        $ad->is_favorite = true;
                        $added = true;
                        break;
                    }
                }
                if(!$added)
                    $new[] = $ad;

            }
           
        }
        

        Debugbar::info($ads[0]->is_favorite);



        // Infinite Scroll Pagination
        if ($request->ajax()) {
            $view = view('home_page.sections.feed', compact('ads'))->render();
            return response()->json(['html' => $view]);
        }

        // normal progress
        return view('home_page.index', ['ads' => $ads, 'search_params' => $search_params]);

    }

    // תצוגת מודעה ספציפית
    public function show($id)
    {
        $ad = Ads::findOrFail($id);
        return view('ads.show', ['ad' => $ad]);
    }

    // עמוד יצירת מודעה
    public function create()
    {
        return view('ads.create');
    }

    //  שמירת מודעה
    public function store(Request $request)
    {
        //$request-all()
        $ad = new Ads();
        $ad->insert($ad);

        return redirect('/')->with('message', 'הופההה! המודעה התפרסמה בהצלחה');
    }

    // עמוד עריכת מודעה
    public function edit($id)
    {
        $ad = Ads::findOrFail($id);
        return view('ads.edit', ['ad' => $ad]);

    }

    public function update(Request $request, $id)
    {

        $ad = Ads::findOrFail($id);

        $ad->category = request('category');
        $ad->asset_type = request('asset_type');
        $ad->asset_condition = request('asset_condition');
        $ad->city = request('city');
        $ad->address_name = request('address_name');
        $ad->address_num = request('address_num');
        $ad->area = request('area');
        $ad->neighborhood = request('neighborhood');
        $ad->floor = request('floor');
        $ad->entry_num = request('entry_num');
        $ad->sum_of_floor = request('sum_of_floor');
        if (request('is_on_pillars')) {
            $ad->is_on_pillars = true;
        } else {
            $ad->is_on_pillars = false;
        }
        $ad->parking_place = (int) request('parking_place');
        $ad->about_the_asset = request('about_the_asset');
        $ad->asset_extras = request('asset_extras');
        $ad->asset_size = (int) request('asset_size');
        $ad->total_asset_size = (int) request('total_asset_size');
        $ad->price = (int) request('price');
        $ad->rooms = request('rooms');
        $ad->porch = request('porch');
        $ad->entry_date = request('entry_date');
        if (request('is_immediate_entry')) {
            $ad->is_immediate_entry = true;
        } else {
            $ad->is_immediate_entry = false;
        }

        // $ad->last_update_date = date('Y-m-d H:i:s');

        $ad->images = ['kjhj' => 'hhh']; //request('images');
        $ad->contacts = ['kjhj' => 'hhh']; //request('contacts');

        $ad->update();

        return redirect('/');

    }

    // מחיקת מודעה
    public function destroy(Ads $ad)
    {

        $ad->delete();
        return redirect('/')->with('message', 'The ad has removed');

    }

    // החזרת תמונות
    public function get_images()
    {
        $id = request('id');
        $ad = Ads::findOrFail($id);
        return response()->json(['result' => $ad->images]);

    }

    //  ---------------------      חיפוש עמוד ראשי       -------------------

    public function search_form($ads, $search_params)
    {
        if (array_key_exists('city', $search_params)) {
            $ads = $this->is_Equal($ads, 'city', $search_params['city']);
        }

        if (array_key_exists('rooms1', $search_params)) {
            $ads = $this->is_smaller($ads, 'rooms', $search_params['rooms1']);
        }

        if (array_key_exists('rooms2', $search_params)) {
            $ads = $this->is_bigger($ads, 'rooms', $search_params['rooms2']);
        }

        if (array_key_exists('price1', $search_params)) {
            $ads = $this->is_smaller($ads, 'price', $search_params['price1']);
        }

        if (array_key_exists('price2', $search_params)) {
            $ads = $this->is_bigger($ads, 'price', $search_params['price2']);
        }

        if (array_key_exists('assets_types', $search_params)) {
            $ads = $this->check_asset_type($ads, $search_params['assets_types']);
        }

        if (array_key_exists('extras', $search_params)) {
            $ads = $this->check_asset_extras($ads, $search_params['extras']);
        }

        if (array_key_exists('floor1', $search_params)) {
            $ads = $this->is_smaller($ads, 'floor', $search_params['floor1']);
        }

        if (array_key_exists('floor2', $search_params)) {
            $ads = $this->is_bigger($ads, 'floor', $search_params['floor2']);
        }

        if (array_key_exists('asset_size1', $search_params)) {
            $ads = $this->is_smaller($ads, 'total_asset_size', $search_params['asset_size1']);
        }

        if (array_key_exists('asset_size2', $search_params)) {
            $ads = $this->is_bigger($ads, 'total_asset_size', $search_params['asset_size2']);
        }

        if (array_key_exists('entry_date', $search_params) || array_key_exists('entry_now', $search_params)) {
            $ads = $this->check_entry_date($ads);
        }

        return $ads;

    }

    public function is_Equal($ads, $col, $val)
    {
        $ads = $ads->where($col, '=', $val);
        return $ads;
    }
    public function is_bigger($ads, $col, $val)
    {
        $ads = $ads->where($col, '<=', (int) $val);
        return $ads;
    }
    public function is_smaller($ads, $col, $val)
    {
        $ads = $ads->where($col, '>=', (int) $val);
        return $ads;
    }
    public function check_asset_type($ads, $params)
    {
        $ads = $ads->where(function ($ads) use ($params) {
            foreach ($params as $key => $value) {
                $ads->orWhere('asset_type', '=', $value);
            }
        });

        return $ads;
    }

    public function check_asset_extras($ads, $query)
    {
        $ads = $ads->whereJsonContains('asset_extras', $query);

        return $ads;
    }
    public function check_entry_date($ads)
    {
        if (request('entry_now')) {
            $ads = $ads->where('is_immediate_entry', '=', '1')
                ->orWhere('entry_date', '<', date("d/m/Y"));

        } else {
            $ads = $ads->where('entry_date', '>=', request('entry_date'));
        }

        return $ads;
    }

    // --------------------------     -------------------------

    private function organize_search_params($params)
    {
        if (array_key_exists('extras', $params)) {
            $extras = [];
            for ($i = 0; $i < $params['extras']; $i++) {
                $extras[] = $params['extra' . $i];
                unset($params['extra' . $i]);
            }
            $params['extras'] = $extras;
        }

        if (array_key_exists('assets_types', $params)) {
            $assets_types = [];
            for ($i = 0; $i < $params['assets_types']; $i++) {
                $assets_types[] = $params['asset' . $i];
                unset($params['asset' . $i]);
            }
            $params['assets_types'] = $assets_types;
        }

        return $params;
        // Debugbar::info();
    }
}
