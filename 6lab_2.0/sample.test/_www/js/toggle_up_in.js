jQuery('document').ready(function(){

    let btn = $(".toggle");
    btn.on("click", function () {

        $('.toggle_form').removeClass('active');

        let num = $(this).data('num');
        $('#tog_form'+num).addClass('active');
    });

});