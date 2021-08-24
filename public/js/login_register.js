
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