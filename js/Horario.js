var currentMateria = 1;

function agregarMateria() {
    var numMaterias = document.getElementById('materias').value;

    // Verificar si ya se han agregado todas las materias
    if (currentMateria > numMaterias) {
        alert("Ya se han agregado todas las materias.");
        return;
    }

    // Limpiar campos de la materia anterior
    var materiasContainer = document.getElementById('materiasContainer');
    while (materiasContainer.firstChild) {
        materiasContainer.removeChild(materiasContainer.firstChild);
    }

    // Crear campos para la nueva materia
    var materiaDiv = document.createElement('div');
    materiaDiv.id = 'materia' + currentMateria;
    materiaDiv.innerHTML = '<label for="nombreMateria' + currentMateria + '">Nombre de la Materia:</label>';
    materiaDiv.innerHTML += '<input type="text" id="nombreMateria' + currentMateria + '" name="nombreMateria' + currentMateria + '">';
    
    for (var j = 1; j <= 6; j++) {
        materiaDiv.innerHTML += '<label for="materia' + currentMateria + 'dia' + j + '">Día ' + j + ':</label>';
        materiaDiv.innerHTML += '<input type="text" id="materia' + currentMateria + 'dia' + j + '" name="materia' + currentMateria + 'dia' + j + '">';
    }

    materiasContainer.appendChild(materiaDiv);
    currentMateria++;

    // Mostrar el botón de "Ver Horario" cuando se hayan agregado todas las materias
    if (currentMateria > numMaterias) {
        document.getElementById('verHorarioBtn').style.display = 'inline-block';
    }
}

function verHorario() {
    // Aquí puedes implementar la lógica para mostrar el horario según los datos ingresados
    alert("Aquí mostrarías el horario. Implementa la lógica según tus necesidades.");
}

document.getElementById('horarioForm').addEventListener('submit', function (e) {
    e.preventDefault();
    console.log("Formulario enviado"); // Agrega este console.log() para verificar si el formulario se está enviando correctamente
    updateProgressBar(100);
});

function updateProgressBar(progress) {
    var progressBar = document.getElementById('progress');
    progressBar.style.width = progress + '%';
    progressBar.innerHTML = progress + '%';
}
