<?php

session_start();

if (!isset($_SESSION['usua_sahilices']))
{
	header('Location: ../error.php');
} else {


include ('../includes/funcionesUsuarios.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funciones.php');
include ('../includes/funcionesReferencias.php');
include ('../includes/base.php');

$serviciosUsuario = new ServiciosUsuarios();
$serviciosHTML = new ServiciosHTML();
$serviciosFunciones = new Servicios();
$serviciosReferencias 	= new ServiciosReferencias();
$baseHTML = new BaseHTML();

$fecha = date('Y-m-d');

//$resProductos = $serviciosProductos->traerProductosLimite(6);
$resMenu = $serviciosHTML->menu($_SESSION['nombre_sahilices'],"Dashboard",$_SESSION['refroll_sahilices'],'');

$configuracion = $serviciosReferencias->traerConfiguracion();

$tituloWeb = mysql_result($configuracion,0,'sistema');

$breadCumbs = '<a class="navbar-brand" href="../index.php">Dashboard</a>';


$resVar2 = $serviciosReferencias->traerPlatos();
$cadRef2 	= $serviciosFunciones->devolverSelectBox($resVar2,array(1),'');

$resVar1 = $serviciosReferencias->traerAlergenicos();
$cadRef1 	= $serviciosFunciones->devolverSelectBox($resVar1,array(1),'');

/////////////////////// Opciones pagina ///////////////////////////////////////////////
$singular = "";

$plural = "";

$eliminar = "";

$insertar = "";

//$tituloWeb = "Gestión: Talleres";
//////////////////////// Fin opciones ////////////////////////////////////////////////


/////////////////////// Opciones para la creacion del formulario  /////////////////////



///////////////////////////              fin                   ////////////////////////

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo $tituloWeb; ?></title>
    <!-- Favicon-->
    <link rel="icon" href="../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <?php echo $baseHTML->cargarArchivosCSS('../'); ?>

	 <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

	 <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />

    <style>
        .alert > i{ vertical-align: middle !important; }
    </style>

</head>

<body class="theme-red">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Cargando...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="Ingrese palabras...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <?php echo $baseHTML->cargarNAV($breadCumbs); ?>
    <!-- #Top Bar -->
    <?php echo $baseHTML->cargarSECTION($_SESSION['usua_sahilices'], $_SESSION['nombre_sahilices'], str_replace('..','../dashboard',$resMenu),'../'); ?>
    <main id="app">
    <section class="content" style="margin-top:-35px;">

		<div class="container-fluid">
		<!-- Widgets -->
		<div class="row clearfix">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                  <div class="header bg-green">
                      <h2>
                          PLATOS <small>seleccione el plato para obtener los alergenicos...</small>
                      </h2>

                  </div>
                  <div class="body">
                  	<form role="form" class="form">
								<div class="row">
									<div class="form-group col-md-6" style="display:'.$lblOculta.'">
										<label for="plato" class="control-label" style="text-align:left">Platos</label>
										<div class="input-group col-md-12">
											<select data-placeholder="selecione el Plato" id="plato" name="plato" class="chosen-select" tabindex="2">
												<?php echo $cadRef2; ?>
											</select>
										</div>
										<button type="button" class="btn bg-blue waves-effect btnBuscarAlergenico">
											<i class="material-icons">search</i>
											<span>BUSCAR</span>
										</button>
									</div>
								</div>
								<hr>
								<div class="row">
									
									<div class="resultadoAlergenicos">

									</div>
								</div>
								<hr>
								<div class="row">

									<div class="historial">

									</div>
								</div>
							</form>
                  </div>
              </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                  <div class="header bg-red">
                      <h2>
                          ALERGENICOS <small>platos que incluyen este alergeno...</small>
                      </h2>

                  </div>
                  <div class="body">
							<form role="form" class="form">
							  <div class="row">
								  <div class="form-group col-md-6" style="display:'.$lblOculta.'">
									  <label for="plato" class="control-label" style="text-align:left">Alergenicos</label>
									  <div class="input-group col-md-12">
										  <select data-placeholder="selecione el alergenico" id="alergenico" name="alergenico" class="chosen-select" tabindex="2">
											  <?php echo $cadRef1; ?>
										  </select>
									  </div>
									  <button type="button" class="btn bg-blue waves-effect btnBuscarPlato">
										  <i class="material-icons">search</i>
										  <span>BUSCAR</span>
									  </button>
								  </div>
							  </div>
							  <hr>
							  <div class="row">

								  <div class="resultadoPlatos">

								  </div>
							  </div>

						  </form>
                  </div>
              </div>
          </div>

      </div>


		</div>


    </section>




    </main>

    <?php echo $baseHTML->cargarArchivosJS('../'); ?>

   <script>
		$(document).ready(function(){
			function traerAlergenicosPorPlatos(idplato) {
				$.ajax({
					url: '../ajax/ajax.php',
					type: 'POST',
					// Form data
					//datos del formulario
					data: {accion: 'traerAlergenicosPorPlatos', idplato: idplato},
					//mientras enviamos el archivo
					beforeSend: function(){
						$('.resultadoAlergenicos').html('');
					},
					//una vez finalizado correctamente
					success: function(data){

						if (data != '') {
							$('.resultadoAlergenicos').html(data);
						} else {
							swal("Error!", data, "warning");
							$('.resultadoAlergenicos').html('');

						}
					},
					//si ha ocurrido un error
					error: function(){
						swal("Error!", 'Actualice la pagina', "warning");

						$('.resultadoAlergenicos').html('');
					}
				});

			}


			function traerHistorialPorPlato(idplato) {
				$.ajax({
					url: '../ajax/ajax.php',
					type: 'POST',
					// Form data
					//datos del formulario
					data: {accion: 'traerHistorialplatosingredientesPorPlato', idplato: idplato},
					//mientras enviamos el archivo
					beforeSend: function(){
						$('.historial').html('');
					},
					//una vez finalizado correctamente
					success: function(data){

						if (data != '') {
							$('.historial').html(data);
						} else {
							swal("Error!", data, "warning");
							$('.historial').html('');

						}
					},
					//si ha ocurrido un error
					error: function(){
						swal("Error!", 'Actualice la pagina', "warning");

						$('.historial').html('');
					}
				});

			}


			function traerPlatosPorAlergenico(idalergenico) {
				$.ajax({
					url: '../ajax/ajax.php',
					type: 'POST',
					// Form data
					//datos del formulario
					data: {accion: 'traerPlatosPorAlergenicos', idalergenico: idalergenico},
					//mientras enviamos el archivo
					beforeSend: function(){
						$('.resultadoPlatos').html('');
					},
					//una vez finalizado correctamente
					success: function(data){

						if (data != '') {
							$('.resultadoPlatos').html(data);
						} else {
							swal("Error!", data, "warning");
							$('.resultadoPlatos').html('');

						}
					},
					//si ha ocurrido un error
					error: function(){
						swal("Error!", 'Actualice la pagina', "warning");

						$('.resultadoPlatos').html('');
					}
				});
			}

			$('.btnBuscarPlato').click(function() {
				traerPlatosPorAlergenico($('#alergenico').val());
			});

			$('.btnBuscarAlergenico').click(function() {
				traerAlergenicosPorPlatos($('#plato').val());
				traerHistorialPorPlato($('#plato').val());
			});


		});
   </script>



</body>
<?php } ?>
</html>
