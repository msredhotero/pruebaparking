<?php

date_default_timezone_set('America/Buenos_Aires');

class serviciosValidador {

   function validaRequerido($valor){
      if(trim($valor) == ''){
         return false;
      }else{
         return true;
      }
   }

   function validarEntero($valor){
      if(filter_var($valor, FILTER_VALIDATE_INT) === FALSE){
         return false;
      }else{
         return true;
      }
   }


   function validarEnteroRango($valor, $min, $max){
      if(filter_var($valor, FILTER_VALIDATE_INT, array("options" => array("min_range"=>$min, "max_range"=>$max))) === FALSE){
         return false;
      }else{
         return true;
      }
   }

   function validaEmail($valor){
      if(filter_var($valor, FILTER_VALIDATE_EMAIL) === FALSE){
         return false;
      }else{
         return true;
      }
   }

   function validaLongitud($valor, $longitud) {
      if (strlen($valor) != $longitud) {
         return false;
      } else {
         return true;
      }
   }

   function validar_fecha_espanol($fecha){
   	$valores = explode('-', str_replace('_','',$fecha));
   	//die(var_dump((integer)$valores[1].(integer)$valores[2].(integer)$valores[0]));
   	if(count($valores) == 3 &&
   		checkdate((integer)$valores[1], (integer)$valores[2], (integer)$valores[0] &&
   		strlen($valores[1]) == 2 &&
   		strlen($valores[2]) == 2 &&
   		strlen($valores[0]) == 4)){
   		return true;
       }
   	return false;
   }


}



?>
