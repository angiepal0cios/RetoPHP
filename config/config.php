<?php

// Definición de constantes para la configuración de la base de datos y la URL base
define('URL', 'http://localhost/RetoPHP/'); // URL base de la aplicación
define('HOST', 'localhost'); // Host de la base de datos
define('DB', 'reto'); // Nombre de la base de datos
define('USER', 'root'); // Usuario de la base de datos
define('PASSWORD', "root"); // Contraseña de la base de datos
define('CHARSET', 'utf8mb4'); // Juego de caracteres de la base de datos

?>
<script>
// Configuración de la URL base para su uso en JavaScript
url = "<?php echo constant('URL')?>";
</script>
