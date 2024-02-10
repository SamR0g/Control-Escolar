function generatePDF() {
    cargarDatos(); // Llama a cargarDatos() antes de generar el PDF

    const element = document.querySelector('.alumno');
    html2pdf(element);
}

function cargarDatos() {
    var grupoSeleccionado = document.getElementById("grupoSelect").value;
    var semestreSeleccionado = document.getElementById("semestreSelect").value;
    var tabla = document.getElementById("datosTabla");

    // Limpiar la tabla antes de agregar nuevas filas
    limpiarTabla(tabla);

    if (grupoSeleccionado === "A") {
        if (semestreSeleccionado === "5") {
            agregarFila(tabla, "Juan Pérez", "12345", "A", "5", "Matutino", "Matemáticas", "90");
            agregarFila(tabla, "María López", "67890", "A", "5", "Vespertino", "Historia", "85");
            agregarFila(tabla, "Carlos Rodríguez", "13579", "A", "5", "Matutino", "Física", "92");
        } else if (semestreSeleccionado === "6") {
            agregarFila(tabla, "Ana Ramírez", "98765", "A", "6", "Vespertino", "Química", "88");
            agregarFila(tabla, "Luis González", "24680", "A", "6", "Matutino", "Biología", "87");
        }
    } else if (grupoSeleccionado === "B") {
        if (semestreSeleccionado === "5") {
            agregarFila(tabla, "Pedro García", "54321", "B", "5", "Matutino", "Historia", "85");
            agregarFila(tabla, "Sofía Martínez", "11223", "B", "5", "Vespertino", "Geografía", "88");
        } else if (semestreSeleccionado === "6") {
            agregarFila(tabla, "Diego Hernández", "99887", "B", "6", "Matutino", "Ética", "91");
            agregarFila(tabla, "Valeria Sánchez", "44556", "B", "6", "Vespertino", "Arte", "89");
        }
    }
    // Agrega más condiciones según tus grupos y semestres
}

function limpiarTabla(tabla) {
    while (tabla.rows.length > 1) {
        tabla.deleteRow(1);
    }
}

function agregarFila(tabla, nombre, matricula, grupo, semestre, turno) {
    turno = turno.charAt(0).toUpperCase() + turno.slice(1).toLowerCase();
    var fila = "<tr><td>" + nombre + "</td><td>" + matricula + "</td><td>" + grupo + "</td><td>" + semestre + "</td><td>" + turno + "</td></tr>";
    tabla.innerHTML += fila;
}


// Resto del código sigue igual...




function agregarFila(tabla, nombre, matricula, grupo, semestre, turno) {
    turno = turno.charAt(0).toUpperCase() + turno.slice(1).toLowerCase();
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
