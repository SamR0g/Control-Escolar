<?php
//esto va en cada inicio de sesion
session_start();
if(isset($_SESSION['Matricula'])){
    header("location: ./PrincipalAlumno.php");
    exit;
  
}
?>
<link rel="stylesheet" href="../css/LogIn.css">
<div class="wrapper">
    <div class="logo">
        <img src="../Imagenes/LogoBycenj.png">
    </div>
    <div class="text-center mt-4 name">
        Alumnos ByCENJ
    </div>
    <form class="p-3 mt-3" method="post" action="../php/LogInAlumno.php">
        <div class="form-field d-flex align-items-center">
            <span class="far fa-user"></span>
            <input type="text" name="Matricula" id="Matricula" placeholder="Matricula">
        </div>
        <div class="form-field d-flex align-items-center">
            <span class="fas fa-key"></span>
            <input type="Password" name="Password" id="Password" placeholder="contraseña">
        </div>
        <button class="btn mt-3" type="submit">Iniciar</button>
    </form>
    <div class="text-center fs-6">
        <a href="#">Olvidaste tu contraseña?</a> o <a href="#"> Registrarte</a>
    </div>
</div>
