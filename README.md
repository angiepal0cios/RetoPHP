Requisitos:
- Configurar un entorno de desarrollo como XAMPP para ejecutar PHP y MySQL localmente.
- Modificar y verificar las credenciales de la base de datos en el archivo config.php.

Resumen:

Para abordar el reto, se configuró un entorno de desarrollo XAMPP, utilizando PHP y MySQL bajo el patrón MVC. El flujo de ejecución se inicia con el archivo app.php, encargado de manejar las solicitudes del usuario. En el modelo, se establece un objeto para operaciones de base de datos, verificando y, si es necesario, creando la base de datos. El controlador, crudusuario.php, gestiona las solicitudes del usuario, coordinando acciones entre modelo y vista, e implementa métodos CRUD para manipular los datos de los usuarios. Al renderizar la página en el controlador, se comprueba la existencia de la tabla de usuarios y, de ser necesario, se crea. En el controlador también se integró la funcionalidad de consumir una API para obtener datos de usuarios, los cuales se cargan en la tabla si está vacía. Se mejoró la interfaz de usuario utilizando Bootstrap y FontAwesome, y se logró interactividad con JavaScript, permitiendo operaciones como eliminar y actualizar usuarios de manera dinámica. GitHub se empleó para el control de versiones y para compartir el código. Esta solución modular y completa cumple con los requerimientos del reto, ofreciendo una aplicación funcional y escalable.
