<?php

if (isset($_POST['action']) && $_POST['action'] === 'sign_up')
    if (isset($_POST['login']) && (isset($_POST['email'])) && (isset($_POST['password'])) && (isset($_POST['password_try']))) {


        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);
        $password_try = htmlspecialchars($_POST['password_try']);
        $email = htmlspecialchars($_POST['email']);

        $count = 0;
        $sql = "SELECT * FROM users WHERE login = :login";
        $data = ['login' => $login];
        $statement = $connection->prepare($sql);
        $statement->execute($data);
        $check_set_user = $statement->fetchAll(PDO::FETCH_ASSOC);


        $sql_login = "SELECT * FROM users WHERE email = :email";
        $data_login = ['email' => $email];
        $statement = $connection->prepare($sql_login);
        $statement->execute($data_login);
        $check_set_email = $statement->fetchAll(PDO::FETCH_ASSOC);

        if($password === '' || $login === '' || $email === '')
        {
            $wmsg = 'Заполните все поля!';
        }

        else if (!preg_match("/^[a-zA-Z0-9]+$/", $login))
        {
            $wmsg = "Логин может состоять только из букв английского алфавита и цифр";
        }

        else if(!preg_match('#([A-Z])+([a-z])+([0-9])+[(\,\.\;\:)+]#', $password))
        {
            $wmsg = "Пароль должен содержать цифры, буквы верхнего регистра, а также знаки препинания!";
        }

        else if(strlen($password) < 6)
        {
            $wmsg = "Длина пароля должна быть не меньше 6!";
        }

        else if(count($check_set_user) !== 0)
        {
            $wmsg = "Логин занят!";
        }

        else if(!preg_match('#([a-zA-Z0-9])+[@]([a-z])+[.][a-z]+#', $email))
        {
            $wmsg = "Почта введена в недопустимом формате!";
        }

        else if(count($check_set_email) !== 0)
        {
            $wmsg = "Введённая почта уже используется!";
        }

        else if($password !== $password_try)
        {
            $wmsg = "Пароли не совпадают!";
        }

        else if(!isset($wmsg))
        {
            $array = [ 'login' => $login,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ];

            $sql_sign_up = 'INSERT INTO users (login, email, password) VALUES (:login, :email, :password)';

            $stmt = $connection->prepare($sql_sign_up);
            $stmt->execute($array);
            $smsg = 'Вы успешно зарегестрировались!';

        }
    }