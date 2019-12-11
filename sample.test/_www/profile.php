<?php
session_start();
if(isset($_SESSION['login']) && $_SESSION['status'] == 1)
{
    require_once 'db_connect.php';
    require_once 'functions.php';
   $login = $_SESSION['login'];

   $sql = 'SELECT email FROM users WHERE login = :login';
   $statement = $connection->prepare($sql);

   $data = ['login' => $login];
   $statement->execute($data);
   $result = $statement->fetch(PDO::FETCH_ASSOC);

   $user_email = $result['email'];



?>


    <!DOCTYPE html>
    <html id="yui">
    <head>
        <title>КиноЛента</title>

        <meta charset="utf-8">

        <link rel="shortcut icon" type="image/png" sizes="16x16" href="img/favicon/favicon32.png">

        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

        <link rel="stylesheet" type="text/css" href="css/css_main.css">

        <script type="text/javascript" src="js/jquery.min.js"></script>

        <script type="text/javascript" src="js/geo.js"></script>

    </head>

    <body id="uio">

    <div class="container-fluid" id="Header">

        <div class="row" id="find_str">

                <div class="col-7 logo_div" style="text-align: right"> <a href="index.php" class="logo_text"> <b>КиноЛента</b> </a> </div>

                <div class="col-5" style="text-align: right" id="btn_login">

                    <a href="logout.php" class="online_user">Выйти из аккаунта</a>

                </div>

        </div>

    </div>


    <div class="cont_up">

        <div class="container col-7" id="cont">
            <div class="main_line"> <a class="main_line_text"><b class ="main_line_text_decor">Личный кабинет</b></a></div>
            <div class="row">

                <div class="col-3">

                    <div class="col-12 offset-1" id="lk_ava">
                        <img src="img/fire.gif" id="lk_ava_img">
                    </div>
                </div>

                <div class="col">

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label align">Login:</label>
                        <div class="col-sm-6">

                            <input type="email" readonly class="form-control-plaintext" id="inputEmail3" placeholder="<?=$_SESSION['login']?>"/>

                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label align">Email:</label>
                        <div class="col-sm-6">

                            <input type="email" readonly class="form-control-plaintext" id="inputEmail3" placeholder="<?php echo $user_email;?>"/>

                        </div>

                    </div>

                    <section class="container">

                        <h3>Ваше местоположение</h3>

                        <input type="text" id="geo">

                        <div hidden>
                            IP-адрес:
                            <input hidden id="ip">
                        </div>
                        <pre hidden id="suggestions"></pre>
                    </section>


                </div>

            </div>

        </div>

    </div>


    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </body>
    </html>

<?php
}
else header('Location: login.php');
?>