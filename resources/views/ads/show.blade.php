@extends('layouts.yad2')

@section('content')

    <link href="{{ asset('css/show.css') }}" rel="stylesheet">

    <section  id="desktop_show" style="width:960px" class="center" >
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
                    <p style="padding-right: 2.5%;padding-left: 2.5%;">{{ $ad->about_the_asset }}</p>
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
                        <div class="mobile_extrass-item-box" >
                            @if (!in_array('A', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >מיזוג</span>
                            @else  
                            <span class="v">✔</span>
                            <span>מיזוג</span>
                            @endif
                        </div>
                        <div class="mobile_extrass-item-box" >
                            @if (!in_array('B', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >סורגים</span>
                            @else  
                            <span class="v">✔</span>
                            <span>סורגים</span>
                            @endif
                        </div>
                        <div class="mobile_extrass-item-box" >
                            @if (!in_array('C', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >מעלית</span>
                            @else  
                            <span class="v">✔</span>
                            <span>מעלית</span>
                            @endif
                        </div>
                        <div class="mobile_extrass-item-box" >
                            @if (!in_array('D', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >מטבח כשר</span>
                            @else  
                            <span class="v">✔</span>
                            <span>מטבח כשר</span>
                            @endif
                        </div>
                        <div class="mobile_extrass-item-box" >
                            @if (!in_array('E', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >גישה לנכים</span>
                            @else  
                            <span class="v">✔</span>
                            <span>גישה לנכים</span>
                            @endif
                        </div>
                        <div class="mobile_extrass-item-box" >
                            @if (!in_array('F', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >משופצת</span>
                            @else  
                            <span class="v">✔</span>
                            <span>משופצת</span>
                            @endif
                        </div>
                        <div class="mobile_extrass-item-box" >
                            @if (!in_array('G', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >ממ"ד</span>
                            @else  
                            <span class="v">✔</span>
                            <span>ממ"ד</span>
                            @endif
                        </div>
                        <div class="mobile_extrass-item-box" >
                            @if (!in_array('H', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >מחסן</span>
                            @else  
                            <span class="v">✔</span>
                            <span>מחסן</span>
                            @endif
                        </div>
                        <div class="mobile_extrass-item-box" >
                            @if (!in_array('I', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >דלתות פנדור</span>
                            @else  
                            <span class="v">✔</span>
                            <span>דלתות פנדור</span>
                            @endif
                        </div>
                        <div class="mobile_extrass-item-box" >
                            @if (!in_array('J', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >מזגן תדיראן</span>
                            @else  
                            <span class="v">✔</span>
                            <span>מזגן תדיראן</span>
                            @endif
                        </div>
                        <div class="mobile_extrass-item-box" >
                            @if (!in_array('K', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >ריהוט</span>
                            @else  
                            <span class="v">✔</span>
                            <span>ריהוט</span>
                            @endif
                        </div>
                        <div class="mobile_extrass-item-box" >
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









    <section  id="mobile_show" style="width:100%" class="center" >
        <div>
            <div class="flex">
                <span class="ml-auto mr-3 f12 color2" >{{ $ad->asset_type }} למכירה ב{{ $ad->city }}</span>
                <span class="mr-auto ml-3 f12 color2">
                    @if ( strtotime(date('d.m.Y')) === strtotime(date('d.m.y', strtotime( $ad->updated_at ))))
                    עודכן היום
                    @else                                    
                    {{ date('d/m/y', strtotime( $ad->updated_at )) }}
                    @endif    
                </span>
            </div>
            <div style="width:100%;height:400px" class="flex">
                <img style="width:100%;height:auto;max-height:400px;" src="{{ asset('images/upload/home.jpg') }}" alt="" >
            </div>
            <div style="box-shadow: 0 4px 5px 0 rgb(0 0 0 / 14%), 0 1px 10px 0 rgb(0 0 0 / 12%), 0 2px 4px 0 rgb(0 0 0 / 20%);;" class="m-auto flex">
               
                <div style="width:100%; padding:15px;" >
                    
                    <div class="mt-3" >
                        <p class="f24 color1">{{ $ad->price }}  ₪</p>
                    </div>

                    <div class="mt-2">
                        <p class="f24 color1"><strong>{{ $ad->address_name }} {{ $ad->address_num }}</strong></p>
                        <p class="f18 color1">{{ $ad->neighborhood }}, {{ $ad->city }}</p>
                    </div>

                    <div style="box-shadow: 0 3px 10px 0 rgb(0 0 0 / 10%);
                    border-radius: 4px;" class="flex">
                        <div class="flex" style="width: 33%">
                            <span class="m-auto" style="display: block;">
                                <div class="text-center f18 color1" >{{ $ad->rooms }}</div>                            
                                <div class="f16 color2" >חדרים</div>                            
                            </span>
                        </div>
                        <div class="flex" style="width: 33%">
                            <span class="m-auto" style="display: block;">
                                <div class="text-center f18 color1" >{{ $ad->floor }}</div>                            
                                <div class="f16 color2" >קומה</div>                            
                            </span>
                        </div>
                        <div class="flex" style="width: 33%">
                            <span class="m-auto" style="display: block;">
                                <div class="text-center f18 color1" >{{ $ad->asset_size }}</div>                            
                                <div class="f16 color2" >מ"ר</div>                            
                            </span>
                        </div>
                    </div>
                    

                    <div id="mobile_show_menu" class="mt-2">
                        <ul class="m-auto">
                            <li style="color: #ff7100; border-bottom: 3px solid #ff7100;">על הנכס</li>
                            <li>איך השכונה?</li>
                            <li>עסקאות באזור</li>
                            <li>בתי ספר וגני ילדים</li>
                            <li>איך השכנים?</li>
                            <li>תחבורה ציבורית</li>
                        </ul>
        
                    </div>

                </div>
            </div>
         

        </div>


        <div id="info_wrapper">
            

            <div id="mobile_info_container" >
                <div>                   
                    <p style="padding-right: 5%;padding-top:20px"><strong>על הנכס</strong></p>
                    <p style="padding-right: 5%">{{ $ad->about_the_asset }}</p>
                    <div class="flex p-1">
                        <div style="width: 90%;margin-right:5%" >
                            <div class="flex">
                                <span style="width: 50%" class="text-gray">מצב הנכס</span>
                                <span style="width: 50%"><strong>{{ $ad->asset_condition }}</strong></span>
                            </div>
                            <hr>
                        </div>
                        <div style="width: 90%; margin-right:5%" >
                            <div class="flex">
                                <span style="width: 50%" class="text-gray">תאריך כניסה</span>
                                <span style="width: 50%"><strong>{{ $ad->entry_date }}</strong></span>
                            </div>
                            <hr>
                        </div>
                        <div style="width: 90%;margin-right:5%" >
                            <div class="flex">
                                <span style="width: 50%" class="text-gray">קומות בבניין</span>
                                <span style="width: 50%"><strong>{{ $ad->sum_of_floor }}</strong></span>
                            </div>
                            <hr>
                        </div>
                        <div style="width: 90%; margin-right:5%" >
                            <div class="flex">
                                <span style="width: 50%" class="text-gray">חניות</span>
                                <span style="width: 50%"><strong>{{ $ad->parking_place == 0 ? 'ללא' :$ad->parking_place  }}</strong></span>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="px-5 pt-3 pb-5" >
                    <p><strong>מה יש בנכס?</strong></p>
                    <div class="flex">
                        <div class="mobile_extrass-item-box" >
                            @if (!in_array('A', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >מיזוג</span>
                            @else  
                            <span class="v">✔</span>
                            <span>מיזוג</span>
                            @endif
                        </div>
                        <div class="mobile_extrass-item-box" >
                            @if (!in_array('B', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >סורגים</span>
                            @else  
                            <span class="v">✔</span>
                            <span>סורגים</span>
                            @endif
                        </div>
                        <div class="mobile_extrass-item-box" >
                            @if (!in_array('C', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >מעלית</span>
                            @else  
                            <span class="v">✔</span>
                            <span>מעלית</span>
                            @endif
                        </div>
                        <div class="mobile_extrass-item-box" >
                            @if (!in_array('D', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >מטבח כשר</span>
                            @else  
                            <span class="v">✔</span>
                            <span>מטבח כשר</span>
                            @endif
                        </div>
                        <div class="mobile_extrass-item-box" >
                            @if (!in_array('E', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >גישה לנכים</span>
                            @else  
                            <span class="v">✔</span>
                            <span>גישה לנכים</span>
                            @endif
                        </div>
                        <div class="mobile_extrass-item-box" >
                            @if (!in_array('F', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >משופצת</span>
                            @else  
                            <span class="v">✔</span>
                            <span>משופצת</span>
                            @endif
                        </div>
                        <div class="mobile_extrass-item-box" >
                            @if (!in_array('G', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >ממ"ד</span>
                            @else  
                            <span class="v">✔</span>
                            <span>ממ"ד</span>
                            @endif
                        </div>
                        <div class="mobile_extrass-item-box" >
                            @if (!in_array('H', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >מחסן</span>
                            @else  
                            <span class="v">✔</span>
                            <span>מחסן</span>
                            @endif
                        </div>
                        <div class="mobile_extrass-item-box" >
                            @if (!in_array('I', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >דלתות פנדור</span>
                            @else  
                            <span class="v">✔</span>
                            <span>דלתות פנדור</span>
                            @endif
                        </div>
                        <div class="mobile_extrass-item-box" >
                            @if (!in_array('J', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >מזגן תדיראן</span>
                            @else  
                            <span class="v">✔</span>
                            <span>מזגן תדיראן</span>
                            @endif
                        </div>
                        <div class="mobile_extrass-item-box" >
                            @if (!in_array('K', $ad->asset_extras))
                            <span class="xxx">X</span>
                            <span style="color:#CCCCCC" >ריהוט</span>
                            @else  
                            <span class="v">✔</span>
                            <span>ריהוט</span>
                            @endif
                        </div>
                        <div class="mobile_extrass-item-box" >
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>

    <script>
        if($(window).width() > 880){
                $('#mobile_show').remove()
            }else{
                $('#desktop_show').remove()
        }
        </script>

@endsection
