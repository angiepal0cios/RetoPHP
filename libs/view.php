<?php

class View{

    // El constructor se llama automáticamente cuando se crea un objeto de la clase View
    function __construct(){
        }

    // La función render($nombre) se encarga de cargar una vista específica
    function render($nombre){
        // Se incluye el archivo de la vista especificada utilizando la ruta relativa 'views/' y el nombre proporcionado
        require_once 'views/' . $nombre . '.php';
    }
}

?>
