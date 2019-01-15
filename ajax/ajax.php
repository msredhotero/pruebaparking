<?php

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funcionesReferencias.php');
include ('../includes/funcionesNotificaciones.php');
include ('../includes/validadores.php');


$serviciosUsuarios  		= new ServiciosUsuarios();
$serviciosFunciones 		= new Servicios();
$serviciosHTML				= new ServiciosHTML();
$serviciosReferencias		= new ServiciosReferencias();
$serviciosNotificaciones	= new ServiciosNotificaciones();
$serviciosValidador        = new serviciosValidador();


$accion = $_POST['accion'];

$resV['error'] = '';
$resV['mensaje'] = '';



switch ($accion) {
    case 'login':
        enviarMail($serviciosUsuarios);
        break;
	case 'entrar':
		entrar($serviciosUsuarios);
		break;
	case 'insertarUsuario':
        insertarUsuario($serviciosUsuarios);
        break;
	case 'modificarUsuario':
        modificarUsuario($serviciosUsuarios);
        break;
	case 'registrar':
		registrar($serviciosUsuarios);
		break;

   case 'frmAjaxModificar':
      frmAjaxModificar($serviciosFunciones, $serviciosReferencias);
      break;
   case 'frmAjaxNuevo':
      frmAjaxNuevo($serviciosFunciones, $serviciosReferencias);
      break;


   case 'insertarHistorialplatosingredientes':
      insertarHistorialplatosingredientes($serviciosReferencias);
   break;
   case 'modificarHistorialplatosingredientes':
      modificarHistorialplatosingredientes($serviciosReferencias);
   break;
   case 'eliminarHistorialplatosingredientes':
      eliminarHistorialplatosingredientes($serviciosReferencias);
   break;
   case 'traerHistorialplatosingredientes':
      traerHistorialplatosingredientes($serviciosReferencias);
   break;
   case 'traerHistorialplatosingredientesPorId':
      traerHistorialplatosingredientesPorId($serviciosReferencias);
   break;
   case 'insertarIngredientesalergenicos':
      insertarIngredientesalergenicos($serviciosReferencias);
   break;
   case 'modificarIngredientesalergenicos':
      modificarIngredientesalergenicos($serviciosReferencias);
   break;
   case 'eliminarIngredientesalergenicos':
      eliminarIngredientesalergenicos($serviciosReferencias);
   break;
   case 'traerIngredientesalergenicos':
      traerIngredientesalergenicos($serviciosReferencias);
   break;
   case 'traerIngredientesalergenicosPorId':
      traerIngredientesalergenicosPorId($serviciosReferencias);
   break;
   case 'insertarPlatos':
      insertarPlatos($serviciosReferencias, $serviciosValidador);
   break;
   case 'modificarPlatos':
      modificarPlatos($serviciosReferencias, $serviciosValidador);
   break;
   case 'eliminarPlatos':
      eliminarPlatos($serviciosReferencias);
   break;
   case 'traerPlatos':
      traerPlatos($serviciosReferencias);
   break;
   case 'traerPlatosPorId':
      traerPlatosPorId($serviciosReferencias);
   break;
   case 'insertarPlatosingredientes':
      insertarPlatosingredientes($serviciosReferencias);
   break;
   case 'modificarPlatosingredientes':
      modificarPlatosingredientes($serviciosReferencias);
   break;
   case 'eliminarPlatosingredientes':
      eliminarPlatosingredientes($serviciosReferencias);
   break;
   case 'traerPlatosingredientes':
      traerPlatosingredientes($serviciosReferencias);
   break;
   case 'traerPlatosingredientesPorId':
      traerPlatosingredientesPorId($serviciosReferencias);
   break;
   case 'insertarAlergenicos':
      insertarAlergenicos($serviciosReferencias, $serviciosValidador);
   break;
   case 'modificarAlergenicos':
      modificarAlergenicos($serviciosReferencias, $serviciosValidador);
   break;
   case 'eliminarAlergenicos':
      eliminarAlergenicos($serviciosReferencias);
   break;
   case 'traerAlergenicos':
      traerAlergenicos($serviciosReferencias);
   break;
   case 'traerAlergenicosPorId':
      traerAlergenicosPorId($serviciosReferencias);
   break;
   case 'insertarIngredientes':
      insertarIngredientes($serviciosReferencias, $serviciosValidador);
   break;
   case 'modificarIngredientes':
      modificarIngredientes($serviciosReferencias, $serviciosValidador);
   break;
   case 'eliminarIngredientes':
      eliminarIngredientes($serviciosReferencias);
   break;
   case 'traerIngredientes':
      traerIngredientes($serviciosReferencias);
   break;
   case 'traerIngredientesPorId':
      traerIngredientesPorId($serviciosReferencias);
   break;
   case 'traerAlergenicosPorPlatos':
      traerAlergenicosPorPlatos($serviciosReferencias);
   break;
   case 'traerHistorialplatosingredientesPorPlato':
      traerHistorialplatosingredientesPorPlato($serviciosReferencias);
   break;
   case 'traerPlatosPorAlergenicos':
      traerPlatosPorAlergenicos($serviciosReferencias);
   break;


/* Fin */

}
/* Fin */

function traerAlergenicosPorPlatos($serviciosReferencias) {
   $idplato = $_POST['idplato'];

   $res = $serviciosReferencias->traerAlergenicosPorPlatos($idplato);
   $cad = '';

   $cant = 0;

   $cad .= '<div class="list-group"><a href="javascript:void(0);" class="list-group-item active">
                                    LISTA DE ALERGENICOS
                                </a>';
   while ($row = mysql_fetch_array($res)) {
      $cant += 1;
      $cad .= '<a href="javascript:void(0);" class="list-group-item">'.$row['alergenico'].'</a>';
   }

   if ($cant == 0) {
      $cad .= '<a href="javascript:void(0);" class="list-group-item">No existen alergenicos para este plato</a>';
   }

   $cad .= '</div>';

   echo $cad;
}


function traerPlatosPorAlergenicos($serviciosReferencias) {
   $idalergenico = $_POST['idalergenico'];

   $res = $serviciosReferencias->traerPlatosPorAlergenicos($idalergenico);
   $cad = '';

   $cant = 0;

   $cad .= '<div class="list-group"><a href="javascript:void(0);" class="list-group-item active">
                                    LISTA DE PLATOS
                                </a>';
   while ($row = mysql_fetch_array($res)) {
      $cant += 1;
      $cad .= '<a href="javascript:void(0);" class="list-group-item">'.$row['nombre'].'</a>';
   }

   if ($cant == 0) {
      $cad .= '<a href="javascript:void(0);" class="list-group-item">No existen platos con este alergenico</a>';
   }

   $cad .= '</div>';

   echo $cad;
}

function traerHistorialplatosingredientesPorPlato($serviciosReferencias) {
   $idplato = $_POST['idplato'];

   $res = $serviciosReferencias->traerHistorialplatosingredientesPorPlato($idplato);
   $cad = '';

   $cad .= '<h3>Historial</h3><table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Accion</th>
                                        <th>Valor Viejo</th>
                                        <th>Valor Nuevo</th>
                                    </tr>
                                </thead><tbody>';
   while ($row = mysql_fetch_array($res)) {
      $cad .= '<tr>
              <th>'.$row['fechacrecion'].'</th>
              <td>'.$row['accion'].'</td>
              <td>'.$row['valorviejo'].'</td>
              <td>'.$row['valornuevo'].'</td>
          </tr>';
   }

   $cad .= '</tbody></table>';

   echo $cad;
}



function frmAjaxModificar($serviciosFunciones, $serviciosReferencias) {
   $tabla = $_POST['tabla'];
   $id = $_POST['id'];

   switch ($tabla) {
      case 'dbplatos':
         $modificar = "modificarPlatos";
         $idTabla = "idplato";

         $lblCambio	 	= array();
         $lblreemplazo	= array();

         $cadRef 	= '';

         $refdescripcion = array();
         $refCampo 	=  array();
         break;
      case 'tbingredientes':

         $modificar = "modificarIngredientes";
         $idTabla = "idingrediente";

         $lblCambio	 	= array();
         $lblreemplazo	= array();

         $cadRef2 	= '';

         $refdescripcion = array();
         $refCampo 	=  array();
         break;
      case 'tbalergenicos':

         $modificar = "modificarAlergenicos";
         $idTabla = "idalergenico";

         $lblCambio	 	= array();
         $lblreemplazo	= array();

         $cadRef2 	= '';

         $refdescripcion = array();
         $refCampo 	=  array();
         break;
      case 'dbingredientesalergenicos':
         $resultado = $serviciosReferencias->traerIngredientesalergenicosPorId($id);
         $modificar = "modificarIngredientesalergenicos";
         $idTabla = "idingredientealergenico";

         $lblCambio	 	= array('refingredientes','refalergenicos');
         $lblreemplazo	= array('Ingrediente','Alergenico');

         $resVar1 = $serviciosReferencias->traerIngredientes();
         $cadRef1 	= $serviciosFunciones->devolverSelectBoxActivo($resVar1,array(1),'', mysql_result($resultado,0,'refingredientes'));

         $resVar2 = $serviciosReferencias->traerAlergenicos();
         $cadRef2 	= $serviciosFunciones->devolverSelectBoxActivo($resVar2,array(1),'', mysql_result($resultado,0,'refalergenicos'));

         $refdescripcion = array(0=>$cadRef1,1=>$cadRef2);
         $refCampo 	=  array('refingredientes','refalergenicos');
         break;
      case 'dbplatosingredientes':
         $resultado = $serviciosReferencias->traerPlatosingredientesPorId($id);
         $modificar = "modificarPlatosingredientes";
         $idTabla = "idplatoingrediente";

         $lblCambio	 	= array('refingredientes','refplatos');
         $lblreemplazo	= array('Ingrediente','Plato');

         $resVar1 = $serviciosReferencias->traerIngredientes();
         $cadRef1 	= $serviciosFunciones->devolverSelectBoxActivo($resVar1,array(1),'', mysql_result($resultado,0,'refingredientes'));

         $resVar2 = $serviciosReferencias->traerPlatos();
         $cadRef2 	= $serviciosFunciones->devolverSelectBoxActivo($resVar2,array(1),'', mysql_result($resultado,0,'refplatos'));

         $refdescripcion = array(0=>$cadRef1,1=>$cadRef2);
         $refCampo 	=  array('refingredientes','refplatos');
         break;

      default:
         // code...
         break;
   }

   $formulario = $serviciosFunciones->camposTablaModificar($id, $idTabla,$modificar,$tabla,$lblCambio,$lblreemplazo,$refdescripcion,$refCampo);

   echo $formulario;
}


function frmAjaxNuevo($serviciosFunciones, $serviciosReferencias) {
   $tabla = $_POST['tabla'];
   $id = $_POST['id'];

   switch ($tabla) {
      case 'dbplantas':

         $insertar = "insertarPlantas";
         $idTabla = "idplanta";

         $lblCambio	 	= array("reflientes");
         $lblreemplazo	= array("Cliente");

         $resVar1 = $serviciosReferencias->traerClientesPorId($id);
         $cadRef1 	= $serviciosFunciones->devolverSelectBoxActivo($resVar1,array(1),'', $id);

         $refdescripcion = array(0=>$cadRef1);
         $refCampo 	=  array('refclientes');
         break;



      default:
         // code...
         break;
   }

   $formulario = $serviciosFunciones->camposTablaViejo($insertar ,$tabla,$lblCambio,$lblreemplazo,$refdescripcion,$refCampo);

   echo $formulario;
}




/* PARA Ingredientes */

function insertarHistorialplatosingredientes($serviciosReferencias) {
   $refplatos = $_POST['refplatos'];
   $refingredientes = $_POST['refingredientes'];
   $fechacrecion = $_POST['fechacrecion'];
   $tipo = $_POST['tipo'];
   $valorviejo = $_POST['valorviejo'];
   $valornuevo = $_POST['valornuevo'];

   $res = $serviciosReferencias->insertarHistorialplatosingredientes($refplatos,$refingredientes,$fechacrecion,$tipo,$valorviejo,$valornuevo);

   if ((integer)$res > 0) {
      echo '';
   } else {
      echo 'Huvo un error al insertar datos';
   }
}

function modificarHistorialplatosingredientes($serviciosReferencias) {
   $id = $_POST['id'];
   $refplatos = $_POST['refplatos'];
   $refingredientes = $_POST['refingredientes'];
   $fechacrecion = $_POST['fechacrecion'];
   $tipo = $_POST['tipo'];
   $valorviejo = $_POST['valorviejo'];
   $valornuevo = $_POST['valornuevo'];

   $res = $serviciosReferencias->modificarHistorialplatosingredientes($id,$refplatos,$refingredientes,$fechacrecion,$tipo,$valorviejo,$valornuevo);

   if ($res == true) {
      echo '';
   } else {
      echo 'Huvo un error al modificar datos';
   }
}

function eliminarHistorialplatosingredientes($serviciosReferencias) {
   $id = $_POST['id'];
   $res = $serviciosReferencias->eliminarHistorialplatosingredientes($id);
   if ($res == true) {
      echo '';
   } else {
      echo 'Huvo un error al modificar datos';
   }
}

function traerHistorialplatosingredientes($serviciosReferencias) {
   $res = $serviciosReferencias->traerHistorialplatosingredientes();
   $ar = array();

   while ($row = mysql_fetch_array($res)) {
      array_push($ar, $row);
   }

   $resV['datos'] = $ar;

   header('Content-type: application/json');
   echo json_encode($resV);
}

function insertarIngredientesalergenicos($serviciosReferencias) {
   $refingredientes = $_POST['refingredientes'];
   $refalergenicos = $_POST['refalergenicos'];

   $existe = $serviciosReferencias->existeIngredienteAlergenico($refingredientes, $refalergenicos);

   if ($existe == 1) {
      echo 'Ya existe esta dupla';
   } else {
      $res = $serviciosReferencias->insertarIngredientesalergenicos($refingredientes,$refalergenicos);

      if ((integer)$res > 0) {
         echo '';
      } else {
         echo 'Huvo un error al insertar datos';
      }
   }

}

function modificarIngredientesalergenicos($serviciosReferencias) {
   $id = $_POST['id'];
   $refingredientes = $_POST['refingredientes'];
   $refalergenicos = $_POST['refalergenicos'];

   $existe = $serviciosReferencias->existeIngredienteAlergenico($refingredientes, $refalergenicos, $id);

   if ($existe == 1) {
      echo 'Ya existe esta dupla';
   } else {
      $res = $serviciosReferencias->modificarIngredientesalergenicos($id,$refingredientes,$refalergenicos);

      if ($res == true) {
         echo '';
      } else {
         echo 'Huvo un error al modificar datos';
      }
   }
}

function eliminarIngredientesalergenicos($serviciosReferencias) {
   $id = $_POST['id'];

   $res = $serviciosReferencias->eliminarIngredientesalergenicos($id);

   if ($res == true) {
      echo '';
   } else {
      echo 'Huvo un error al modificar datos';
   }
}

function traerIngredientesalergenicos($serviciosReferencias) {
   $res = $serviciosReferencias->traerIngredientesalergenicos();
   $ar = array();

   while ($row = mysql_fetch_array($res)) {
      array_push($ar, $row);
   }

   $resV['datos'] = $ar;

   header('Content-type: application/json');
   echo json_encode($resV);
}

function insertarPlatos($serviciosReferencias, $serviciosValidador) {
   $error = '';

   $nombre = ($serviciosValidador->validaRequerido( trim($_POST['nombre'])) == true ? trim($_POST['nombre']) : $error .= 'El Nombre es Obligatorio
   ');

   $precio = $_POST['precio'];

   if ($error != '') {
      echo $error;
   } else {
      $res = $serviciosReferencias->insertarPlatos($nombre,$precio);

      if ((integer)$res > 0) {
         echo '';
      } else {
         echo 'Huvo un error al insertar datos';
      }
   }


}

function modificarPlatos($serviciosReferencias, $serviciosValidador) {
   $error = '';

   $id = $_POST['id'];
   $nombre = ($serviciosValidador->validaRequerido( trim($_POST['nombre'])) == true ? trim($_POST['nombre']) : $error .= 'El Nombre es Obligatorio
   ');
   $precio = $_POST['precio'];

   if ($error != '') {
      echo $error;
   } else {
      $res = $serviciosReferencias->modificarPlatos($id,$nombre,$precio);

      if ($res == true) {
         echo '';
      } else {
         echo 'Huvo un error al modificar datos';
      }
   }
}

function eliminarPlatos($serviciosReferencias) {
   $id = $_POST['id'];

   $res = $serviciosReferencias->eliminarPlatos($id);

   if ($res == true) {
      echo '';
   } else {
      echo 'Huvo un error al modificar datos';
   }
}

function traerPlatos($serviciosReferencias) {
   $res = $serviciosReferencias->traerPlatos();
   $ar = array();

   while ($row = mysql_fetch_array($res)) {
      array_push($ar, $row);
   }

   $resV['datos'] = $ar;

   header('Content-type: application/json');
   echo json_encode($resV);
}

function insertarPlatosingredientes($serviciosReferencias) {
   $refplatos = $_POST['refplatos'];
   $refingredientes = $_POST['refingredientes'];

   $existe = $serviciosReferencias->existePlatoIngrediente($refplatos, $refingredientes);

   if ($existe == 1) {
      echo 'Ya existe esta dupla';
   } else {
      $res = $serviciosReferencias->insertarPlatosingredientes($refplatos,$refingredientes);

      $ingrediente = $serviciosReferencias->traerIngredientesPorId($refingredientes);

      $historial = $serviciosReferencias->insertarHistorialplatosingredientes($refplatos, $refingredientes, 'I','', mysql_result($ingrediente,0,'ingrediente'));

      if ((integer)$res > 0) {
         echo '';
      } else {
         echo 'Huvo un error al insertar datos';
      }
   }
}

function modificarPlatosingredientes($serviciosReferencias) {
   $id = $_POST['id'];
   $refplatos = $_POST['refplatos'];
   $refingredientes = $_POST['refingredientes'];

   $existe = $serviciosReferencias->existePlatoIngrediente($refplatos, $refingredientes, $id);

   if ($existe == 1) {
      echo 'Ya existe esta dupla';
   } else {

      $ingredienteViejo = $serviciosReferencias->traerPlatosingredientesPorIdCompleto($id);

      if (mysql_num_rows($ingredienteViejo) > 0) {
         $res = $serviciosReferencias->modificarPlatosingredientes($id,$refplatos,$refingredientes);

         $ingrediente = $serviciosReferencias->traerIngredientesPorId($refingredientes);

         $historial = $serviciosReferencias->insertarHistorialplatosingredientes($refplatos, $refingredientes, 'M',mysql_result($ingredienteViejo,0,'ingrediente'), mysql_result($ingrediente,0,'ingrediente'));

         if ($res == true) {
            echo '';
         } else {
            echo 'Huvo un error al modificar datos';
         }
      } else {
         echo 'Huvo un error al modificar datos';
      }

   }
}

function eliminarPlatosingredientes($serviciosReferencias) {
   $id = $_POST['id'];

   $ingredienteViejo = $serviciosReferencias->traerPlatosingredientesPorIdCompleto($id);

   if (mysql_num_rows($ingredienteViejo) > 0) {

      $historial = $serviciosReferencias->insertarHistorialplatosingredientes(mysql_result($ingredienteViejo,0,'refplatos'), mysql_result($ingredienteViejo,0,'refingredientes'), 'E',mysql_result($ingredienteViejo,0,'ingrediente'), '');

      $res = $serviciosReferencias->eliminarPlatosingredientes($id);

      if ($res == true) {
         echo '';
      } else {
         echo 'Huvo un error al modificar datos';
      }
   } else {
      echo 'Huvo un error al modificar datos';
   }
}

function traerPlatosingredientes($serviciosReferencias) {
   $res = $serviciosReferencias->traerPlatosingredientes();
   $ar = array();

   while ($row = mysql_fetch_array($res)) {
      array_push($ar, $row);
   }

   $resV['datos'] = $ar;

   header('Content-type: application/json');
   echo json_encode($resV);
}

function insertarAlergenicos($serviciosReferencias, $serviciosValidador) {
   $error = '';

   $alergenico = ($serviciosValidador->validaRequerido( trim($_POST['alergenico'])) == true ? trim($_POST['alergenico']) : $error .= 'El alergenico es Obligatorio
   ');

   if ($error != '') {
      echo $error;
   } else {
      $res = $serviciosReferencias->insertarAlergenicos($alergenico);

      if ((integer)$res > 0) {
         echo '';
      } else {
         echo 'Huvo un error al insertar datos';
      }
   }
}

function modificarAlergenicos($serviciosReferencias, $serviciosValidador) {
   $error = '';

   $id = $_POST['id'];

   $alergenico = ($serviciosValidador->validaRequerido( trim($_POST['alergenico'])) == true ? trim($_POST['alergenico']) : $error .= 'El alergenico es Obligatorio
   ');

   if ($error != '') {
      echo $error;
   } else {
      $res = $serviciosReferencias->modificarAlergenicos($id,$alergenico);

      if ($res == true) {
         echo '';
      } else {
         echo 'Huvo un error al modificar datos';
      }
   }
}

function eliminarAlergenicos($serviciosReferencias) {
   $id = $_POST['id'];

   $res = $serviciosReferencias->eliminarAlergenicos($id);

   if ($res == true) {
      echo '';
   } else {
      echo 'Huvo un error al modificar datos';
   }
}

function traerAlergenicos($serviciosReferencias) {
   $res = $serviciosReferencias->traerAlergenicos();
   $ar = array();

   while ($row = mysql_fetch_array($res)) {
      array_push($ar, $row);
   }

   $resV['datos'] = $ar;

   header('Content-type: application/json');
   echo json_encode($resV);
}

function insertarIngredientes($serviciosReferencias, $serviciosValidador) {
   $error = '';

   $ingrediente = ($serviciosValidador->validaRequerido( trim($_POST['ingrediente'])) == true ? trim($_POST['ingrediente']) : $error .= 'El ingrediente es Obligatorio
   ');

   if ($error != '') {
      echo $error;
   } else {
      $res = $serviciosReferencias->insertarIngredientes($ingrediente);

      if ((integer)$res > 0) {
         echo '';
      } else {
         echo 'Huvo un error al insertar datos';
      }
   }
}

function modificarIngredientes($serviciosReferencias) {
   $id = $_POST['id'];
   $error = '';

   $ingrediente = ($serviciosValidador->validaRequerido( trim($_POST['ingrediente'])) == true ? trim($_POST['ingrediente']) : $error .= 'El ingrediente es Obligatorio
   ');

   if ($error != '') {
      echo $error;
   } else {
      $res = $serviciosReferencias->modificarIngredientes($id,$ingrediente);

      if ($res == true) {
         echo '';
      } else {
         echo 'Huvo un error al modificar datos';
      }
   }
}

function eliminarIngredientes($serviciosReferencias) {
   $id = $_POST['id'];

   $res = $serviciosReferencias->eliminarIngredientes($id);

   if ($res == true) {
      echo '';
   } else {
      echo 'Huvo un error al modificar datos';
   }
}


function traerIngredientes($serviciosReferencias) {
   $res = $serviciosReferencias->traerIngredientes();
   $ar = array();

   while ($row = mysql_fetch_array($res)) {
      array_push($ar, $row);
   }

   $resV['datos'] = $ar;

   header('Content-type: application/json');
   echo json_encode($resV);
}

/* Fin */


?>
