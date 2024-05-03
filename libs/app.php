<?php

class App{

    function __construct(){
        // Se obtiene la URL de la solicitud
        $url = isset($_GET['url'])? $_GET['url']: null;
        // Se elimina la barra final de la URL y se divide en partes
        $url = rtrim($url, '/');
        $url = explode('/', $url);
  
        // Si la URL está vacía, se asigna un controlador predeterminado
        if(empty($url[0])){
            $url[0]='crudusuario';
            // Se establece la ruta del archivo del controlador predeterminado
            $archivoController = 'controllers/crudusuario.php';
        }else{
            // Si la URL contiene un controlador específico, se establece su ruta de archivo
            $archivoController = 'controllers/' . $url[0] . '.php';
        }
        
        // Se verifica si existe el archivo del controlador
        if(file_exists($archivoController)){
            // Se incluye el archivo del controlador
            require_once $archivoController;
            // Se instancia el controlador correspondiente
            $controller = new $url[0];
            // Se carga el modelo correspondiente al controlador
            $controller->loadModel($url[0]);


            // Se obtiene el número de parámetros en la URL
            $nparam = sizeof($url);
            // Si se proporcionan parámetros en la URL
            if($nparam > 1){
                // Si hay más de un parámetro
                if($nparam > 2){
                    // Se almacenan los parámetros en un array
                    $param = [];
                    for($i = 2; $i < $nparam; $i++){
                        array_push($param, $url[$i]);
                    }
                    // Se llama al método del controlador con los parámetros
                    $controller->{$url[1]}($param);
                }else{
                    // Si solo hay un parámetro, se llama al método del controlador sin parámetros
                    $controller->{$url[1]}();
                }
            }else{
                // Si no se proporcionan parámetros, se llama al método render() del controlador
                $controller->render();  
            }
        }else{
           // Apuntar a vista de error
        }
    }
    
}
?>
