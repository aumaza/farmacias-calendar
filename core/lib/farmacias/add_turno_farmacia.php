<?php session_start();
      include "../../../connection/connection.php";
      include "lib_farmacias.php";

    if($conn){

        $nFarmacia = new Farmacias();

        $id = mysqli_real_escape_string($conn,$_POST['id']);
        $fecha_turno = mysqli_real_escape_string($conn,$_POST['fecha_turno']);

        if(($id == '') || ($fecha_turno == '')){
            echo 5; // hay campos sin completar
        }else{
            $nFarmacia->addFechaFarmacia($nFarmacia,$id,$fecha_turno,$conn,$dbase);
        }


    }else{
        echo 7; // sin conexion a la base de datos
    }



?>
