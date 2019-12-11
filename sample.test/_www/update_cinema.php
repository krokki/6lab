<?php

$urlParams = "all_film_for_cinema.php?id_cinema=".$_GET['id_cinema'];

if (isset($_POST['action']) && $_POST['action'] === 'edit')
if(isset($_POST['new_name']) && isset($_POST['new_year']) && isset($_POST['new_genre']) && isset($_POST['new_age']) && isset($_POST['new_country']))
{

        $connection = new PDO('mysql:host=localhost;dbname=db_films;charset=utf8', 'root', '');

        $sql = "UPDATE table_cinema_films SET films=:name, year=:year, genre=:genre, age=:age, country=:country WHERE film_id = :id AND cinema_id =:id_cinema";

        $data = [
                'id' => htmlspecialchars($_POST['id_film']),
            'id_cinema' => htmlspecialchars($_POST['id_cinema']),
            'name' => htmlspecialchars($_POST['new_name']),
            'year' => htmlspecialchars($_POST['new_year']),
            'age' => htmlspecialchars($_POST['new_age']),
            'genre' => htmlspecialchars($_POST['new_genre']),
            'country' => htmlspecialchars($_POST['new_country'])
        ];

        $query = $connection->prepare($sql);

        if(($data['name'] === '' )||($data['year'] === '') ||($data['age'] === '') ||($data['genre'] === '') ||($data['country'] === '')) $fmsg = "Поля не должны быть пустыми!";
        else if((($query->execute($data)) != NULL)) {header('Location: all_film_for_cinema.php?id_cinema='.$_POST['id_cinema']);}

}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Апдейт кинотеатра</title>

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

        <div class="row justify-content-center align-items-center" style="width: inherit; margin: 0">
            <div class="col-6">
                <?php if(isset($fmsg)) { ?> <div class="col alert-warning"> <?php echo $fmsg ?> </div> <?php } ?>
                <form method="post" class="valid-form">

                    <label>Название фильма:</label><br>
                    <input type="text" name="new_name" class="form-control valid-input" value="<?php if(isset($_GET['namefilm']))echo $_GET['namefilm'];?>">
                    <br>

                    <label for="Год">Год</label><br>
                    <input type="text" class="form-control valid-input" name="new_year" value="<?php if(isset($_GET['year']))echo $_GET['year'];?>" ><br>

                    <label for="Название жанра">Жанр:</label><br>
                    <input type="text" name="new_genre" class="form-control valid-input" value="<?php if(isset($_GET['genre']))echo $_GET['genre'];?>">

                    <label for="Возраст">Возраст:</label><br>
                    <input type="text" name="new_age" class="form-control valid-input" value="<?php if(isset($_GET['age']))echo $_GET['age'];?>">

                    <label for="Страна">Страна:</label><br>
                    <input type="text" name="new_country" class="form-control valid-input" value="<?php if(isset($_GET['country']))echo $_GET['country'];?>">


                    <input type="number" hidden class="form-control valid-input" name="id_cinema" value="<?php echo $_GET['id_cinema'];?>"><br>
                    <input type="number" hidden class="form-control valid-input" name="id_film" value="<?php echo $_GET['id_film'];?>"><br>

                    <input type="submit" id="btn-submit" class="valid-btn btn" name="action" value="edit">

                    <a class="valid-btn btn" id="btn-submit" href="<?php echo $urlParams?>">Вернуться назад</a>
                </form>
            </div>

        </div>

    </div>

</div>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>