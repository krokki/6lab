<?php

if(isset($_POST['id_cinema_delete']))
{

    $sql_check = "SELECT * FROM table_cinema_films WHERE cinema_id=".$_POST['id_cinema_delete'];

    if(($connection->query($sql_check) !== NULL))
    {
        $count = 0;
        foreach($connection->query($sql_check) as $row)
        {
            $count++;
        }
    }

    if($count == 0)
    {
        $sql_del = "DELETE FROM cinema WHERE id = :id_cinema_delete";

        $req = ['id_cinema_delete' => htmlspecialchars($_POST['id_cinema_delete'])];
        $statement = $connection->prepare($sql_del);
        $statement->execute($req);
        header("Location: cinema.php");
    }

    if($count !== 0) {$fdel = "Удаление связанных объектов запрещено!";}



}