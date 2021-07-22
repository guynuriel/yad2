<?php

use Illuminate\Http\Request;

class storeAdsRepository{

    


    public function store(Request $request)
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
        
        if(request('image_upload_1')){
            for($i = 1 ; $i <= 10 ; $i++){
                $images_files[] = request('image_upload_'.$i);
            }
            $image_code = '';
            $images_url=[];
            $destinationPath = public_path('/images/upload');
            
            foreach($images_files as $image){

                //$new_name = time() . '.' . $image->$image->getClientOriginalExtension();
                $new_name = time() . '.' . $image->getClientOriginalExtension();
                $image->move($destinationPath, $new_name);
                // $image_code .= '<div class="col-md-3" style="margin-bottom:24px;">
                //     <img src="/imgs/projects/'.$new_name.'" class="img-thumbnail" />
                //     </div>';
                $images_url[]= "/images/upload/".$new_name;
            
            }
            
            // $output= array(
            //     'success' => 'Images uploaded successfully',
            //     'image'   =>  $image_code,
            // );     
        }
        $ad->images = $images_url;

        $ad->save();

        return redirect('/')->with('message','הופההה! המודעה התפרסמה בהצלחה');
    }
}


?>