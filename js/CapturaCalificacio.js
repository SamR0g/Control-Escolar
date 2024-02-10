function agregarCalificacion() {
    var nombre = document.getElementById('nombre').value;
    var materia = document.getElementById('materia').value;
    var semestre = document.getElementById('semestre').value;
    var calificacion = document.getElementById('calificacion').value;
  
    document.getElementById('info-nombre').textContent = 'Nombre: ' + nombre;
    document.getElementById('info-materias').textContent = 'Materia: ' + materia;
    document.getElementById('info-semestre').textContent = 'Semestre: ' + semestre;
    document.getElementById('info-calificaciones').textContent = 'Calificación: ' + calificacion;
  }
// ... (tu script JavaScript existente) ...

// Datos de ejemplo para la selección dinámica de materias
var materiasPorSemestre = {
    "1": ["Materia1A", "Materia2A", "Materia3A"],
    "2": ["Materia1B", "Materia2B", "Materia3B"],
    // Agrega más materias según sea necesario para cada semestre
  };
  
  function actualizarMaterias() {
    var semestreSeleccionado = document.getElementById('semestre').value;
    var materiaSelect = document.getElementById('materia');
  
    // Limpiar las opciones actuales
    materiaSelect.innerHTML = '';
  
    // Agregar nuevas opciones basadas en el semestre seleccionado
    var materias = materiasPorSemestre[semestreSeleccionado] || [];
    for (var i = 0; i < materias.length; i++) {
      var option = document.createElement('option');
      option.value = materias[i];
      option.text = materias[i];
      materiaSelect.appendChild(option);
    }
  }
  
  // Llamar a la función al cargar la página para establecer las opciones iniciales
  actualizarMaterias();
    