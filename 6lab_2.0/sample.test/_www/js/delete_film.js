jQuery('document').ready(function(){

          let btn = $(".btn_del_film");
          btn.on("click", function () {

          let value = $(this).data('id');

          $('#input_film_del').val(value);

          $('#del-film-form').submit();

     })

});