// validacion.js

function validarFormulario() {
    // Limpiar mensajes de error anteriores
    limpiarErrores();

    var matricula = document.getElementById("matricula").value;
    var nombre = document.getElementById("nombre").value;
    var apellidoPaterno = document.getElementById("apellidoPaterno").value;
    var apellidoMaterno = document.getElementById("apellidoMaterno").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    // Validar que la matrícula contenga solo números
    if (!esNumero(matricula)) {
        mostrarError("matricula", "La matrícula debe contener solo números.");
        return false; // Detener el envío del formulario
    }

    // Validar que nombre y apellidos contengan solo letras
    if (!esLetra(nombre) || !esLetra(apellidoPaterno) || !esLetra(apellidoMaterno)) {
        mostrarError("nombre", "Los campos de nombre y apellidos deben contener solo letras.");
        return false; // Detener el envío del formulario
    }

    if (matricula === "" || nombre === "" || apellidoPaterno === "" || apellidoMaterno === "" || email === "" || password === "") {
        mostrarError("general", "Por favor, complete todos los campos.");
        return false; // Detener el envío del formulario
    }

    // Puedes agregar aquí más lógica de validación según tus necesidades

    return true; // Permitir el envío del formulario
}

function esNumero(valor) {
    // Expresión regular que verifica si el valor contiene solo números
    return /^\d+$/.test(valor);
}

function esLetra(valor) {
    // Expresión regular que verifica si el valor contiene solo letras
    return /^[a-zA-Z]+$/.test(valor);
}

function mostrarError(campo, mensaje) {
    // Mostrar mensaje de error debajo del campo correspondiente
    var elementoError = document.getElementById(campo + "-error");
    if (elementoError) {
        elementoError.innerHTML = mensaje;
        elementoError.style.display = "block";
    }
}

function limpiarErrores() {
    // Limpiar mensajes de error
    var campos = ["matricula", "nombre", "apellidoPaterno", "apellidoMaterno", "email", "password", "general"];
    campos.forEach(function(campo) {
        var elementoError = document.getElementById(campo + "-error");
        if (elementoError) {
            elementoError.innerHTML = "";
            elementoError.style.display = "none";
        }
    });
}
