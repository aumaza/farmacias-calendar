<?php

class Usuarios{

    // PROPIEDADES
    private $name = '';
    private $user = '';
    private $password = '';
    private $email = '';
    private $task = '';
    private $avatar = '';
    private $role = '';

    // CONSTRUCTOR
    function __construct(){
        $this->name = '';
        $this->user = '';
        $this->password = '';
        $this->email = '';
        $this->task = '';
        $this->avatar = '';
        $this->role = '';
    }

    // SETTERS
    private function setName($_name){
        $this->name = $_name;
    }

    private function setUser($_user){
        $this->user = $_user;
    }

    private function setPassword($_password){
        $this->password = $_password;
    }

    private function setEmail($_email){
        $this->email = $_email;
    }

    private function setTask($_task){
        $this->task = $_task;
    }

    private function setAvatar($_avatar){
        $this->avatar = $_avatar;
    }

    private function setRole($_role){
        $this->role = $_role;
    }

    // GETTERS
    private function getName($_name){
        return $this->name = $_name;
    }

    private function getUser($_user){
        return $this->user = $_user;
    }

    private function getPassword($_password){
        return $this->password = $_password;
    }

    private function getEmail($_email){
        return $this->email = $_email;
    }

    private function getTask($_task){
        return $this->task = $_task;
    }

    private function getAvatar($_avatar){
        return $this->avatar = $_avatar;
    }

    private function getRole($_role){
        return $this->role = $_role;
    }


    // METODOS
    public function listUsuarios($nUsuario,$conn,$dbname){

        if($conn){

                $sql = "SELECT * FROM fc_usuarios";
                mysqli_select_db($conn,$dbase);
                $resultado = mysqli_query($conn,$sql);

                // se definen los roles
                $enable = 'Habilitado';
                $disable = 'Deshabilitado';
                // se definen las tareas
                $admin = 'Sys Admin';
                $user = 'Usuario';
                //mostramos fila x fila
                $count = 0;
                echo '<div class="container-fluid">
                            <div class="jumbotron">

                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <img src="../img/icons/apps/system-users.png"  class="img-reponsive img-rounded" alt="img" /> <strong>Usuarios</strong>
                                </div>
                            </div><hr>';


                echo "<table class='display compact' style='width:100%' id='usuariosTable'>";


                echo "<thead>
                                <th class='text-nowrap text-center'><span class='label label-default'>Nombre</span></th>
                                <th class='text-nowrap text-center'><span class='label label-default'>Usuario</span></th>
                                <th class='text-nowrap text-center'><span class='label label-default'>Email</span></th>
                                <th class='text-nowrap text-center'><span class='label label-default'>Tareas</span></th>
                                <th class='text-nowrap text-center'><span class='label label-default'>Estado</span></th>
                                <th class='text-nowrap text-center'><span class='label label-warning'>Acciones</span></th>
                            </thead>";


                while($fila = mysqli_fetch_array($resultado)){
                        // Listado normal
                        echo "<tr>";
                        echo "<td align=center>".$nUsuario->getName($fila['name'])."</td>";
                        echo "<td align=center>".$nUsuario->getUser($fila['user'])."</td>";
                        echo '<td align=center>'.$nUsuario->getEmail($fila['email']).'</td>';
                        if($nUsuario->getTask($fila['task']) == '1'){
                            echo '<td align=center><span class="label label-primary">'.$admin.'</span></td>';
                        }
                        if($nUsuario->getTask($fila['task']) == '2'){
                            echo '<td align=center><span class="label label-info">'.$user.'</span></td>';
                        }
                        if($nUsuario->getRole($fila['role']) == '1'){
                            echo '<td align=center><span class="label label-success">'.$enable.'</span></td>';
                        }
                        if($nUsuario->getRole($fila['role']) == '0'){
                            echo '<td align=center><span class="label label-danger">'.$disable.'</span></td>';
                        }
                        echo '<td class="text-nowrap" align=center>';
                                if($fila['id'] != 1){
                                     echo '<button type="button" class="btn btn-warning btn-block" value="'.$fila['id'].'"  onclick="callEditEstado(this.value);">
                                            <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Cambiar Estado</button>';
                                }
                                echo '</td>';
                                $count++;
                    }

                    echo "</table>";
                    echo "<hr>";
                    echo '<div class="alert alert-info">
                                    <span class="glyphicon glyphicon-option-vertical" aria-hidden="true"></span>
                                    <strong>Cantidad de Registros:</strong>  ' .$count.'
                                </div><hr>';

                    echo '</div>
                               </div>';
                    }else{
                        echo 'Connection Failure...';
                    }

                mysqli_close($conn);

    } // END OF FUNCTION


    // FORMULARIOS
    public function formEditarEstado($nUsuario,$id,$conn,$dbname){

        // se realiza la consulta
        mysqli_select_db($conn,$dbname);
        $sql = "select * from fc_usuarios where id = '$id'";
        $query = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($query);

        echo '<div class="container">
                    <div class="jumbotron">
                        <hr>
                        <div class="alert alert-info">

                        <p><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                                    Cambiar Estado del Usuario:</p>
                        <p><strong>'.$nUsuario->getName($row['name']).'</strong><p>

                        </div>
                        <hr>
                        <form id="fr_edit_role_ajax" method="POST">
                            <input type="hidden" id="id_user" name="id_user" value="'.$id.'">
                            <div class="form-group">
                                <label for="role">Estado Actual:</label>
                                <select class="form-control" id="role" name="role" data-toggle="tooltip" data-placement="top" title="Seleccione el estado al cual desea cambiar">
                                    <option value="1" '.($nUsuario->getRole($row['role']) == '1' ? "selected" : "").' style="color: green";>Habilitado</option>
                                    <option value="0" '.($nUsuario->getRole($row['role']) == '0' ? "selected" : "").' style="color: red;">Deshabilitado</option>
                                </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block" id="edit_role_user">
                                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Actualizar</button>
                        </form><hr>
                        <div id="messageRoleUser"></div>
                        </div>
                        </div>';

    } // END OF FUNCTION

    public function userBio($nUsuario,$user_id,$conn,$dbname){

        mysqli_select_db($conn,$dbname);
        $sql = "select * from fc_usuarios where id = '$user_id'";
        $query = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($query);

        echo '<div class="container">
                        <div class="jumbotron">
                        <div class="alert alert-info">
                        <h2><img src="../img/icons/actions/view-process-own.png"  class="img-reponsive img-rounded" alt="img" /> Mis Datos</h2>
                        </div><hr>
                        <button type="button" class="btn btn-primary btn-sm" value="'.$user_id.'" onclick="callChangeAvatar(this.value);">
                            <span class="glyphicon glyphicon-picture" aria-hidden="true"></span> Cambiar Avatar</button><hr>

                        <form id="fr_mis_datos_ajax" method="POST">
                            <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" class="form-control" id="name" name="name" value="'.$nUsuario->getName($row['name']).'" disabled>
                            </div>
                            <div class="form-group">
                            <label for="user">Usuario:</label>
                            <input type="text" class="form-control" id="user" name="user" value="'.$nUsuario->getUser($row['user']).'"" disabled>
                            </div>

                            <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="'.$nUsuario->getEmail($row['email']).'" disabled>
                            </div>

                            <div class="form-group">
                            <label for="task">tipo Usuario:</label>';
                            if($nUsuario->getTask($row['task']) == '1'){
                                echo '<input type="text" class="form-control" id="task" name="task" value="Sys Admin" disabled>';
                            }
                            if($nUsuario->getTask($row['task']) == '2'){
                                echo '<input type="text" class="form-control" id="task" name="task" value="Usuario" disabled>';
                            }

                    echo '</div><br>

                            <div class="alert alert-warning">
                            <h2><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Cambiar Password</h2>
                            <button type="button" class="btn btn-warning" id="enabled_change_password" data-toggle="tooltip" data-placement="top" title="Atención! El password debe tener entre 10 y 15 caracteres" onclick="enablePassword();">
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Habilitar cambio de Password</button>
                            <div id="enableButton"></div>
                            </div>
                            <br>

                            <div class="form-group">
                            <label for="password_1">Password:</label>
                            <input type="password" class="form-control" id="password_1" name="password_1" disabled>
                                <button type="button" class="btn btn-default btn-sm" id="show_A">Mostrar Contraseña</button>
                            </div>

                            <div class="form-group">
                            <label for="password_2">Repetir Password:</label>
                            <input type="password" class="form-control" id="password_2" name="password_2" disabled>
                                <button type="button" class="btn btn-default btn-sm" id="show_B">Mostrar Contraseña</button>
                            </div>

                            <input type="hidden" id="id" name="id" value="'.$user_id.'">

                            <button type="submit" class="btn btn-primary" id="update_password">
                                <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Actualizar</button>
                        </form><hr>
                        <div id="messagePassUpdate"></div>
                        </div>
                        </div>';

} // END OF FUNCTION


    public function changeAvatar($id){

        echo '<div class="container">
                <div class="jumbotron">
                <div class="alert alert-info">
                    <h2><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Cambiar Avatar</h2>
                </div><hr>
                <form id="fr_change_avatar_ajax" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="id" name="id" value="'.$id.'">
                <div class="alert alert-success">
                    <div class="form-group">
                    <label for="my_file">Archivo:</label>
                    <input type="file" id="my_file" name="my_file">
                    </div>
                </div>

                    <button type="submit" class="btn btn-primary btn-block" id="update_avatar">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Cambiar</button>
                </form>
                <div id="messageAvatarUpdate"></div>
                </div>
                </div>';

    } // FIN DE LA FUNCTION

    // PERSISTENCIA

    public function updateRole($nUsuario,$id,$role,$conn,$dbname){

            mysqli_select_db($conn,$dbname);
            $sql = "update fc_usuarios set role = $nUsuario->setRole('$role') where id = '$id' ";
            $query = mysqli_query($conn,$sql);

            if($query){
                $success = 'Actualización de usuario con id: '.$id.' exitosa!';
                $nUsuario->successMysqlUsers($success);
                echo 1; // actualización correcta
            }else{
                $error = 'Actualización de Estado. '.mysqli_error($conn);
                $nUsuario->errorMysqlUsers($error);
                echo -1; //error al intentar actualizar
            }
    } // END OF FUNCTION


    public function updatePassword($nUsuario,$id,$password_1,$password_2,$conn,$dbname){

        if(((strlen($password_1) >= 10) && (strlen($password_1) <= 15)) && ((strlen($password_2) >= 10) && (strlen($password_2) <= 15))){

			if((strcmp($password_2,$password_1) == 0)){

						// se encripta el password
                    	$passHash = password_hash($password_1, PASSWORD_BCRYPT);

                        mysqli_select_db($conn,$dbname);
                        $sql = "update fc_usuarios set password = $nUsuario->setPassword('$passHash') where id = '$id'";
                        $query = mysqli_query($conn,$sql);

                        if($query){
                            $success = 'Actualización de password para el usuario con id: '.$id.' existosa';
                            $nUsuario->successMysqlUsers($success);
                            echo 1; // registro actualizado correctamente
                        }else{
                            $error = 'Actualización de password para el usuario con id: '.$id.' '.mysqli_error($conn);
                            $nUsuario->errorMysqlUsers($error);
                            echo -1; // hubo un error al intentar actualizar el registro
                        }

            }else{
                echo 3; // los passwords no coinciden
            }
        }else{
            echo 9; // los passwords deben tener entre 10 y 15 caracteres
        }

} // EN OF FUNCTION


    public function updateAvatar($nUser,$id,$file,$conn,$dbname){


        if($file != ''){

                    			$targetDir = '../../avatars/';
								$fileName = $file;
								$targetFilePath = $targetDir . $fileName;

								$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

									   // Allow certain file formats
									    $allowTypes = array('png','jpg');

									    if(in_array($fileType, $allowTypes)){

									       // Upload file to server
									        if(move_uploaded_file($_FILES["my_file"]["tmp_name"], $targetFilePath)){


									        $sql_1 = "update fc_usuarios set avatar = $nUser->setAvatar('$targetFilePath') where id = '$id'";

									        mysqli_select_db($conn,$dbname);
									        $query_1 = mysqli_query($conn,$sql_1);


									            if($query_1){

                                                    $success = 'Se ha actualizado la imagen de usuario con id: "'.$id.'"';
                                                    $nUser->successMysqlUsers($success);
												    echo 1; // sea actualizo la base  y subio bien el archivo


									            }else{

												   echo 2; // solo se subio el archivo

									            }
									            }else{

									              echo 3; // verificar permisos del directorio

									            }
									            }else{

												  echo 4; // solo archivos png, jpg
									            }


		                    	}else{
                                    echo 7; // no se ha seleccionado ningun archivo
                                }

    } // FUN DE LA FUNCTION

    // MENEJO DE  ACTUALIZACION EXITOSA

    public function successMysqlUsers($success){

        $fileName = "users_mysql_success.log";
        $date = date("d-m-Y H:i:s");
        $message = 'Success: '.$success.' - '.$date;

        if (file_exists($fileName)){

        $file = fopen($fileName, 'a');
        fwrite($file, "\n".$message);
        fclose($file);
        chmod($file, 0777);

        }else{
            $file = fopen($fileName, 'w');
            fwrite($file, $message);
            fclose($file);
            chmod($file, 0777);
            }
    }

    // MANEJO DE ERRORES

    public function errorMysqlUsers($error){

        $fileName = "users_mysql_error.log";
        $date = date("d-m-Y H:i:s");
        $message = 'Error: '.$error.' - '.$date;

        if (file_exists($fileName)){

        $file = fopen($fileName, 'a');
        fwrite($file, "\n".$message);
        fclose($file);
        chmod($file, 0777);

        }else{
            $file = fopen($fileName, 'w');
            fwrite($file, $message);
            fclose($file);
            chmod($file, 0777);
            }
    } // END OF FUNCTION

} // fin de la clase


?>
