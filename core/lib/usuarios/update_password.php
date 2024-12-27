<?php    session_start();
                include "../../../connection/connection.php";
                include "lib_usuarios.php";

                if($conn){

                    // SE CREA EL OBJETO
                    $nUsuario = new Usuarios();

                    // SE CAPTURAN LOS DATOS
                    $id = mysqli_real_escape_string($conn,$_POST['id']);
                    $password_1 = mysqli_real_escape_string($conn,$_POST['password_1']);
                    $password_2 = mysqli_real_escape_string($conn,$_POST['password_2']);

                    if(($id == '') || ($password_1 == '') || ($password_2 == '')){
                        echo 5; // hay campos vacios
                    }else{
                          $nUsuario->updatePassword($nUsuario,$id,$password_1,$password_2,$conn,$dbname);
                    }
                }else{
                    echo 7; // sin conexion a la base de datos
                }




?>
