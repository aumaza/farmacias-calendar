<?php session_start(); 
      
      error_reporting(E_ALL ^ E_NOTICE);
      ini_set('display_errors', 1);



      include "../../connection/connection.php";
      include "../lib/lib_system.php";
      include "lib_main.php";
      include "../lib/usuarios/lib_usuarios.php";
      include "../lib/farmacias/lib_farmacias.php";


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
                <title>BPlanner - Main</title>
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
  <title>Calendario de Farmacias - Menú Principal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php skeleton(); ?>
</head>


<body onload="lock();">

<?php mainNavBar($nombre,$avatar,$user_id); ?>

  
<div class="container-fluid">

  <?php

    if($conn){

        // MODALES
        modalAbout();
        modalDocumentation();

        // SALIR DEL SISTEMA
        if(isset($_POST['exit'])){
          logOut($nombre);
        }

        // HOME
        /*
        if(isset($_POST['home'])){

        }*/

        // USUARIOS
        $nUsuario = new Usuarios();

        if(isset($_POST['users'])){
            $nUsuario->listUsuarios($nUsuario,$conn,$db_basename);
        }

        if(isset($_POST['user_bio'])){
            $nUsuario->userBio($nUsuario,$user_id,$conn,$db_basename);
        }

        // FARMACIAS
        $nFarmacia = new Farmacias();

        if(isset($_POST['farmacias']) && $user_id != 1){
            $nFarmacia->drugstore($nFarmacia,$conn,$dbname);
        }

        if(isset($_POST['farmacias']) && $user_id == 1){
            $nFarmacia->listFarmacias($nFarmacia,$conn,$db_basename);
        }

        if(isset($_POST['editar_farmacia'])){
           $id = mysqli_real_escape_string($conn,$_POST['id']);
           $nFarmacia->formEditfarmacia($nFarmacia,$id,$conn,$db_basename);
        }

        if(isset($_POST['calendario'])){
            $nFarmacia->calendario($conn,$db_basename);
        }

        if(isset($_POST['cargar_turno'])){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            $nFarmacia->formCargarTurno($nFarmacia,$id,$conn,$dbname);
        }

        if(isset($_POST['turnos'])){
            $nFarmacia->listTurnosFarmacias($conn,$dbname);
        }

        $nFarmacia->formNuevafarmacia();



    }else{
      flyerConnFailure();
    }


  ?>


</div>

<script type="text/javascript" src="main.js"></script>
<script type="text/javascript" src="../lib/usuarios/lib_usuarios.js"></script>
<script type="text/javascript" src="../lib/farmacias/lib_farmacias.js"></script>
</body>
</html>
