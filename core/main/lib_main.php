<?php

function mainNavBar($nombre,$avatar,$user_id){
	

	echo '<nav class="navbar navbar-inverse">
			  <div class="container-fluid">
			    <div class="navbar-header">
			    <form action="#" method="POST">
			      <button class="btn btn-warning btn-sm navbar-btn" type="submit" name="home">
                    <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</button>
			    </form>
			    </div>

			    <ul class="nav navbar-nav">
			      
			      <button type="button" class="btn btn-info btn-sm navbar-btn" data-toggle="modal" data-target="#myModalAbout">
			      	<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> A cerca de..</button>
			      
			      <button type="button" class="btn btn-success btn-sm navbar-btn" data-toggle="modal" data-target="#myModalDocumentation">
			      	<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Ayuda al Usuario</button>
			    </ul>
			    
			    <ul class="nav navbar-nav navbar-right">
			      
			      <div class="dropdown">
				    <button class="btn btn-primary dropdown-toggle navbar-btn btn-sm" type="button" data-toggle="dropdown" data-toggle="tooltip" title="Menú">
                        '.($avatar != ".." ? '<img src="'.$avatar.'" alt="Avatar" class="avatar" />' : '<img src="../img/icons/actions/view-media-artist.png" alt="Avatar" class="avatar"/>').' '.$nombre.'</button>
				    <ul class="dropdown-menu">
				    <form action="#" method="POST">
				      <li class="dropdown-header">Menú del Usuario</li>
				      <li><button type="submit" name="user_bio" class="btn btn-default btn-sm btn-block">
				      	<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span> Mis Datos</button></li>
				      
				      <li><button type="button" class="btn btn-default btn-sm btn-block" value="" onclick="callCalendar(this.value);">
				      	<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Calendario</button></li>
				      
				      <li><button type="submit" name="farmacias" class="btn btn-default btn-sm btn-block">
				      	<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Farmacias</button></li>';
				      
                        if($user_id == 1){
                            echo '<li class="divider"></li>
                                    <li class="dropdown-header">Menú del sistema</li>
                                    <li><button type="submit" name="users" class="btn btn-default btn-sm btn-block">
                                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Usuarios</button></li>';
                        }
				      
				      echo '<li><button class="btn btn-danger btn-sm btn-block" type="submit" name="exit">
                                <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Salir</button></li>
				     </form>
				    </ul>
				  </div>

			</div>
			      
			      
			    </ul>
			  </div>
			</nav>';

}


function modalAbout(){

	echo '<div class="modal fade" id="myModalAbout" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> A Cerca de...</h4>
		        </div>
		        <div class="modal-body">

		          <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Desarrollo</a></li>
                    <li><a data-toggle="tab" href="#menu1"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Contacto</a></li>
                    <li><a data-toggle="tab" href="#menu2"><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span> Version</a></li>
                </ul>

                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active"><br>
                    <p><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Desarrollado por Slackzone Development</p>
                    </div>
                    <div id="menu1" class="tab-pane fade"><br>
                    <p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> develslack@gmail.com</p>
                    <p><span class="glyphicon glyphicon-phone" aria-hidden="true"></span> 1161669201</p>
                    </div>
                    <div id="menu2" class="tab-pane fade"><br>
                    <p><span class="glyphicon glyphicon-certificate" aria-hidden="true"></span> Version 1.0</p>
                    </div>
                </div>

		        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
		        </div>
		      </div>
		      
		    </div>
		  </div>';
}


function modalDocumentation(){

	echo '<div class="modal fade" id="myModalDocumentation" role="dialog">
		    <div class="modal-dialog modal-lg">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Ayuda al Usuario</h4>
		        </div>
		        <div class="modal-body">

                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#mis_datos"><span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span> Mis Datos</a></li>
                        <li><a data-toggle="tab" href="#calendario"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Calendario</a></li>
                        <li><a data-toggle="tab" href="#farmacias"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Farmacias</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="mis_datos" class="tab-pane fade in active"><br>
                        <p align=justify>
                            Desde el botón <strong>Mis Datos</strong> podrá acceder a cambiar su contraseña
                            como también camiar el avatar (imagen) que verá en el botón de inicio (ángulo superior derecho de la aplicación).
                            Recuerde que la contraseña debe tener entre 10 y 15 caracteres.
                            Cómo consejo de seguridad, no utilice fechas de nacimiento ni numeros consecutivos. Ejemplo 1234 / 5678
                            Trate de combinar mayúsculas con minúsculas y números, nunca deje espacios en una contraseña.
                            Al seleccionar una imagen recuerde que sólo se admiten archivos con extensión jpg / png.
                        </p>
                        </div>
                        <div id="calendario" class="tab-pane fade"><br>
                            <p align=justify>
                                Desde el botón <strong>Calendario</strong> podrá acceder al calendario anual con los turnos
                                de todas las farmacias existentes.
                                Dentro de la ventana del calendario podrá moverse entre los meses con los botones <strong>Mes Anterior</strong> | <strong>Mes Siguiente</strong>
                                al pie del calendario.
                            </p>
                        </div>
                        <div id="farmacias" class="tab-pane fade"><br>
                            <p align=justify>
                                Desde el botón <strong>Farmacias</strong> podrá acceder a los datos
                                de todas las farmacias existentes.
                                Se mostrarán las farmacias de forma vertical, al hacer click sobre el nombre
                                de cada farmacia se desplegarán los datos correspondiente a la farmacia seleccionada.
                                Una particularidad entre dichos datos, es que encontrá el botón <strong>Calendario de Turnos</strong>.
                                Este le mostrará los turnos únicamente de la farmacia seleccionada.
                                Debajo de este botón podrá observar la ubicación geográfica de la farmacia, para que gane tiempo al intentar encontrarla.
                            </p>
                        </div>

                    </div>

		        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
		        </div>
		      </div>
		      
		    </div>
		  </div>';

}




?>
