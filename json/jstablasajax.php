<?php


include ('../includes/funciones.php');
include ('../includes/funcionesReferencias.php');

$serviciosFunciones = new Servicios();
$serviciosReferencias 	= new ServiciosReferencias();

$tabla = $_GET['tabla'];
$draw = $_GET['sEcho'];
$start = $_GET['iDisplayStart'];
$length = $_GET['iDisplayLength'];
$busqueda = $_GET['sSearch'];

$referencia1 = 0;

if (isset($_GET['referencia1'])) {
	$referencia1 = $_GET['referencia1'];
} else {
	$referencia1 = 0;
}

function armarAcciones($id,$label='',$class,$icon) {
	$cad = "";

	for ($j=0; $j<count($class); $j++) {
		$cad .= '<button type="button" class="btn '.$class[$j].' btn-circle waves-effect waves-circle waves-float '.$label[$j].'" id="'.$id.'">
				<i class="material-icons">'.$icon[$j].'</i>
			</button> ';
	}

	return $cad;
}

switch ($tabla) {
	case 'platos':
		$resAjax = $serviciosReferencias->traerPlatosajax($length, $start, $busqueda);
		$res = $serviciosReferencias->traerPlatos();
		$label = array('btnModificar','btnEliminar');
		$class = array('bg-amber','bg-red');
		$icon = array('create','delete');
		$indiceID = 0;
		$empieza = 1;
		$termina = 2;

		break;
	case 'ingredientes':
		$resAjax = $serviciosReferencias->traerIngredientesajax($length, $start, $busqueda);
		$res = $serviciosReferencias->traerIngredientes();
		$label = array('btnModificar','btnEliminar');
		$class = array('bg-amber','bg-red');
		$icon = array('create','delete');
		$indiceID = 0;
		$empieza = 1;
		$termina = 1;

		break;
	case 'alergenicos':
		$resAjax = $serviciosReferencias->traerAlergenicosajax($length, $start, $busqueda);
		$res = $serviciosReferencias->traerAlergenicos();
		$label = array('btnModificar','btnEliminar');
		$class = array('bg-amber','bg-red');
		$icon = array('create','delete');
		$indiceID = 0;
		$empieza = 1;
		$termina = 1;

		break;
	case 'ingredientesalergenicos':
		$resAjax = $serviciosReferencias->traerIngredientesalergenicosajax($length, $start, $busqueda);
		$res = $serviciosReferencias->traerIngredientesalergenicos();
		$label = array('btnModificar','btnEliminar');
		$class = array('bg-amber','bg-red');
		$icon = array('create','delete');
		$indiceID = 0;
		$empieza = 1;
		$termina = 2;

		break;
	case 'platoingredientes':
		$resAjax = $serviciosReferencias->traerPlatosingredientesajax($length, $start, $busqueda);
		$res = $serviciosReferencias->traerPlatosingredientes();
		$label = array('btnModificar','btnEliminar');
		$class = array('bg-amber','bg-red');
		$icon = array('create','delete');
		$indiceID = 0;
		$empieza = 1;
		$termina = 2;

		break;
	case 'motivosoportunidades':
		$resAjax = $serviciosReferencias->traerMotivosoportunidadesajax($length, $start, $busqueda);
		$res = $serviciosReferencias->traerMotivosoportunidades();
		$label = array('btnModificar','btnEliminar');
		$class = array('bg-amber','bg-red');
		$icon = array('create','delete');
		$indiceID = 0;
		$empieza = 1;
		$termina = 2;

		break;
	case 'recursosnecesarios':
		$resAjax = $serviciosReferencias->traerRecursosnecesariosajax($length, $start, $busqueda);
		$res = $serviciosReferencias->traerRecursosnecesarios();
		$label = array('btnModificar','btnEliminar');
		$class = array('bg-amber','bg-red');
		$icon = array('create','delete');
		$indiceID = 0;
		$empieza = 1;
		$termina = 2;

		break;
	case 'empleados':
		$resAjax = $serviciosReferencias->traerEmpleadosajax($length, $start, $busqueda);
		$res = $serviciosReferencias->traerEmpleados();
		$label = array('btnModificar','btnEliminar');
		$class = array('bg-amber','bg-red');
		$icon = array('create','delete');
		$indiceID = 0;
		$empieza = 1;
		$termina = 8;

		break;
	case 'conceptos':
		$resAjax = $serviciosReferencias->traerConceptosajax($length, $start, $busqueda);
		$res = $serviciosReferencias->traerConceptos();
		$label = array('btnModificar','btnEliminar');
		$class = array('bg-amber','bg-red');
		$icon = array('create','delete');
		$indiceID = 0;
		$empieza = 1;
		$termina = 4;

		break;
	case 'clientes':
		$resAjax = $serviciosReferencias->traerClientesajax($length, $start, $busqueda);
		$res = $serviciosReferencias->traerClientes();
		$label = array('btnModificar','btnEliminar','btnVer');
		$class = array('bg-amber','bg-red','bg-blue');
		$icon = array('create','delete','search');
		$indiceID = 0;
		$empieza = 1;
		$termina = 5;

		break;
	case 'plantas':
		$resAjax = $serviciosReferencias->traerPlantasajaxPorCliente($length, $start, $busqueda, $referencia1);
		$res = $serviciosReferencias->traerPlantas();
		$label = array('btnModificar','btnEliminar');
		$class = array('bg-amber','bg-red');
		$icon = array('create','delete');
		$indiceID = 0;
		$empieza = 1;
		$termina = 1;

		break;
	case 'sectores':
		$resAjax = $serviciosReferencias->traerSectoresajaxPorCliente($length, $start, $busqueda, $referencia1);
		$res = $serviciosReferencias->traerSectores();
		$label = array('btnModificar','btnEliminar');
		$class = array('bg-amber','bg-red');
		$icon = array('create','delete');
		$indiceID = 0;
		$empieza = 1;
		$termina = 2;
		break;
	case 'contactos':
		$resAjax = $serviciosReferencias->traerContactosajaxPorCliente($length, $start, $busqueda, $referencia1);
		$res = $serviciosReferencias->traerContactos();
		$label = array('btnModificar','btnEliminar');
		$class = array('bg-amber','bg-red');
		$icon = array('create','delete');
		$indiceID = 0;
		$empieza = 1;
		$termina = 7;

		break;
	case 'conceptosviaticos':
		$resAjax = $serviciosReferencias->traerConceptosviaticosajax($length, $start, $busqueda);
		$res = $serviciosReferencias->traerConceptosviaticos();
		$label = array('btnModificar','btnEliminar');
		$class = array('bg-amber','bg-red');
		$icon = array('create','delete');
		$indiceID = 0;
		$empieza = 1;
		$termina = 3;

		break;
	case 'listasprecios':
		$resAjax = $serviciosReferencias->traerListaspreciosajax($length, $start, $busqueda);
		$res = $serviciosReferencias->traerListasprecios();
		$label = array('btnModificar','btnEliminar');
		$class = array('bg-amber','bg-red');
		$icon = array('create','delete');
		$indiceID = 0;
		$empieza = 1;
		$termina = 9;

		break;
	case 'oportunidades':
		$resAjax = $serviciosReferencias->traerOportunidadesajax($length, $start, $busqueda);
		$res = $serviciosReferencias->traerOportunidades();
		$label = array('btnModificar','btnEliminar');
		$class = array('bg-amber','bg-red');
		$icon = array('create','delete');
		$indiceID = 0;
		$empieza = 1;
		$termina = 12;

		break;

	default:
		// code...
		break;
}


$cantidadFilas = mysql_num_rows($res);


header("content-type: Access-Control-Allow-Origin: *");

$ar = array();
$arAux = array();
$cad = '';
$id = 0;
	while ($row = mysql_fetch_array($resAjax)) {
		//$id = $row[$indiceID];

		for ($i=$empieza;$i<=$termina;$i++) {
			array_push($arAux, $row[$i]);
		}

		array_push($arAux, armarAcciones($row[0],$label,$class,$icon));

		array_push($ar, $arAux);

		$arAux = array();
		//die(var_dump($ar));
	}

$cad = substr($cad, 0, -1);

$data = '{ "sEcho" : '.$draw.', "iTotalRecords" : '.$cantidadFilas.', "iTotalDisplayRecords" : 10, "aaData" : ['.$cad.']}';

//echo "[".substr($cad,0,-1)."]";
echo json_encode(array(
			"draw"            => $draw,
			"recordsTotal"    => $cantidadFilas,
			"recordsFiltered" => $cantidadFilas,
			"data"            => $ar
		));

?>
