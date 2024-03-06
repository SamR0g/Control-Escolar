<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Materias</title>
    <link rel="stylesheet" href="../css/Horario.css">
</head>
<body>

<div class="container">
    <h2>Registro de Materias</h2>

    <form action="../php/GuardarHorario.php" method="post">
        <div class="label-input">
            <label for="numero_materias">Número de Materias:</label>
            <input type="number" id="numero_materias" name="numero_materias" required min="1">
            <button type="button" onclick="generarCampos()">Generar Campos</button>
        </div>

        <div id="campos_materias">
            <!-- Aquí se generan los campos para ingresar los detalles de las materias -->
        </div>

        <input type="submit" value="Guardar">
    </form>
</div>

<script>
    function generarCampos() {
        var numeroMaterias = document.getElementById("numero_materias").value;
        var container = document.getElementById("campos_materias");
        container.innerHTML = ""; // Limpiar cualquier contenido previo

        for (var i = 1; i <= numeroMaterias; i++) {
            var div = document.createElement("div");
            div.innerHTML = `
                <h3>Materia ${i}</h3>
                <label for='nombre_materia_${i}'>Nombre de la Materia:</label>
                <input type='text' id='nombre_materia_${i}' name='nombre_materia[]' required>

                <label for='grupo_${i}'>Grupo:</label>
                <input type='text' id='grupo_${i}' name='grupo[]' required>

                <label for='semestre_${i}'>ID:</label>
                <input type='text' id='semestre_${i}' name='semestre[]' required>

                <label for='lunes_${i}'>Lunes:</label>
                <input type='text' id='lunes_${i}' name='lunes[]' placeholder='hh:mm - hh:mm'>

                <label for='martes_${i}'>Martes:</label>
                <input type='text' id='martes_${i}' name='martes[]' placeholder='hh:mm - hh:mm'>

                <label for='miercoles_${i}'>Miércoles:</label>
                <input type='text' id='miercoles_${i}' name='miercoles[]' placeholder='hh:mm - hh:mm'>

                <label for='jueves_${i}'>Jueves:</label>
                <input type='text' id='jueves_${i}' name='jueves[]' placeholder='hh:mm - hh:mm'>

                <label for='viernes_${i}'>Viernes:</label>
                <input type='text' id='viernes_${i}' name='viernes[]' placeholder='hh:mm - hh:mm'>

                <label for='sabado_${i}'>Sábado:</label>
                <input type='text' id='sabado_${i}' name='sabado[]' placeholder='hh:mm - hh:mm'>

                <label for='docente_${i}'>Docente:</label>
                <input type='text' id='docente_${i}' name='docente[]' required>`;
            container.appendChild(div);
        }
    }
</script>

</body>
</html>
