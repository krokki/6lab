<?php
require 'db_connect.php';
require_once 'functions.php';

require_once 'modules/delete_film_from_cinema.php';

require_once 'modules/delete_cinema.php';

if(isset($_GET['id_cinema'])) {

    $id_cinema = htmlspecialchars($_GET['id_cinema']);
    $url_add = "add_film_into_cinema.php?id_cinema=".$id_cinema;


    $sql = "SELECT * FROM table_cinema_films WHERE cinema_id = " . $id_cinema;

    if(($connection->query($sql)) !== NULL)
    {
        $statement = $connection->prepare($sql);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    $sql_name = "SELECT name FROM cinema WHERE id = " . $id_cinema;
    $result = $connection->query($sql_name);
    $cinema_name = $result->fetch();

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Кинотеатры</title>

    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/css_main.css">


    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/delete_cinema.js"></script>
    <script type="text/javascript" src="js/delete_film_from_cinema.js" ></script>
</head>
<body>


<div class="container-fluid" id="Header">
    <div class="row" id="find_str">
        <div class="col logo_div "> <a href="index.php" class="logo_text"> <b>КиноЛента</b> </a> </div>
    </div>

</div>


<div class="cont_up">

    <div class="container col-10" id="cont">
       <div class="col" style="padding-top: 3%">
           <div class="row" style="width: inherit; margin: 0">

               <div class="col" id="main_topic"><?php echo $cinema_name['name']; ?></div>

</div>
<div class="row" style="width: inherit; margin: 0">
    <div class="col" id="topic">В данном кинотеатре в прокате следующие фильмы:</div>
</div>

           <a class="valid-btn btn" id="btn-submit" href="<?php echo $url_add; ?>">Add film in this cinema</a>
           <button class="valid-btn btn delete_cinema" name="action" value="delete" id="btn-submit">Delete this cinema</button>
           <a class="valid-btn btn" id="btn-submit" href="cinema.php">All cinemas </a>



</div>

    <?php if(isset($fdel)){?> <div class="col"> <?php echo $fdel; ?> </div> <?php } ?>
        <div class="row justify-content-center" style="width: inherit; margin-top: 5%; margin-left: 0">
            <div class="col topic-table" style="border-left: 0.5px solid #2d3436" >Название</div>
            <div class="col topic-table">Год</div>
            <div class="col topic-table">Жанр</div>
            <div class="col topic-table">Возраст</div>
            <div class="col topic-table">Страна</div>
            <div class="col topic-table">Постер</div>
            <div class="col topic-table">Действие</div>

        </div>

  <?php render_all_film_for_cinema($data, $id_cinema); ?>

     <form class="delete_form" hidden action="" method="post">
         <input hidden type="number" name="id_cinema_delete" value="<?php echo $_GET['id_cinema']?>">
     </form>


        <form hidden method="post" id="delete_f_f_c" class="valid-form">

            <input hidden type="text" id="id_film_delete" name="id_film_delete" class="form-control valid-input">

            <input hidden type="text" name="id_cinema_delete_film" class="form-control valid-input" value="<?php if(isset($_GET['id_cinema']))echo $_GET['id_cinema'];?>">

        </form>

        <form action="update_cinema.php"></form>
</div>

</div>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>
