<?php

class Password{

// PROPERTIES
	private $user = '';
	private $password = '';

// CONSTRUCTOR
	function __contruct(){
		$this->user = '';
		$this->password = '';
	}

// SETTERS
	private function setUser($var){
		$this->user = $var;
	}

	private function setPassword($var){
		$this->password = $var;
	}

// GETTERS
	private function getUser($var){
		return $this->user = $var;
	}

	private function getPassword($var){
		return $this->password = $var;
	}	

// METHODS


/*
** FORM FOR CHANGING THE PASSWORD
*/
	public function formResetPassword(){

		echo '<div class="container-fluid">
				  <div class="jumbotron">
				  <footer class="container-fluid text-center">
				    <h3><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Reset Password</h3>
				    </footer><hr>
				    <p><span class="label label-default"> Por favor ingrese los datos que solicitaremos para blanquear su password</span></p><hr>
				    
				     <form id="fr_reset_password_ajax" method="POST">
				      <div class="form-group">
				        <label for="email"><span class="label label-default"> Email</span></label>
				        <input type="email" class="form-control" id="user" name="user" placeholder="Por favor ingrese su email" data-toggle="tooltip" title="Ingrese el email con el que se registró">
				      </div>
				      <div class="form-group">
				        <label for="pwd_1"><span class="label label-default"> Password</span></label>
				        <input type="password" class="form-control" id="pwd_1" name="pwd_1" placeholder="Ingrese el password" data-toggle="tooltip" title="La contraseña debe tener entre 10 y 15 caracteres"><button type="button" class="btn btn-default btn-sm" id="btn-show_1">Mostrar Contraseña</button>
				      </div>
				      <div class="form-group">
				        <label for="pwd_2"><span class="label label-default"> Repita Password</span></label>
				        <input type="password" class="form-control" id="pwd_2" name="pwd_2" placeholder="Ingrese el password nuevamente" data-toggle="tooltip" title="La contraseña debe tener entre 10 y 15 caracteres"><button type="button" class="btn btn-default btn-sm" id="btn-show_2">Mostrar Contraseña</button>
				      </div><br>
				      
				      <div class="alert alert-success">
				        <button type="submit" class="btn btn-default btn-block" id="reset_password" name="reset_password"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Actualizar</button>
				        <button type="reset" class="btn btn-default btn-block"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Limpiar Formulario</button>
				      </div>
				    </form><hr>
				    
				    <div id="messageUpdatePass"></div>

				  </div>
				      
				</div>';

	} // END OF FUNCTION


/*
** VALIDATE PASSWORD
** @ FIRST PARAMETER $PASSWORD_1
** @ SCOND PARAMETER $PASSWORD_2
** THIS FUNCTION EVALUATES WHAT PASSWORD ARE THE SAME AND GOT A MIN AND MAX CANT OF CHARACTERS
*/
public function validatePassword($password_1,$password_2){

	$limInf = 10;
	$limSup = 15;

	if(((strlen($password_1) >= $limInf) && (strlen($password_1) <= $limSup)) && ((strlen($password_2) >= $limInf) && (strlen($password_2) <= $limSup))){

			if((strcmp($password_2,$password_1) == 0)){
				return 0;
			}else{
				return -1; // THE PASSWORDS DON'T MATCH
			}

	}else{
		return -2; // THE PASSWORDS DON'T HAVE THE CANT OF CHARACTERS CORRECT
	}


} // END OF FUNCTION




/*
** FUNCTION FOR UPDATE PASSWORD ON THE DATABASE
*/
public function resetPassword($onePassword,$user,$password_1,$password_2,$conn,$dbname){

	mysqli_select_db($conn,$dbname);
	$sql = "select user from fc_usuarios where user = $onePassword->getUser('$user')";
	$query = mysqli_query($conn,$sql);
	$rows = mysqli_num_rows($query);

	$validatePass = $onePassword->validatePassword($password_1,$password_2);

	if($rows == 1){

		if($validatePass == 0){

			$passHash = password_hash($password_1, PASSWORD_BCRYPT);

			$sql_1 = "update fc_usuarios set password = $onePassword->setPassword('$passHash') where user = $onePassword->getUser('$user')";
			$query_1 = mysqli_query($conn,$sql_1);

			if($query_1){
				echo 1; // PASSWORD SUCCESSFULLY UPDATES
			}else{
				echo -1; // SOMETHING GO WRONG ON UPDATE PASSWORD
			}
		}

		if($validatePass == -1){
			echo 13; // PASSWORDS DON'T MATCH
		}

		if($validatePass == -2){
			echo 11; // PASSWORD WITH CANT OF CHARACTERS WRONG
		}
	}

	if($rows == 0){
		echo 6; // USER UNKNOWN
	}

} // END OF FUNCTION 

} // END OF CLASS



?>
