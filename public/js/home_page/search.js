const search_asset_type_all = document.querySelector("#search_asset_type_all");

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

const search_asset_type1 = document.querySelector("#search_asset_type1");

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
const search_asset_type2 = document.querySelector("#search_asset_type2");

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
const search_asset_type3 = document.querySelector("#search_asset_type3");

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



$(document).ready(function(){
    if (search_asset_type_all.checked) {
        $("input.asset-type1[type=checkbox]").each(function() {
            $(this).attr('checked', true);
        });
        $("input.asset-type2[type=checkbox]").each(function() {
            $(this).attr('checked', true);
        });
        $("input.asset-type2[type=checkbox]").each(function() {
            $(this).attr('checked', true);
        });
    }else {
        
        if (search_asset_type1.checked) {
            $("input.asset-type1[type=checkbox]").each(function() {
                $(this).attr('checked', true);
            });
        }
        if (search_asset_type2.checked) {
            $("input.asset-type2[type=checkbox]").each(function() {
                $(this).attr('checked', true);
            });
        }
        if (search_asset_type3.checked) {
            $("input.asset-type3[type=checkbox]").each(function() {
                $(this).attr('checked', true);
            });
        }
    }
})



$('.search_btn_dd').click(function (e) {
    e.stopPropagation();
    if ($('#input_dropdown1').is(":visible")) {
        $('#input_dropdown1').toggle();
        $('#input1-icon').toggleClass('fa-chevron-up');
    }
    if ($('#input_dropdown2').is(":visible")) {
        $('#input_dropdown2').toggle();
        $('#input2-icon').toggleClass('fa-chevron-up');
    }

    let dd = e.target.attributes.name.value
    $('#input_dropdown'+dd).toggle();
    $('#input'+dd+'-icon').toggleClass('fa-chevron-up');
})
$('#input_dropdown1,#input_dropdown2').click(function (e) {
    e.stopPropagation();
})
$('body').click(function (e) {
    if ($('#input_dropdown1').is(":visible")) {
        $('#input_dropdown1').toggle();
        $('#input1-icon').toggleClass('fa-chevron-up');
    }
    if ($('#input_dropdown2').is(":visible")) {
        $('#input_dropdown2').toggle();
        $('#input2-icon').toggleClass('fa-chevron-up');
    }
})

let search_dropdown_toggle = function( input, dropNum = 0 ){
    
    // $('.collapse').toggle();

    if(dropNum > 0){

        $('#input' + input + '_dropdown' + dropNum).toggle();
        $('#input' + input + '-d' + dropNum + '-icon'+ dropNum).toggleClass('fa-chevron-up');

    }


}

let advancedSearch = function(){
    $('#advancedSearch').toggle();
}


/* take params from url
    const urlSearchParams = new URLSearchParams(window.location.search);
    const params = Object.fromEntries(urlSearchParams.entries());
    console.log(params)
*/

// upload search params to the URL
function searchAndSort(){
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
        price2: $('#search-price2').val(),
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
    p.asset_type_all = search_asset_type_all.checked ? 't':'';
    p.asset_type1 = search_asset_type1.checked ? 't':'';
    p.asset_type2 = search_asset_type2.checked ? 't':'';
    p.asset_type3 = search_asset_type3.checked ? 't':'';
    let assetsChecked = $('input[type="checkbox"][name="search_asset_type\\[\\]"]:checked').map(function() { return this.value; }).get();
    
    p.assets_types = assetsChecked.length;

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

