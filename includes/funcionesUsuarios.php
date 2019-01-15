<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosUsuarios {

function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}


function login($usuario,$pass) {

	$sqlusu = "select * from dbusuarios where email = '".$usuario."'";

	$error = '';

	if (trim($usuario) != '' and trim($pass) != '') {

	$respusu = $this->query($sqlusu,0);

	if (mysql_num_rows($respusu) > 0) {


		$idUsua = mysql_result($respusu,0,0);
		$sqlpass = "select nombrecompleto,email,usuario,r.descripcion, r.idrol, u.refcontactos
				from dbusuarios u
				inner join tbroles r on r.idrol = u.refroles
				where password = '".$pass."' and u.activo = 1 and idusuario = ".$idUsua;


		$resppass = $this->query($sqlpass,0);

		if (mysql_num_rows($resppass) > 0) {
			$error = '';
			} else {
				$error = 'Usuario o Password incorrecto';
			}

		}
		else

		{
			$error = 'Usuario o Password incorrecto';
		}

		if ($error == '') {
			//die(var_dump($error));
			session_start();
			$_SESSION['usua_sahilices'] = $usuario;
			$_SESSION['nombre_sahilices'] = mysql_result($resppass,0,0);
			$_SESSION['usuaid_sahilices'] = $idUsua;
			$_SESSION['email_sahilices'] = mysql_result($resppass,0,1);
			$_SESSION['idroll_sahilices'] = mysql_result($resppass,0,4);
			$_SESSION['refroll_sahilices'] = mysql_result($resppass,0,3);
			$_SESSION['idcontacto_sahilices'] = mysql_result($resppass,0,'refcontactos');


			return 1;
		}

	}	else {
		$error = 'Usuario y Password son campos obligatorios';
	}


	return $error;

}

function loginFacebook($usuario) {

	$sqlusu = "select concat(apellido,' ',nombre),email,direccion,refroll from se_usuarios where email = '".$usuario."'";
	$error = '';


if (trim($usuario) != '') {

$respusu = $this->query($sqlusu,0);

	if (mysql_num_rows($respusu) > 0) {


		if ($error == '') {
			session_start();
			$_SESSION['usua_predio'] = $usuario;
			$_SESSION['nombre_predio'] = mysql_result($resppass,0,0);
			$_SESSION['email_predio'] = mysql_result($resppass,0,1);
			$_SESSION['refroll_predio'] = mysql_result($resppass,0,3);
			//$error = 'andube por aca'-$sqlusu;
		}

	}	else {
		$error = 'Usuario y Password son campos obligatorios';
	}

}

	return $error;

}




function loginUsuario($usuario,$pass) {

	$sqlusu = "select * from dbusuarios where email = '".$usuario."'";



if (trim($usuario) != '' and trim($pass) != '') {

	$respusu = $this->query($sqlusu,0);

	if (mysql_num_rows($respusu) > 0) {
		$error = '';

		$idUsua = mysql_result($respusu,0,0);
		$sqlpass = "select concat(apellido,' ',nombre),email,refroles from dbusuarios where password = '".$pass."' and IdUsuario = ".$idUsua;

		$resppass = $this->query($sqlpass,0);

			if (mysql_num_rows($resppass) > 0) {
				$error = '';

			} else {
				if (mysql_result($respusu,0,'activo') == 0) {
					$error = 'El usuario no fue activado, verifique su cuenta de email: '.$usuario;
				} else {
					$error = 'Usuario o Password incorrecto';
				}

			}

		}
		else

		{
			$error = 'Usuario o Password incorrecto';
		}

		if ($error == '') {
			session_start();
			$_SESSION['usua_predio'] = $usuario;
			$_SESSION['nombre_predio'] = mysql_result($resppass,0,0);
			$_SESSION['email_predio'] = mysql_result($resppass,0,1);
			$_SESSION['refroll_predio'] = mysql_result($resppass,0,2);
		}


	}	else {
		$error = 'Usuario y Password son campos obligatorios';
	}


	return $error;

}


function traerRoles() {
	$sql = "select * from tbroles";
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function traerRolesSimple() {
	$sql = "select * from tbroles where idrol <> 1";
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}


function traerUsuario($email) {
	$sql = "select idusuario,usuario,refroll,nombrecompleto,email,password from se_usuarios where email = '".$email."'";
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function traerUsuarios() {
	$sql = "select u.idusuario,u.usuario, u.password, r.descripcion, u.email , u.nombrecompleto, u.refroles
			from dbusuarios u
			inner join tbroles r on u.refroles = r.idrol
			order by nombrecompleto";
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}


function traerUsuariosSimple() {
	$sql = "select u.idusuario,u.usuario, u.password, r.descripcion, u.email , u.nombrecompleto, u.refroles
			from dbusuarios u
			inner join tbroles r on u.refroles = r.idrol
			where r.idrol <> 1
			order by nombrecompleto";
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function traerTodosUsuarios() {
	$sql = "select u.idusuario,u.usuario,u.nombrecompleto,u.refroll,u.email,u.password
			from se_usuarios u
			order by nombrecompleto";
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function traerUsuarioId($id) {
	$sql = "select idusuario,usuario,refroles,nombrecompleto,email,password from dbusuarios where idusuario = ".$id;
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		return $res;
	}
}

function existeUsuario($usuario) {
	$sql = "select * from dbusuarios where email = '".$usuario."'";
	$res = $this->query($sql,0);
	if (mysql_num_rows($res)>0) {
		return true;
	} else {
		return false;
	}
}

function enviarEmail($destinatario,$asunto,$cuerpo) {


	# Defina el número de e-mails que desea enviar por periodo. Si es 0, el proceso por lotes
	# se deshabilita y los mensajes son enviados tan rápido como sea posible.
	define("MAILQUEUE_BATCH_SIZE",0);

	//para el envío en formato HTML
	//$headers = "MIME-Version: 1.0\r\n";

	// Cabecera que especifica que es un HMTL
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	//dirección del remitente
	$headers .= "From: Daniel Eduardo Duranti <info@carnesacasa.com.ar>\r\n";

	//ruta del mensaje desde origen a destino
	$headers .= "Return-path: ".$destinatario."\r\n";

	//direcciones que recibirán copia oculta
	$headers .= "Bcc: info@carnesacasa.com.ar,msredhotero@msn.com\r\n";

	mail($destinatario,$asunto,$cuerpo,$headers);
}


function insertarUsuario($usuario,$password,$refroles,$email,$nombrecompleto) {
	$sql = "INSERT INTO dbusuarios
				(idusuario,
				usuario,
				password,
				refroles,
				email,
				nombrecompleto)
			VALUES
				('',
				'".($usuario)."',
				'".($password)."',
				".$refroles.",
				'".($email)."',
				'".($nombrecompleto)."')";
	if ($this->existeUsuario($email) == true) {
		return "Ya existe el usuario";
	}
	$res = $this->query($sql,1);
	if ($res == false) {
		return 'Error al insertar datos';
	} else {

		return $res;
	}
}


function modificarUsuario($id,$usuario,$password,$refroles,$email,$nombrecompleto) {
	$sql = "UPDATE dbusuarios
			SET
				usuario = '".utf8_decode($usuario)."',
				password = '".utf8_decode($password)."',
				email = '".utf8_decode($email)."',
				refroles = ".$refroles.",
				nombrecompleto = '".utf8_decode($nombrecompleto)."'
			WHERE idusuario = ".$id;
	$res = $this->query($sql,0);
	if ($res == false) {
		return 'Error al modificar datos';
	} else {
		return '';
	}
}



function query($sql,$accion) {



		require_once 'appconfig.php';

		$appconfig	= new appconfig();
		$datos		= $appconfig->conexion();
		$hostname	= $datos['hostname'];
		$database	= $datos['database'];
		$username	= $datos['username'];
		$password	= $datos['password'];

		$conex = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());

		mysql_select_db($database);

		        $error = 0;
		mysql_query("BEGIN");
		$result=mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		if(!$result){
			$error=1;
		}
		if($error==1){
			mysql_query("ROLLBACK");
			return false;
		}
		 else{
			mysql_query("COMMIT");
			return $result;
		}

	}

}

?>
