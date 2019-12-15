<?php

if(isset($_POST['id_cinema_delete_film']) && isset($_POST['id_film_delete'])) {

    $id_cinema = htmlspecialchars($_POST['id_cinema_delete_film']);
    $id_film = htmlspecialchars($_POST['id_film_delete']);

    $sql = 'DELETE FROM table_cinema_films WHERE cinema_id = :cinema_id AND film_id = :film_id';
    $req = ['film_id' => $id_film, 'cinema_id' => $id_cinema];
    $statement = $connection->prepare($sql);
    $statement->execute($req);

}