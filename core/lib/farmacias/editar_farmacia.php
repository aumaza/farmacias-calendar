<?php session_start();
      include "../../../connection/connection.php";
      include "lib_farmacias.php";

    if($conn){

        $nFarmacia = new Farmacias();

        $id = mysqli_real_escape_string($conn,$_POST['id']);
        $nombre_farmacia = mysqli_real_escape_string($conn,$_POST['nombre_farmacia']);
        $direccion_farmacia = mysqli_real_escape_string($conn,$_POST['direccion_farmacia']);
        $telefono_1 = mysqli_real_escape_string($conn,$_POST['telefono_1']);
        $telefono_2 = mysqli_real_escape_string($conn,$_POST['telefono_2']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $obra_social = mysqli_real_escape_string($conn,$_POST['obra_social']);

        if(($nombre_farmacia == '') ||
            ($direccion_farmacia == '') ||
                ($telefono_1 == '') ||
                    ($telefono_2 == '') ||
                        ($email == '') ||
                            ($obra_social == '')){
                                    echo 5; // hay campos sin completar
                            }else{
                                $nFarmacia->updateFarmacia($nFarmacia,$id,$nombre_farmacia,$direccion_farmacia,$telefono_1,$telefono_2,$email,$obra_social,$conn,$db_basename);
                            }


    }else{
        echo 7; // sin conexion a la base de datos
    }



?>
