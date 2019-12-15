<?php

if (isset($_POST['action']) && $_POST['action'] === 'sign_in')
    if(isset($_POST['login']) && isset($_POST['password']))
    {
        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);

        $sql_check = 'SELECT * FROM users WHERE login = :login';
        $data = ['login' => $login];
        $statement = $connection->prepare($sql_check);
        $statement->execute($data);

        $check_set_user = $statement->fetchAll(PDO::FETCH_ASSOC);

        if(count($check_set_user) !== 0)
        {
            $check_password = password_verify($password, $check_set_user[0]['password']);
        }
        else $check_password = FALSE;

        if(count($check_set_user) === 1 && $check_password === TRUE)
        {
            $_SESSION['login'] = $login;
            $_SESSION['status'] = 1;
            header('Location: index.php');
        }
        else if($check_password === FALSE || count($check_set_user) !== 1)
        {
            $fmsg = 'Вы ввели неправильный логин\пароль!';
        }
    }
