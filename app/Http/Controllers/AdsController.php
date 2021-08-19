<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Ads;
use App\Models\User;
use App\Models\User_info;
//  return User::with('user_info')->get();
// use database\repository\storeAdsRepository;


class AdsController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth'); נותן גישה רק למשתמשים רשומים לקבל את כל התוכן
        // $this->middleware('guest'); נותן גישה רק למשתמשים לא רשומים לקבל את כל התוכן
        $this->middleware('auth', ['except'=>['index','show','get_images']]);// רק משתמשים מחוברים יוכלו לקבל תוכן מלבד העמודים המפורטים שפתוחים לכולם
    }
    

    // תצוגת דף הבית
    public function index(Request $request)
    {
        
        // search progress
       if(request('search') === 't'){
            $ads = Ads::latest()->get();
            $ads = $this->search_form(Ads::latest(),request('search'));     
            $ads = $ads->paginate(8);
        }else{
            $ads = Ads::latest()->paginate(8);  
        } 
        
        // Infinite Scroll Pagination
        if($request->ajax()){
            $view = view('home_page.sections.feed',compact('ads'))->render();
            return response()->json(['html'=>$view]);
        } 
        

        // normal progress
        $query = $request->all();
        return view('home_page.index',['ads'=>$ads,'query'=>$query]);

        
    }

    // תצוגת מודעה ספציפית
    public function show($id)
    {
        $ad = Ads::findOrFail($id);
        return view('ads.show',['ad' => $ad]);
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
    
        return redirect('/')->with('message','הופההה! המודעה התפרסמה בהצלחה');
    }
    
    // עמוד עריכת מודעה
    public function edit($id)
    {
        $ad = Ads::findOrFail($id);
        return view('ads.edit',['ad'=>$ad]);

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
        if(request('is_on_pillars')){
            $ad->is_on_pillars = true;
        }
        else{
            $ad->is_on_pillars = false;
        }
        $ad->parking_place = (int)request('parking_place');
        $ad->about_the_asset = request('about_the_asset');
        $ad->asset_extras = request('asset_extras');
        $ad->asset_size = (int)request('asset_size');
        $ad->total_asset_size = (int)request('total_asset_size');
        $ad->price = (int)request('price');
        $ad->rooms = request('rooms');
        $ad->porch = request('porch');
        $ad->entry_date = request('entry_date');
        if(request('is_immediate_entry')){
            $ad->is_immediate_entry = true;
        }
        else{
            $ad->is_immediate_entry = false;
        }

        // $ad->last_update_date = date('Y-m-d H:i:s');
        
        $ad->images =['kjhj'=>'hhh']; //request('images');
        $ad->contacts = ['kjhj'=>'hhh']; //request('contacts');

        $ad->update();

        return redirect('/');

    }
    

    // מחיקת מודעה
    public function destroy (Ads $ad)
    {

        $ad->delete();
        return redirect('/')->with('message','The ad has removed');

    }

    // החזרת תמונות
    public function get_images ()
    {
        $id = request('id');
        $ad = Ads::findOrFail($id);
        return response()->json(['result' => $ad->images ])  ;

    }





    //  ---------------------      חיפוש עמוד ראשי       -------------------




    public function search_form($ads, $searchType)
    {
        if(request('city'))
            $ads = $this->is_Equal($ads, 'city', request('city'));

        if(request('rooms1'))
            $ads = $this->is_smaller($ads, 'rooms', request('rooms1'));

        if(request('rooms2'))
            $ads = $this->is_bigger($ads, 'rooms', request('rooms2'));

        if(request('price1'))
            $ads = $this->is_smaller($ads, 'price', request('price1'));

        if(request('price2'))
            $ads = $this->is_bigger($ads, 'price', request('price2'));            
        if(request('sumOfAssetsType'))
            $ads = $this->check_asset_type($ads);
        if(request('extras'))
            $ads = $this->check_asset_extras($ads);
        if(request('floor1'))
            $ads = $this->is_smaller($ads, 'floor', request('floor1'));
        if(request('floor2'))
            $ads = $this->is_bigger($ads, 'floor', request('floor2'));
        if(request('asset_size1'))
            $ads = $this->is_smaller($ads, 'total_asset_size', request('asset_size1'));
        if(request('asset_size2'))
            $ads = $this->is_bigger($ads, 'total_asset_size', request('asset_size2'));
        if(request('entry_date')||request('entry_now'))
            $ads = $this->check_entry_date($ads);

    
        return $ads;
                
    }

    public function is_Equal($ads,$col,$val)
    {


        $ads = $ads->where($col,'=',$val);
        // $new_ads =[];
        // foreach($ads as $ad){
        //     echo $ad[$col] . ' = ' . $val;
        //     if($ad[$col] == $val){
        //         $new_ads[]= $ad;
                
        //     };
        // };
        // return $new_ads;
        return $ads;
    } 
    public function is_bigger($ads,$col,$val)
    {
        $ads = $ads->where($col, '<=', (int)$val);
        return $ads;
    
    } 
    public function is_smaller($ads,$col,$val)
    {
        $ads = $ads->where($col, '>=', (int)$val);
        return $ads;
    } 
    public function check_asset_type($ads)
    {   
        $assets_type = [];
        for($i = 0 ; $i < (int)request('sumOfAssetsType') ; $i++ )
        {             
            $assets_type[] =  request('asset'.$i);
        }
        $ads = $ads->where(function ($ads) use ($assets_type){
            foreach ($assets_type as $key => $value)
            {
                $ads->orWhere('asset_type','=',$value);
            }
        });

        return $ads;
    }

    public function check_asset_extras($ads)
    {
        $asset_extras = [];
        for($i = 0 ; $i < (int)request('extras') ; $i++ )
        {             
            $asset_extras[] =  request('extra'.$i);
        }
        // $ads = $ads->whereJsonContains(function ($ads) use ($assets_extras){
        //     foreach ($assets_extras as $key => $value)
        //     {
        //         $ads->orWhere('assets_extras['.$value.']','=',$value);
        //     }
        // });
        $ads = $ads->whereJsonContains('asset_extras',$asset_extras);
        
        return $ads;
    }
    public function check_entry_date($ads)
    {
            if(request('entry_now')){
                $ads = $ads->where('is_immediate_entry','=','1')
                ->orWhere('entry_date','<',date("d/m/Y"));
            
            }else{
                $ads = $ads->where('entry_date','>=',request('entry_date'));
            }
        
        return $ads;
    }
  

}
