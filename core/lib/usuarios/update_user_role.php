<?php    session_start();
                include "../../../connection/connection.php";
                include "lib_usuarios.php";

                if($conn){

                    // SE CREA EL OBJETO
                    $nUsuario = new Usuarios();

                    // SE CAPTURAN LOS DATOS
                    $id = mysqli_real_escape_string($conn,$_POST['id_user']);
                    $role = mysqli_real_escape_string($conn,$_POST['role']);

                    $nUsuario->updateRole($nUsuario,$id,$role,$conn,$dbname);

                }else{
                    echo 7; // sin conexion a la base de datos
                }




?>
