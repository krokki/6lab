<?php
require_once ('db_connect.php');
require_once ('functions.php');

$table = "cinema";

if((isset($_POST['name'])) && (isset($_POST['address'])))
{
    $inputs = array();

    foreach ($_POST as $key => $value)
    {
        $inputs[$key] = htmlspecialchars($value);
    }

    request($connection, $table, $inputs);
    header('Location: cinema.php');
}

$data = show($connection, $table);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Кинотеатры</title>

    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/css_main.css">

</head>
<body>


<div class="container-fluid" id="Header">
    <div class="row justify-content-around" id="find_str">
        <!--        <div class="col logo_div" style="display: inline"> <a href="index.php" class="logo_text"> <b>КиноЛента</b> </a> </div>-->

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
    </div>
</div>


<div class="cont_up">

    <div class="container col-7" id="cont">

        <div class="row justify-content-center align-items-center" style="width: inherit; margin: 0">
            <div class="col-6">
                <form class="valid-form" action="cinema.php" method="post">

                    <input type="text" id="name" name="name" class="form-control valid-input" placeholder="Cinema">
                    <input type="text" id="address" name="address" class="form-control valid-input" placeholder="Address">
                    <button type="submit" id="btn-submit" class="valid-btn btn">Add cinema</button>
                </form>
            </div>

            <a class="valid-btn btn" id="btn-submit" href="index.php">Show films</a>

        </div>



        <div class="row justify-content-center" style="width: inherit; margin-top: 5%; margin-left: 0">
            <div class="col topic-table" style="border-left: 0.5px solid #2d3436" >Название кинотеатра</div>
            <div class="col topic-table">Адресс</div>
        </div>

        <?php render_cinema($data); ?>

    </div>

</div>

<script type="text/javascript" src="js/validate.js" ></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>