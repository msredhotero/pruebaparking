<?php
session_start();
$_SESSION['usua_sahilices'] = 'El Parking';
$_SESSION['nombre_sahilices'] = 'El Parking';
$_SESSION['usuaid_sahilices'] = 1;
$_SESSION['email_sahilices'] = 'El Parking';
$_SESSION['idroll_sahilices'] = 1;
$_SESSION['refroll_sahilices'] = 'Administrador';

header('Location: dashboard/');

?>
