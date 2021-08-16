<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function insert(Ads $ad){
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
          
        
        $ad->images = $images_url;

        $ad->save();
    }
    
}
