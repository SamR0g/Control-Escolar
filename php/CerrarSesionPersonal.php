<?php
session_start();
session_destroy();
header("location: ../Modulos Personal/LogInPersonal.php");

?>