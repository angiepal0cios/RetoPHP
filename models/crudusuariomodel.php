<?php

// Se requiere el archivo que contiene la definición de la clase Usuario
require_once 'models/usuario.php';

/**
 * La clase CrudUsuarioModel extiende la clase Model y proporciona métodos para realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar) en la tabla 'usuario'.
 */
class CrudUsuarioModel extends Model
{
    /**
     * El constructor de la clase. Llama al constructor de la clase padre.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Método para crear la tabla 'usuario' si no existe.
     * @return bool Retorna true si la tabla se crea exitosamente, false si hay algún error.
     */
    public function createTableIfNotExists()
    {
        // Consulta SQL para crear la tabla 'usuario'
        $query = "CREATE TABLE IF NOT EXISTS usuario (
                      id INT AUTO_INCREMENT PRIMARY KEY,
                      nombre VARCHAR(255) NOT NULL,
                      telefono VARCHAR(30) NOT NULL,
                      correo VARCHAR(255) NOT NULL,
                      compania VARCHAR(255) NOT NULL,
                      calle VARCHAR(255) NOT NULL,
                      latitud DECIMAL(10, 8) NOT NULL,
                      longitud DECIMAL(11, 8) NOT NULL
                  );";

        try {
            // Ejecutar la consulta SQL
            $this->db->connect()->exec($query);
            return true; // Creación exitosa
        } catch (PDOException $e) {
            return false; // Error en la creación de la tabla
        }
    }

    /**
     * Método para insertar datos desde una API en la tabla 'usuario' si está vacía.
     * @return bool Retorna true si la inserción de datos se realiza exitosamente, false si la tabla no está vacía o si hay algún error.
     */
    public function insertDataFromAPI()
    {
        // Consulta para verificar si la tabla 'usuario' está vacía
        $query = "SELECT COUNT(*) FROM usuario";
        $stmt = $this->db->connect()->query($query);
        $rowCount = $stmt->fetchColumn();

        if ($rowCount == 0) {
            // La tabla está vacía, proceder con la inserción de datos desde la API
            $json_data = file_get_contents('https://jsonplaceholder.typicode.com/users');
            $data = json_decode($json_data, true);

            // Consulta para insertar datos en la tabla 'usuario'
            $query = "INSERT INTO usuario (nombre, telefono, correo, compania, calle, latitud, longitud) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->connect()->prepare($query);

            // Iterar sobre los datos de la API y ejecutar la consulta de inserción
            foreach ($data as $user) {
                $stmt->execute([
                    $user['name'],                   // Nombre
                    $user['phone'],                  // Teléfono
                    $user['email'],                  // Correo
                    $user['company']['name'],        // Nombre de la compañía
                    $user['address']['street'],      // Calle
                    $user['address']['geo']['lat'],  // Latitud
                    $user['address']['geo']['lng']   // Longitud
                ]);
            }
            return true; // Inserción exitosa
        } else {
            // La tabla no está vacía, no es necesario insertar datos
            return false;
        }
    }

    /**
     * Método para insertar un nuevo usuario en la tabla 'usuario'.
     * @param object $usuario Objeto Usuario que contiene los datos del usuario a insertar.
     * @return bool Retorna true si la inserción se realiza exitosamente, false si hay algún error.
     */
    public function insert($usuario)
    {
        // Consulta para insertar un nuevo usuario en la tabla 'usuario'
        $query = $this->db->connect()->prepare('INSERT INTO usuario (nombre, telefono, correo, compania, calle, latitud, longitud) VALUES(:nombre, :telefono, :correo, :compania, :calle, :latitud, :longitud)');
        try {
            // Ejecutar la consulta SQL con los datos proporcionados
            $query->execute([
                'nombre' => $usuario->nombre,
                'telefono' => $usuario->telefono,
                'correo' => $usuario->correo,
                'compania' => $usuario->compania,
                'calle' => $usuario->calle,
                'latitud' => $usuario->latitud,
                'longitud' => $usuario->longitud,
            ]);
            return true; // Inserción exitosa
        } catch (PDOException $e) {
            return false; // Error en la inserción
        }
    }

    /**
     * Método para obtener todos los usuarios de la tabla 'usuario'.
     * @return array Retorna un array de objetos Usuario con los datos de los usuarios obtenidos de la tabla.
     */
    public function get()
    {
        $items = []; // Inicializar un array para almacenar los usuarios
        try {
            // Consulta para obtener todos los usuarios de la tabla 'usuario'
            $query = $this->db->connect()->query('SELECT * FROM usuario');

            // Iterar sobre los resultados de la consulta y crear objetos Usuario
            while ($row = $query->fetch()) {
                $item = new Usuario();
                $item->id = $row['id'];
                $item->nombre = $row['nombre'];
                $item->telefono = $row['telefono'];
                $item->correo = $row['correo'];
                $item->compania = $row['compania'];
                $item->calle = $row['calle'];
                $item->latitud = $row['latitud'];
                $item->longitud = $row['longitud'];
                array_push($items, $item); // Agregar el usuario al array
            }
            return $items; // Retornar el array de usuarios
        } catch (PDOException $e) {
            return []; // Retornar un array vacío en caso de error
        }
    }

    /**
     * Método para actualizar los datos de un usuario en la tabla 'usuario'.
     * @param object $usuario Objeto Usuario que contiene los datos actualizados del usuario.
     * @return bool Retorna true si la actualización se realiza exitosamente, false si hay algún error.
     */
    public function update($usuario)
    {
        // Consulta para actualizar los datos de un usuario en la tabla 'usuario'
        $query = $this->db->connect()->prepare('UPDATE usuario SET nombre = :nombre, telefono = :telefono, correo = :correo, compania = :compania, calle = :calle, latitud = :latitud, longitud = :longitud WHERE id = :id');
        try {
            // Ejecutar la consulta SQL con los datos proporcionados
            $query->execute([
                'id' => $usuario->id,
                'nombre' => $usuario->nombre,
                'telefono' => $usuario->telefono,
                'correo' => $usuario->correo,
                'compania' => $usuario->compania,
                'calle' => $usuario->calle,
                'latitud' => $usuario->latitud,
                'longitud' => $usuario->longitud,
            ]);
            return true; // Actualización exitosa
        } catch (PDOException $e) {
            return false; // Error en la actualización
        }
    }

    /**
     * Método para eliminar un usuario de la tabla 'usuario' por su ID.
     * @param int $id El ID del usuario a eliminar.
     * @return bool Retorna true si la eliminación se realiza exitosamente, false si hay algún error.
     */
    public function delete($id)
    {
        // Consulta para eliminar un usuario de la tabla 'usuario' por su ID
        $query = $this->db->connect()->prepare('DELETE FROM usuario WHERE id = :id');
        try {
            // Ejecutar la consulta SQL con el ID proporcionado
            $query->execute([
                'id' => $id
            ]);
            return true; // Eliminación exitosa
        } catch (PDOException $e) {
            return false; // Error en la eliminación
        }
    }
}

?>
