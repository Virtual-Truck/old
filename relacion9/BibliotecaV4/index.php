<!-- BIBLIOTECA VERSIÓN 4 (Y ÚLTIMA)
     Características de esta versión:
       - Arquitectura MVC.
       - Modelo genérico y capa de abstracción de datos.
       - Controladores múltiples.
       - Control de acceso
       - Capa de seguridad
-->
<?php

session_start();

include_once "models/seguridad.php";

// Hacemos include de todos los controladores
foreach (glob("controllers/*.php") as $file) {
    include $file;
}

// Miramos el valor de la variable "controller", si existe. Si no, le asignamos un controlador por defecto
if (isset($_REQUEST["controller"])) {
    $controller = $_REQUEST["controller"];
} else {
    $controller = "UsuariosController";  // Controlador por defecto
}

// Miramos el valor de la variable "action", si existe. Si no, le asignamos una acción por defecto
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} else {
    $action = "formLogin";  // Acción por defecto
}

// Creamos un objeto de tipo $controller y llamamos al método $action()
$biblio = new $controller();
$biblio->$action();