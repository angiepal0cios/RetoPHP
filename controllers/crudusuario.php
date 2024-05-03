<?php

// Se requiere el archivo que contiene la definición de la clase Usuario
require_once 'models/usuario.php';

/**
 * La clase CRUDUsuario extiende la clase Controller y proporciona métodos para manejar las operaciones CRUD (Crear, Leer, Actualizar, Eliminar) de usuarios.
 */
class CRUDUsuario extends Controller
{

    /**
     * El constructor de la clase. Llama al constructor de la clase padre y inicializa el mensaje de la vista.
     */
    function __construct()
    {
        parent::__construct();
        $this->view->mensaje = "";
    }

    /**
     * Método para renderizar la vista 'crudusuario' y manejar las operaciones CRUD de usuarios.
     */
    function render()
    {
        // Crear la tabla 'usuario' si no existe
        $this->model->createTableIfNotExists();
        // Insertar datos en la tabla 'usuario' desde una API si está vacía
        $this->model->insertDataFromAPI();
        // Obtener todos los usuarios de la tabla 'usuario'
        $this->view->usuarios = $this->model->get();
        // Renderizar la vista 'crudusuario'
        $this->view->render('crudusuario');
    }

    /**
     * Método para crear un nuevo usuario.
     */
    function crear()
    {
        // Crear un nuevo usuario a partir de los datos recibidos por POST
        $nuevo_usuario = $this->crearUsuarioDesdePOST();

        // Validar el usuario
        if (!$this->validarUsuario($nuevo_usuario)) {
            // Si la validación falla, establecer un mensaje de error
            $this->view->mensaje = "Usuario no se pudo crear, fallo en la validación";
        } else {
            // Si la validación es exitosa, intentar insertar el usuario en la base de datos
            if ($this->model->insert($nuevo_usuario)) {
                $this->view->mensaje = "Usuario creado correctamente";
            } else {
                $this->view->mensaje = "Error! No se pudo crear el usuario";
            }
        }
        // Redirigir de vuelta a la página principal
        header("Location: /RetoPHP/");
        exit();
    }

    /**
     * Método para actualizar un usuario existente.
     * @param array|null $param Parámetro opcional que contiene el ID del usuario a actualizar.
     */
    function actualizarUsuario($param = null)
    {
        // Crear un objeto Usuario con los datos recibidos por POST
        $usuario_por_actualizar = $this->crearUsuarioDesdePOST();
        // Establecer el ID del usuario a actualizar utilizando el parámetro proporcionado
        $usuario_por_actualizar->id = $param[0];

        // Validar el usuario
        if (!$this->validarUsuario($usuario_por_actualizar)) {
            // Si la validación falla, establecer un mensaje de error
            $this->view->mensaje = "Usuario no se pudo actualizar, fallo en la validación";
        } else {
            // Si la validación es exitosa, intentar actualizar el usuario en la base de datos
            if ($this->model->update($usuario_por_actualizar)) {
                $this->view->usuario = $usuario_por_actualizar;
                $this->view->mensaje = "Usuario actualizado correctamente";
            } else {
                $this->view->mensaje = "No se pudo actualizar al usuario";
            }
        }

        // Redirigir de vuelta a la página principal
        header("Location: /RetoPHP/");
        exit();
    }

    /**
     * Método para eliminar un usuario existente.
     * @param array|null $param Parámetro opcional que contiene el ID del usuario a eliminar.
     */
    function eliminarUsuario($param = null)
    {
        // Obtener el ID del usuario a eliminar del parámetro proporcionado
        $id = $param[0];

        // Intentar eliminar el usuario de la base de datos
        if ($this->model->delete($id)) {
            $this->view->mensaje = "Usuario eliminado correctamente";
        } else {
            $this->view->mensaje = "No se pudo eliminar al usuario";
        }
    }

    /**
     * Método para crear un objeto Usuario a partir de los datos recibidos por POST.
     * @return Usuario Retorna un objeto Usuario con los datos del usuario creado.
     */
    function crearUsuarioDesdePOST()
    {
        // Crear un nuevo objeto Usuario y asignar los valores recibidos por POST a sus propiedades
        $nuevo_usuario = new Usuario;
        $nuevo_usuario->nombre = $_POST['nombre'] ?? null;
        $nuevo_usuario->telefono = $_POST['telefono'] ?? null;
        $nuevo_usuario->correo = $_POST['correo'] ?? null;
        $nuevo_usuario->compania = $_POST['compania'] ?? null;
        $nuevo_usuario->calle = $_POST['calle'] ?? null;
        $nuevo_usuario->latitud = $_POST['latitud'] ?? null;
        $nuevo_usuario->longitud = $_POST['longitud'] ?? null;

        return $nuevo_usuario;
    }

    /**
     * Método para validar un usuario.
     * @param Usuario $usuario Objeto Usuario que se va a validar.
     * @return bool Retorna true si el usuario es válido, false si no lo es.
     */
    function validarUsuario($usuario)
    {
        // Implementar la lógica de validación aquí
        return true; // Por ahora siempre retorna true
    }
}
