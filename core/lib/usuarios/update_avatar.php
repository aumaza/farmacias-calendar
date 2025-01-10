<?php    session_start();
                include "../../../connection/connection.php";
                include "lib_usuarios.php";

                if($conn){

                    // SE CREA EL OBJETO
                    $nUsuario = new Usuarios();

                    // SE CAPTURAN LOS DATOS
                    $id = mysqli_real_escape_string($conn,$_POST['id']);
                    $file = basename($_FILES["my_file"]["name"]);

                    $nUsuario->updateAvatar($nUsuario,$id,$file,$conn,$dbname);

                }else{
                    echo 9; // sin conexion a la base de datos
                }




?>
