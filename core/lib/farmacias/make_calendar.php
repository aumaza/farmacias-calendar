<?php session_start();

      error_reporting(E_ALL ^ E_NOTICE);
      ini_set('display_errors', 1);

      include "../../../connection/connection.php";
      include "../lib_system.php";

      $varsession = $_SESSION['user'];



  if($varsession == null || $varsession == ''){
        echo '<!DOCTYPE html>
                <html lang="es">
                <head>
                <title>Calendario de Farmacias - Main</title>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">';
                skeleton();
                echo '</head><body style = "background: #839192;">';
                echo '<br><div class="container">
                        <div class="alert alert-danger" role="alert">';
                echo '<p align="center"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Su sesión ha caducado. Por favor, inicie sesión nuevamente</p>';
                echo '<a href="../../logout.php"><hr><button type="buton" class="btn btn-default btn-block"><span class="glyphicon glyphicon-send" aria-hidden="true"></span> Iniciar</button></a>';
                echo "</div></div>";
                die();
                echo '</body></html>';
  }

      // Conexión a la base de datos
/*$host = 'slackzone.ddns.net';
$db = 'farmacia_calendar';
$user = 'root';
$pass = 'slack142';*/

try {
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbase;charset=utf8", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}

// Función para obtener eventos del mes
function obtenerEventos($pdo, $anio, $mes, $id_farmacia) {
    //$sql = "SELECT * FROM fc_calendario WHERE YEAR(fecha) = :anio AND MONTH(fecha) = :mes";

    if($id_farmacia == ''){

        $sql = "SELECT fecha, (select nombre_farmacia from fc_farmacias where fc_farmacias.id = fc_calendario.id_farmacia) as farmacia FROM fc_calendario WHERE YEAR(fecha) = :anio AND MONTH(fecha) = :mes";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['anio' => $anio, 'mes' => $mes]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
    if($id_farmacia != ''){
        $sql = "SELECT fecha, (select nombre_farmacia from fc_farmacias where fc_farmacias.id = fc_calendario.id_farmacia) as farmacia FROM fc_calendario WHERE YEAR(fecha) = :anio AND MONTH(fecha) = :mes AND id_farmacia = '$id_farmacia'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['anio' => $anio, 'mes' => $mes]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Parámetros del mes actual o seleccionado
$id_farmacia = $_GET['id_farmacia'];
$anio = isset($_GET['anio']) ? intval($_GET['anio']) : date('Y');
$mes = isset($_GET['mes']) ? intval($_GET['mes']) : date('m');

// Obtener eventos del mes
$eventos = obtenerEventos($pdo, $anio, $mes, $id_farmacia);

// Crear matriz de eventos por día
$eventosPorDia = [];
foreach ($eventos as $evento) {
    $dia = (int)date('j', strtotime($evento['fecha']));
    $eventosPorDia[$dia][] = $evento;
}

// Crear el calendario
function crearCalendario($anio, $mes, $eventosPorDia,$id_farmacia) {
    $primerDiaMes = strtotime("$anio-$mes-01");
    $diasEnMes = date('t', $primerDiaMes);
    $diaSemanaPrimerDia = date('N', $primerDiaMes);
    $nombreMes = date('F', $primerDiaMes);
    $hoy = date('d');
    $mesActual = date('F');

    switch($nombreMes){

        case 'January': $nombreMes = 'Enero'; break;
        case 'February': $nombreMes = 'Febrero'; break;
        case 'March': $nombreMes = 'Marzo'; break;
        case 'April': $nombreMes = 'Abril'; break;
        case 'May': $nombreMes = 'Mayo'; break;
        case 'June': $nombreMes = 'Junio'; break;
        case 'July': $nombreMes = 'Julio'; break;
        case 'August': $nombreMes = 'Agosto'; break;
        case 'September': $nombreMes = 'Septiembre'; break;
        case 'October': $nombreMes = 'Octubre'; break;
        case 'November': $nombreMes = 'Noviembre'; break;
        case 'December': $nombreMes = 'Diciembre'; break;

    }

    switch($mesActual){

        case 'January': $mesActual = 'Enero'; break;
        case 'February': $mesActual = 'Febrero'; break;
        case 'March': $mesActual = 'Marzo'; break;
        case 'April': $mesActual = 'Abril'; break;
        case 'May': $mesActual = 'Mayo'; break;
        case 'June': $mesActual = 'Junio'; break;
        case 'July': $mesActual = 'Julio'; break;
        case 'August': $mesActual = 'Agosto'; break;
        case 'September': $mesActual = 'Septiembre'; break;
        case 'October': $mesActual = 'Octubre'; break;
        case 'November': $mesActual = 'Noviembre'; break;
        case 'December': $mesActual = 'Diciembre'; break;

    }

    echo '<div class="container-fluid">
            <div class="jumbotron">';

    echo "<table class='table table-bordered'>";
    echo "<div class='alert alert-success'>
            <p><img src='../../img/icons/actions/view-calendar.png'  class='img-reponsive img-rounded' alt='img' /> <strong>$nombreMes $anio</strong></p></div><hr>";
    echo "<tr>";
    foreach (['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'] as $dia) {
        echo "<th class='text-nowrap text-center' style='background-color:#454545; color: white;'>$dia</th>";
    }
    echo "</tr>";

    $dia = 1 - $diaSemanaPrimerDia + 1;
    while ($dia <= $diasEnMes) {
        echo "<tr>";
        for ($i = 0; $i < 7; $i++, $dia++) {

            if ($dia > 0 && $dia <= $diasEnMes) {

                    if($i == 6){
                        echo "<td align=center><h3><span class='label label-danger'>$dia</span></h3>";
                    }else if(($dia == $hoy) && ($nombreMes == $mesActual)){
                        echo "<td align=center><h3><span class='label label-success'>$dia</span></h3>";
                    }else{
                        echo "<td align=center><h3><span class='label label-warning'>$dia</span></h3>";
                    }

                if (isset($eventosPorDia[$dia])) {
                    foreach ($eventosPorDia[$dia] as $evento) {
                        echo "<div><span class='label label-default'>{$evento['farmacia']}</span></div>";
                    }
                }
                echo "</td>";
            } else {
                echo "<td></td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";

    // Navegación
    $mesAnterior = $mes - 1 > 0 ? $mes - 1 : 12;
    $anioAnterior = $mes - 1 > 0 ? $anio : $anio - 1;

    $mesSiguiente = $mes + 1 <= 12 ? $mes + 1 : 1;
    $anioSiguiente = $mes + 1 <= 12 ? $anio : $anio + 1;
    echo '<div align=center>
            <div class="alert alert-info">
                <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> <strong>Importante</strong>
                    Sábados, Domingos y Feriados atenderán solamente las farmacias de turno. <strong>Los turnos comenzarán a las 8:30 hs
                    del día indicado y finalizarán a las 8:30 hs del día siguiente</strong>.
            </div>
          </div><hr>';
    echo "<div align=center><div class='alert alert-success'>";
    echo "<a href='?anio=$anioAnterior&mes=$mesAnterior&id_farmacia=$id_farmacia'>
            <button type='button' class='btn btn-default btn-sm'>
                <span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span> Mes Anterior</button></a>";
    echo " <span class='glyphicon glyphicon-transfer' aria-hidden='true'></span> ";
    echo "<a href='?anio=$anioSiguiente&mes=$mesSiguiente&id_farmacia=$id_farmacia'>
            <button type='button' class='btn btn-default btn-sm'>Mes Siguiente <span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span></button></a></div>";
    echo "</div></div></div>";
}


?>


<!DOCTYPE html>
<html lang="es">
<head>
  <title>Calendario de Farmacias - Menú Principal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php skeleton(); ?>
</head>


<body onload="lock();">

<div class="container-fluid"><br>

  <?php

  // Mostrar el calendario
    crearCalendario($anio, $mes, $eventosPorDia,$id_farmacia);


  ?>

</div>
</body>
</html>
