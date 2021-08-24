
<section class="my-5">
    @if (session('message'))
        <p class="mssg text-center color4">{{ session('message') }}</p>
    @endif
    
    <div id="search_form_wrapper"
        class="m-auto flex form-group">

        <div class="flex" style="width: 100%;">
            <div class="ml-auto">
                <strong>
                    <span>איזה נכס ל<span class="color4">מכירה</span> תרצו לחפש?</span>
                </strong>
            </div>
            <div id="search_alert" class="mr-auto flex p-1">
                <i class="far fa-bell f16 h-center ml-1"></i>
                <span>קבלו התראה במייל על החיפוש</span>
            </div>

        </div>

        <style>
            #asset-type-ul-dd{
                padding: 5px;
                min-width: 150px;
                border: 1px solid rgba(0,0,0,.125);
                margin: 0;
                width: 300px;
            }

            #asset-type-ul-dd > li{
                margin-bottom: 5px;
                padding: 10px;
                background-color: #f9f9f9;
                list-style: none;
                position: relative;
            }
            #asset-type-ul-dd > li >i{
                position: absolute;
                left: 10px;
                top: 15px;
            }
            #asset-type-ul-dd > li > ul > li{
                padding: 10px 20px;
                border-bottom: 1px solid #eee;
                list-style: none;
            }
            .input_dropdown{
                background-color: white !important;
            }
            .search_btn_dd{
                background-color:white;
                border:1px solid #d0d5db; 
                border-radius:3px; 
                padding-top:5px;
                height:38px;
                color:#999
            }
        </style>


            <div class="flex">
                <div class="autocomplete" style="margin-left: 10px;">
                    <label class="f14" for="place">חפשו אזור, עיר, שכונה או רחוב</label>
                    <input value="{{ array_key_exists('city', $search_params) ? $search_params['city'] :'' }}" type="text" style="width: 175px" class="form-control" name="place"
                        id="city_search_autocomplete" placeholder="עיר מגורים" />
                </div>
                <div style="position: relative;margin-left:10px;">
                    <p style="margin-bottom: 8px">סוג הנכס</p>
                    <button class="click search_btn_dd" name="1">
                        בחרו סוגי נכס <i id="input1-icon" class="fas fa-chevron-down h-center"></i>
                    </button>
                    <div id="input_dropdown1" class="displaynone"
                        style="position: absolute;top:70px;background-color:white;width: max-content;z-index: 9999;">
                        <ul id="asset-type-ul-dd" >
                            <li><input id="search_asset_type_all" class="ml-1" type="checkbox" {{ array_key_exists('asset_type_all', $search_params) ? 'checked' :'' }} value="0"  /> כל סוגי הדירות</li>
                            <li><input id="search_asset_type1" class="ml-1 asset-type1" type="checkbox" value="1" {{ array_key_exists('asset_type1', $search_params) ? 'checked' :'' }} /> דירות <i onclick="search_dropdown_toggle(1,1)"
                                    id="input1-d1-icon1" class="fas fa-chevron-down h-center mr-1"></i> </li>
                            <li id="input1_dropdown1" class="displaynone input_dropdown">
                                <ul class="pr-0">
                                    @if (array_key_exists('assets_types', $search_params))
                                        <li><input {{ in_array('דירה', $search_params['assets_types']) ? 'checked' :'' }} name="search_asset_type[]" class="ml-1 asset-type1" type="checkbox" value="דירה" /> דירה</li>
                                        <li><input {{ in_array('דירת גן', $search_params['assets_types']) ? 'checked' :'' }} name="search_asset_type[]" class="ml-1 asset-type1" type="checkbox" value="דירת גן" /> דירת גן</li>
                                        <li><input {{ in_array('גג/פנטהאוז', $search_params['assets_types']) ? 'checked' :'' }} name="search_asset_type[]" class="ml-1 asset-type1" type="checkbox" value="גג/פנטהאוז" /> גג / פנטהאוז</li>
                                        <li><input {{ in_array('דופלקס', $search_params['assets_types']) ? 'checked' :'' }} name="search_asset_type[]" class="ml-1 asset-type1" type="checkbox" value="דופלקס" /> דופלקס</li>
                                        <li><input {{ in_array('דירת נופש', $search_params['assets_types']) ? 'checked' :'' }} name="search_asset_type[]" class="ml-1 asset-type1" type="checkbox" value="דירת נופש" /> דירת נופש</li>
                                        <li><input {{ in_array('מרתף/פרטר', $search_params['assets_types']) ? 'checked' :'' }} name="search_asset_type[]" class="ml-1 asset-type1" type="checkbox" value="מרתף/פרטר" /> מרתף/ פרטר</li>
                                        <li><input {{ in_array('טריפלקס', $search_params['assets_types']) ? 'checked' :'' }} name="search_asset_type[]" class="ml-1 asset-type1" type="checkbox" value="טריפלקס" /> טריפלקס</li>
                                        <li><input {{ in_array('יחידת דיור', $search_params['assets_types']) ? 'checked' :'' }} name="search_asset_type[]" class="ml-1 asset-type1" type="checkbox" value="יחידת דיור" /> יחידת דיור</li>
                                        <li><input {{ in_array('סטודיו/לופט', $search_params['assets_types']) ? 'checked' :'' }} name="search_asset_type[]" class="ml-1 asset-type1" type="checkbox" value="סטודיו/לופט" /> סטודיו / לופט</li>
                                    @else
                                        <li><input name="search_asset_type[]" class="ml-1 asset-type1" type="checkbox" value="דירה" /> דירה</li>
                                        <li><input name="search_asset_type[]" class="ml-1 asset-type1" type="checkbox" value="דירת גן" /> דירת גן</li>
                                        <li><input name="search_asset_type[]" class="ml-1 asset-type1" type="checkbox" value="גג/פנטהאוז" /> גג / פנטהאוז</li>
                                        <li><input name="search_asset_type[]" class="ml-1 asset-type1" type="checkbox" value="דופלקס" /> דופלקס</li>
                                        <li><input name="search_asset_type[]" class="ml-1 asset-type1" type="checkbox" value="דירת נופש" /> דירת נופש</li>
                                        <li><input name="search_asset_type[]" class="ml-1 asset-type1" type="checkbox" value="מרתף/פרטר" /> מרתף/ פרטר</li>
                                        <li><input name="search_asset_type[]" class="ml-1 asset-type1" type="checkbox" value="טריפלקס" /> טריפלקס</li>
                                        <li><input name="search_asset_type[]" class="ml-1 asset-type1" type="checkbox" value="יחידת דיור" /> יחידת דיור</li>
                                        <li><input name="search_asset_type[]" class="ml-1 asset-type1" type="checkbox" value="סטודיו/לופט" /> סטודיו / לופט</li>
                                    @endif
                                </ul>
                            </li>
                            <li><input id="search_asset_type2" class="ml-1 asset-type2" type="checkbox" value="2" {{ array_key_exists('asset_type2', $search_params) ? 'checked' :'' }} /> בתים <i onclick="search_dropdown_toggle(1,2)"
                                    id="input1-d2-icon2" class="fas fa-chevron-down h-center mr-1"></i> </li>
                            <li id="input1_dropdown2" class="displaynone input_dropdown">
                                <ul class="pr-0">
                                    @if (array_key_exists('assets_types', $search_params))
                                        <li><input {{ in_array('בית פרטי/קוטג', $search_params['assets_types']) ? 'checked' :'' }} name="search_asset_type[]" class="ml-1 asset-type2" type="checkbox" value="בית פרטי/קוטג" /> בית פרטי/קוטג'</li>
                                        <li><input {{ in_array('דו משפחתי', $search_params['assets_types']) ? 'checked' :'' }} name="search_asset_type[]" class="ml-1 asset-type2" type="checkbox" value="דו משפחתי" /> דו משפחתי</li>
                                        <li><input {{ in_array('משק חקלאי/נחלה', $search_params['assets_types']) ? 'checked' :'' }} name="search_asset_type[]" class="ml-1 asset-type2" type="checkbox" value="משק חקלאי/נחלה" /> משק חקלאי/נחלה</li>
                                        <li><input {{ in_array('משק עזר', $search_params['assets_types']) ? 'checked' :'' }} name="search_asset_type[]" class="ml-1 asset-type2" type="checkbox" value="משק עזר" /> משק עזר</li>
                                    @else
                                        <li><input name="search_asset_type[]" class="ml-1 asset-type2" type="checkbox" value="בית פרטי/קוטג" /> בית פרטי/קוטג'</li>
                                        <li><input name="search_asset_type[]" class="ml-1 asset-type2" type="checkbox" value="דו משפחתי" /> דו משפחתי</li>
                                        <li><input name="search_asset_type[]" class="ml-1 asset-type2" type="checkbox" value="משק חקלאי/נחלה" /> משק חקלאי/נחלה</li>
                                        <li><input name="search_asset_type[]" class="ml-1 asset-type2" type="checkbox" value="משק עזר" /> משק עזר</li>
                                    @endif
                                </ul>
                            </li>
                            <li><input id="search_asset_type3" class="ml-1 asset-type3" type="checkbox" value="3" {{ array_key_exists('asset_type3', $search_params) ? 'checked' :'' }} /> סוגים נוספים <i
                                    onclick="search_dropdown_toggle(1,3)" id="input1-d3-icon3"
                                    class="fas fa-chevron-down h-center mr-1"></i></li>
                            <li id="input1_dropdown3" class="displaynone input_dropdown">
                                <ul class="pr-0">
                                    @if (array_key_exists('assets_types', $search_params))
                                        <li><input {{ in_array('מגרשים', $search_params['assets_types']) ? 'checked' :'' }} name="search_asset_type[]" class="ml-1 asset-type3" type="checkbox" value="מגרשים" /> מגרשים</li>
                                        <li><input {{ in_array('דיור מוגן', $search_params['assets_types']) ? 'checked' :'' }} name="search_asset_type[]" class="ml-1 asset-type3" type="checkbox" value="דיור מוגן" /> דיור מוגן</li>
                                        <li><input {{ in_array('בניין מגורים', $search_params['assets_types']) ? 'checked' :'' }} name="search_asset_type[]" class="ml-1 asset-type3" type="checkbox" value="בניין מגורים" /> בניין מגורים</li>
                                        <li><input {{ in_array('מחסן', $search_params['assets_types']) ? 'checked' :'' }} name="search_asset_type[]" class="ml-1 asset-type3" type="checkbox" value="מחסן" /> מחסן</li>
                                        <li><input {{ in_array('חניה', $search_params['assets_types']) ? 'checked' :'' }} name="search_asset_type[]" class="ml-1 asset-type3" type="checkbox" value="חניה" /> חניה</li>
                                        <li><input {{ in_array("קב' רכישה/זכות לנכס", $search_params['assets_types']) ? 'checked' :'' }} name="search_asset_type[]" class="ml-1 asset-type3" type="checkbox" value="קב' רכישה/זכות לנכס" /> קב' רכישה/זכות לנכס</li>
                                        <li><input {{ in_array('כללי', $search_params['assets_types']) ? 'checked' :'' }} name="search_asset_type[]" class="ml-1 asset-type3" type="checkbox" value="כללי" /> כללי</li>
                                    @else
                                        <li><input name="search_asset_type[]" class="ml-1 asset-type3" type="checkbox" value="מגרשים" /> מגרשים</li>
                                        <li><input name="search_asset_type[]" class="ml-1 asset-type3" type="checkbox" value="דיור מוגן" /> דיור מוגן</li>
                                        <li><input name="search_asset_type[]" class="ml-1 asset-type3" type="checkbox" value="בניין מגורים" /> בניין מגורים</li>
                                        <li><input name="search_asset_type[]" class="ml-1 asset-type3" type="checkbox" value="מחסן" /> מחסן</li>
                                        <li><input name="search_asset_type[]" class="ml-1 asset-type3" type="checkbox" value="חניה" /> חניה</li>
                                        <li><input name="search_asset_type[]" class="ml-1 asset-type3" type="checkbox" value="קב' רכישה/זכות לנכס" /> קב' רכישה/זכות לנכס</li>
                                        <li><input name="search_asset_type[]" class="ml-1 asset-type3" type="checkbox" value="כללי" /> כללי</li>
                                    @endif
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div style="position: relative;margin-left :10px;">
                    <p style="margin-bottom: 8px">חדרים</p>
                    <button class="click search_btn_dd" name="2">
                        חדרים <i id="input2-icon" class="fas fa-chevron-down h-center"></i>
                    </button>
                    <div id="input_dropdown2" class="displaynone"
                        style="position: absolute;top:70px;right:-60px;background-color:white;width: max-content;z-index: 9999;padding: 15px; box-shadow: 0 2px 6px 0 rgb(0 0 0 / 10%);width: 182px;height: 60px;">
                        <div class="flex">

                            <div style="border: 1px solid #ccc;border-radius: 1px;">

                                <input {{ array_key_exists('rooms1', $search_params) ? 'value='.$search_params["rooms1"] :'' }} placeholder="מ-" id="search-rooms1" list="rooms1" style="width:72px; outline: none;border: 0;">
                                <datalist  id="rooms1" style="width:75px;">
                                    <option value="1">
                                    <option value="1.5">
                                    <option value="2">
                                    <option value="2.5">
                                    <option value="3">
                                    <option value="4.5">
                                    <option value="5">
                                    <option value="5.5">
                                    <option value="6">
                                    <option value="6.5">
                                    <option value="7">
                                    <option value="7.5">
                                    <option value="8">
                                    <option value="8.5">
                                    <option value="9">
                                    <option value="9.5">
                                    <option value="10">
                                    <option value="10.5">
                                    <option value="11">
                                    <option value="11.5">
                                    <option value="12">

                                </datalist>

                            </div>

                            <div style="border: 1px solid #ccc;border-radius: 1px;width:75px;">

                                <input {{ array_key_exists('rooms2', $search_params) ? 'value='.$search_params["rooms2"] :'' }} placeholder="עד-" list="rooms2" id="search-rooms2" style="width:72px; outline: none;border: 0;">
                                <datalist id="rooms2" style="width:75px;">
                                    <option value="1">
                                    <option value="1.5">
                                    <option value="2">
                                    <option value="2.5">
                                    <option value="3">
                                    <option value="4.5">
                                    <option value="5">
                                    <option value="5.5">
                                    <option value="6">
                                    <option value="6.5">
                                    <option value="7">
                                    <option value="7.5">
                                    <option value="8">
                                    <option value="8.5">
                                    <option value="9">
                                    <option value="9.5">
                                    <option value="10">
                                    <option value="10.5">
                                    <option value="11">
                                    <option value="11.5">
                                    <option value="12">

                                </datalist>

                            </div>

                        </div>
                    </div>
                </div>
                <div style="width: 200px;margin-left:10px;">
                    <p style="margin-bottom: 8px">מחיר</p>
                    <div class="flex">
                        <input {{ array_key_exists('price1', $search_params) ? 'value='.$search_params["price1"] :'' }} id="search-price1" type="text" style="width: 50%" class="form-control" name="start-price"
                            placeholder="ממחיר" />
                        <input {{ array_key_exists('price2', $search_params) ? 'value='.$search_params["price2"] :'' }} type="text" id="search-price2" style="width: 50%" class="form-control" name="stop-price"
                            placeholder="עד מחיר" />
                    </div>
                </div>
                <div style="padding-top: 33px; margin-left:10px;">
                    <div  onclick="advancedSearch()" id="plus-search-btn" class="click">
                        <i style="border: 1px solid black;border-radius:50%;padding:1px;" class="fas fa-plus"></i>
                        <span  class="f14">חיפוש מתקדם</span>
                    </div>
                </div>
                <div style="padding-top: 33px;">
                    <div onclick="searchAndSort()" id="search-btn" class="click">
                        <i class="fas fa-search text-white"></i>
                        <span class="f14">חיפוש</span>
                    </div>
                </div>

            </div>
    </div>

    <div id="advancedSearch" class="m-auto form-group displaynone">

        <div>
            <div><p><strong>מאפייני דירה</strong></p></div>
            <div id="search-extras-wrapper" class="row">
                @if (array_key_exists('extras', $search_params))
                    <div class="col-sm-3 mb-1" ><input class="ml-1" type="checkbox" name="asset_extras[]"  value="A"  {{ in_array('A', $search_params['extras']) ? 'checked' :'' }} >מיזוג</div>
                    <div class="col-sm-3 mb-1" ><input class="ml-1" type="checkbox" name="asset_extras[]"  value="B"  {{ in_array('B', $search_params['extras']) ? 'checked' :'' }} >סורגים</div>
                    <div class="col-sm-3 mb-1" ><input class="ml-1" type="checkbox" name="asset_extras[]"  value="C"  {{ in_array('C', $search_params['extras']) ? 'checked' :'' }} >מעלית</div>
                    <div class="col-sm-3 mb-1" ><input class="ml-1" type="checkbox" name="asset_extras[]"  value="D"  {{ in_array('D', $search_params['extras']) ? 'checked' :'' }} >מטבח כשר</div>
                    <div class="col-sm-3 mb-1" ><input class="ml-1" type="checkbox" name="asset_extras[]"  value="E"  {{ in_array('E', $search_params['extras']) ? 'checked' :'' }} >גישה לנכים</div>
                    <div class="col-sm-3 mb-1" ><input class="ml-1" type="checkbox" name="asset_extras[]"  value="F"  {{ in_array('F', $search_params['extras']) ? 'checked' :'' }} >משופצת</div>
                    <div class="col-sm-3 mb-1" ><input class="ml-1" type="checkbox" name="asset_extras[]"  value="G"  {{ in_array('G', $search_params['extras']) ? 'checked' :'' }} >ממ"ד</div>
                    <div class="col-sm-3 mb-1" ><input class="ml-1" type="checkbox" name="asset_extras[]"  value="H"  {{ in_array('H', $search_params['extras']) ? 'checked' :'' }} >מחסן</div>
                    <div class="col-sm-3 mb-1" ><input class="ml-1" type="checkbox" name="asset_extras[]"  value="I"  {{ in_array('I', $search_params['extras']) ? 'checked' :'' }} >דלתות פנדור</div>
                    <div class="col-sm-3 mb-1" ><input class="ml-1" type="checkbox" name="asset_extras[]"  value="J"  {{ in_array('J', $search_params['extras']) ? 'checked' :'' }} >מזגן תדיראן</div>
                    <div class="col-sm-3 mb-1" ><input class="ml-1" type="checkbox" name="asset_extras[]"  value="K"  {{ in_array('K', $search_params['extras']) ? 'checked' :'' }} >ריהוט</div>
                    <div class="col-sm-3 mb-1" ><input class="ml-1" type="checkbox" name="asset_extras[]"  value="L"  {{ in_array('L', $search_params['extras']) ? 'checked' :'' }} >יחידת דיור</div>
                @else
                    <div class="col-sm-3 mb-1" ><input class="ml-1" type="checkbox" name="asset_extras[]" value="A">מיזוג</div>
                    <div class="col-sm-3 mb-1" ><input class="ml-1" type="checkbox" name="asset_extras[]" value="B">סורגים</div>
                    <div class="col-sm-3 mb-1" ><input class="ml-1" type="checkbox" name="asset_extras[]" value="C">מעלית</div>
                    <div class="col-sm-3 mb-1" ><input class="ml-1" type="checkbox" name="asset_extras[]" value="D">מטבח כשר</div>
                    <div class="col-sm-3 mb-1" ><input class="ml-1" type="checkbox" name="asset_extras[]" value="E">גישה לנכים</div>
                    <div class="col-sm-3 mb-1" ><input class="ml-1" type="checkbox" name="asset_extras[]" value="F">משופצת</div>
                    <div class="col-sm-3 mb-1" ><input class="ml-1" type="checkbox" name="asset_extras[]" value="G">ממ"ד</div>
                    <div class="col-sm-3 mb-1" ><input class="ml-1" type="checkbox" name="asset_extras[]" value="H">מחסן</div>
                    <div class="col-sm-3 mb-1" ><input class="ml-1" type="checkbox" name="asset_extras[]" value="I">דלתות פנדור</div>
                    <div class="col-sm-3 mb-1" ><input class="ml-1" type="checkbox" name="asset_extras[]" value="J">מזגן תדיראן</div>
                    <div class="col-sm-3 mb-1" ><input class="ml-1" type="checkbox" name="asset_extras[]" value="K">ריהוט</div>
                    <div class="col-sm-3 mb-1" ><input class="ml-1" type="checkbox" name="asset_extras[]" value="L">יחידת דיור</div>
                @endif
            </div>
        </div>

        <hr>
        
        <div class="row" >
            <div class="col-sm-4">
                <p>קומה</p>
                <div class="flex">
                    <div style="border: 1px solid #ccc;border-radius: 1px; width:45%; margin-left:5px;">

                        <input id="search-floor1" {{ array_key_exists('floor1', $search_params) ? 'value='.$search_params["floor1"] :'' }} placeholder="מ-" list="search_list_floor1" class="form-control">
                        <datalist id="search_list_floor1" style="width:75px;">
                            <option value="1">
                            <option value="1.5">
                            <option value="2">
                            <option value="2.5">
                            <option value="3">
                            <option value="4.5">
                            <option value="5">
                            <option value="5.5">
                            <option value="6">
                            <option value="6.5">
                            <option value="7">
                            <option value="7.5">
                            <option value="8">
                            <option value="8.5">
                            <option value="9">
                            <option value="9.5">
                            <option value="10">
                            <option value="10.5">
                            <option value="11">
                            <option value="11.5">
                            <option value="12">
                        </datalist>

                    </div>
                    <div style="border: 1px solid #ccc;border-radius: 1px; width:45%;">

                        <input id="search-floor2" {{ array_key_exists('floor2', $search_params) ? 'value='.$search_params["floor2"] :'' }}
                         list="search_list_floor1" placeholder="עד-" class="form-control">
                        <datalist id="search_list_floor1" style="width:75px;">
                            <option value="1">
                            <option value="1.5">
                            <option value="2">
                            <option value="2.5">
                            <option value="3">
                            <option value="4.5">
                            <option value="5">
                            <option value="5.5">
                            <option value="6">
                            <option value="6.5">
                            <option value="7">
                            <option value="7.5">
                            <option value="8">
                            <option value="8.5">
                            <option value="9">
                            <option value="9.5">
                            <option value="10">
                            <option value="10.5">
                            <option value="11">
                            <option value="11.5">
                            <option value="12">

                        </datalist>

                    </div>

                </div>
            </div>

            <div class="col-sm-3">
                <p>גודל דירה (במ"ר)</p>
                <div class="flex">
                    <input {{ array_key_exists('asset_size1', $search_params) ? 'value='.$search_params["asset_size1"] :'' }} id="search-asset_size1" type="text" style="width: 45%; margin-left: 5px" class="form-control"
                        placeholder="מ-" />

                    <input {{ array_key_exists('asset_size2', $search_params) ? 'value='.$search_params["asset_size2"] :'' }} id="search-asset_size2" type="text" style="width: 45%" class="form-control"
                        placeholder="עד-" />
                </div>
            </div>

            <div class="col-sm-3">
                <p>תאריך כניסה</p>
                <div class="flex">
                    <input {{ array_key_exists('entry_date', $search_params) ? 'value='.$search_params["entry_date"] :'' }} id="search-entry_date" type="text" class="form-control"
                        value="החל מ- הזינו תאריך" onfocus="(this.type='date')" />

                </div>
            </div>
            
            <div class="col-sm-2 flex" style="align-self: center; padding-top:40px;">
                
                <input {{ array_key_exists('entry_now', $search_params) ? 'checked' :'' }} id="search-entry_now" style="margin-left: 5px" type="checkbox" name="entry"> כניסה מיידית
            </div>
        </div>
        
        <hr>
        <div>
            <p>חיפוש חופשי</p>
            <textarea name="" id="" cols="30" rows="2"></textarea>
        </div>
        <hr>
        <div class="flex p-2">
            <button onclick="searchAndSort()" class="px-4 py-2" style="background-color:#ff7100; margin:auto; border:0">
                <strong style="color: white" >חיפוש</strong>
            </button>
            <span style="z-index: 999" class="click"><a class="color1 f13" href="/">נקה</a></span>
        </div>
    </div>      
    
    
    
    
</section>