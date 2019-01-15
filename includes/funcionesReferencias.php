<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosReferencias {


	function GUID()
	{
		if (function_exists('com_create_guid') === true)
		{
			return trim(com_create_guid(), '{}');
		}

		return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
	}

	function sanear_string($string)
	{

		$string = trim($string);

		$string = str_replace(
			array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
			array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
			$string
		);

		$string = str_replace(
			array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
			array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
			$string
		);

		$string = str_replace(
			array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
			array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
			$string
		);

		$string = str_replace(
			array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
			array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
			$string
		);

		$string = str_replace(
			array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
			array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
			$string
		);

		$string = str_replace(
			array('ñ', 'Ñ', 'ç', 'Ç'),
			array('n', 'N', 'c', 'C',),
			$string
		);



		return $string;
	}


	function existeDevuelveId($sql) {

	    $res = $this->query($sql,0);

	    if (mysql_num_rows($res)>0) {
	        return mysql_result($res,0,0);
	    }
	    return 0;
	}

	function existe($sql) {

	    $res = $this->query($sql,0);

	    if (mysql_num_rows($res)>0) {
	        return 1;
	    }
	    return 0;
	}



	function insertarConfiguracion($razonsocial,$empresa,$sistema,$direccion,$telefono,$email) {
	$sql = "insert into tbconfiguracion(idconfiguracion,razonsocial,empresa,sistema,direccion,telefono,email)
	values ('','".($razonsocial)."','".($empresa)."','".($sistema)."','".($direccion)."','".($telefono)."','".($email)."')";
	$res = $this->query($sql,1);
	return $res;
	}


	function modificarConfiguracion($id,$razonsocial,$empresa,$sistema,$direccion,$telefono,$email) {
	$sql = "update tbconfiguracion
	set
	razonsocial = '".($razonsocial)."',empresa = '".($empresa)."',sistema = '".($sistema)."',direccion = '".($direccion)."',telefono = '".($telefono)."',email = '".($email)."'
	where idconfiguracion =".$id;
	$res = $this->query($sql,0);
	return $res;
	}


	function eliminarConfiguracion($id) {
	$sql = "delete from tbconfiguracion where idconfiguracion =".$id;
	$res = $this->query($sql,0);
	return $res;
	}


	function traerConfiguracion() {
	$sql = "select
	c.idconfiguracion,
	c.razonsocial,
	c.empresa,
	c.sistema,
	c.direccion,
	c.telefono,
	c.email
	from tbconfiguracion c
	order by 1";
	$res = $this->query($sql,0);
	return $res;
	}


	function traerConfiguracionPorId($id) {
	$sql = "select idconfiguracion,razonsocial,empresa,sistema,direccion,telefono,email from tbconfiguracion where idconfiguracion =".$id;
	$res = $this->query($sql,0);
	return $res;
	}

	/* Fin */
	/* /* Fin de la Tabla: tbconfiguracion*/


function traerContactosajaxPorCliente($length, $start, $busqueda, $idcliente) {

	$where = '';

	$busqueda = str_replace("'","",$busqueda);
	if ($busqueda != '') {
		$where = "and pl.planta like '%".$busqueda."%' or sec.sector like '%".$busqueda."%' or c.apellido like '%".$busqueda."%' or c.nombre like '%".$busqueda."%' or c.nrodocumento like '%".$busqueda."%' or c.email like '%".$busqueda."%' or c.telefono like '%".$busqueda."%'";
	}

	$sql = "select
	c.idcontacto,
	pl.planta,
	sec.sector,
	c.apellido,
	c.nombre,
	c.nrodocumento,
	c.email,
	c.telefono,
	c.refsectores
	from dbcontactos c
	inner join dbsectores sec ON sec.idsector = c.refsectores
	inner join dbplantas pl ON pl.idplanta = sec.refplantas
	where pl.refclientes = ".$idcliente." ".$where."
	order by c.apellido, c.nombre
	limit ".$start.",".$length;

	$res = $this->query($sql,0);
	return $res;
}



function traerEmpleadosajax($length, $start, $busqueda) {

	$where = '';

	$busqueda = str_replace("'","",$busqueda);
	if ($busqueda != '') {
		$where = "where e.apellido like '%".$busqueda."%' or e.nombre like '%".$busqueda."%' or e.nrodocumento like '%".$busqueda."%' or e.cuit like '%".$busqueda."%' or e.fechanacimiento like '%".$busqueda."%' or e.telefonomovil like '%".$busqueda."%' or e.email like '%".$busqueda."%' or (case when e.activo = 1 then 'Si' else 'No' end) = '".$busqueda."'";
	}

	$sql = "select
	e.idempleado,
	e.apellido,
	e.nombre,
	e.nrodocumento,
	e.cuit,
	e.fechanacimiento,
	e.telefonomovil,
	e.email,
	(case when e.activo = 1 then 'Si' else 'No' end) as activo
	from dbempleados e
	".$where."
	order by e.apellido, e.nombre
	limit ".$start.",".$length;

	$res = $this->query($sql,0);
	return $res;
}




/* PARA Historialplatosingredientes */

function insertarHistorialplatosingredientes($refplatos,$refingredientes,$tipo,$valorviejo,$valornuevo) {
$sql = "insert into dbhistorialplatosingredientes(iddbhistorialplatoingrediente,refplatos,refingredientes,tipo,valorviejo,valornuevo)
values ('',".$refplatos.",".$refingredientes.",'".($tipo)."','".($valorviejo)."','".($valornuevo)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarHistorialplatosingredientes($id,$refplatos,$refingredientes,$tipo,$valorviejo,$valornuevo) {
$sql = "update dbhistorialplatosingredientes
set
refplatos = ".$refplatos.",refingredientes = ".$refingredientes.",tipo = '".($tipo)."',valorviejo = '".($valorviejo)."',valornuevo = '".($valornuevo)."'
where iddbhistorialplatoingrediente =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarHistorialplatosingredientes($id) {
$sql = "delete from dbhistorialplatosingredientes where iddbhistorialplatoingrediente =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerHistorialplatosingredientes() {
$sql = "select
h.iddbhistorialplatoingrediente,
h.refplatos,
h.refingredientes,
h.fechacrecion,
h.tipo,
h.valorviejo,
h.valornuevo
from dbhistorialplatosingredientes h
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerHistorialplatosingredientesPorPlato($idplato) {
$sql = "select
h.iddbhistorialplatoingrediente,
p.nombre,
h.fechacrecion,
(case when h.tipo = 'I' then 'Insertar'
		when h.tipo = 'M' then 'Modificar'
		when h.tipo = 'E' then 'Eliminar' end) as accion,
h.valorviejo,
h.valornuevo,
h.refplatos,
h.refingredientes
from dbhistorialplatosingredientes h
inner join dbplatos p on p.idplato = h.refplatos
where p.idplato = ".$idplato."
order by h.fechacrecion";
$res = $this->query($sql,0);
return $res;
}


function traerHistorialplatosingredientesPorId($id) {
$sql = "select iddbhistorialplatoingrediente,refplatos,refingredientes,fechacrecion,tipo,valorviejo,valornuevo from dbhistorialplatosingredientes where iddbhistorialplatoingrediente =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbhistorialplatosingredientes*/


/* PARA Ingredientesalergenicos */

function insertarIngredientesalergenicos($refingredientes,$refalergenicos) {
$sql = "insert into dbingredientesalergenicos(idingredientealergenico,refingredientes,refalergenicos)
values ('',".$refingredientes.",".$refalergenicos.")";
$res = $this->query($sql,1);
return $res;
}


function modificarIngredientesalergenicos($id,$refingredientes,$refalergenicos) {
$sql = "update dbingredientesalergenicos
set
refingredientes = ".$refingredientes.",refalergenicos = ".$refalergenicos."
where idingredientealergenico =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarIngredientesalergenicos($id) {
$sql = "delete from dbingredientesalergenicos where idingredientealergenico =".$id;
$res = $this->query($sql,0);
return $res;
}

function existeIngredienteAlergenico($refingrediente, $refalergenico, $id=0) {
	if ($id != 0) {
		$sql = "select idingredientealergenico from dbingredientesalergenicos where refingredientes = ".$refingrediente." and refalergenicos = ".$refalergenico." and idingredientealergenico <> ".$id;
	} else {
		$sql = "select idingredientealergenico from dbingredientesalergenicos where refingredientes = ".$refingrediente." and refalergenicos = ".$refalergenico;
	}

	return $this->existe($sql);
}


function traerIngredientesalergenicosajax($length, $start, $busqueda) {

	$where = '';

	$busqueda = str_replace("'","",$busqueda);
	if ($busqueda != '') {
		$where = "where ale.alergenico like '%".$busqueda."%' or ing.ingrediente like '%".$busqueda."%' ";
	}

	$sql = "select
	i.idingredientealergenico,
	ing.ingrediente,
	ale.alergenico,
	i.refingredientes,
	i.refalergenicos
	from dbingredientesalergenicos i
	inner join tbingredientes ing ON ing.idingrediente = i.refingredientes
	inner join tbalergenicos ale ON ale.idalergenico = i.refalergenicos
	".$where."
	order by ing.ingrediente, ale.alergenico
	limit ".$start.",".$length;

	$res = $this->query($sql,0);
	return $res;
}

function traerIngredientesalergenicos() {
$sql = "select
i.idingredientealergenico,
i.refingredientes,
i.refalergenicos
from dbingredientesalergenicos i
inner join tbingredientes ing ON ing.idingrediente = i.refingredientes
inner join tbalergenicos ale ON ale.idalergenico = i.refalergenicos
order by ing.ingrediente, ale.alergenico";
$res = $this->query($sql,0);
return $res;
}


function traerIngredientesalergenicosPorId($id) {
$sql = "select idingredientealergenico,refingredientes,refalergenicos from dbingredientesalergenicos where idingredientealergenico =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbingredientesalergenicos*/


/* PARA Platos */

function insertarPlatos($nombre,$precio) {
$sql = "insert into dbplatos(idplato,nombre,precio)
values ('','".($nombre)."',".$precio.")";
$res = $this->query($sql,1);
return $res;
}


function modificarPlatos($id,$nombre,$precio) {
$sql = "update dbplatos
set
nombre = '".($nombre)."',precio = ".$precio."
where idplato =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarPlatos($id) {
$sql = "delete from dbplatos where idplato =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerPlatosajax($length, $start, $busqueda) {

	$where = '';

	$busqueda = str_replace("'","",$busqueda);
	if ($busqueda != '') {
		$where = "where p.nombre like '%".$busqueda."%'";
	}

	$sql = "select
	p.idplato,
	p.nombre,
	p.precio
	from dbplatos p
	".$where."
	order by p.nombre
	limit ".$start.",".$length;

	$res = $this->query($sql,0);
	return $res;
}

function traerPlatos() {
$sql = "select
p.idplato,
p.nombre,
p.precio
from dbplatos p
order by p.nombre";
$res = $this->query($sql,0);
return $res;
}


function traerPlatosPorId($id) {
$sql = "select idplato,nombre,precio from dbplatos where idplato =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbplatos*/


/* PARA Platosingredientes */

function insertarPlatosingredientes($refplatos,$refingredientes) {
$sql = "insert into dbplatosingredientes(idplatoingrediente,refplatos,refingredientes)
values ('',".$refplatos.",".$refingredientes.")";
$res = $this->query($sql,1);
return $res;
}


function modificarPlatosingredientes($id,$refplatos,$refingredientes) {
$sql = "update dbplatosingredientes
set
refplatos = ".$refplatos.",refingredientes = ".$refingredientes."
where idplatoingrediente =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarPlatosingredientes($id) {
$sql = "delete from dbplatosingredientes where idplatoingrediente =".$id;
$res = $this->query($sql,0);
return $res;
}

function existePlatoIngrediente($refplato, $refingrediente, $id=0) {
	if ($id != 0) {
		$sql = "select idplatoingrediente from dbplatosingredientes where refplatos = ".$refplato." and refingredientes = ".$refingrediente." and idplatoingrediente <> ".$id;
	} else {
		$sql = "select idplatoingrediente from dbplatosingredientes where refplatos = ".$refplato." and refingredientes = ".$refingrediente;
	}

	return $this->existe($sql);
}

function traerPlatosingredientesajax($length, $start, $busqueda) {

	$where = '';

	$busqueda = str_replace("'","",$busqueda);
	if ($busqueda != '') {
		$where = "where pla.nombre like '%".$busqueda."%' or ing.ingrediente like '%".$busqueda."%' ";
	}

	$sql = "select
	p.idplatoingrediente,
	pla.nombre,
	ing.ingrediente,
	p.refplatos,
	p.refingredientes
	from dbplatosingredientes p
	inner join dbplatos pla ON pla.idplato = p.refplatos
	inner join tbingredientes ing ON ing.idingrediente = p.refingredientes
	".$where."
	order by pla.nombre, ing.ingrediente
	limit ".$start.",".$length;

	$res = $this->query($sql,0);
	return $res;
}


function traerPlatosingredientes() {
$sql = "select
p.idplatoingrediente,
p.refplatos,
p.refingredientes
from dbplatosingredientes p
inner join dbplatos pla ON pla.idplato = p.refplatos
inner join tbingredientes ing ON ing.idingrediente = p.refingredientes
order by pla.nombre, ing.ingrediente";
$res = $this->query($sql,0);
return $res;
}

function traerPlatosingredientesPorIdCompleto($id) {
$sql = "select
p.idplatoingrediente,
pla.nombre,
ing.ingrediente,
p.refplatos,
p.refingredientes
from dbplatosingredientes p
inner join dbplatos pla ON pla.idplato = p.refplatos
inner join tbingredientes ing ON ing.idingrediente = p.refingredientes
where p.idplatoingrediente = ".$id;
$res = $this->query($sql,0);
return $res;
}


function traerPlatosingredientesPorId($id) {
$sql = "select idplatoingrediente,refplatos,refingredientes from dbplatosingredientes where idplatoingrediente =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbplatosingredientes*/


/* PARA Alergenicos */

function insertarAlergenicos($alergenico) {
$sql = "insert into tbalergenicos(idalergenico,alergenico)
values ('','".($alergenico)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarAlergenicos($id,$alergenico) {
$sql = "update tbalergenicos
set
alergenico = '".($alergenico)."'
where idalergenico =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarAlergenicos($id) {
$sql = "delete from tbalergenicos where idalergenico =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerAlergenicosajax($length, $start, $busqueda) {

	$where = '';

	$busqueda = str_replace("'","",$busqueda);
	if ($busqueda != '') {
		$where = "where a.alergenico like '%".$busqueda."%'";
	}

	$sql = "select
	a.idalergenico,
	a.alergenico
	from tbalergenicos a
	".$where."
	order by a.alergenico
	limit ".$start.",".$length;

	$res = $this->query($sql,0);
	return $res;
}


function traerAlergenicos() {
$sql = "select
a.idalergenico,
a.alergenico
from tbalergenicos a
order by a.alergenico";
$res = $this->query($sql,0);
return $res;
}


function traerAlergenicosPorId($id) {
$sql = "select idalergenico,alergenico from tbalergenicos where idalergenico =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbalergenicos*/


/* PARA Ingredientes */

function insertarIngredientes($ingrediente) {
$sql = "insert into tbingredientes(idingrediente,ingrediente)
values ('','".($ingrediente)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarIngredientes($id,$ingrediente) {
$sql = "update tbingredientes
set
ingrediente = '".($ingrediente)."'
where idingrediente =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarIngredientes($id) {
$sql = "delete from tbingredientes where idingrediente =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerIngredientesajax($length, $start, $busqueda) {

	$where = '';

	$busqueda = str_replace("'","",$busqueda);
	if ($busqueda != '') {
		$where = "where i.ingrediente like '%".$busqueda."%'";
	}

	$sql = "select
	i.idingrediente,
	i.ingrediente
	from tbingredientes i
	".$where."
	order by i.ingrediente
	limit ".$start.",".$length;

	$res = $this->query($sql,0);
	return $res;
}

function traerIngredientes() {
$sql = "select
i.idingrediente,
i.ingrediente
from tbingredientes i
order by i.ingrediente";
$res = $this->query($sql,0);
return $res;
}


function traerIngredientesPorId($id) {
$sql = "select idingrediente,ingrediente from tbingredientes where idingrediente =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerAlergenicosPorPlatos($idplato) {
	$sql = "SELECT DISTINCT
				    a.alergenico
				FROM
				    dbplatos p
				        INNER JOIN
				    dbplatosingredientes pli ON p.idplato = pli.refplatos
				        INNER JOIN
				    dbingredientesalergenicos ia ON ia.refingredientes = pli.refingredientes
				        INNER JOIN
				    tbalergenicos a ON a.idalergenico = ia.refalergenicos
				WHERE
				    p.idplato = ".$idplato;
	$res = $this->query($sql,0);
 	return $res;
}

function traerPlatosPorAlergenicos($idalergenico) {
	$sql = "SELECT DISTINCT
				    p.nombre
				FROM
				    dbplatos p
				        INNER JOIN
				    dbplatosingredientes pli ON p.idplato = pli.refplatos
				        INNER JOIN
				    dbingredientesalergenicos ia ON ia.refingredientes = pli.refingredientes
				        INNER JOIN
				    tbalergenicos a ON a.idalergenico = ia.refalergenicos
				WHERE
				    a.idalergenico = ".$idalergenico;
	$res = $this->query($sql,0);
 	return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbingredientes*/




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
