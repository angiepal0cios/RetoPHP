<?php

class Database{

    // Se definen las propiedades privadas que almacenarán la información de conexión a la base de datos
    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

    // El constructor se llama automáticamente cuando se crea un objeto de la clase Database
    public function __construct(){
        // Se asignan los valores de las constantes definidas en el archivo de configuración a las propiedades correspondientes
        $this->host     = constant('HOST');
        $this->db       = constant('DB');
        $this->user     = constant('USER');
        $this->password = constant('PASSWORD');
        $this->charset  = constant('CHARSET');
    }

    // La función createDatabaseIfNotExists() se encarga de crear la base de datos si no existe
    function createDatabaseIfNotExists(){
        try{
            // Se construye la cadena de conexión sin especificar la base de datos
            $connection = "mysql:host=" . $this->host . ";charset=" . $this->charset;
            // Se establecen algunas opciones para la conexión PDO
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            // Se crea una instancia de PDO con la cadena de conexión y las opciones especificadas
            $pdo = new PDO($connection, $this->user, $this->password, $options);
            // Se ejecuta una consulta para crear la base de datos si no existe
            $pdo->exec("CREATE DATABASE IF NOT EXISTS {$this->db}");
        }catch(PDOException $e){
            // Si ocurre un error, se muestra un mensaje de error
            print_r('Error creating database: ' . $e->getMessage());
        }   
    }

    // La función connect() se encarga de establecer la conexión con la base de datos
    function connect(){
        try{
            // Se construye la cadena de conexión incluyendo el nombre de la base de datos
            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;
            // Se establecen algunas opciones para la conexión PDO
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            // Se crea una instancia de PDO con la cadena de conexión y las opciones especificadas
            $pdo = new PDO($connection, $this->user, $this->password, $options);
            // Se devuelve la instancia de PDO, que representa la conexión establecida con la base de datos
            return $pdo;
        }catch(PDOException $e){
            // Si ocurre un error, se muestra un mensaje de error
            print_r('Error connection: ' . $e->getMessage());
        }   
    }
}

?>
