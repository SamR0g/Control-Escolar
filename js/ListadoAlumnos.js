function generatePDF() {
    cargarDatos(); // Llama a cargarDatos() antes de generar el PDF

    const element = document.querySelector('.alumno');
    html2pdf(element);
}

function cargarDatos() {
    // Obtener el valor seleccionado en el dropdown
    var grupoSeleccionado = document.getElementById("grupoSelect").value;

    // Obtener el elemento de la tabla
    var tabla = document.getElementById("datosTabla");

    // Limpiar la tabla
    tabla.innerHTML = "<tr><th>Nombre</th><th>Matrícula</th><th>Grupo</th><th>Semestre</th><th>Turno</th></tr>";

    // Agregar filas según el grupo seleccionado
    if (grupoSeleccionado === "A") {
        // Datos de ejemplo con turno
        agregarFila(tabla, "Juan Pérez", "12345", "A", "5", "Matutino");
        agregarFila(tabla, "María López", "67890", "A", "6", "Vespertino");
        // Puedes agregar más filas según sea necesario
    } else if (grupoSeleccionado === "B") {
        // Datos de ejemplo con turno
        agregarFila(tabla, "Pedro García", "54321", "B", "5", "Matutino");
        agregarFila(tabla, "Ana Ramírez", "98765", "B", "6", "Vespertino");
        // Puedes agregar más filas según sea necesario
    }
    // Agrega más condiciones según tus grupos
}

function agregarFila(tabla, nombre, matricula, grupo, semestre, turno) {
    // Dar formato al turno con la primera letra en mayúscula
    turno = turno.charAt(0).toUpperCase() + turno.slice(1).toLowerCase();

    // Agregar una fila a la tabla con los datos proporcionados
    var fila = "<tr><td>" + nombre + "</td><td>" + matricula + "</td><td>" + grupo + "</td><td>" + semestre + "</td><td>" + turno + "</td></tr>";
    tabla.innerHTML += fila;
}

// Resto del código sigue igual...


function agregarFila(tabla, nombre, matricula, grupo, semestre, turno) {
    // Dar formato al turno con la primera letra en mayúscula
    turno = turno.charAt(0).toUpperCase() + turno.slice(1).toLowerCase();

    // Agregar una fila a la tabla con los datos proporcionados
    var fila = "<tr><td>" + nombre + "</td><td>" + matricula + "</td><td>" + grupo + "</td><td>" + semestre + "</td><td>" + turno + "</td></tr>";
    tabla.innerHTML += fila;
}



function generateExcel() {
    const table = document.getElementById('datosTabla'); // Cambiado a 'datosTabla'
    const ws = XLSX.utils.table_to_sheet(table);
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, 'Concentrado_Alumnos');
    XLSX.writeFile(wb, 'Concentrado_Alumnos.xlsx');
}

// Cargar datos al cargar la página
cargarDatos();

