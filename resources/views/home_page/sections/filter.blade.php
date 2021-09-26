<style>
    .filter_wrapper {
        border: 1px solid #dbdbdb;
        border-radius: 2px;
        display: flex;
        cursor: pointer;
        padding: 6px 12px;
    }

    #filter1_wrapper {
        width: 170px;
    }

    #filter_dd1 {
        display: none;
        position: absolute;
        top: 50px;
        right: 30px;
        background-color: #fff;
        box-shadow: 0 3px 5px 0 rgb(0 0 0 / 20%), 0 1px 18px 0 rgb(0 0 0 / 12%), 0 6px 10px 0 rgb(0 0 0 / 14%);
        width: 200px;
        padding: 12px 17px;
        z-index: 999;
    }

    #filter_dd2 {
        display: none;
        position: absolute;
        top: 50px;
        left: 111px;
        background-color: #fff;
        box-shadow: 0 3px 5px 0 rgb(0 0 0 / 20%), 0 1px 18px 0 rgb(0 0 0 / 12%), 0 6px 10px 0 rgb(0 0 0 / 14%);
        width: 200px;
        padding: 12px 17px;
        z-index: 999;
    }

    #filter_dd1::after,
    #filter_dd2::after {
        content: "";
        height: 15px;
        width: 15px;
        transform: rotate(45deg) translateX(50%);
        -webkit-transform: rotate(45deg) translateX(50%);
        -moz-transform: rotate(45deg) translateX(50%);
        -o-transform: rotate(45deg) translateX(50%);
        -ms-transform: rotate(45deg) translateX(50%);
        position: absolute;
        display: inline-block;
        background-color: #fff;
    }

    #filter_dd1::after {
        top: -10px;
        right: 50%;
    }

    #filter_dd2::after {
        top: -10px;
        left: 18%;
    }
</style>

<section>

    <div class="flex">
        <div style="position: relative">
            <div class="flex filter_dd" name="1">
                <span class="ml-2 f14 h-center" name="1">
                    מיין לפי
                </span>
                <div name="1" class="filter_wrapper" id="filter1_wrapper">
                    <span name="1" class="label f14 color1 no_select">
                        @php
                        if(array_key_exists('price-up', $search_params)){
                        echo 'מחיר - מהזול ליקר';
                        }elseif (array_key_exists('price-down', $search_params)) {
                        echo 'מחיר - מהיקר לזול';
                        }else {
                        echo 'לפי תאריך';
                        }
                        @endphp
                    </span>
                    <i name="1" class="mr-auto fas fa-chevron-down bold f14 h-center color1 mt-1"></i>
                </div>
            </div>
            <div id="filter_dd1">
                <div onclick="filter1();" class="flex click my-2">
                    <i
                        class="{{ array_key_exists('price-up', $search_params)|| array_key_exists('price-down', $search_params) ? 'far fa-circle' :'far fa-dot-circle color4' }} h-center f16"></i>
                    <span class="mr-1">לפי תאריך</span>
                </div>
                <div onclick="filter1('price-up');" class="flex click my-2">
                    <i
                        class="{{ array_key_exists('price-up', $search_params) ? 'far fa-dot-circle color4 ' :'far fa-circle' }} h-center f16"></i>
                    <span class="mr-1">מחיר - מהזול ליקר</span>
                </div>
                <div onclick="filter1('price-down');" class="flex click my-2">
                    <i
                        class="{{ array_key_exists('price-down', $search_params) ? 'far fa-dot-circle color4' :'far fa-circle' }} h-center f16"></i>
                    <span class="mr-1">מחיר - מהיקר לזול</span>
                </div>
            </div>
        </div>

        <div style="position: relative" class="mr-auto flex">
            <div class="filter_wrapper filter_dd" name="2">
                <i class="fas fa-filter color1 f14 h-center" name="2"></i>
                <span class="mr-1 f14 color1 no_select" name="2">סנן תוצאות</span>
            </div>

            <div id="filter_dd2"> 
                <custom-checkbox value="price" {{ array_key_exists('with_price', $search_params) ? 'checked' :'' }}
                    class="ml-1 filter2" name="with_price">עם מחיר
                </custom-checkbox>
                <custom-checkbox value="image" {{ array_key_exists('with_image', $search_params) ? 'checked' :'' }}
                    class="ml-1 filter2" name="with_image">עם תמונה
                </custom-checkbox>
                <hr style="margin-top: -10px; margin-bottom: 10px;">
                <div class="flex">
                    <span class="click" onclick="filter2Clean();">ניקוי</span>
                    <span onclick="filter2();" class="mr-auto click color4">סינון</span>
                </div>
            </div>

            <div class="filter_wrapper mr-2">
                <i class="fas fa-map-marker-alt h-center color1 f14"></i>
                <span class="f14 color1 mr-1">תצוגת מפה</span>
            </div>
        </div>
    </div>

</section>
<script>
    $('.filter_dd').click(function (e) {
    e.stopPropagation();
    let num = e.target.attributes.name.value
    let isClosedNow = false
    if ($('#filter_dd1').is(":visible")) {
        $('#filter_dd1').toggle();
        $('#filter1-icon').toggleClass('fa-chevron-up');
        if (num === '1') {
            isClosedNow = true;
        }
    }
    if ($('#filter_dd2').is(":visible")) {
        $('#filter_dd2').toggle();
        $('#filter2-icon').toggleClass('fa-chevron-up');
        if (num === '2') {
            isClosedNow = true;
        }
    }
    
    if (!isClosedNow) {
        $('#filter_dd'+num).toggle();
        $('#filter'+num+'-icon').toggleClass('fa-chevron-up');
    }
})
$('#filter_dd1,#filter_dd2').click(function (e) {
    e.stopPropagation();
})
$('body').click(function (e) {
    if ($('#filter_dd1').is(":visible")) {
        $('#filter_dd1').toggle();
        $('#filter1-icon').toggleClass('fa-chevron-up');
    }
    if ($('#filter_dd2').is(":visible")) {
        $('#filter_dd2').toggle();
        $('#filter2-icon').toggleClass('fa-chevron-up');
    }
})



function filter1(type = null){
        const urlSearchParams = new URLSearchParams(window.location.search);
        const params = Object.fromEntries(urlSearchParams.entries());
        
        if(jQuery.isEmptyObject(params) ){
            window.location.href = "/?search=t&"+type+'=t';
        }else{
            let url = "/?"
            for (let key in params) {
                debugger
                if (params.hasOwnProperty(key)) {
                    
                    if(key === type || key === 'null')
                        {continue;}
                    
                    
                    if(key === 'price-up'||key === 'price-down')
                        {continue;}
                    

                    url += key + '=' + params[key] + '&'
                }
            }
            
            url += type;
            window.location.href = url;
        }

        

        
    }
function filter2(){
        const urlSearchParams = new URLSearchParams(window.location.search);
        const params = Object.fromEntries(urlSearchParams.entries());
        
        let url = "/?search=t&"

        $("custom-checkbox.filter2").each(function () {
            if($(this)[0].isChecked){
                url += $(this)[0].getAttribute('name') + '&'
            }
        });

        if(jQuery.isEmptyObject(params) ){
            window.location.href = url;
        }else{
            for (let key in params) {
                if (params.hasOwnProperty(key)) {
                    switch(key){
                        case 'with_image': 
                            continue;
                        case 'with_price': 
                            continue;
                        case 'search': 
                            continue;
                        default:
                            break;
                    }
                    url += key + '=' + params[key] + '&'
                }
            }
            
            window.location.href = url;
        }


        
        
        
    }
    function filter2Clean(){
        $("custom-checkbox.filter2").each(function () {
            $(this)[0].uncheck()
        
        });
    }
</script>