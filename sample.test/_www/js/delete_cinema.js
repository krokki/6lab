jQuery('document').ready(function(){

    let del_btn = $(".delete_cinema");

    del_btn.on('click', function () {

        $('.delete_form').submit();

    });

});