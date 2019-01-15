<?php


include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funcionesReferencias.php');
include ('../includes/funcionesNotificaciones.php');


$serviciosUsuarios  		= new ServiciosUsuarios();
$serviciosFunciones 		= new Servicios();
$serviciosHTML				= new ServiciosHTML();
$serviciosReferencias		= new ServiciosReferencias();
$serviciosNotificaciones	= new ServiciosNotificaciones();

$resV['error'] = '';
$resV['mensaje'] = '';

$accion = $_POST['accion'];


switch ($accion) {
    case 'traerImgenCountry':
        traerImgenCountry($serviciosReferencias);
    break;

}


function traerImgenCountry($serviciosReferencias) {
	$id = $_POST['id'];

	$res = $serviciosReferencias->traerCountriesPorId($id);

	$imagen = mysql_result($res,0,'imagen');

	echo $imagen;
}


?>