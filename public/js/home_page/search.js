const search_asset_type_all = document.querySelector("#search_asset_type_all");

search_asset_type_all.addEventListener('click', function() {
    if($(this)[0].isChecked){

        $("custom-checkbox.asset-type1").each(function() {
            $(this)[0].check();
        });
        $("custom-checkbox.asset-type2").each(function() {
            $(this)[0].check();
        });
        $("custom-checkbox.asset-type3").each(function() {
            $(this)[0].check();
        });



    }else{


        $("custom-checkbox.asset-type1").each(function () {
            
            $(this)[0].uncheck();
        });
        $("custom-checkbox.asset-type2").each(function() {
            $(this)[0].uncheck();
        });
        $("custom-checkbox.asset-type3").each(function() {
            $(this)[0].uncheck();
        });
        
    } 

});

const search_asset_type1 = document.querySelector("#search_asset_type1");

search_asset_type1.addEventListener('click', function() {
    if($(this)[0].isChecked){
        $("custom-checkbox.asset-type1").each(function() {
            $(this)[0].check();
        });
    }else{
        $("custom-checkbox.asset-type1").each(function() {
            $(this)[0].uncheck();
        });        
    } 

});
const search_asset_type2 = document.querySelector("#search_asset_type2");

search_asset_type2.addEventListener('click', function () {
    
    if($(this)[0].isChecked){
        $("custom-checkbox.asset-type2").each(function () {
            $(this)[0].check();
        });
    }else{
        $("custom-checkbox.asset-type2").each(function () {
            $(this)[0].uncheck();
        });        
    } 

});
const search_asset_type3 = document.querySelector("#search_asset_type3");

search_asset_type3.addEventListener('click', function() {
    if($(this)[0].isChecked){
        $("custom-checkbox.asset-type3").each(function() {
            $(this)[0].check();
        });
    }else{
        $("custom-checkbox.asset-type3").each(function() {
            $(this)[0].uncheck();
        });        
    } 

});



$(document).ready(function () {
    // debugger
    if (search_asset_type_all.isChecked) {
        
        $("custom-checkbox.asset-type1").each(function () {
            $(this)[0].check();
        });
        $("custom-checkbox.asset-type2").each(function(i) {
            $(this)[0].check();
        });
        $("custom-checkbox.asset-type2").each(function(i) {
            $(this)[0].check();
        });
    }else {
        
        if (search_asset_type1.isChecked) {
            $("custom-checkbox.asset-type1").each(function() {
                $(this)[0].check();
            });
        }
        if (search_asset_type2.isChecked) {
            $("custom-checkbox.asset-type2").each(function() {
                $(this)[0].check();
            });
        }
        if (search_asset_type3.isChecked) {
            $("custom-checkbox.asset-type3").each(function() {
                $(this)[0].check();
            });
        }
    }
})



$('.search_btn_dd').click(function (e) {
    e.stopPropagation();
    let dd = e.target.attributes.name.value
    let isClosedNow = false
    if ($('#input_dropdown1').is(":visible")) {
        $('#input_dropdown1').toggle();
        $('#input1-icon').toggleClass('fa-chevron-up');
        if (dd === '1') {
            isClosedNow = true;
        }
    }
    if ($('#input_dropdown2').is(":visible")) {
        $('#input_dropdown2').toggle();
        $('#input2-icon').toggleClass('fa-chevron-up');
        if (dd === '2') {
            isClosedNow = true;
        }
    }
    
    if (!isClosedNow) {
        $('#input_dropdown'+dd).toggle();
        $('#input'+dd+'-icon').toggleClass('fa-chevron-up');
    }
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

    p["entry_now"] = $('#search-entry_now')[0].isChecked;          
    if($('#search-entry_date').val()  !=="החל מ- הזינו תאריך")
        p["entry_date"] = $('#search-entry_date').val();
    
    
    
    let extrasInputs = [...document.querySelectorAll('custom-checkbox[name="asset_extras\\[\\]"]')];
    let i = 0;
    extrasInputs.forEach(e => {
       
        if (e.isChecked) {
            p['extra'+i] = e.getAttribute('value');
            i++;
        }
        
    });
    p['extras'] = i;
    
    p.asset_type_all = search_asset_type_all.isChecked ? 't':'';
    p.asset_type1 = search_asset_type1.isChecked ? 't':'';
    p.asset_type2 = search_asset_type2.isChecked ? 't':'';
    p.asset_type3 = search_asset_type3.isChecked ? 't' : '';


    let assetsInputs = [...document.querySelectorAll('custom-checkbox[name="search_asset_type\\[\\]"]')];
    let assetsChecked = [];
    for (let i = 0; i < assetsInputs.length; i++) {
        if (assetsInputs[i].isChecked) {
            assetsChecked.push(assetsInputs[i].getAttribute("value"));
        }    
    }

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

