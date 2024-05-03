<?php
// Incluye los archivos necesarios para el funcionamiento del framework MVC
require_once 'libs/database.php';
require_once 'libs/model.php';
require_once 'libs/controller.php';
require_once 'libs/view.php';
require_once 'libs/app.php';

// Incluye el archivo de configuración del sistema
require_once 'config/config.php';

// Crea una nueva instancia de la aplicación
$app = new App();
