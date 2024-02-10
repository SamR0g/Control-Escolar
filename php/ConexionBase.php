<?php

$con = mysqli_connect("localhost", "root", "", "controlescolar");
   
   if ($con){
       //echo "Conectado exitosamente";
   } else {
       echo "No se a podido conectar a la base de datos";
   }
   
 
?>