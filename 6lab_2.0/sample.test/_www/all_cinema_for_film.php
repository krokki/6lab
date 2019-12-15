<?php

if(isset($_GET['id_film'])) {
    $connection = new PDO('mysql:host=localhost;dbname=db_films;charset=utf8', 'root', '');

    $id_film = htmlspecialchars($_GET['id_film']);

    $sql = "SELECT * FROM table_cinema_films WHERE film_id = " .$id_film;

    $cinema_id = array();
    $i = 0;
    if (($connection->query($sql)) != NULL) {

        foreach ($connection->query($sql) as $row) {
            $cinema_id[$i] = $row['cinema_id'];
            $i++;
        }
    }

    $data = array();

    for ($j = 0; $j < $i; $j++)
    {

            $sqlw = "SELECT * FROM cinema WHERE id = " . $cinema_id[$j];

            if (($connection->query($sqlw)) != NULL)
            {
                foreach ($connection->query($sqlw) as $rowcin)
                {
                    $data[$j] = $rowcin;
                }
            }

    }

    $sql_name = "SELECT namefilm FROM films WHERE id = " .$id_film;
    $result = $connection->query($sql_name);
    $film_name = $result->fetch();
}
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
    <div class="row" id="find_str">
        <div class="col logo_div "> <a href="index.php" class="logo_text"> <b>КиноЛента</b> </a> </div>
    </div>

</div>


<div class="cont_up">

    <div class="container col-7" id="cont">
       <div class="col" style="padding-top: 3%">
           <div class="row" style="width: inherit; margin: 0">

               <div class="col" id="main_topic"><?php  echo $film_name['namefilm']; ?></div>

           </div>
           <div class="row" style="width: inherit; margin: 0">
               <div class="col" id="topic">Этот фильм можно посмотреть в следующих кинотеатрах:</div>
           </div>

       </div>




        <div class="row justify-content-center" style="width: inherit; margin-top: 5%; margin-left: 0">
            <div class="col topic-table" style="border-left: 0.5px solid #2d3436" >Название кинотеатра</div>
            <div class="col topic-table">Адресс</div>
        </div>


        <?php
        foreach($data as $row)
        { $url_params = "all_film_for_cinema.php?id_cinema=".$row['id'];
            ?>

            <div class="row justify-content-center" id="table">

                <div class="col item-table font-style">
                    <div class="row align-items-center justify-content-center family">
                        <div class="col"><a href="<?php echo $url_params; ?>"><?php echo $row['name']?></a></div>
                    </div>
                </div>
                <div class="col item-table font-style" style="height: inherit;">
                    <div class="row align-items-center justify-content-center family" style="height: inherit;">
                        <div class="col"><?php echo $row['address']?></div>
                    </div>
                </div>



            </div>
        <?php } ?>

    </div>

</div>

<script type="text/javascript" src="js/validate.js" ></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>
