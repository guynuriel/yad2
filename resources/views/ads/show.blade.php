@extends('layouts.yad2')

@section('content')


    <section style="width:960px" class="center" >




        <div class="flex">

            <div style="box-shadow: 0 4px 5px 0 rgb(0 0 0 / 14%), 0 1px 10px 0 rgb(0 0 0 / 12%), 0 2px 4px 0 rgb(0 0 0 / 20%);;" class="m-auto flex">
                <div style="width:630px;height:400px" class="flex">
                    <img style="width:auto;height:100%;max-width:630px;" src="{{ asset('images/upload/home.jpg') }}" alt="" >
                </div>
                <div style="width:330px;padding:15px;" >
                    <div class="flex">
                        <span class="ml-auto f12 color2" >דירה למכירה ב{{ $ad->city }}</span>
                        <span class="mr-auto f12 color2">
                            @if ( strtotime(date('d.m.Y')) === strtotime(date('d.m.y', strtotime( $ad->updated_at ))))
                            עודכן היום
                            @else                                    
                            {{ date('d/m/y', strtotime( $ad->updated_at )) }}
                            @endif    
                        </span>

                    </div>

                    <div class="mt-4">
                        <p class="f24 color1"><strong>{{ $ad->address_name }} {{ $ad->address_num }}</strong></p>
                        <p class="f18 color1">{{ $ad->neighborhood }}, {{ $ad->city }}</p>
                    </div>

                    <hr>
                    <div class="flex">
                        <div class="flex" style="width: 33%">
                            <span class="m-auto" style="display: block;">
                                <div class="text-center f16 color1" >{{ $ad->rooms }}</div>                            
                                <div class="f14 color2" >חדרים</div>                            
                            </span>
                        </div>
                        <div class="flex" style="width: 33%">
                            <span class="m-auto" style="display: block;">
                                <div class="text-center f16 color1" >{{ $ad->floor }}</div>                            
                                <div class="f14 color2" >קומה</div>                            
                            </span>
                        </div>
                        <div class="flex" style="width: 33%">
                            <span class="m-auto" style="display: block;">
                                <div class="text-center f16 color1" >{{ $ad->asset_size }}</div>                            
                                <div class="f14 color2" >מ"ר</div>                            
                            </span>
                        </div>
                    </div>
                    
                    <hr>

                    <div class="mt-5" >
                        <p class="f24 color1">{{ $ad->price }}  ₪</p>
                    </div>

                </div>
            </div>
         

        </div>


        <div id="info_wrapper">
            <div class="flex mt-2">
                <ul id="show_menu" class="flex m-auto">
                    <li>על הנכס</li>
                    <li>איך השכונה?</li>
                    <li>עסקאות באזור</li>
                    <li>בתי ספר וגני ילדים</li>
                    <li>איך השכנים?</li>
                    <li>תחבורה ציבורית</li>
                </ul>

            </div>

            <div id="info_container" >
                <div>                   
                    <p style="padding-right: 2.5%"><strong>על הנכס</strong></p>
                    <p style="padding-right: 2.5%">{{ $ad->about_the_asset }}</p>
                    <div class="flex p-1">
                        <div style="width: 45%;margin-right:2.5%" >
                            <div>
                                <span class="text-gray">מצב הנכס</span>
                                <span class="mr-5"><strong>{{ $ad->asset_condition }}</strong></span>
                            </div>
                            <hr>
                        </div>
                        <div style="width: 45%; margin-right:5%" >
                            <div>
                                <span  class="text-gray">תאריך כניסה</span>
                                <span class="mr-5"><strong>{{ $ad->entry_date }}</strong></span>
                            </div>
                            <hr>
                        </div>
                        <div style="width: 45%;margin-right:2.5%" >
                            <div>
                                <span  class="text-gray">קומות בבניין</span>
                                <span class="mr-5"><strong>{{ $ad->sum_of_floor }}</strong></span>
                            </div>
                            <hr>
                        </div>
                        <div style="width: 45%; margin-right:5%" >
                            <div>
                                <span  class="text-gray">חניות</span>
                                <span class="mr-5"><strong>{{ $ad->parking_place == 0 ? 'ללא' :$ad->parking_place  }}</strong></span>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 20px;" class="px-4" >
                    <p><strong>מה יש בנכס?</strong></p>
                    <div class="flex">
                        <div class="extrass-item-box" >
                            @if (!in_array('A', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >מיזוג</span>
                            @else  
                            <span class="v">✔</span>
                            <span>מיזוג</span>
                            @endif
                        </div>
                        <div class="extrass-item-box" >
                            @if (!in_array('B', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >סורגים</span>
                            @else  
                            <span class="v">✔</span>
                            <span>סורגים</span>
                            @endif
                        </div>
                        <div class="extrass-item-box" >
                            @if (!in_array('C', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >מעלית</span>
                            @else  
                            <span class="v">✔</span>
                            <span>מעלית</span>
                            @endif
                        </div>
                        <div class="extrass-item-box" >
                            @if (!in_array('D', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >מטבח כשר</span>
                            @else  
                            <span class="v">✔</span>
                            <span>מטבח כשר</span>
                            @endif
                        </div>
                        <div class="extrass-item-box" >
                            @if (!in_array('E', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >גישה לנכים</span>
                            @else  
                            <span class="v">✔</span>
                            <span>גישה לנכים</span>
                            @endif
                        </div>
                        <div class="extrass-item-box" >
                            @if (!in_array('F', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >משופצת</span>
                            @else  
                            <span class="v">✔</span>
                            <span>משופצת</span>
                            @endif
                        </div>
                        <div class="extrass-item-box" >
                            @if (!in_array('G', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >ממ"ד</span>
                            @else  
                            <span class="v">✔</span>
                            <span>ממ"ד</span>
                            @endif
                        </div>
                        <div class="extrass-item-box" >
                            @if (!in_array('H', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >מחסן</span>
                            @else  
                            <span class="v">✔</span>
                            <span>מחסן</span>
                            @endif
                        </div>
                        <div class="extrass-item-box" >
                            @if (!in_array('I', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >דלתות פנדור</span>
                            @else  
                            <span class="v">✔</span>
                            <span>דלתות פנדור</span>
                            @endif
                        </div>
                        <div class="extrass-item-box" >
                            @if (!in_array('J', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >מזגן תדיראן</span>
                            @else  
                            <span class="v">✔</span>
                            <span>מזגן תדיראן</span>
                            @endif
                        </div>
                        <div class="extrass-item-box" >
                            @if (!in_array('K', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >ריהוט</span>
                            @else  
                            <span class="v">✔</span>
                            <span>ריהוט</span>
                            @endif
                        </div>
                        <div class="extrass-item-box" >
                            @if (!in_array('L', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >יחידת דיור</span>
                            @else  
                            <span class="v">✔</span>
                            <span>יחידת דיור</span>
                            @endif
                        </div>
                        
                       
                    </div>
                </div>
            </div>
        </div>

    </section>

<style>
    .text-gray{
        color:#999
    }

    #info_wrapper{
        background-color: white;
    }
    
    
    #info_container{
        margin: 20px;
        padding: 20px;
        background-color: #f9f9f9;
    }
    #info_container div{
        background-color: white;
        border-radius:10px;
        padding:20px 0;
    }
    #show_menu{
        padding-right: 0;
        background-color: white; 
        border-bottom:1px solid #eee;
        -webkit-box-shadow: 0 2px 6px -2px rgb(0 0 0 / 10%);
        box-shadow: 0 2px 6px -2px rgb(0 0 0 / 10%);

    }
    #show_menu li:first-child{
        border-bottom: 3px solid #ff7100;
        color: #ff7100;
    }
    #show_menu li{
        padding: 12px 36px
    }
    #show_menu li:hover{
        background-color: #f9f9f9;
        cursor: pointer;
    }


    .extrass-item-box{
        width: 25%;
        display: flex;
    }
    .extrass-item-box .xxx{
        padding: 5px 3px;
        font-size: 12px;
        background-color: #ccc;
        color: #999;
        margin-left: 10px;
        height: 18px;
        line-height: 10px;
        margin-top: 4px;
        font-weight: bolder;
    }
    .extrass-item-box .v{
    padding: 5px 3px;
    font-size: 12px;
    color: #ff7100;
    background-color: #fff1e5;
    margin-left: 10px;
    height: 18px;
    line-height: 10px;
    margin-top: 4px;
    font-weight: bolder;
}
    }
    
    

</style>


@endsection
