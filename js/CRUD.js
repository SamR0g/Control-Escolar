let listaAlumnos = [];

function agregarEditarAlumno() {
    const nombre = document.getElementById('nombre').value;
    const edad = document.getElementById('edad').value;

    if (nombre && edad) {
        const alumno = {
            nombre,
            edad
        };

        // Verificar si estamos editando o agregando
        const index = listaAlumnos.findIndex(a => a.nombre === nombre);
        if (index !== -1) {
            // Editar alumno existente
            listaAlumnos[index] = alumno;
        } else {
            // Agregar nuevo alumno
            listaAlumnos.push(alumno);
        }

        mostrarListaAlumnos();
        limpiarFormulario();
    } else {
        alert('Por favor, complete todos los campos.');
    }
}

function eliminarAlumno(nombre) {
    listaAlumnos = listaAlumnos.filter(a => a.nombre !== nombre);
    mostrarListaAlumnos();
}

function editarAlumno(nombre) {
    const alumno = listaAlumnos.find(a => a.nombre === nombre);

    if (alumno) {
        document.getElementById('nombre').value = alumno.nombre;
        document.getElementById('edad').value = alumno.edad;
    }
}

function mostrarListaAlumnos() {
    const lista = document.getElementById('listaAlumnos');
    lista.innerHTML = '';

    listaAlumnos.forEach(alumno => {
        const listItem = document.createElement('li');
        listItem.innerHTML = `${alumno.nombre}, ${alumno.edad} años 
            <button onclick="editarAlumno('${alumno.nombre}')">Editar</button>
            <button onclick="eliminarAlumno('${alumno.nombre}')">Eliminar</button>`;
        lista.appendChild(listItem);
    });
}

function limpiarFormulario() {
    document.getElementById('nombre').value = '';
    document.getElementById('edad').value = '';
}

// Mostrar lista inicialmente
mostrarListaAlumnos();
