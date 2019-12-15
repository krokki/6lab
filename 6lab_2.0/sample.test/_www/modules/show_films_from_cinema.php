<?php
//all film for cinema
if(isset($_GET['id_cinema'])) {

    $id_cinema = htmlspecialchars($_GET['id_cinema']);
    $url_add = "add_film_into_cinema.php?id_cinema=".$id_cinema;


    $sql = "SELECT * FROM table_cinema_films WHERE cinema_id = " . $id_cinema;

    $film_id = array();

    if (($connection->query($sql)) != NULL) {
        $i = 0;
        foreach ($connection->query($sql) as $row) {
            $film_id[$i] = $row;
            $i++;
        }

        $data = $film_id;
    }

    $sql_name = "SELECT name FROM cinema WHERE id = " . $id_cinema;
    $result = $connection->query($sql_name);
    $cinema_name = $result->fetch();

}