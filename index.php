<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/
require_once 'config/global.php'; // Configuración global
require_once 'core/ControladorBase.php'; // Base para los controladores
require_once 'core/ControladorFrontal.func.php'; // Funciones para el controlador frontal

//Cargamos controladores y acciones
if (isset($_GET["controller"])) {
    $controllerObj=cargarControlador($_GET["controller"]);
    lanzarAccion($controllerObj);
} 
else {
    $controllerObj=cargarControlador(CONTROLADOR_DEFECTO);
    lanzarAccion($controllerObj);
}