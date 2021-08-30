$( document ).ready(function() {

    // make it as accordion for smaller screens
    if (window.innerWidth > 1400) {
    
        document.querySelectorAll('.navbar .nav-item').forEach(function(nav_dd){
    
            nav_dd.addEventListener('mouseover', function(e){
    
                let el_link = this.querySelector('a[data-bs-toggle]');
    
                if(el_link != null){
                    let nextEl = el_link.nextElementSibling;
                    el_link.classList.add('show');
                    nextEl.classList.add('show');
                }
    
            });
            nav_dd.addEventListener('mouseleave', function(e){
                let el_link = this.querySelector('a[data-bs-toggle]');
    
                if(el_link != null){
                    let nextEl = el_link.nextElementSibling;
                    el_link.classList.remove('show');
                    nextEl.classList.remove('show');
                }
    
    
            })
        });
    
    }
    if($(window).width() > 880){
        $('.mobile_ad_wrapper').hide()
        $('.mobile_ad_wrapper').remove()
    }else{
        $('.single-ad-wrapper').hide()
        $('.single-ad-wrapper').remove()
    }
}); 



function toggle_ad_on_main__page(id){

    $('#max'+id).toggle()
    $('#min'+id).toggle()

}

$('.contact-seller-btn').click (function(e){
    e.stopPropagation();
    let id = e.target.attributes.name.value
    console.log(id);
    $('#contact'+id).toggle('slide');
})

var isMoreAds = true;
// -------   pagination
function infiniteScrollPagination(page) {

    if (window.isMoreAds) {
        // check if exists params in the url and add them to the ajax
        let urlSearchParams = new URLSearchParams(window.location.search);
        let params = Object.fromEntries(urlSearchParams.entries());
        let url = '?page=' + page;
        if (params) {
            for (let key in params) {
                if (params.hasOwnProperty(key)&& params[key]!='' ) {
                    url += "&" + key + "=" + params[key];
                }
            }
        }
        $.ajax({
            url: url,
            type: 'GET',
            beforeSend: function() {
                $('#ajax-load').show();
            },
            success: function(ads) {
                if (ads.html == "") {
                    $('#ajax-load').html("אין מודעות נוספות");
                    $('#ajax-load').css("display", "block");
                    window.isMoreAds = false;
                    return;
                }
                setTimeout(function() {
                    $('#ajax-load').hide();
                }, 2000);
                $('.feed_items').append(ads.html);
                if ($(window).width() > 880) {
                    $('.mobile_ad_wrapper').remove()
                } else {
                    $('.single-ad-wrapper').remove()
                }

            },
            error: function(jqXHR) {
                $('#ajax-load').html("טעינת מודעות נוספות נכשלה")
            },
        })

    } else {
        $('#ajax-load').css("display", "block");
    }
}

var page = 1;

$(window).scroll(function () {
    if (($(window).scrollTop() + $(window).height()) >= $(document).height()) {
        page++;
        infiniteScrollPagination(page);

    }
})

// -------- popupimages funcs
function get_images(e) {
    e.stopPropagation();
    let id = e.target.getAttribute('ad_id')
    
    $.ajax({
        url: 'http://127.0.0.1:8000/ajax/popupimgs',
        type: 'GET',
        data: {
            id: id
        },
        success: function(res) {
            let src;
            if (res.result) {
                for(let i = 0 ; i < res.result.length ; i++){
                    src = res.result[i];
                    let num = i+1;
                    if(src[15] === 'v')
                        $(".slideshow-container").append(' <div class="mySlides"><video class="swiper_video" controls><source src="'+ src +'" type="video/mp4"> </video><div class="numbertext fade">תמונה '+ num +' מתוך ' + res.result.length+ '</div></div>')
                    else
                        $(".slideshow-container").append(' <div class="mySlides"><img src="'+ src +'"><div class="numbertext fade">תמונה '+ num +' מתוך ' + res.result.length+ '</div></div>')
                }
                
                window.showSlides(1);
                $("#images_popup").toggle();
            }

        },
        error: function(jqXHR) {
            alert("טעינת תמונות נכשלה")
        },
        complete: function() {

        }
    })
}


$("#container").click(function(e) {
    e.stopPropagation();
});
$(".carousel-control-prev-icon").click(function(e) {
    e.stopPropagation();
});

$("#images_popup").click(function() {
    $("#images_popup").hide();
    $(".slideshow-container").empty();
    $(".slideshow-container").html('<a class="prev" onclick="plusSlides(-1)">&#10094;</a><a class="next" onclick="plusSlides(1)">&#10095;</a>');
});

function redirectTo(url){
    window.location.href = url;
}