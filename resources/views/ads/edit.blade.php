
@extends('layouts.main')

@section('content')

<section class="row">

    <div class="col-sm-3"></div>
    <div class="col-sm-6"  >
        
        <form style="display: grid;" action="/ads/{{ $ad->id }}" method="POST">
            
            @csrf
            @method('PUT')
            
            <label for="category">קטגוריה</label>
            <select name="category">
                <option value="{{ $ad->category }}" selected>{{ $ad->category }}</option>
                <option value="מכירה">מכירה</option>
                <option value="השכרה">השכרה</option>
                <option value="שותפים">שותפים</option>
                <option value="מסחרי">מסחרי</option>
            </select>
            

            <label for="asset type">סוג הנכס</label>
            <select  name="asset_type" id="" >

                <option value="{{ $ad->asset_type }}" selected>{{ $ad->asset_type }}</option>
                <option value="דירה">דירה</option>
                <option value="דירת גן">דירת גן</option>
                <option value="בית פרטי/קוטג">בית פרטי/קוטג</option>
                <option value="גג/פנטהאוז">גג/פנטהאוז</option>
                <option value="מגרשים">מגרשים</option>
                <option value="דופלקס">דופלקס</option>
                <option value="דירת נופש">דירת נופש</option>
                <option value="דו משפחתי">דו משפחתי</option>
                <option value="מרתף/פרטר">מרתף/פרטר</option>
                <option value="טריפלקס">טריפלקס</option>
                <option value="יחידת דיור">יחידת דיור</option>
                <option value="משק חקלאי/נחלה">משק חקלאי/נחלה</option>
                <option value="משק עזר">משק עזר</option>
                <option value="דיור מוגן">דיור מוגן</option>
                <option value="בניין מגורים">בניין מגורים</option>
                <option value="סטודיו/לופט">סטודיו/לופט</option>
                <option value="מחסן">מחסן</option>
                <option value="קב' רכישה/ זכות לנכס">קב' רכישה/ זכות לנכס</option>
                <option value="חניה">חניה</option>
                <option value="כללי">כללי</option>

            </select>
            
            <label for="asset_comdition">מצב הנכס</label>
            <select name="asset_condition" id="" >
                <option value="{{ $ad->asset_condition }}" selected>{{ $ad->asset_condition }}</option>
                <option value="חדש מקבלן"> חדש מקבלן (לא גרו בו בכלל)</option>
                <option value="חדש"> חדש (נכס בן עד 5 שנים)</option>
                <option value="משופץ"> משופץ (שופץ ב5 השנים האחרונות)</option>
                <option value="במצב שמור"> במצב שמור (במצב טוב, לא שופץ)</option>
                <option value="דרוש שיפוץ"> דרוש שיפוץ (זקוק לעבודת שיפוץ)</option>
            </select>
            
            <label for="city">עיר מגורים</label>
            <select name="city" id="">
                <option value="{{ $ad->city }}" selected>{{ $ad->city }}</option>
                <option value="תל אביב">תל-אביב</option>
                <option value="יהוד">יהוד</option>
                <option value="מגשימים">מגשימים</option>
            </select>
            
            <label for="address_name">רחוב</label>
            <select name="address_name" id="" >
                <option value="{{ $ad->address_name }}" selected>{{ $ad->address_name }}</option>
                <option value="רמז">רמז</option>
                <option value="ויצמן">ויצמן</option>
                <option value="הדס">הדס</option>
            </select>
            
            <label for="address_num">מס' בית</label>
            <input type="number" name="address_num" id="" value="{{ $ad->address_num }}">
            
            <label for="area">אזור</label>
            <input type="text" name="area" id=""  value="{{ $ad->area }}">
            
            <label for="neighborhood">שכונה</label>
            <input type="text" name="neighborhood" id=""  value="{{ $ad->neighborhood }}">
            
            <label for="flour">קומה</label>
            <input type="number" name="flour" id=""  value="{{ $ad->flour }}">
            
            <label for="entry_num">כניסה</label>
            <input type="number" name="entry_num" id=""  value="{{ $ad->entry_num }}">
            
            <label for="sum_of_flour">סה"כ קומות בבניין</label>
            <input type="number" name="sum_of_flour" id="" value="{{ $ad->sum_of_flour }}">
            
            <label for="is_on_pillars">האם הבניין על עמודים?</label>
            <input type="checkbox" name="is_on_pillars" id=""  {{ $ad->is_on_pillars ? 'checked' : "" }}>
                 

            <label for="parking_place">חניה</label>
            <select name="parking_place" id="">
                <option value="{{ $ad->parking_place }}" selected>{{ $ad->parking_place }}</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>


            <label for="rooms">מספר חדרים</label>
            <select name="rooms" id=""  value="{{ $ad->rooms }}">
                <option value="{{ $ad->rooms }}" selected>{{ $ad->rooms }}</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="1.5">1.5</option>
                <option value="2">2</option>
                <option value="2.5">2.5</option>
                <option value="3">3</option>
                <option value="3.5">3.5</option>
                <option value="4">4</option>
                <option value="4.5">4.5</option>
                <option value="5">5</option>
                <option value="5.5">5.5</option>
                <option value="6">6</option>
                <option value="6.5">6.5</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
            <label for="porch">מרפסת</label>
            <select name="porch" id=""  value="{{ $ad->porch }}">
                <option value="{{ $ad->porch }}" selected>{{ $ad->porch }}</option>
                <option value="0">ללא</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
            
            
            <label for="about_the_asset">אודות הנכס:</label>
            
            <textarea id="about_the_asset" name="about_the_asset" rows="4" cols="50"  >
                {{ $ad->about_the_asset }}
            </textarea>
            
            <fieldset>
                <label for="asset_extras">מה יש בנכס?</label>
                <input {{ !in_array('A', $ad->asset_extras) ? 'checked' : '' }} type="checkbox" name="asset_extras[]" value="A">מיזוג
                <input {{ !in_array('B', $ad->asset_extras) ? 'checked' : '' }} type="checkbox" name="asset_extras[]" value="B">סורגים
                <input {{ !in_array('C', $ad->asset_extras) ? 'checked' : '' }} type="checkbox" name="asset_extras[]" value="C">מעלית
                <input {{ !in_array('D', $ad->asset_extras) ? 'checked' : '' }} type="checkbox" name="asset_extras[]" value="D">מטבח כשר
                <input {{ !in_array('E', $ad->asset_extras) ? 'checked' : '' }} type="checkbox" name="asset_extras[]" value="E">גישה לנכים
                <input {{ !in_array('F', $ad->asset_extras) ? 'checked' : '' }} type="checkbox" name="asset_extras[]" value="F">משופצת
                <input {{ !in_array('G', $ad->asset_extras) ? 'checked' : '' }} type="checkbox" name="asset_extras[]" value="G">ממ"ד
                <input {{ !in_array('H', $ad->asset_extras) ? 'checked' : '' }} type="checkbox" name="asset_extras[]" value="H">מחסן
                <input {{ !in_array('I', $ad->asset_extras) ? 'checked' : '' }} type="checkbox" name="asset_extras[]" value="I">דלתות פנדור
                <input {{ !in_array('J', $ad->asset_extras) ? 'checked' : '' }} type="checkbox" name="asset_extras[]" value="J">מזגן תדיראן
                <input {{ !in_array('K', $ad->asset_extras) ? 'checked' : '' }} type="checkbox" name="asset_extras[]" value="K">ריהוט
                <input {{ !in_array('L', $ad->asset_extras) ? 'checked' : '' }} type="checkbox" name="asset_extras[]" value="L">יחידת דיור
            </fieldset>
            
            <label for="asset_size">גודל הנכס</label>
            <input type="number" name="asset_size" id=""  value="{{ $ad->asset_size }}">
            
            
            <label for="total_asset_size">גודל הנכס סה"כ</label>
            <input type="number" name="total_asset_size" id=""  value="{{ $ad->total_asset_size }}">
            
            
            <label for="price">מחיר</label>
            <input type="number" name="price" id=""  value="{{ $ad->price }}">
            
            
            
            
            <label for="entry_date">תאריך כניסה</label>
            <input type="date" name="entry_date" id=""  value="{{ $ad->entry_date }}">
            
            <label for="is_immediate_entry">האם הכניסה מיידית?</label>
            <input type="checkbox" name="is_immediate_entry"  id=""  {{ $ad->is_immediate_entry ? 'checked' : "" }}>
            
            
            
            <label>אנשי קשר</label>
            <input type="text" name="contact_name"  />
            <input type="text" name="contact_number" />
            
            <input type="submit" value="עדכן מודעה"/>
        </form>
        
        
    </div>
</section>
    
    @endsection
    
    
    {{-- $table->json('images'); --}}