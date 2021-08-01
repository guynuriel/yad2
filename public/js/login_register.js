// $("#login_submit").click(function(){
//     console.log('')
//     let valid = true;
//     let res = true;

//     res = IsEmpty($("#login_password"),'password')
//     if(!res)
//         valid = false
//     res = IsEmpty($("#login_password"),'email')
//     if(!res)
//         valid = false
//     res = validate_email($("#login_email"))
//     if(!res)
//         valid = false
//     res = validatePassword($("#login_password"));
//     if(!res)
//         valid = false

//     if(valid)
//         $("#login_form").submit();
// })


// function validatePassword(fld) {
//     var error = "";
//     var illegalChars = /[\W_]/; // allow only letters and numbers
 
//     if (fld.val() == "") {
//         fld.css('background', 'Yellow');
//         error = "You didn't enter a password.\n";
//         alert(error);
//         return false;
 
//     } else if ((fld.val().length < 7) || (fld.val().length > 15)) {
//         error = "The password is the wrong length. \n";
//         fld.css('background', 'Yellow');
//         alert(error);
//         return false;
 
//     } else if (illegalChars.test(fld.val())) {
//         error = "The password contains illegal characters.\n";
//         fld.css('background', 'Yellow');
//         alert(error);
//         return false;
 
//     } else if ( (fld.val().search(/[a-zA-Z]+/)==-1) || (fld.val().search(/[0-9]+/)==-1) ) {
//         error = "The password must contain at least one numeral.\n";
//         fld.css('background', 'Yellow');
//         alert(error);
//         return false;
 
//     } else {
//         fld.css('background', 'White');
//     }
//    return true;
// }


// function validate_email(field)
// {
//     with (field)
//     {
//         apos=val().indexOf("@");
//         dotpos=val().lastIndexOf(".");
//         if (apos<1||dotpos-apos<2){
//             alert('המייל שהוזן אינו תקין');return false;
//         }
//         else {
//             return true;
//         }
//     }
// }

// function IsEmpty(objectfield,stringfield)
// {
//     objectvalue = objectfield.val().length;
//     if(objectvalue=="")
//     {
//         alert("Oops.. Please fill out the value of "+stringfield);
//         objectfield.css('background', 'Yellow');
//         return false;
//     }
//     else
//         return true;
// }




$('.popup_wrapper2').click(function(e){
    e.stopPropagation() 
    let father = $(this).parent()
    hidePopup(father)
})

$('.hide_popup_btn').click(function(e){
    e.stopPropagation() 
    let popup = $(this).closest('.popup_wrapper1');
    hidePopup(popup)
})
$('.popup_content').click(function(e){
    e.stopPropagation() 
})


function switchPopup(popup1,popup2){
    sessionStorage.removeItem("form");
    $('#'+popup1).hide();
    $('#'+popup2).show('slide');
    sessionStorage.setItem("form", popup2);

}


function hidePopup(popup){
    sessionStorage.removeItem("form");
    popup.hide('slide');
}

function showPopup(id){
    if(sessionStorage.getItem("form"))
        sessionStorage.removeItem("form");

    sessionStorage.setItem("form", id);
    $('#'+id).show('slide');
}