<?php

class Controller{

    function __construct(){
        // Se crea una instancia del objeto View y se asigna a la propiedad $view
        $this->view = new View();
    }

    function loadModel($model){
        // Se construye la ruta del archivo del modelo basándose en el nombre del modelo proporcionado
        $url = 'models/'.$model.'model.php';

        // Se verifica si el archivo del modelo existe
        if(file_exists($url)){
            // Si el archivo del modelo existe, se incluye
            require_once $url;
            
            // Se construye el nombre de la clase del modelo
            $modelName = $model.'Model';
            // Se crea una instancia del objeto del modelo
            $this->model = new $modelName();
        }
    }
}

?>
