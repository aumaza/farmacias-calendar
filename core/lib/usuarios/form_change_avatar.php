<?php session_start(); 
      
      error_reporting(E_ALL ^ E_NOTICE);
      ini_set('display_errors', 1);



      include "../../../connection/connection.php";
      include "../lib_system.php";
      include "lib_usuarios.php";


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
  

  if($varsession == null || $varsession == ''){
        echo '<!DOCTYPE html>
                <html lang="es">
                <head>
                <title>Calendario de Farmcias - Main</title>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">';
                skeleton();
                echo '</head><body style = "background: #839192;">';
                echo '<br><div class="container">
                        <div class="alert alert-danger" role="alert">';
                echo '<p align="center"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Su sesión ha caducado. Por favor, inicie sesión nuevamente</p>';
                echo '<a href="../../logout.php"><hr><button type="buton" class="btn btn-default btn-block"><span class="glyphicon glyphicon-send" aria-hidden="true"></span> Iniciar</button></a>';  
                echo "</div></div>";
                die();
                echo '</body></html>';
  }


?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Calendario de Farmacias - Cambiar Avatar Usuario</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php skeleton(); ?>
</head>
<body style="background-color: #4169E1;">
  
<div class="container"><br>
 
  <?php

    if($conn){
       
        $id = $_GET['id'];
        // se crea el objeto usuario
        $nUsuario = new Usuarios();
        $nUsuario->changeAvatar($id);

    }else{
      flyerConnFailure();
    }


  ?>


</div>


<script type="text/javascript" src="lib_usuarios.js"></script>
</body>
</html>
