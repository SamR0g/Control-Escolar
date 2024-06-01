// Función para buscar calificaciones
function buscarCalificaciones() {
    var matricula = document.getElementById("matriculaInput").value;
    var grupo = document.getElementById("grupoSelect").value;

    // Aquí puedes enviar la petición al servidor para obtener las calificaciones según la matrícula y el grupo seleccionado
    // Por ahora, simplemente mostraremos un mensaje en la consola
    console.log("Buscar calificaciones para matrícula: " + matricula + " y grupo: " + grupo);
}

// Función para imprimir la tabla
function imprimirTabla() {
    window.print();
}

// Función para exportar a Excel
function exportarAExcel() {
    // Aquí puedes implementar la lógica para exportar los datos a un archivo Excel
    // Por ahora, simplemente mostraremos un mensaje en la consola
    console.log("Exportando a Excel...");
}
