let search_asset_type_all = document.querySelector("#search_asset_type_all");

search_asset_type_all.addEventListener('change', function() {
    if($(this).is(':checked')){

        $("input.asset-type1[type=checkbox]").each(function() {
            $(this).attr('checked', true);
        });
        $("input.asset-type2[type=checkbox]").each(function() {
            $(this).attr('checked', true);
        });
        $("input.asset-type3[type=checkbox]").each(function() {
            $(this).attr('checked', true);
        });



    }else{


        $("input.asset-type1[type=checkbox]").each(function() {
            $(this).attr('checked', false);
        });
        $("input.asset-type2[type=checkbox]").each(function() {
            $(this).attr('checked', false);
        });
        $("input.asset-type3[type=checkbox]").each(function() {
            $(this).attr('checked', false);
        });
        
    } 

});

let search_asset_type1 = document.querySelector("#search_asset_type1");

search_asset_type1.addEventListener('change', function() {
    if($(this).is(':checked')){
        $("input.asset-type1[type=checkbox]").each(function() {
            $(this).attr('checked', true);
        });
    }else{
        $("input.asset-type1[type=checkbox]").each(function() {
            $(this).attr('checked', false);
        });        
    } 

});
let search_asset_type2 = document.querySelector("#search_asset_type2");

search_asset_type2.addEventListener('change', function() {
    if($(this).is(':checked')){
        $("input.asset-type2[type=checkbox]").each(function() {
            $(this).attr('checked', true);
        });
    }else{
        $("input.asset-type2[type=checkbox]").each(function() {
            $(this).attr('checked', false);
        });        
    } 

});
let search_asset_type3 = document.querySelector("#search_asset_type3");

search_asset_type3.addEventListener('change', function() {
    if($(this).is(':checked')){
        $("input.asset-type3[type=checkbox]").each(function() {
            $(this).attr('checked', true);
        });
    }else{
        $("input.asset-type3[type=checkbox]").each(function() {
            $(this).attr('checked', false);
        });        
    } 

});


let search_dropdown_toggle = function(input,dropnum=0){
    
    // $('.collapse').toggle();

    if(dropnum>0){

        $('#input'+input+'_dropdown'+dropnum).toggle();
        $('#input'+input+'-d'+dropnum+'-icon'+dropnum).toggleClass('fa-chevron-up');

    }else{
        
        $('#input_dropdown'+input).toggle();
        $('#input'+input+'-icon').toggleClass('fa-chevron-up');
        
    }


}

let advancedSearch = function(){
    
    $('#advancedSearch').toggle();
}



// const urlSearchParams = new URLSearchParams(window.location.search);
// const params = Object.fromEntries(urlSearchParams.entries());
// console.log(params)

// if(params.search === 'tt' )
//     advancedSearch()



function searchAndSort(searchType = 1){
    let url = '/?search=t'; 
    let p = {
        floor1:$('#search-floor1').val(),
        floor2:$('#search-floor2').val(),
        asset_size1:$('#search-asset_size1').val(),
        asset_size2:$('#search-asset_size2').val(),
        city:$('#city_search_autocomplete').val(),
        rooms1:$('#search-rooms1').val(),
        rooms2:$('#search-rooms2').val(),
        price1:$('#search-price1').val(),
        price2:$('#search-price2').val(),
    };

    p["entry_now"] = $('#search-entry_now').is(':checked')?true:false;          
    if($('#search-entry_date').val()  !=="החל מ- הזינו תאריך")
        p["entry_date"] = $('#search-entry_date').val();
    
    
    
    let extras = $("#search-extras-wrapper input:checkbox:checked").map(function(){
        return $(this).val();
    }).get(); // <----
    if(extras.length>0)
    {
        let i = 0;
        p['extras'] = extras.length;
        extras.forEach(e => {
            p['extra'+i] = e;
            i++;
        });
    }

    let assetsChecked = $('input[type="checkbox"][name="search_asset_type\\[\\]"]:checked').map(function() { return this.value; }).get();
    
    p.sumOfAssetsType = assetsChecked.length;

    for (let i = 0; i < assetsChecked.length; i++) {
        p['asset'+i] = assetsChecked[i];
    }

    for (let key in p) {
        if (p.hasOwnProperty(key)&& p[key]!='' ) {
            url += "&" + key + "=" + p[key];
        }
    }

    if(url === '/?search=t')
        window.location.href = "/";
    else
        window.location.href = url;     
}

