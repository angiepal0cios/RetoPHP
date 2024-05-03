<?php

class Model{

    // El constructor se llama automáticamente cuando se crea un objeto de la clase Model
    function __construct(){
        // Se instancia un objeto de la clase Database y se asigna a la propiedad $db
        // Este objeto se utilizará para realizar operaciones de base de datos
        $this->db = new Database();

        // Se llama al método createDatabaseIfNotExists() del objeto Database para crear la base de datos si aún no existe
        $this->db->createDatabaseIfNotExists();
    }
}

?>
