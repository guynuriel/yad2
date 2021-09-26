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