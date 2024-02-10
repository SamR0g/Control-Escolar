<?php
session_start();
session_destroy();
header("location: ../Modulos Alumno/LogInAlumno.php");

?>