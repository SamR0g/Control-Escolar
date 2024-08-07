<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Información Personal</title>
  <link rel="stylesheet" media="all" href="../css/LLenadoInfoAlumno.css" />
</head>
<body>
<div class="container">
  <div class="row">
    <h1>Llenado de Información Personal</h1>
  </div>
  <div class="row">
    <h4 style="text-align:center">Llena todos los campos</h4>
  </div>
  
  <form action="../php/LLenadoInfoAlumno.php" method="POST">
    <div class="row input-container">
      <h2>Información Personal</h2>

      <div class="col-xs-12">
        <div class="styled-input wide">
          <input type="text" name="Matricula" required />
          <label>Matrícula</label>
        </div>
      </div>

      <div class="col-xs-12">
        <div class="styled-input wide">
          <input type="text" name="NumSeguroSocial" required />
          <label>Número de Seguro Social</label>
        </div>
      </div>

      <div class="col-xs-12">
        <div class="styled-input wide">
          <input type="text" name="NombrePadreTutor" required />
          <label>Nombre del Padre o Tutor</label>
        </div>
      </div>

      <div class="col-xs-12">
        <div class="styled-input wide">
          <input type="text" name="TelefonoPadre" required />
          <label>Teléfono del Padre</label>
        </div>
      </div>

      <div class="col-xs-12">
        <div class="styled-input wide">
          <input type="text" name="Domicilio" required />
          <label>Domicilio</label>
        </div>
      </div>

      <div class="col-xs-12">
        <div class="styled-input wide">
          <input type="text" name="Colonia" required />
          <label>Colonia</label>
        </div>
      </div>

      <div class="col-xs-12">
        <div class="styled-input wide">
          <input type="text" name="Municipio" required />
          <label>Municipio</label>
        </div>
      </div>

      <div class="col-xs-12">
        <div class="styled-input wide">
          <input type="text" name="TelefonoEmergencia" required />
          <label>Teléfono de Emergencia</label>
        </div>
      </div>

      <div class="col-xs-12">
        <div class="styled-input wide">
          <input type="text" name="TelefonoCasa" required />
          <label>Teléfono de Casa</label>
        </div>
      </div>

      <div class="col-xs-12">
        <div class="styled-input wide">
          <input type="text" name="TelefonoCelular" required />
          <label>Teléfono Celular</label>
        </div>
      </div>

      <div class="col-xs-12">
        <div class="styled-input wide">
          <input type="email" name="CorreoPersonal" required />
          <label>Correo Personal</label>
        </div>
      </div>

      <div class="col-xs-12">
        <div class="styled-input wide">
          <input type="text" name="Nacional" required />
          <label>Nacionalidad</label>
        </div>
      </div>

      <div class="col-xs-12">
        <div class="styled-input wide">
          <input type="text" name="Estado" required />
          <label>Estado</label>
        </div>
      </div>

      <div class="col-xs-12">
        <div class="styled-input wide">
          <input type="text" name="LocalidadAlumno" required />
          <label>Localidad del Alumno</label>
        </div>
      </div>

      <div class="col-xs-12">
        <div class="styled-input wide">
          <input type="text" name="Talla" required />
          <label>Talla</label>
        </div>
      </div>

      <div class="col-xs-12">
        <div class="styled-input wide">
          <input type="text" name="Sexo" required />
          <label>Sexo</label>
        </div>
      </div>

      <div class="col-xs-12">
        <div class="styled-input wide date-field">
          <label>Fecha de Nacimiento</label>
		  <input type="date" name="FechaNacimiento" required />
		</div>
      </div>
    </div>

    <div class="row input-container">
      <h2>Información Académica</h2>

      <div class="col-xs-12">
        <div class="styled-input wide">
          <input type="text" name="FichaExamen" required />
          <label>Ficha de Examen</label>
        </div>
      </div>

      <div class="col-xs-12">
        <div class="styled-input wide">
          <input type="number" step="0.01" name="PuntajeExamen" required />
          <label>Puntaje de Examen</label>
        </div>
      </div>

      <div class="col-xs-12">
        <div class="styled-input wide">
          <input type="number" step="0.01" name="PromedioBachillerato" required />
          <label>Promedio de Bachillerato</label>
        </div>
      </div>

      <div class="col-xs-12">
        <div class="styled-input wide">
          <input type="text" name="FolioBachillerato" required />
          <label>Folio de Bachillerato</label>
        </div>
      </div>

      <div class="col-xs-12">
        <div class="styled-input wide date-field">
          <label>Fecha de Expedición de Bachillerato</label>
          <input type="date" name="FechaExpedicionBachillerato" required />
        </div>
      </div>

      <div class="col-xs-12">
        <div class="styled-input wide">
          <input type="text" name="NombreBachillerato" required />
          <label>Nombre del Bachillerato</label>
        </div>
      </div>

      <div class="col-xs-12">
        <div class="styled-input wide">
          <input type="text" name="MunicipioBachillerato" required />
          <label>Municipio del Bachillerato</label>
        </div>
      </div>

      <div class="col-xs-12">
        <div class="styled-input wide date-field">
          <label>Fecha de Ingreso</label>
          <input type="date" name="FechaIngreso" required />
        </div>
      </div>
    </div>

    <div class="col-xs-12">
      <button type="submit" class="btn-lrg submit-btn">Enviar Información</button>
    </div>
  </form>
</div>
</body>
</html>
