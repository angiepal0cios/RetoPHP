// Seleccionar todos los elementos con la clase "bEliminar" y "bEditar"
const items = document.querySelectorAll(".bEliminar");
const botonesEditar = document.querySelectorAll(".bEditar");

// Iterar sobre cada elemento con la clase "bEliminar"
items.forEach(item => {
  item.addEventListener("click", function () {
    // Obtener el ID del elemento
    let id = this.dataset.id;
    // Mostrar un mensaje de confirmación al usuario
    let confirmacion = window.confirm("¿Deseas eliminar el elemento?");
    // Si el usuario confirma la eliminación, enviar una solicitud HTTP para eliminar el usuario
    if (confirmacion) {
      httpRequest(url + "crudusuario/eliminarUsuario/" + id, function (e) {
        console.log(this.responseText);
        // Eliminar la fila correspondiente a este usuario de la tabla
        const tbody = document.querySelector("#tbody-usuarios");
        const fila = document.querySelector("#fila-" + id);
        tbody.removeChild(fila);
      })
    }
  });
});

// Iterar sobre cada elemento con la clase "bEditar"
botonesEditar.forEach(item => {
  item.estado = 1; // Establecer un estado inicial para el botón
  item.addEventListener("click", function () {
    let id = this.dataset.id;
    let tbody = document.querySelector("#tbody-usuarios");
    let fila = document.querySelector("#fila-" + id);
    let iEditar = document.querySelector(`#fila-${id} .iEditar`);

    // Si el estado del botón es 1 (editar), cambiar la interfaz para permitir la edición de los campos
    if (item.estado == 1) {
      // Reemplazar el texto en las celdas con inputs para editar
      fila.cells[1].innerHTML = `<td><input style="width: 200px" name='nombre' value='${fila.cells[1].innerText}'></td>`;
      fila.cells[2].innerHTML = `<td><input style="width: 200px" name='telefono' value='${fila.cells[2].innerText}'></td>`;
      fila.cells[3].innerHTML = `<td><input style="width: 200px" name='correo' value='${fila.cells[3].innerText}'></td>`;
      fila.cells[4].innerHTML = `<td><input style="width: 200px" name='compania' value='${fila.cells[4].innerText}'></td>`;
      fila.cells[5].innerHTML = `<td><input style="width: 200px" name='calle' value='${fila.cells[5].innerText}'></td>`;
      fila.cells[6].innerHTML = `<td><input style="width: 200px" name='latitud' value='${fila.cells[6].innerText}'></td>`;
      fila.cells[7].innerHTML = `<td><input style="width: 200px" name='longitud' value='${fila.cells[7].innerText}'></td>`;

      // Cambiar el ícono del botón de editar a guardar
      iEditar.classList.remove('fa-pencil');
      iEditar.classList.add('fa-save');
      item.estado = 2; // Cambiar el estado del botón a 2 (guardar)
    } else {
      // Si el estado del botón es 2 (guardar), guardar los cambios realizados
      let formulario = document.createElement("form");
      formulario.setAttribute('method', "post");
      formulario.setAttribute('action', url + "crudusuario/actualizarUsuario/" + id);

      const nombresCampos = ['nombre', 'telefono', 'correo', 'compania', 'calle', 'latitud', 'longitud'];

      // Crear inputs ocultos dentro de un formulario para enviar los datos actualizados al servidor
      nombresCampos.forEach(nombreCampo => {
        let input = document.createElement("input");
        input.setAttribute('type', "text");
        input.setAttribute('name', nombreCampo);
        input.setAttribute('value', fila.cells[nombresCampos.indexOf(nombreCampo) + 1].firstChild.value);
        formulario.appendChild(input);
      });

      // Crear un botón de submit para enviar el formulario
      let submit = document.createElement("input");
      submit.setAttribute('type', "submit");
      submit.setAttribute('value', "Submit");
      formulario.appendChild(submit);
      fila.appendChild(formulario);

      // Cambiar el ícono del botón de guardar a editar
      iEditar.classList.remove('fa-save');
      iEditar.classList.add('fa-pencil');

      // Actualizar el texto en las celdas con los valores editados
      nombresCampos.forEach(nombreCampo => {
        fila.cells[nombresCampos.indexOf(nombreCampo) + 1].innerHTML = `<td>${fila.cells[nombresCampos.indexOf(nombreCampo) + 1].firstChild.value}</td>`;
      });

      item.estado = 1; // Cambiar el estado del botón a 1 (editar)
      submit.click(); // Simular un clic en el botón de submit para enviar el formulario automáticamente
    }
  });
});

// Función para enviar una solicitud HTTP
function httpRequest(url, callback) {
  const http = new XMLHttpRequest();
  http.open("GET", url);
  http.send();

  // Esperar la respuesta del servidor
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // Ejecutar la función de callback cuando se recibe una respuesta
      callback.apply(http);
    }
  }
}
