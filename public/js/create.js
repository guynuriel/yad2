// $('input').addEventListener('focusout',function(){
//     this.css('border','1px solid #ccc')


// })
let focusout = function(id){
    $('#'+id).css('border','1px solid #ccc')
}


let check_input = function (id, isValid = true){
        
    if(!$('#'+id).val() || $('#'+id).val() ==" " ){
        $('#'+id).css('border','1px solid red')
        return false;
    }else{
        $('#'+id).css('border','1px solid #ccc')
        if(isValid)
            return true;
        else
            return false;   
    }
  
}

let check_city_address_input = function (id, type){
    let isFound = false
    if(type === 'city')
    {
        for (let i = 0; i < cities.length; i++) {
            if( $('#'+id).val().trim() === cities[i].trim() )
            {
                debugger
                isFound = true;
                break;   
            }
            
        };
    }else if( type === 'address'){
        for (let i = 0; i < cityAddresses.length; i++) {
            if( $('#'+id).val().trim() === cityAddresses[i]['שם_רחוב'].trim() )
            {
                debugger
                isFound = true;
                break;   
            }
        }
    }
    
    if(isFound){
        $('#'+id).css('border','1px solid #ccc')
        return true;
    }else{
        $('#'+id).css('border','1px solid red')
        return false;
    }
}

let is2valid = function(){
    
    let isValid = true;
    isValid = check_input('asset_typeIN');  
    isValid = check_input('asset_conditionIN',isValid); 
    isValid = check_input('cityIN',isValid);
    if(isValid)    
        isValid = check_city_address_input('cityIN','city');
    isValid = check_input('address_nameIN',isValid);
    if(isValid) 
        isValid = check_city_address_input('address_nameIN','address');
    isValid = check_input('address_numIN',isValid); 
    isValid = check_input('floorIN',isValid);   
    isValid = check_input('sum_of_floorIN',isValid);    
    isValid = check_input('neighborhoodIN',isValid);    
    isValid = check_input('areaIN',isValid);
    return isValid;
}

let is3valid = function(){
    let isValid = true;
    isValid = check_input('roomsIN');

    return isValid;
}
let is4valid = function(){
    let isValid = true;
    isValid = check_input('total_asset_sizeIN');
    if(isValid)
        if(!$('#is_immediate_entryIN').is(':checked'))
            isValid = check_input('entry_dateIN');
        
    return isValid;
}

let is6valid = function(){
    let isValid = true;
    isValid = check_input('contact_name1IN');
    isValid = check_input('contact_number1IN',isValid);
    isValid = check_input('contact_code_num1IN',isValid);
    isValid = check_input('contact_mail1IN',isValid);

    return isValid;
}

// בודק ולידציה בכל הטופס
let nextStep = function(row1, row2){
    let isValid = true;

    if(row1<row2){
        switch(row1){
            case 2:
                isValid = is2valid();

                break
            case 3:
                isValid = is3valid();
                break
            case 4:
                isValid = is4valid();
                break
            case 5:
                break
            case 6:
                isValid = is6valid();
                break
            case 7:
                break
            default:
                isValid = true;
                break
        }
    }

    if(isValid){

        $('#header-step'+row1).toggle();
        $('#step'+row1).toggle();

        if(row1<row2){
            $('#check'+row1).show();
            $('#num'+row1).hide();
        }else{
            $('#check'+row1).hide();
            $('#num'+row1).show();
        }

        $('#header-step'+row2).toggle();
        $('#step'+row2).toggle();
    }
}

let add_contact = function(){

    $('#add_contact2').toggle();
    $('#contact2').toggle();



}

//    הצגת תמונה וסרטון לפני פרסום
function showPreview(event, number){
    if(event.target.files.length > 0){
        let src = URL.createObjectURL(event.target.files[0]);
        console.log(src);
        let preview = document.getElementById("image_upload_"+number+"-preview");
        preview.src = src;
        preview.style.display = "block";
        if(number===11)
            $("#video_preview").show();
        $("#imgRemove_"+number).show();
    } 
}
function myImgRemove(number) {
    document.getElementById("image_upload_"+number+"-preview").src = "";
    $("#image_upload_"+number+"-preview").hide();
    $("#imgRemove_"+number).hide();
    if(number===11)
        $("#video_preview").hide();
    document.getElementById("image_upload_"+number).value = null;
}


