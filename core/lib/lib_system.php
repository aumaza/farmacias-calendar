<?php


/*
** Funcion que carga el skeleto del sistema
*/

function skeleton(){

  echo '<link rel="stylesheet" href="/farmacias-calendar/skeleton/css/bootstrap.min.css" >
		<link rel="stylesheet" href="/farmacias-calendar/skeleton/css/bootstrap-theme.css" >
		<link rel="stylesheet" href="/farmacias-calendar/skeleton/css/bootstrap-theme.min.css" >
		<link rel="stylesheet" href="/farmacias-calendar/skeleton/css/scrolling-nav.css" >
		<link rel="stylesheet" href="/farmacias-calendar/skeleton/css/font-awesome.min.css" >
		<link rel="stylesheet" href="/farmacias-calendar/core/main/main.css" >
			
		<link rel="stylesheet" href="/farmacias-calendar/skeleton/Chart.js/Chart.min.css" >
		<link rel="stylesheet" href="/farmacias-calendar/skeleton/Chart.js/Chart.css" >
		
		<link rel="stylesheet" href="/farmacias-calendar/skeleton/css/jquery.dataTables.min.css" >
		<link rel="stylesheet" href="/farmacias-calendar/skeleton/css/buttons.dataTables.min.css" >
		<link rel="stylesheet" href="/farmacias-calendar/skeleton/css/buttons.bootstrap.min.css" >
		<link rel="stylesheet" href="/farmacias-calendar/skeleton/css/jquery.dataTables-1.11.5.min.css" >
		<link rel="stylesheet" href="/farmacias-calendar/skeleton/dataTables/fixedColumns.dataTables.min.css" >
		
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
	    
	    <script src="/farmacias-calendar/skeleton/js/jquery-3.4.1.min.js"></script>
	    <script src="/farmacias-calendar/skeleton/js/jquery-3.5.1.min.js"></script>
		<script src="/farmacias-calendar/skeleton/js/bootstrap.min.js"></script>
		
		<script src="/farmacias-calendar/skeleton/js/jquery.dataTables.min.js"></script>
		<script src="/farmacias-calendar/skeleton/dataTables/DataTables/js/jquery.dataTables1.min.js"></script>
		<script src="/farmacias-calendar/skeleton/dataTables/DataTables/js/dataTables.fixedColumns.min.js"></script>
		
		<script src="/farmacias-calendar/skeleton/js/dataTables.editor.min.js"></script>
		<script src="/farmacias-calendar/skeleton/js/dataTables.select.min.js"></script>
		<script src="/farmacias-calendar/skeleton/js/dataTables.buttons.min.js"></script>
		<script src="/farmacias-calendar/skeleton/dataTables/DataTables/js/buttons.colVis.min.js"></script>
		
		<script src="/farmacias-calendar/skeleton/js/jszip.min.js"></script>
		<script src="/farmacias-calendar/skeleton/js/pdfmake.min.js"></script>
		<script src="/farmacias-calendar/skeleton/js/vfs_fonts.js"></script>
		<script src="/farmacias-calendar/skeleton/js/buttons.html5.min.js"></script>
		<script src="/farmacias-calendar/skeleton/js/buttons.bootstrap.min.js"></script>
		<script src="/farmacias-calendar/skeleton/js/buttons.print.min.js"></script>
		
		<script src="/farmacias-calendar/skeleton/js/bootbox/bootbox.all.js"></script>
		<script src="/farmacias-calendar/skeleton/js/bootbox/bootbox.all.min.js"></script>
		<script src="/farmacias-calendar/skeleton/js/bootbox/bootbox.js"></script>
		<script src="/farmacias-calendar/skeleton/js/bootbox/bootbox.locales.js"></script>
		<script src="/farmacias-calendar/skeleton/js/bootbox/bootbox.locales.min.js"></script>
		<script src="/farmacias-calendar/skeleton/js/bootbox/bootbox.min.js"></script>
		
		<script src="/farmacias-calendar/skeleton/Chart.js/Chart.min.js"></script>
		<script src="/farmacias-calendar/skeleton/Chart.js/Chart.bundle.min.js"></script>
		<script src="/farmacias-calendar/skeleton/Chart.js/Chart.bundle.js"></script>
		<script src="/farmacias-calendar/skeleton/Chart.js/Chart.js"></script>';
}


function formLogIn(){

		echo '<div class="container-fluid">
					<div class="jumbotron">
					<footer class="container-fluid text-center">
					<h3><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Calendario de Farmacias</h3>
					</footer><hr>
					<p><span class="label label-success"> <strong>Ingrese sus datos</strong></span></p><hr>
  
				   <form id="fr_login_ajax" method="POST">
				    <div class="form-group">
				      <label for="email"><span class="label label-default"> Usuario</span></label>
				      <input type="email" class="form-control" id="user" name="user" placeholder="Ingrese su email">
				    </div>
				    <div class="form-group">
				      <label for="pwd"><span class="label label-default"> Password</span></label>
				      <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Ingrese su password">
				      <button type="button" class="btn btn-default btn-sm" id="btn-show">Ver Contraseña</button>
				    </div><br>
				    
				    <div class="alert alert-info">
					    <button type="submit" class="btn btn-default btn-block" id="login" name="login"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Ingresar</button>
					    <button type="reset" class="btn btn-default btn-block"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Limpiar Formulario</button>
				    </div>
				  </form><hr>
				  
				  <div id="messageLogIn"></div>

				</div>
				</div>';

}


/*
** Funcion de validación de ingreso
*/
function logIn($user,$pass,$conn,$db_basename){

    mysqli_select_db($conn,$db_basename);
    
	$_SESSION['user'] = $user;
	$_SESSION['pass'] = $pass;
	
	$sql_1 = "select password from fc_usuarios where user = '$user'";
	$query_1 = mysqli_query($conn,$sql_1);
	while($row = mysqli_fetch_array($query_1)){
        $hash = $row['password'];
	}
	
    
    
	$sql = "SELECT * FROM fc_usuarios where user = '$user' and role = 1";
	$q = mysqli_query($conn,$sql);
	
	$query = "SELECT * FROM fc_usuarios where user = '$user' and role = 0";
	$retval = mysqli_query($conn,$query);
	
	
	
	if(!$q && !$retval){	
			echo 7; // CONNECTION FAILURE
			
			}
		
			if(($user = mysqli_fetch_assoc($retval)) && (password_verify($pass,$hash))){
				

				echo -1; // USER BLOCK
			}

			else if(($user = mysqli_fetch_assoc($q)) && (password_verify($pass,$hash))){

				if(strcmp($_SESSION["user"], 'root@gmail.com') == 0){

					echo 1; // LOGIN SUCCESSFULLY
				
				
			}else{
				echo 1; // LOGIN SUCESSFULLY
				
			}
			}else{
				echo 2; // USER OR PASSWORD INCORRECT
				}
}


function flyerConnFailure(){

		echo '<div class="container">
				  <div class="jumbotron">
				    <h1><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Atención</h1><hr>
				    <div class="alert alert-danger">    
				    	<p><span class="glyphicon glyphicon-link" aria-hidden="true"></span> Sin Conexión a la Base de Datos. Contactese con el Administrador.</p>
				    </div><hr>
				  </div>';

}


function logOut($nombre){
    
    echo '<div class="container">
    			<div class="jumbotron">
    			<div class="alert alert-info">
                    <p align=center><strong>Hasta Luego</strong></p>
                    <p align=center><strong>'.$nombre.'</strong></p>
                </div>
                <hr>
                <p align=center><img src="logout.gif"  class="img-reponsive img-rounded"></p><hr>
                <meta http-equiv="refresh" content="4;URL=../../logout.php "/>
            </div>
            </div>';

}

function home(){

	echo '<div class="container-fluid">
    			<div class="jumbotron">
    			<footer class="container-fluid text-center">
					  <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Calendario de Farmacias
                        </footer><hr>
                        <p align=center><img src="./core/img/logo-farmacia.gif"  class="img-reponsive img-rounded" style="width:100%"></p><hr>

                        <h2 align=center><span class="label label-success"> Bienvenidos/as</span></h2>
                         En <strong>Calendarios de Farmacias</strong> podrá consultar las farmacias de turno en <strong>Ciudad Evita</strong> y ver las carácterísticas de cada farmacia.</p><hr>
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Farmacias</a>
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    Consulte las farmacias que están de turno en cada año.
                                    Desde el mismo calendario podrá acceder a los datos de cada farmacia.
                                    Dirección, teléfonos, etc, etc. Todo desde su casa.
                                </div>
                            </div>
                            </div>
                            <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                    <span class="glyphicon glyphicon-heart" aria-hidden="true"></span> Obras Sociales / Prepagas</a>
                                </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    Podrá saber que obras sociales atiende cada farmacia.
                                    Esto es importante para saber si cuenta con descuentos con la obra social que posee.
                                </div>
                            </div>
                            </div>
                            <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                    <span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span> Métodos de Pago</a>
                                </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    Sepa de ante mano cómo puede pagar en cada farmacia.
                                    Ganando tiempo cuando se dirija  a la misma.
                                </div>
                            </div>
                            </div>
                        </div>
                	
                	<footer class="container-fluid text-center">
					  Develop by <a href="mailto:develslack@gmail.com">Slackzone Development</a>
					</footer>
          		</div>
            </div>';
}


?>
