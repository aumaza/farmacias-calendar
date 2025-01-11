<?php 	session_start();

      	error_reporting(E_ALL ^ E_NOTICE);
      	ini_set('display_errors', 1);

		include "connection/connection.php";
		include "core/lib/lib_system.php";
        include "regestry/lib_regestry.php";
        include "password/lib_password.php";


        $varsession = $_SESSION['user'];

        if($conn){

            $sql = "select id, name, avatar from fc_usuarios where user = '$varsession'";

            mysqli_select_db($conn,$db_basename);
            $query = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_array($query)){
                $nombre = $row['name'];
                $user_id = $row['id'];
                $avatar = '..'.substr($row['avatar'], 7);

            }
        }else{
            echo 'CONNECTION FAILURE';
        }


?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Calendario de Farmacias</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php skeleton(); ?>
</head>
<body style="height:800px">

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
  <form action="#" method="POST">
    <div class="navbar-header">
      <button type="submit" class="btn btn-default navbar-btn" name="home"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Calendarios de Farmacias</button>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <button type="submit" class="btn btn-danger navbar-btn" name="password"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Olvidé mi Password</button>
      <button type="submit" class="btn btn-primary navbar-btn" name="registro"><span class="glyphicon glyphicon-flash" aria-hidden="true"></span> Registrarse</button>
      <button type="submit" class="btn btn-success navbar-btn" name="ingresar"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Ingresar</button>
    </ul>
 </form>
  </div>
</nav>

<div class="container-fluid" style="margin-top:50px"><br>

<div class="row">
    <div class="col-sm-3">
        <?php home(); ?>
    </div>

    <div class="col-sm-9">

  <?php

    if($conn){


        if(isset($_POST['password'])){
            $nPassword = new Password();
            $nPassword->formResetPassword();
        }

        if(isset($_POST['registro'])){
            $nRegestry = new Regestry();
            $nRegestry->formRegestry($conn,$db_basename);
        }

        if(isset($_POST['ingresar'])){
            formLogIn();
        }

    }else{
        flyerConnFailure();
    }


  ?>
  </div>

</div>
</div>

<script type="text/javascript" src="login.js"></script>
<script type="text/javascript" src="regestry/lib_regestry.js"></script>
<script type="text/javascript" src="password/lib_password.js"></script>
</body>
</html>
