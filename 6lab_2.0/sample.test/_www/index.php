<?php
session_start();

$table = "films";

require ('db_connect.php');
require_once ('functions.php');
require_once ('modules/delete_film.php');
require_once ('modules/add_film.php');

$data = show($connection, $table);
?>


<!DOCTYPE html>
<html>
<head>
	<title>Фильмы</title>

<meta charset="utf-8">

    <script type="text/javascript" src="js/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/css_main.css">

</head>
<body>


<div class="container-fluid" id="Header">
    <div class="row justify-content-around" id="find_str">

        <div class="col logo_div" style="display: inline"> <a href="index.php" class="logo_text"> <b>КиноЛента</b> </a> </div>

         <div class="col-5">
            <form method="post" action="searching_results.php" style="width: inherit; display:inline">
                <div class="input-group col" id="search">
                    <input type="text" name="find_str" id="form_search" style="display:inline" class="form-control" placeholder="Название фильма,сериала...">
                    <div class="input-group-append" style="display:inline">
                        <button type="submit" class="btn btn-outline-secondary btn_icon" id="search_btn">
                            <img src="img/favicon/search_icon.png" id="search_favicon">
                        </button>
                    </div>
                </div>
            </form>
         </div>

        <div class="col" id="btn_login">

    <?php if(isset($_SESSION['login'])){?><a class="text_decor_none online_user" href="profile.php"> <?php echo $_SESSION['login'] ?></a><?php }?>
    <?php if(!(isset($_SESSION['login']))){?><a class="text_decor_none" id="login_text" href="login.php"> <?php echo "Войти";?></a><?php }?>

        </div>

        </div>

</div>

<div class="cont_up">

        <div class="container col-10" id="cont">

                   <div class="row justify-content-center align-items-center" style="width: inherit; margin: 0">
                              <div class="col-6">

                                  <?php if(isset($fmsg)){?> <div class="col alert-warning"> <?php echo $fmsg; ?> </div> <?php } ?>

                                   <form class="valid-form" id="main_form" action="index.php" method="post" enctype="multipart/form-data">

                                       <input type="text" id="film" name="namefilm" class="form-control valid-input" placeholder="NameFilm">
                                       <input type="text" id="year" name="year" class="form-control valid-input num-input" placeholder="Year">
                                       <input type="text" id="genre" name="genre" class="form-control valid-input" placeholder="Genre">
                                       <input type="text" id="age" name="age" class="form-control valid-input" placeholder="Age">
                                       <input type="text" id="country" name="country" class="form-control valid-input" placeholder="Country">
                                       <input type="file" name="image" class="form-control-file file-style" id="file_input">
                                       <button type="submit" id="btn-submit" class="valid-btn btn">Add film</button>
                                   </form>
                               </div>

                       <a class="valid-btn btn" id="btn-submit" href="cinema.php">Show cinema</a>

                   </div>

                   <div class="row justify-content-center" style="width: inherit; margin-top: 5%; margin-left: 0">
                       <div class="col topic-table" style="border-left: 0.5px solid #2d3436" >Название</div>
                       <div class="col topic-table">Год</div>
                       <div class="col topic-table">Жанр</div>
                       <div class="col topic-table">Возраст</div>
                       <div class="col topic-table">Страна</div>
                       <div class="col topic-table">Постер</div>
                       <div class="col topic-table">Действие</div>

                   </div>

<?php render_index($data); ?>

        </div>

    <form hidden id="del-film-form" method="post" action="index.php">
        <input id="input_film_del" type="number" name="id_film_del">
    </form>

</div>
<script type="text/javascript" src="js/validate.js" ></script>
<script type="text/javascript" src="js/delete_film.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>