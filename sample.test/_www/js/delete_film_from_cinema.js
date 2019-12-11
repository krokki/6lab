jQuery('document').ready(function(){

    let del_btn = $(".btn_del_f_f_c");

    del_btn.on("click", function () {

        let value = $(this).data('id');

        $('#id_film_delete').val(value);

        $('#delete_f_f_c').submit();

    })

});