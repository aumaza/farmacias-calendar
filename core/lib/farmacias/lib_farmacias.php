<?php

class Farmacias{

    // PROPIEDADES
    private $nombre_farmacia = '';
    private $direccion_farmacia = '';
    private $telefono_1 = '';
    private $telefono_2 = '';
    private $email = '';
    private $obra_social = '';
    private $geo = '';

    // CONSTRUCTOR
    function __construct(){

        $this->nombre_farmacia = '';
        $this->direccion_farmacia = '';
        $this->telefono_1 = '';
        $this->telefono_2 = '';
        $this->email = '';
        $this->obra_social = '';
        $this->geo = '';
    }

    // SETTERS
    private function setNombreFarmacia($_nombre){
        $this->nombre_farmacia = $_nombre;
    }

    private function setDireccionFarmacia($_direccion){
        $this->direccion_farmacia = $_direccion;
    }

    private function setTelefono1($_telefono1){
        $this->telefono_1 = $_telefono1;
    }

    private function setTelefono2($_telefono2){
        $this->telefono_2 = $_telefono2;
    }

    private function setEmail($_email){
        $this->email = $_email;
    }

    private function setObraSocial($_os){
        $this->obra_social = $_os;
    }

    private function setGeo($_geo){
        $this->geo = $_geo;
    }

    // GETTERS
    private function getNombreFarmacia($_nombre){
        return $this->nombre_farmacia = $_nombre;
    }

    private function getDireccionFarmacia($_direccion){
        return $this->direccion_farmacia = $_direccion;
    }

    private function getTelefono1($_telefono1){
        return $this->telefono_1 = $_telefono1;
    }

    private function getTelefono2($_telefono2){
        return $this->telefono_2 = $_telefono2;
    }

    private function getEmail($_email){
        return $this->email = $_email;
    }

    private function getObraSocial($_os){
        return $this->obra_social = $_os;
    }

    private function getGEo($_geo){
        return $this->geo = $_geo;
    }


    // METODOS
    public function listFarmacias($nFarmacia,$conn,$dbname){

        if($conn){

                $sql = "SELECT * FROM fc_farmacias";
                mysqli_select_db($conn,$dbase);
                $resultado = mysqli_query($conn,$sql);

                // obras sociales
                $non = 'No';
                $ok= 'Si';

                //mostramos fila x fila
                $count = 0;
                echo '<div class="container-fluid">
                            <div class="jumbotron">

                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <img src="../img/icons/emblems/vcs-added.png"  class="img-reponsive img-rounded" alt="img" /> <strong>Farmacias</strong>
                                </div>
                            </div><hr>
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal-NewFarmacia">
                                <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Añadir Farmacia</button><br><br>
                            <form action="#" method="POST">
                                <button type="submit" class="btn btn-primary btn-sm" name="turnos">
                                    <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Turnos</button>
                            </form><hr>';


                echo "<table class='display compact' style='width:100%' id='farmaciasTable'>";


                echo "<thead>
                                <th class='text-nowrap text-center'><span class='label label-default'>Farmacia</span></th>
                                <th class='text-nowrap text-center'><span class='label label-default'>Dirección</span></th>
                                <th class='text-nowrap text-center'><span class='label label-default'>Telefono 1</span></th>
                                <th class='text-nowrap text-center'><span class='label label-default'>Telefono 2</span></th>
                                <th class='text-nowrap text-center'><span class='label label-default'>Email</span></th>
                                <th class='text-nowrap text-center'><span class='label label-default'>Atiende Obras Sociales</span></th>
                                <th class='text-nowrap text-center'><span class='label label-warning'>Acciones</span></th>
                            </thead>";


                while($fila = mysqli_fetch_array($resultado)){
                        // Listado normal
                        echo "<tr>";
                        echo "<td align=center>".$nFarmacia->getNombreFarmacia($fila['nombre_farmacia'])."</td>";
                        echo "<td align=center>".$nFarmacia->getDireccionFarmacia($fila['direccion_farmacia'])."</td>";
                        echo '<td align=center>'.$nFarmacia->getTelefono1($fila['telefono_1']).'</td>';
                        echo '<td align=center>'.$nFarmacia->getTelefono2($fila['telefono_2']).'</td>';
                        echo '<td align=center>'.$nFarmacia->getEmail($fila['email']).'</td>';
                        if($nFarmacia->getObraSocial($fila['obra_social']) == '1'){
                            echo '<td align=center><span class="label label-success">'.$ok.'</span></td>';
                        }
                        if($nFarmacia->getObraSocial($fila['obra_social']) == '0'){
                            echo '<td align=center><span class="label label-danger">'.$non.'</span></td>';
                        }
                        echo '<td class="text-nowrap" align=center>
                                <form action="#" method="POST">
                                <input type="hidden" id="id" name="id" value="'.$fila['id'].'">
                                            <button type="submit" class="btn btn-primary btn-sm" name="editar_farmacia">
                                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</button>
                                            <button type="submit" class="btn btn-success btn-sm" name="cargar_turno">
                                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Cargar Turno</button>

                                </form></td>';
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

    public function listTurnosFarmacias($conn,$dbname){

        if($conn){

                $sql = "select id, fecha, (select nombre_farmacia from fc_farmacias where fc_farmacias.id = fc_calendario.id_farmacia) as farmacia from fc_calendario";
                mysqli_select_db($conn,$dbase);
                $resultado = mysqli_query($conn,$sql);

                // obras sociales
                $non = 'No';
                $ok= 'Si';

                //mostramos fila x fila
                $count = 0;
                echo '<div class="container-fluid">
                            <div class="jumbotron">

                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <img src="../img/icons/actions/view-calendar-day.png"  class="img-reponsive img-rounded" alt="img" /> <strong>Turnos Farmacias</strong>
                                </div>
                            </div><hr>
                            <form action="#" method="POST">
                                <button type="submit" class="btn btn-success btn-sm" name="farmacias">
                                    <span class="glyphicon glyphicon-export" aria-hidden="true"></span> Ir a Farmacias</button>
                            </form><hr>';


                echo "<table class='display compact' style='width:100%' id='turnosFarmaciasTable'>";


                echo "<thead>
                                <th class='text-nowrap text-center'><span class='label label-default'>Fecha</span></th>
                                <th class='text-nowrap text-center'><span class='label label-default'>Farmacia</span></th>
                                <th class='text-nowrap text-center'><span class='label label-warning'>Acciones</span></th>
                            </thead>";


                while($fila = mysqli_fetch_array($resultado)){
                        // Listado normal
                        echo "<tr>";
                        echo "<td align=center>".$fila['fecha']."</td>";
                        echo "<td align=center>".$fila['farmacia']."</td>";
                        echo '<td class="text-nowrap" align=center>
                                <form action="#" method="POST">
                                <input type="hidden" id="id" name="id" value="'.$fila['id'].'">
                                            <button type="submit" class="btn btn-primary btn-sm" name="editar_turno">
                                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</button>
                                </form></td>';
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

    public function drugstore($nFarmacia,$conn,$dbname){

        mysqli_select_db($conn,$dbanme);
        $sql = "select * from fc_farmacias";
        $query = mysqli_query($conn,$sql);
        $count = 0;

        $on = 'Si';
        $off = 'No';

        echo '<div class="container">
                <div class="jumbotron">
                <div class="alert alert-info">
                    <p><img src="../img/icons/emblems/vcs-added.png"  class="img-reponsive img-rounded" alt="img" /> <strong>Farmacias</strong></p>
                </div><hr>';

        while($row = mysqli_fetch_array($query)){

            echo '<div class="panel-group">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                            <a data-toggle="collapse" href="#'.$row['id'].'">
                                <img src="../img/store-add.gif"  class="img-reponsive img-rounded" alt="img" width="42" height="42" /> '.$nFarmacia->getNombreFarmacia($row['nombre_farmacia']).'</a>
                            </h4>
                        </div>
                        <div id="'.$row['id'].'" class="panel-collapse collapse">
                            <ul class="list-group">
                            <li class="list-group-item">
                                <img src="../img/icons/actions/flag.png"  class="img-reponsive img-rounded" alt="img" />
                                <span class="label label-default">Dirección</span> '.$nFarmacia->getDireccionFarmacia($row['direccion_farmacia']).'</li>
                            <li class="list-group-item">
                                <img src="../img/icons/apps/internet-telephony.png"  class="img-reponsive img-rounded" alt="img" />
                                <span class="label label-default">Teléfono</span> '.$nFarmacia->getTelefono1($row['telefono_1']).'</li>
                            <li class="list-group-item">
                                <img src="../img/icons/devices/phone.png"  class="img-reponsive img-rounded" alt="img" />
                                <span class="label label-default">Celular</span> '.$nFarmacia->getTelefono2($row['telefono_2']).'</li>
                            <li class="list-group-item">
                                <img src="../img/icons/actions/mail-flag.png"  class="img-reponsive img-rounded" alt="img" />
                                <span class="label label-default">Email</span> '.$nFarmacia->getEmail($row['email']).'</li>';
                            if($nFarmacia->getObraSocial($row['obra_social']) == 1){
                                echo '<li class="list-group-item">
                                        <img src="../img/icons/emblems/emblem-favorite.png"  class="img-reponsive img-rounded" alt="img" />
                                        <span class="label label-default">Atiende Obra Social</span> <span class="label label-success">'.$on.'</span></li>';
                            }
                            if($nFarmacia->getObraSocial($row['obra_social']) == 0){
                                echo '<li class="list-group-item">
                                        <img src="../img/icons/emblems/emblem-favorite.png"  class="img-reponsive img-rounded" alt="img" />
                                        <span class="label label-default">Atiende Obra Social</span> <span class="label label-danger">'.$off.'</span></li>';
                            }
                        echo '<li class="list-group-item">
                                <button type="button" class="btn btn-default btn-sm" value="'.$row['id'].'" onclick="callCalendar(this.value);">
                                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Calendario de Turnos</button</li>';

                      echo '</ul>
                            <div class="panel-footer" align=center> '.$nFarmacia->getGeo($row['geo']).'</div>
                        </div>
                        </div>
                    </div>';

            $count++;
        }

        echo '<div class="alert alert-info">
                    <p><img src="../img/icons/actions/format-list-ordered.png"  class="img-reponsive img-rounded" alt="img" /> <strong>Hay '.$count.' farmacias disponibles</strong></p>
                </div>
              </div>
              </div>';
    } // FIN DE LA FUNCTION

    // FORMULARIOS
    public function formNuevafarmacia(){

        echo '<div id="myModal-NewFarmacia" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Añadir Farmacia</h4>
                    </div>
                    <div class="modal-body">

                        <div class="container-fluid">
                            <form id="fr_add_farmacia_ajax" method="POST">

                                <div class="form-group">
                                    <label for="nombre_farmacia"><span class="label label-default"> Nombre Farmacia</span></label>
                                    <input type="text" class="form-control" id="nombre_farmacia" name="nombre_farmacia">
                                </div>
                                <div class="form-group">
                                    <label for="direccion_farmacia"><span class="label label-default"> Dirección Farmacia</span></label>
                                    <input type="text" class="form-control" id="direccion_farmacia" name="direccion_farmacia">
                                </div>
                                <div class="form-group">
                                    <label for="telefono_1"><span class="label label-default"> Telefono 1</span></label>
                                    <input type="text" class="form-control" id="telefono_1" name="telefono_1">
                                </div>
                                <div class="form-group">
                                    <label for="telefono_2"><span class="label label-default"> Telefono 2</span></label>
                                    <input type="text" class="form-control" id="telefono_2" name="telefono_2">
                                </div>
                                <div class="form-group">
                                    <label for="email"><span class="label label-default"> Email</span></label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="obra_social"><span class="label label-default"> Obra Social</span></label>
                                    <select class="form-control" id="obra_social" name="obra_social">
                                        <option value="" selected disabled>Seleccionar</option>
                                        <option value="1">Atiende Obras Sociales</option>
                                        <option value="0">No Atiende Obras Sociales</option>
                                    </select>
                                </div><br>

                                <button type="submit" class="btn btn-primary" id="add_farmacia">
                                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Aceptar</button>
                            </form>

                            <div id="messageNewFarmacia"></div>

                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Cerrar</button>
                    </div>
                    </div>

                </div>
                </div>';

    } // FIN DE LA FUNCTION

    public function formEditfarmacia($nFarmacia,$id,$conn,$db_basename){

        // se realiza la consulta
        mysqli_select_db($conn,$db_basename);
        $sql = "select * from fc_farmacias where id = '$id'";
        $query = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($query);

        echo '<div class="container">
                <div class="jumbotron">
                    <div class="alert alert-info">
                        <p><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> <strong>Editar Farmacia</strong></p>
                    </div>

              <form id="fr_edit_farmacia_ajax" method="POST">
              <input type="hidden" id="id" name="id" value="'.$id.'">

              <div class="form-group">
               <label for="nombre_farmacia"><span class="label label-default"> Nombre Farmacia</span></label>
               <input type="text" class="form-control" id="nombre_farmacia" name="nombre_farmacia" value="'.$nFarmacia->getNombreFarmacia($row['nombre_farmacia']).'">
              </div>

              <div class="form-group">
               <label for="direccion_farmacia"><span class="label label-default"> Dirección Farmacia</span></label>
               <input type="text" class="form-control" id="direccion_farmacia" name="direccion_farmacia" value="'.$nFarmacia->getDireccionFarmacia($row['direccion_farmacia']).'">
              </div>

              <div class="form-group">
               <label for="telefono_1"><span class="label label-default"> Telefono 1</span></label>
               <input type="text" class="form-control" id="telefono_1" name="telefono_1" value="'.$nFarmacia->getTelefono1($row['telefono_1']).'">
              </div>

              <div class="form-group">
               <label for="telefono_2"><span class="label label-default"> Telefono 2</span></label>
               <input type="text" class="form-control" id="telefono_2" name="telefono_2" value="'.$nFarmacia->getTelefono2($row['telefono_2']).'">
              </div>

              <div class="form-group">
               <label for="email"><span class="label label-default"> Email</span></label>
               <input type="email" class="form-control" id="email" name="email" value="'.$nFarmacia->getEmail($row['email']).'">
              </div>

              <div class="form-group">
                <label for="obra_social"><span class="label label-default"> Obra Social</span></label>
                    <select class="form-control" id="obra_social" name="obra_social">
                    <option value="" selected disabled>Seleccionar</option>
                    <option value="1" '.(($nFarmacia->getObraSocial($row['obra_social']) == 1) ? "selected" : "").'>Atiende Obras Sociales</option>
                    <option value="0" '.(($nFarmacia->getObraSocial($row['obra_social']) == 0) ? "selected" : "").'>No Atiende Obras Sociales</option>
                </select>
              </div>

              <div class="form-group">
                <label for="comment"><span class="label label-default"> Ubicación Geografica</span></label>
                <textarea class="form-control" rows="5" id="geo" name="geo"> '.$nFarmacia->getGeo($row['geo']).'</textarea>
              </div><br>

              <button type="submit" class="btn btn-primary btn-block" id="edit_farmacia">
                <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Actualizar</button>
              </form><hr>

              <div id="messageEditFarmacia"></div>

              </div>
              </div>';

    } // FIN DE LA FUNCION


    public function formCargarTurno($nFarmacia,$id,$conn,$dbname){

        // realizamos la consulta
        $sql  = "select nombre_farmacia from fc_farmacias where id = '$id'";
        $query = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($query);

        echo '<div class="container">
                <div class="jumbotron">
                <div class="alert alert-info">
                    <p><img src="../img/icons/actions/view-time-schedule-insert.png"  class="img-reponsive img-rounded" alt="img" />
                         <strong>Carga de Turnos para la Farmacia: <span class="label label-default">'.$nFarmacia->getNombreFarmacia($row['nombre_farmacia']).'</span></strong></p>
                </div>
                <form id="fr_cargar_turno_farmacia_ajax" method="POST">

                <input type="hidden" id="id" name="id" value="'.$id.'">

                <div class="form-group">
                    <label for="fecha_turno"><span class="label label-default">Fecha Turno</span></label>
                    <input type="date" class="form-control" id="fecha_turno" name="fecha_turno">
                </div>

                <button type="submit" class="btn btn-primary" id="cargar_fecha_turno">
                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Aceptar</button>
                </form><hr>
                <div id="messageNewTurnoFarmacia"></div>
                </div>
                </div>';


    } // FIN DE LA FUNCTION


    public function calendario($conn, $dbase) {

		$diaSem = array(0=> "",
        1=> "Lúnes",
		2=> "Martes",
		3=> "Miércoles",
		4=> "Jueves",
		5=> "Viernes",
		6=> "Sábado",
		7=> "Domingo");

		$semana = 1;
		$dia = date('j');
		$mes = date('m');
		$anio= date('Y');

        /*
		echo "<div class='col-sm-2' align='center'>
               <div class='panel panel-default'>
                <div class='panel-heading'>

                <div class='form-group'>
                 <label for='anio'>Selecione Año:</label>
                  <select class='form-control' id='anio' name='cambio_anio' onchange='cambiarAnio(this.value);'>";

                    for($i = 2020; $i <= 2100; $i++) {
                        echo '<option value="'.$i.'" '.($i == $anio?"selected":'').'>'.$i.'</option>';

                    }

            echo '</select>
                  </div>';

            echo "</div>
                  </div>

                    <div class='panel panel-default'>
                     <div class='panel-heading'>

                      <div class='form-group'>
                       <label for='mes'>Selecione Mes:</label>
                        <select class='form-control' id='mes' name='cambio_mes' onchange='cambiarMes(this.value);'>";

                            for($i = 1; $i <= 12; $i++) {

                                echo '<option value="'.$i.'" '.($i == $mes ? "selected":'').'>'.$i.'</option>';

                            }

                        echo '</select></div>';

                        echo "</div>
                              </div><br>
                              </div>";

		$nuevo_anio = '<div id="nuevo_anio" ></div>';
		//$n_anio = strVal($nuevo_anio);

		$nuevo_mes = '<div id="nuevo_mes"></div>';
		//$n_mes = strVal($nuevo_mes);

		echo $nuevo_anio;
		echo $nuevo_mes;
        */

		$miAnio = intVal($anio);

		switch ($mes) {

			case '01':$mi_mes = 'Enero';
                $cant_dias = 31;
                break;

			case '02':$mi_mes = 'Febrero';
                if ($miAnio % 4 != 0) {
                    $cant_dias = 28;
                } else if ($miAnio % 4 == 0) {
                    $cant_dias = 29;
                }
                break;

			case '03':$mi_mes = 'Marzo';
                $cant_dias = 31;
                break;

            case '04':$mi_mes = 'Abril';
                $cant_dias = 30;
                break;

            case '05':$mi_mes = 'Mayo';
                $cant_dias = 31;
                break;

            case '06':$mi_mes = 'Junio';
                $cant_dias = 30;
                break;

            case '07':$mi_mes = 'Julio';
                $cant_dias = 31;
                break;

            case '08':$mi_mes = 'Agosto';
                $cant_dias = 31;
                break;

            case '09':$mi_mes = 'Septiembre';
                $cant_dias = 30;
                break;

            case '10':$mi_mes = 'Octubre';
                $cant_dias = 31;
                break;

            case '11':$mi_mes = 'Noviembre';
                $cant_dias = 30;
                break;

            case '12':$mi_mes = 'Diciembre';
                $cant_dias = 31;
                break;
		}

		for ($i = 1; $i <= $cant_dias; $i++) {

			$diaSemana = date('N', strtotime(date(''.$anio.'-'.$mes.'').'-'.$i));
			$calendario[$semana][$diaSemana] = $i;

			if ($diaSemana == 7) {
				$semana++;
			}
		}

		echo "<div class='container'>
                <div class='jumbotron'>
                    <div class='alert alert-info'>
                        <p><img src='../img/icons/emblems/vcs-added.png'  class='img-reponsive img-rounded' alt='img' /> <strong>Farmacias de Turno</strong></p>
                    </div>

                <table class='table table-bordered' id='calendar-table'>
                    <thead>

                    <tr>";
		echo "<th class='text-nowrap text-center' id='mi_anio' style='background-color:#454545; color: white;' colspan=2>Año: $anio </th>
                                <th class='text-nowrap text-center' id='mi_mes' style='background-color:#454545; color: white;' colspan=5>Mes $mi_mes</th>";

		echo "</tr>
                <tr>
                    <td class='text-nowrap text-center' style='background-color:#454545; color: white;'> $diaSem[1] &nbsp;</td>
                    <td class='text-nowrap text-center' style='background-color:#454545; color: white;'> $diaSem[2] &nbsp;</td>
                    <td class='text-nowrap text-center' style='background-color:#454545; color: white;'> $diaSem[3] &nbsp;</td>
                    <td class='text-nowrap text-center' style='background-color:#454545; color: white;'> $diaSem[4] &nbsp;</td>
                    <td class='text-nowrap text-center' style='background-color:#454545; color: white;'> $diaSem[5] &nbsp;</td>
                    <td class='text-nowrap text-center' style='background-color:#454545; color: white;'> $diaSem[6] &nbsp;</td>
                    <td class='text-nowrap text-center' style='background-color:#454545; color: white;'> $diaSem[7] &nbsp;</td>
                </tr>
            </thead>
            <tbody>";

                foreach ($calendario as $dias) {

                    echo "<tr>";
                    for ($i = 1; $i <= 7; $i++) {

                        if ($dias[$i] == $dia) {
                            echo "<td align=center id='dia' style='background-color:#FFA07A; color: whi<th class='text-nowrap text-center' style='background-color:#454545; color: white;'>".$dias[$i]."</td>";
                        } else if ($i == 7) {
                            echo "<td align=center style='background-color: #FF5733; color: white;'>".$dias[$i]."</td>";
                        } else if ($dias[$i] == '') {
                            echo "<td align=center style='background-color:  #d5dbdb; color: white;'>".$dias[$i]."</td>";
                        } else {
                            echo "<td align=center>".$dias[$i]."</td>";
                        }
                    }

                    echo "</tr>";
                }

		echo "</tbody>
              </table>
              <br/>
              </div></div>";

	}// FIN FUNCION



    // PERSISTENCIA
    public function addFarmacia($nFarmacia,$nombre_farmacia,$direccion_farmacia,$telefono_1,$telefono_2,$email,$obra_social,$conn,$db_basename){

        // VERIFICAMOS QUE NO EXISTA PREVIAMENTE LA FARMACIA
        mysqli_select_db($conn,$db_basename);
        $sql = "select * from fc_farmacias where nombre_farmacia = $nFarmacia->getNombreFarmacia('$nombre_farmacia')";
        $query = mysqli_query($conn,$sql);
        $rows = mysqli_num_rows($query);

        if($rows <= 0){

            $sql_1 = "insert into fc_farmacias ".
                     "(nombre_farmacia,
                       direccion_farmacia,
                       telefono_1,
                       telefono_2,
                       email,
                       obra_social) ".
                     "VALUES ".
                     "($nFarmacia->setNombreFarmacia('$nombre_farmacia'),
                      $nFarmacia->setDireccionFarmacia('$direccion_farmacia'),
                      $nFarmacia->setTelefono1('$telefono_1'),
                      $nFarmacia->setTelefono2('$telefono_2'),
                      $nFarmacia->setEmail('$email'),
                      $nFarmacia->setObraSocial('$obra_social'))";

            $query_1 = mysqli_query($conn,$sql_1);

            if($query_1){
                $success = "Registro guardado exitosamente en la tabla fc_farmacias. ";
                $nFarmacia->successMysqlFarmacia($success);
                echo 1; // registro guardado correctamente
            }else{
                $error = "Ocurrió un problema al intentar guardar registro en fc_farmacias:  ".mysqli_error($conn);
                $nFarmacia->errorMysqlFarmacia($error);
                echo -1; // hubo un problema al intentar guardar el registro
            }
        }
        if($rows == 1){
            echo 9; // registro existente
        }

    } // FIN DE LA FUNCION

    public function updateFarmacia($nFarmacia,$id,$nombre_farmacia,$direccion_farmacia,$telefono_1,$telefono_2,$email,$obra_social,$geo,$conn,$dbname){

        mysqli_select_db($conn,$dbname);
        $sql = "update fc_farmacias set ".
                "nombre_farmacia = $nFarmacia->setNombreFarmacia('$nombre_farmacia'), ".
                "direccion_farmacia = $nFarmacia->setDireccionFarmacia('$direccion_farmacia'), ".
                "telefono_1 = $nFarmacia->setTelefono1('$telefono_1'), ".
                "telefono_2 = $nFarmacia->setTelefono2('$telefono_2'), ".
                "email = $nFarmacia->setEmail('$email'), ".
                "obra_social = $nFarmacia->setObraSocial('$obra_social'), ".
                "geo = $nFarmacia->setGeo('$geo') where id = '$id'";

        $query = mysqli_query($conn,$sql);

        if($query){
            $success = "Registro actualizado exitosamente en la tabla fc_farmacias con id: ".$id." ";
            $nFarmacia->successUpdateMysqlFarmacia($success);
            echo 1; // registro guardado correctamente
        }else{
            $error = "Ocurrió un problema al intentar actualizar registro id: '.$id.' en fc_farmacias:  ".mysqli_error($conn);
            $nFarmacia->errorMysqlFarmacia($error);
            echo -1; // hubo un problema al intentar guardar el registro
        }

    } // FIN DE LA FUNCTION


    public function addFechaFarmacia($nFarmacia,$id,$fecha_turno,$conn,$dbname){

        mysqli_select_db($conn,$dbname);
        // se verifica que no exista turno el mismo dia para la misma farmacia
        $sql = "select * from fc_calendario where fecha = '$fecha_turno' and id_farmacia = '$id'";
        $query = mysqli_query($conn,$sql);
        $rows = mysqli_num_rows($query);

        if($rows <= 0){

            $sql_1 = "INSERT INTO fc_calendario ".
                     "(fecha,id_farmacia) ".
                     "VALUES ".
                     "('$fecha_turno','$id')";

           $query_1 = mysqli_query($conn,$sql_1);

           if($query_1){
               $success = "Registro guardado exitosamente en la tabla fc_calendario. ";
               $nFarmacia->successFechaTurnoMysqlFarmacia($success);
               echo 1; //registro guardo correctamente
           }else{
               $error = "Ocurrió un problema al intentar guardar registro en fc_calendario:  ".mysqli_error($conn);
               $nFarmacia->errorMysqlFechaTurnoFarmacia($error);
               echo -1; // hugo un problema al intentar guardar el registro
           }

        }
        if($rows == 1){
            echo 9; // turno existente para dicha farmacia
        }


    } // FIN DE LA FUNCTION


    // MENEJO DE  ACTUALIZACION EXITOSA

    public function successMysqlFarmacia($success){

        $fileName = "farmacia_mysql_success.log";
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
    } // END OF FUNCTION

    public function successUpdateMysqlFarmacia($success){

        $fileName = "farmacia_update_mysql_success.log";
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
    } // END OF FUNCTION


    public function successFechaTurnoMysqlFarmacia($success){

        $fileName = "farmacia_fecha_turno_mysql_success.log";
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
    } // END OF FUNCTION

    // MANEJO DE ERRORES

    public function errorMysqlFarmacia($error){

        $fileName = "farmacia_mysql_error.log";
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

    public function errorMysqlFechaTurnoFarmacia($error){

        $fileName = "farmacia_fecha_turno_mysql_error.log";
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

} // FIN DE LA CLASE

?>
