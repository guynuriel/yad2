$( document ).ready(function() {
    // Handler for .ready() called.

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
        $('#mobile_feed').empty()
    }else{
        $('#desktop_feed').empty()
    }
}); 




function toggle_ad_on_main__page(id){

    $('#max'+id).toggle()
    $('#min'+id).toggle()

}

$('.contact-seller-btn').click (function(e){
    e.stopPropagation();
    let id = e.target.attributes.name.value
    $('#contact'+id).toggle('slide');
})

