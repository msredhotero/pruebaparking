<?php

date_default_timezone_set('America/Buenos_Aires');

class appconfig {

function conexion() {
/*
		$hostname = "localhost";
		$database = "restaurant";
		$username = "root";
		$password = "";
*/

		$hostname = "localhost";
		$database = "u235498999_resta";
		$username = "u235498999_resta";
		$password = "rhcp7575";
		//u235498999_kike usuario


		$conexion = array("hostname" => $hostname,
						  "database" => $database,
						  "username" => $username,
						  "password" => $password);

		return $conexion;
}

}




?>
