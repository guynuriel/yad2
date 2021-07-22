<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Ads;
use database\repository\storeAdsRepository;


class AdsController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }
    

    // תצוגת דף הבית
    public function index(Request $request)
    {
        
        $ads = Ads::latest()->get();
       
        if(request('search')){
            $ads = $this->search_form($ads,request('search'));           
        }
            
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
    public function store()
    {
        //$request-all()
        $ad = new Ads();        
        $ad->user_id = Auth::user()->id;
        $ad->category = "מכירה";//request('category');
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
        if(request('asset_extras')){
            $ad->asset_extras = request('asset_extras');
        }
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

        $man1=[
            'name'=>request('contact_name1'),
            'code_num' => request('contact_code_num1'),
            'number'=>request('contact_number1'),
            'mail'=>request('contact_mail1'),
        ];
       

        if(request('contact_name2')){
            $man2=[
                'name'=>request('contact_name2'),
                'code_num' => request('contact_code_num2'),
                'number'=>request('contact_number2'),
            ]; 
            $ad->contacts = [
                'man1'=>$man1,
                'man2'=> $man2
            ];
        }else{
            $ad->contacts = [
                'man1'=>$man1
            ]; 
        }
        
        
        for($i = 1 ; $i <= 11 ; $i++){
            if(request('image_upload_'.$i))
                $images_files[] = request('image_upload_'.$i);
        }
        $images_url=[];
        $destinationPath = public_path('/images/upload');
        
        foreach($images_files as $image){
            if($image->getClientOriginalExtension()==='mp4')
                $new_name = 'v'.time() . '.' . $image->getClientOriginalExtension();
            else
                $new_name = time() . '.' . $image->getClientOriginalExtension();
            
            $image->move($destinationPath, $new_name);
            
            $images_url[]= "/images/upload/".$new_name;
        
        }
          
        
        $ad->images = $images_url;

        $ad->save();

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
        $new_ads =[];

        foreach($ads as $ad){
            if($ad[$col] == $val){
                $new_ads[]= $ad;
            };
        };

        return $new_ads;
    } 
    public function check_asset_type($ads)
    {
        $new_ads =[];
        foreach($ads as $ad)
        {
            for($i = 0 ; $i < (int)request('sumOfAssetsType') ; $i++ )
            {             
                
                if(request('asset'.$i) == $ad->asset_type )
                {
                    $new_ads[]= $ad;
                    break;
                }
                        
            }
        }
        return $new_ads;
    }
    public function check_asset_extras($ads)
    {
        $new_ads =[];
        foreach($ads as $ad)
        {
            if($ad->asset_extras[0] === "0")
                continue;
                
            for($i = 0 ; $i < (int)request('extras') ; $i++ )
            {             
                for($j = 0 ; $j < count($ad->asset_extras) ; $j++ )
                { 
                    if(request('extra'.$i) == $ad->asset_extras[$j] )
                    {
                        $new_ads[]= $ad;
                        break;
                    }
                
                }
                        
            }
        }
        return $new_ads;
    }
    public function check_entry_date($ads)
    {
        $user_date=0;
        $new_ads =[];
        foreach($ads as $ad)
        {  
            if($ad->is_immediate_entry){
                $ad_date =time(); 
            }else{
                $ad_date = strtotime($ad->entry_date);
            }

            if(request('entry_now')){
                if($ad->is_immediate_entry === '1' || time() >= $ad_date ){
                    $new_ads[]= $ad;
                }
            }else{
                $user_date = strtotime(request('entry_date'));
                if( $user_date <= $ad_date ){
                    $new_ads[]= $ad;
                }
            }
        }
        return $new_ads;
    }
    public function is_bigger($ads,$col,$val)
    {
        $new_ads =[];

        foreach($ads as $ad){
            if((float)$ad[$col] <= (float)$val){
                $new_ads[]= $ad;
            };
        };

        return $new_ads;
    
    } 
    public function is_smaller($ads,$col,$val)
    {
        $new_ads =[];

        foreach($ads as $ad){
            if((float)$ad[$col] >= (float)$val){
                $new_ads[]= $ad;
            };
        };

        return $new_ads;
    } 

}
