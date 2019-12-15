<?php

if((isset($_POST['namefilm'])) && (isset($_POST['year'])) && (isset($_POST['age'])) && (isset($_POST['genre'])) && (isset($_POST['country'])) && ($_FILES['image']['name']) !== '')
{

    if($_FILES['image']['type'] === "image/jpeg")
    {

        $inputs = array();

        foreach ($_POST as $key => $value)
        {
            $inputs[$key] = htmlspecialchars($value);
        }

        request($connection, $table, $inputs);

        $file_data = ['file_name' => uniqid("pic_"), 'namefilm' => $inputs['namefilm']];

        add_file($connection, $file_data);

        header('Location: index.php');
    }

    else
    {
        $fmsg = "Не поддерживаемый тип файла";
    }
}
