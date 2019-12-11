<?php

if(isset($_GET['id_cinema']))
{
    require_once 'functions.php';
    require_once 'db_connect.php';

    $id_cinema = $_GET['id_cinema'];

    $sql = 'SELECT * FROM films WHERE id NOT IN (SELECT film_id FROM table_cinema_films WHERE cinema_id='.$id_cinema.')';

    $statement = $connection->prepare($sql);
    $statement->execute();
    $success_data = $statement->fetchAll(PDO::FETCH_ASSOC);

    var_dump($success_data);

    if ((isset($_GET['id_film'])) && ($_GET['action'] === "add"))
    {   $t = htmlspecialchars($_GET['mas_pos']);
        $sql = 'INSERT INTO table_cinema_films (cinema_id, film_id, films, year, genre, age, country, file) VALUES (:cinema_id, :film_id, :films, :year, :genre, :age, :country, :file)';
        $req = [':cinema_id' => $id_cinema,
                ':film_id' => $_GET['id_film'],
                ':films' => $success_data[$t]['namefilm'],
                ':year' => $success_data[$t]['year'],
                ':genre' => $success_data[$t]['genre'],
                ':age' => $success_data[$t]['age'],
                ':country' => $success_data[$t]['country'],
                ':file' => $success_data[$t]['file']];
        $statement = $connection->prepare($sql);
        $statement->execute($req);
        header('Location: all_film_for_cinema.php?id_cinema='.$id_cinema);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Фильмы</title>

    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/css_main.css">

</head>
<body>

<div class="container-fluid" id="Header">
    <div class="row" id="find_str">
        <div class="col logo_div "> <a href="index.php" class="logo_text"> <b>КиноЛента</b> </a> </div>
    </div>

</div>

<div class="cont_up">

    <div class="container col-7" id="cont">

        <div class="row justify-content-center" style="width: inherit; margin-top: 5%; margin-left: 0">
            <div class="col topic-table" style="border-left: 0.5px solid #2d3436" >Название</div>
            <div class="col topic-table">Год</div>
            <div class="col topic-table">Жанр</div>
            <div class="col topic-table">Возраст</div>
            <div class="col topic-table">Страна</div>
            <div class="col topic-table">Постер</div>

        </div>

       <?php render_add_film($success_data, $id_cinema); ?>

    </div>

</div>

<script type="text/javascript" src="js/validate.js" ></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>
