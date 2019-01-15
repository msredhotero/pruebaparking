<?php

/**
 * @author Saupurein Marcos
 * @copyright 2018
 */
date_default_timezone_set('America/Buenos_Aires');

class BaseHTML {

    function cargarArchivosCSS($altura,$ar = array()) {

        $arNuevo = array(0=>'<link href="'.$altura.'plugins/bootstrap/css/bootstrap.css" rel="stylesheet">',
                         1=>'<link href="'.$altura.'plugins/node-waves/waves.css" rel="stylesheet" />',
                         2=>'<link href="'.$altura.'plugins/animate-css/animate.css" rel="stylesheet" />',
                         3=>'<link href="'.$altura.'css/style.css" rel="stylesheet">',
                         4=>'<link href="'.$altura.'css/themes/all-themes.css" rel="stylesheet" />',
                         5=>'<link href="'.$altura.'plugins/sweetalert/sweetalert.css" rel="stylesheet" />',
                         6=>'<link href="'.$altura.'plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />',
                         7=>'<link href="'.$altura.'css/ventanaModal.css" rel="stylesheet" />');

        $cad = '';

        foreach($arNuevo as $var) {
            $cad .= $var.'<br>';
        }

        foreach($ar as $var) {
            $cad .= $var.'<br>';
        }

        echo $cad;
    }


    function cargarArchivosJS($altura ,$ar = array()) {

        $arNuevo = array(0=>'<script src="'.$altura.'plugins/jquery/jquery.min.js"></script>',
                         1=>'<script src="'.$altura.'plugins/bootstrap/js/bootstrap.js"></script>',
                         2=>'<script src="'.$altura.'plugins/bootstrap-select/js/bootstrap-select.js"></script>',
                         3=>'<script src="'.$altura.'plugins/jquery-slimscroll/jquery.slimscroll.js"></script>',
                         4=>'<script src="'.$altura.'plugins/node-waves/waves.js"></script>',
                         5=>'<script src="'.$altura.'js/admin.js"></script>',
                         6=>'<script src="'.$altura.'js/demo.js"></script>',
                         7=>'<script src="'.$altura.'plugins/bootstrap-notify/bootstrap-notify.js"></script>',
                         8=>'<script src="'.$altura.'js/pages/ui/notifications.js"></script>',
                         9=>'<script src="'.$altura.'plugins/jquery-validation/jquery.validate.js"></script>',
                         10=>'<script src="'.$altura.'plugins/jquery-steps/jquery.steps.js"></script>',
                         11=>'<script src="'.$altura.'plugins/sweetalert/sweetalert.min.js"></script>',
                         12=>'<script src="'.$altura.'js/pages/forms/form-validation.js"></script>',
                         13=>'<script src="'.$altura.'js/jquery.number.js"></script>');

        $cad = '';

        foreach($arNuevo as $var) {
            $cad .= $var.'<br>';
        }

        foreach($ar as $var) {
            $cad .= $var.'<br>';
        }

        echo $cad;
    }

    function cargarNotificaciones($datos = null, $altura = '') {

        $cad = '<ul class="menu lstNotificaciones">';

        while ($row = mysql_fetch_array($datos)) {
            $cad .= '<li>
                            <a href="javascript:void(0);">
                            <div class="icon-circle '.$row['color'].'">
                                <i class="material-icons">'.$row['icono'].'</i>
                            </div>
                            <div class="menu-info">
                                <h4>'.$row['titulo'].'</h4>
                                <p>
                                    <i class="material-icons">access_time</i> '.$row['fechacreacion'].'
                                </p>
                            </div>
                        </a>
                    </li>';
        }

        $cad .= '</ul>';

        echo $cad;
    }


   function cargarTareas($datos = null, $altura = '') {

      $cad = '<ul class="menu tasks">';

      while ($row = mysql_fetch_array($datos)) {
         $cad .= '<li>
            <a href="javascript:void(0);">
               <h4>
                  '.$row['titulo'].'
                  <small>'.$row['pocentaje'].'%</small>
               </h4>
               <div class="progress">
                  <div class="progress-bar '.$row['color'].'" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: '.$row['porcentaje'].'%">
                  </div>
               </div>
            </a>
         </li>';
      }

      $cad .= '</ul>';

      echo $cad;
   }

    function cargarNAV($breadCumbs, $notificaciones='', $tareas='', $altura = '', $lstTareas='') {
        $cad = '<nav class="navbar">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                            <a href="javascript:void(0);" class="bars"></a>
                            '.$breadCumbs.'
                        </div>
                        <div class="collapse navbar-collapse" id="navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <!-- Call Search -->
                                <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                                <!-- #END# Call Search -->
                                <!-- Notifications -->
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                        <i class="material-icons">notifications</i>
                                        <span class="label-count notificaciones-cantidad">0</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="header">Notificaciones</li>
                                        <li class="body">
                                           <ul class="menu notificaciones">

                                           </ul>
                                        </li>
                                        <li class="footer">
                                            <a href="javascript:void(0);">Ver Todas</a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- #END# Notifications -->
                                <!-- Tasks -->
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                        <i class="material-icons">flag</i>
                                        <span class="label-count tareas-cantidad">0</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="header">Tareas</li>
                                        <li class="body">
                                            <ul class="menu tasks">

                                            </ul>
                                        </li>
                                        <li class="footer">
                                            <a href="javascript:void(0);">Ver Todas</a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- #END# Tasks -->
                                <li class="pull-right"><a href="javascript:void(0);" class="maximizar"><i class="material-icons icomarcos">aspect_ratio</i></a></li>

                            </ul>
                        </div>
                    </div>
                </nav>';
        echo $cad;
    }

    function cargarSECTION($usuario, $email, $menu, $altura = '') {
        $cad = '<section id="marcos">
                <!-- Left Sidebar -->
                <aside id="leftsidebar" class="sidebar">
                    <!-- User Info -->
                    <div class="user-info">
                        <div class="image">
                            <img src="'.$altura.'images/user.png" width="48" height="48" alt="User" />
                        </div>
                        <div class="info-container">
                            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$usuario.'</div>
                            <div class="email">'.$email.'</div>
                            <div class="btn-group user-helper-dropdown">
                                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                                <ul class="dropdown-menu pull-right">

                                    <li><a href="'.$altura.'logout.php"><i class="material-icons">input</i>Salir</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- #User Info -->
                    <!-- Menu -->
                    <div class="menu">
                        <ul class="list">
                            <li class="header">MENU</li>
                            '.$menu.'
                        </ul>
                    </div>
                    <!-- #Menu -->

                </aside>
                <!-- #END# Left Sidebar -->
                <!-- Right Sidebar -->
                <aside id="rightsidebar" class="right-sidebar">
                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                        <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                        <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
                    </ul>

                </aside>
                <!-- #END# Right Sidebar -->
            </section>';

        echo $cad;
    }

    function modalHTML($id,$titulo,$aceptar,$contenido,$form,$formulario='',$idTabla,$tabla,$accion) {
        $cad = '<div class="modal fade" id="'.$id.'" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-blue">
                        <h4 class="modal-title" id="largeModalLabel">'.$titulo.'</h4>
                    </div>

                    <form id="'.$form.'" method="POST">
                    <div class="modal-body">
                        <p>'.$contenido.'</p>

                        '.$formulario.'

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-link waves-effect" id="btn'.$id.'">'.$aceptar.'</button>
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CERRAR</button>
                    </div>
                    <input type="hidden" ref="ref_'.$idTabla.'" :value="active'.ucwords($tabla).'.'.$idTabla.'" name="'.$idTabla.'" />
                    <input type="hidden" value="'.$accion.'" name="accion" id="accion" />
                    </form>

                </div>
            </div>
        </div>';

        echo $cad;
    }


}
