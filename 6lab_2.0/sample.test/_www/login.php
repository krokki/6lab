<?php
session_start();
require_once 'db_connect.php';
require_once 'modules/sign_up.php';
require_once 'modules/sign_in.php';

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