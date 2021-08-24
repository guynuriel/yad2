@foreach ($ads as $ad)
    <div class="single-ad-wrapper flex">
        <div id="min{{ $ad->id }}" onclick="toggle_ad_on_main__page({{ $ad->id }})"
            class="min-ad-wrapper flex">
            <div class="right_col flex">

                <div class="feed_image_container">
                    <div class="like-btn"></div>
                    @if (is_array($ad->images))
                        <div class="num_of_imgs displaynone">
                            @if ($ad->images[0][15] === 'v')
                                <i class="far fa-film text-white f18"> {{ count($ad->images)}}</i>
                            @else
                                <i class="far fa-images text-white f18"> {{ count($ad->images)}}</i>
                            @endif
                        </div>
                    @endif
                    <img class="feed_image" src="{{ (is_array( $ad->images)&&  $ad->images[0][15]!== 'v')? asset($ad->images[0]): asset('/images/upload/image_placeholder.png') }}">
                </div>

                <div class="addresses">
                    <p class="asset_address f16">{{ $ad->address_name }} {{ $ad->address_num }}</p>
                    <p><span class="asset_type f14">{{ $ad->asset_type }}</span>, <span
                            class="asset_neighborhood f14">{{ $ad->neighborhood }}</span>, <span
                            class="asset_city f14">{{ $ad->city }}</span></p>
                </div>
            </div>

            <div class="middle_col row">
                <div class="col-sm-4">
                    <span class="text-center m-0">{{ $ad->rooms }}</span>
                    <span class="text-center f14 color2">חדרים</span>
                </div>
                <div class="col-sm-4">
                    <span class="text-center m-0">{{ $ad->floor }}</span>
                    <span class="text-center f14 color2">קומה</span>
                </div>
                <div class="col-sm-4">
                    <span class="text-center m-0">{{ $ad->total_asset_size }}</span>
                    <span class="text-center f14 color2">מ"ר</span>
                </div>
            </div>

            <div class="left_col">

                <div class="text-left">
                    <a onclick="event.stopPropagation()" class="newtab_link color2" href="/ads/{{ $ad->id }}">
                        <span>פתיחה בטאב חדש</span>
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                </div>

                <div class=" text-left">
                    {{ $ad->price }} ₪
                </div>

                <div class="text-left f13 color2 update_at">
                    @if ( strtotime(date('d.m.Y')) === strtotime(date('d.m.y', strtotime( $ad->updated_at ))))
                    עודכן היום
                    @else                                    
                    {{ date('d/m/y', strtotime( $ad->updated_at )) }}
                    @endif
                </div>
                <div class="text-left f13 c-f-d">
                    לחצו לפרטים
                </div>

            </div>
        </div>


        {{-- /////////////////////////////////////////// --}}
        
        
        <div id="max{{ $ad->id }}" class="max-ad-wrapper col-sm-12 row ">
            
            <div onclick="toggle_ad_on_main__page({{ $ad->id }})" class="max-header click">
                <div class="right-col flex">
                    <div class="image_container">
                        <div class="pic">
                            @if (is_array($ad->images))
                                <div onclick="get_images(event);" class="num_of_imgs">
                                    @if ($ad->images[0][15] === 'v')
                                        <i ad_id="{{ $ad->id }}" class="far fa-film text-white f18"> {{ count($ad->images)}}</i>
                                    @else
                                        <i ad_id="{{ $ad->id }}" class="far fa-images text-white f18"> {{ count($ad->images)}}</i>
                                    @endif
                                </div>
                            @endif
                            <img ad_id="{{ $ad->id }}" onclick="get_images(event);" class="popup_images" src="{{ (is_array( $ad->images)&&  $ad->images[0][15]!== 'v')? asset($ad->images[0]): asset('/images/upload/image_placeholder.png') }}">
                        </div>
                    </div>
                    <div class="m-2">
                        <div>
                            <span class="asset_address f16">{{ $ad->address_name }}
                                {{ $ad->address_num }}</span>
                            <span class="mr-2 color4 click">
                                <i class="fas fa-map-marker-alt"></i>
                                מפה
                            </span>
                        </div>
                        <div>
                            <p><span class="asset_type f14">{{ $ad->asset_type }}</span>, <span
                                    class="asset_neighborhood f14">{{ $ad->neighborhood }}</span>, <span
                                    class="asset_city f14">{{ $ad->city }}</span></p>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="text-center m-0">{{ $ad->rooms }}</div>
                                <div class="text-center f14 ">חדרים</div>
                            </div>
                            <div class="col-sm-4">
                                <div class="text-center m-0">{{ $ad->floor }}</div>
                                <div class="text-center f14">קומה</div>
                            </div>
                            <div class="col-sm-4">
                                <div class="text-center m-0">{{ $ad->total_asset_size }}</div>
                                <div class="text-center f14">מ"ר</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="left-col text-left p-2">
                    <div class="mb-4">
                        <p class="mb-0">{{ $ad->price }} ₪</p>
                        <p class="color2">עודכן היום</p>
                    </div>
                    <div class="contact-seller-container">
                        <div name="{{ $ad->id }}" class="contact-seller-btn click text-white text-center">
                            <i class="fas fa-phone-alt text-white"></i> הצגת מספר טלפון
                        </div>
                        <div id="contact{{ $ad->id }}" class="contacts_dtl">
                            <div class="name">
                                {{ $ad->contacts['man1']['name'] }}
                            </div>
                            <hr>
                            <div class="number">
                                {{ $ad->contacts['man1']['code_num'] }}-{{ $ad->contacts['man1']['number'] }}
                            </div>
                            <hr>
                            <div class="mail">
                                <a href="mailto:{{ $ad->contacts['man1']['mail'] }}">שליחת דוא"ל למפרסם</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="row py-3 px-4">
            <div class="col-sm-12 mt-2">
                <p class="f14 color1"><b>תיאור הנכס</b></p>
                <p class="f14 color1">{{ $ad->about_the_asset }}</p>
            </div>
            <div class="col-sm-12 row">
                <div class="col-sm-6 f12 color1"> מצב הנכס <strong>{{ $ad->asset_condition }}</strong>
                </div>
                <div class="col-sm-6 f12 color1">תאריך כניסה <strong>
                    @if($ad->is_immediate_entry)
                    כניסה מיידית
                    @else
                    {{ $ad->entry_date ? $ad->entry_date : 'לא צוין תאריך כניסה' }}
                    @endif
                </strong> </div>
                <div class="col-sm-6 f12 color1">קומות בבניין <strong>{{ $ad->sum_of_floor }}</strong>
                </div>
                <div class="col-sm-6 f12 color1">מרפסות <strong>{{ $ad->porch }}</strong> </div>
                <div class="col-sm-6 f12 color1">חניות <strong>{{ $ad->parking_place }}</strong> </div>
            </div>
            <div class="col-sm-12 row extras">
                <p class="f14 col-sm-12 bold mt-3 color1">מה יש בנכס?</p>

                <div
                    class=" {{ !in_array('A', $ad->asset_extras) ? 'color3 col-sm-3 my-2' : 'col-sm-3 my-2' }} ">
                    <i class="fas fa-snowflake fa-lg"></i> <span class="f12">מיזוג</span>
                </div>

                <div
                    class=" {{ !in_array('B', $ad->asset_extras) ? 'color3 col-sm-3 my-2' : 'col-sm-3 my-2' }} ">
                    <i class="fas fa-th fa-lg"></i> <span class="f12">סורגים</span>
                </div>

                <div
                    class=" {{ !in_array('C', $ad->asset_extras) ? 'color3 col-sm-3 my-2' : 'col-sm-3 my-2' }} ">
                    <i class="fas fa-sort fa-lg"></i> <span class="f12">מעלית</span>
                </div>

                <div
                    class=" {{ !in_array('D', $ad->asset_extras) ? 'color3 col-sm-3 my-2' : 'col-sm-3 my-2' }} ">
                    <i class="fas fa-utensils fa-lg"></i> <span class="f12">מטבח כשר</span>
                </div>

                <div
                    class=" {{ !in_array('E', $ad->asset_extras) ? 'color3 col-sm-3 my-2' : 'col-sm-3 my-2' }} ">
                    <i class="fas fa-wheelchair fa-lg"></i> <span class="f12">גישה לנחים</span>
                </div>

                <div
                    class=" {{ !in_array('F', $ad->asset_extras) ? 'color3 col-sm-3 my-2' : 'col-sm-3 my-2' }} ">
                    <i class="fas fa-tools fa-lg"></i> <span class="f12">משופצת</span>
                </div>

                <div
                    class=" {{ !in_array('G', $ad->asset_extras) ? 'color3 col-sm-3 my-2' : 'col-sm-3 my-2' }} ">
                    <i class="fas fa-cube fa-lg"></i> <span class="f12">ממד</span>
                </div>

                <div
                    class=" {{ !in_array('H', $ad->asset_extras) ? 'color3 col-sm-3 my-2' : 'col-sm-3 my-2' }} ">
                    <i class="fas fa-archive fa-lg"></i> <span class="f12">מחסן</span>
                </div>

                <div
                    class=" {{ !in_array('I', $ad->asset_extras) ? 'color3 col-sm-3 my-2' : 'col-sm-3 my-2' }} ">
                    <i class="fas fa-door-closed fa-lg"></i> <span class="f12">דלתות פנדור</span>
                </div>

                <div
                    class=" {{ !in_array('J', $ad->asset_extras) ? 'color3 col-sm-3 my-2' : 'col-sm-3 my-2' }} ">
                    <i class="fas fa-wind fa-lg"></i> <span class="f12">מזגן תדיראן</span>
                </div>

                <div
                    class=" {{ !in_array('K', $ad->asset_extras) ? 'color3 col-sm-3 my-2' : 'col-sm-3 my-2' }} ">
                    <i class="fas fa-couch fa-lg"></i> <span class="f12">ריהוט</span>
                </div>

                <div
                    class=" {{ !in_array('L', $ad->asset_extras) ? 'color3 col-sm-3 my-2' : 'col-sm-3 my-2' }} ">
                    <i class="fas fa-home fa-lg"></i> <span class="f12">יחידת דיור</span>
                </div>
            </div>
        </div>
        </div>


    </div>


        {{-- ///////////////////// Mobile ///////////////////// --}}

    <a class="mobile_ad_wrapper" href="/ads/{{ $ad->id }}">
        <div class="mobile_ad">
            <div style="position: absolute; top: 10px; left: 10px;" >
                <p class="color2">
                    @if ( strtotime(date('d.m.Y')) === strtotime(date('d.m.y', strtotime( $ad->updated_at ))))
                        עודכן היום
                        @else                                    
                        {{ date('d/m/y', strtotime( $ad->updated_at )) }}
                    @endif
                </p>
            </div>
            <div style="width: 100%" class=" flex">
                <div class="center_content p-3" style="width: 200px;">
                    <img style="width: 100%;height:auto" src="{{ (is_array( $ad->images)&&  $ad->images[0][15]!== 'v')? asset($ad->images[0]): asset('/images/upload/image_placeholder.png') }}">
                </div>
                <div style="width: calc(100% - 200px);">
                    <div>
                        <p class="mb-0 mt-3">{{ $ad->price }} ₪</p>
                        <span class="asset_address f16">
                            {{ $ad->address_name }}
                            {{ $ad->address_num }}
                        </span>
    
                    </div>
                    <div>
                        <p class="mb-0">
                            <span class="asset_type f14">{{ $ad->asset_type }}</span>, <span
                                class="asset_neighborhood f14">{{ $ad->neighborhood }}</span>, <span
                                class="asset_city f14">{{ $ad->city }}
                            </span>
                        </p>
                    </div>
                    <hr class="my-1 mx-3">
                    <div style="width:100%" class="flex">
                        <div style="width: 33%" >
                            <div class="text-center m-0">{{ $ad->rooms }}</div>
                            <div class="text-center f14 ">חדרים</div>
                        </div>
                        <div style="width: 33%">
                            <div class="text-center m-0">{{ $ad->floor }}</div>
                            <div class="text-center f14">קומה</div>
                        </div>
                        <div style="width: 33%">
                            <div class="text-center m-0">{{ $ad->total_asset_size }}</div>
                            <div class="text-center f14">מ"ר</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
@endforeach
