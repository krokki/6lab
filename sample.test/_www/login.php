<?php
session_start();
require_once 'db_connect.php';

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
            $wmsg = "Длина пароль должна быть не меньше 6!";
        }

        else if(count($check_set_user) !== 0)
        {
                $wmsg = "Логин занят!";
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

?>

<!DOCTYPE html>
<html id="log_ht">
<head>
	<title>Авторизация</title>

<meta charset="utf-8">

    <script type="text/javascript" src="js/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="css/css_main.css">


</head>
<body id="log_bod">

<div class="box">
        <div class="item">
        	<div class="row justify-content-center align-items-center" id="qwe">
                    <div class="col-4 div_login">
                        <div class="row justify-content-center align-items-center" id="ewq">

                            <button class="btn col-6 toggle" data-num="1" style="text-align: center">Вход</button>
                            <button class="btn col-6 toggle" data-num="2" style="text-align: center">Регистрация</button>

                                <form class="col toggle_form active" action="login.php" id="tog_form1" method="POST">
                                  <?php if((isset($fmsg))) { ?> <div class="col form-group alert-danger"> <?php if (isset($fmsg)) echo $fmsg?> </div> <?php }?>

                                              <div class="col form-group div_input">
                                                <input type="text" name = "login" class="form-control" id="exampleInputEmail1" placeholder="Введите логин или почту">
                                              </div>

                                              <div class="col form-group div_input">
                                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Введите пароль">
                                              </div>

                                              <button type="submit" name="action" value="sign_in" class="col btn btn-primary" id="login_btn_log">Войти</button>
                                 </form>

                                 <form class="col toggle_form" action="login.php" id="tog_form2" method="POST">
                                        <?php if(((isset($wmsg)))) { ?> <div class="col form-group alert-danger"> <?php echo $wmsg; ?> </div> <?php }?>
                                        <?php if(((isset($smsg)))) { ?> <div class="col form-group alert-success"> <?php echo $smsg; ?> </div> <?php }?>

                                        <div class="col form-group div_input">
                                                <input type="text" name = "login" class="form-control" id="exampleInputEmail1" placeholder="Введите логин">
                                            </div>

                                            <div class="col form-group div_input">
                                                <input type="text" name="email" class="form-control" id="exampleInputPassword3" placeholder="Введите почту">
                                            </div>

                                            <div class="col form-group div_input">
                                                <input type="password" name="password" class="form-control" id="exampleInputPassword2" placeholder="Введите пароль">
                                            </div>

                                            <div class="col form-group div_input">
                                                <input type="password" name="password_try" class="form-control" id="exampleInputPassword2" placeholder="Подтвердите пароль">
                                            </div>

                                            <button type="submit" name="action" value="sign_up"  class="col btn btn-primary" id="login_btn_log">Зарегестрироваться</button>
                                 </form>
                       </div>
                    </div>
             </div>
        </div>
</div>

<script type="text/javascript" src="js/toggle_up_in.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>