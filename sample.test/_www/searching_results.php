<?php

if (isset($_POST['find_str']))
{
    require_once 'db_connect.php';
    //echo $_POST['find_str']."-input"."<br>"."<br>";

$search = $_POST['find_str'];
$search = trim(substr($search, 0, 64)); // Это можно убрать, ограничение на 64 символа в поиске
$search = preg_replace("#\#s=#msi", "", $search);
$search = preg_replace("/[^\w\x7F-\xFF\s]/", " ", $search);
$search = preg_replace("#  +#msi", " ", $search);

if(empty($search))
{
  return false;
}

$sql_film = ("SELECT * FROM films WHERE namefilm LIKE '%".preg_replace("# #msi", "%' OR `field1` LIKE '%", $search)."%' OR genre LIKE '%".preg_replace("# #msi", "%' OR `field2` LIKE '%", $search)."%'");

    $statement = $connection->prepare($sql_film);
    $statement->execute();
    $film = $statement->fetchAll(PDO::FETCH_ASSOC);


$sql_cinema = ("SELECT * FROM cinema WHERE name LIKE '%".preg_replace("# #msi", "%' OR `field1` LIKE '%", $search)."%'");

   $statement = $connection->prepare($sql_cinema);
   $statement->execute();
   $cinema = $statement->fetchAll(PDO::FETCH_ASSOC);

}
else echo "EMPTY!!!";
?>


<!DOCTYPE html>
<html>
<head>
    <title>Результаты поиска</title>

    <meta charset="utf-8">

    <script type="text/javascript" src="js/jquery.min.js"></script>

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



</div>

<div class="cont_up">

    <div class="container col-10" id="cont">

        <div class="row justify-content-center" style="width: inherit; margin-top: 5%; margin-left: 0">
            <div class="col topic-table" style="border-left: 0.5px solid #2d3436" >Название</div>
            <div class="col topic-table">Год</div>
            <div class="col topic-table">Жанр</div>
            <div class="col topic-table">Возраст</div>
            <div class="col topic-table">Страна</div>
            <div class="col topic-table">Постер</div>

        </div>


        <?php

        for($i = 0; $i < count($film); $i++)
        {  $url_params_film = "all_cinema_for_film.php?id_film=".$film[$i]['id'];
        ?>
            <div class="row justify-content-center" id="table">

            <?php
            foreach ($film[$i] as $row)
            if(($row !== $film[$i]['id']) AND ($row !== $film[$i]['file'])){
            ?>
                <div class="col item-table font-style">
                    <div class="row align-items-center justify-content-center family">
                        <div class="col"><a href="<?php echo $url_params_film;?>"><?php echo $row?></a></div>
                    </div>
                </div>
            <?php
            }
            ?>
            <div class="col item-table font-style" style="height: inherit;">
                <img style=" height: inherit; width: inherit; object-fit: cover" src="uploads/<?php echo $film[$i]['file'];?>" alt="">
            </div>
            </div>
           <?php
        }
     ?>

        <div class="row justify-content-center" style="width: inherit; margin-left: 0">
            <div class="col topic-table" style="border-left: 0.5px solid #2d3436" >Название кинотеатра</div>
            <div class="col topic-table">Адресс</div>
        </div>

        <?php

        for($i = 0; $i < count($cinema); $i++)
        {  $url_params_cinema = "all_film_for_cinema.php?id_cinema=".$cinema[$i]['id'];
        ?>
        <div class="row justify-content-center" id="table">

            <?php
            foreach ($cinema[$i] as $row)
                if($row !== $cinema[$i]['id']){
                    ?>
                    <div class="col item-table font-style">
                        <div class="row align-items-center justify-content-center family">
                            <div class="col"><a href="<?php echo $url_params_cinema;?>"><?php echo $row?></a></div>
                        </div>
                    </div>
                    <?php
                }
            ?>

        </div>
        <?php
        }
        ?>


    </div>


</div>




<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>
