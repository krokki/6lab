<?php

if (isset($_POST['id_film_del']))
{
    $id_film_del = htmlspecialchars($_POST['id_film_del']);

    $result = delete_film($connection, $id_film_del);

    if($result === false) $fmsg = "Удаление связанных объектов запрещено!";
}