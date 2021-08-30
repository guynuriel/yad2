<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\Debugbar\Facade as DebugBar;

class Ads extends Model
{
    use HasFactory;
    
    protected $table = 'ads';
    protected $primaryKey = 'id';
    protected $foreignKey = 'user_id';

    protected $casts = [
        'images' => 'array',
        'asset_extras' => 'array',
        'contacts' => 'array'
    ];

    // return ads with the owner user
    public function user(){
        return $this->belongsTo(User::class);
    }

    // return ads with user that like them
    public function favorites(){
        
        
        return $this->belongsToMany(User::class,'favorites','ad_id','user_id');
        

    }


    public function insert(Ads $ad){
        $ad->user_id = Auth::user()->id;
        

        if(request('is_on_pillars')){
            $is_on_pillars = true;
        }else{
            $is_on_pillars = false;
        }
        
        if(request('asset_extras')){
            $ad->asset_extras = request('asset_extras');
        }

        if(request('is_immediate_entry')){
            $is_immediate_entry = true;
        }else{
            $is_immediate_entry = false;
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
        
        $num = 1;
        foreach($images_files as $image){
            if($image->getClientOriginalExtension()==='mp4'){
                $new_name = 'v'.$num.time() . '.' . $image->getClientOriginalExtension();
            }else{
                $new_name = $num.time() . '.' . $image->getClientOriginalExtension();
            }
            
            $image->move($destinationPath, $new_name);
            
            $images_url[]= "/images/upload/".$new_name;
            $num++;
        }

        $ad->category = "selling";
        $ad->about_the_asset = request('about_the_asset');
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
        $ad->rooms = request('rooms');
        $ad->porch = request('porch');
        $ad->entry_date = request('entry_date');
        $ad->parking_place = (int)request('parking_place');
        $ad->asset_size = (int)request('asset_size');
        $ad->total_asset_size = (int)request('total_asset_size');
        $ad->price = (int)request('price');
        $ad->is_immediate_entry = $is_immediate_entry;
        $ad->is_on_pillars = $is_on_pillars;
        $ad->images = $images_url;

        $ad->save();
    }
    
}
