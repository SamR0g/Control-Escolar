<?php
session_start(); // Iniciar sesión si no está iniciada aún

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["Matricula"])) {
    // Redirigir al usuario al formulario de inicio de sesión si no ha iniciado sesión
    header("Location: LogInAlumno.php");
    exit();
}

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "controlescolar";

$conn = new mysqli($servername, $username, $password, $database);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta name="generator" content="PhpSpreadsheet, https://github.com/PHPOffice/PhpSpreadsheet">
      <meta name="author" content="Control Escolar" />
      <meta name="company" content="Microsoft Corporation" />
    <style type="text/css">
      html { font-family:Calibri, Arial, Helvetica, sans-serif; font-size:11pt; background-color:white }
      a.comment-indicator:hover + div.comment { background:#ffd; position:absolute; display:block; border:1px solid black; padding:0.5em }
      a.comment-indicator { background:red; display:inline-block; border:1px solid black; width:0.5em; height:0.5em }
      div.comment { display:none }
      table { border-collapse:collapse; page-break-after:always }
      .gridlines td { border:1px dotted black }
      .gridlines th { border:1px dotted black }
      .b { text-align:center }
      .e { text-align:center }
      .f { text-align:right }
      .inlineStr { text-align:left }
      .n { text-align:right }
      .s { text-align:left }
      td.style0 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11.0pt; background-color:white }
      th.style0 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11.0pt; background-color:white }
      td.style1 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11.0pt; background-color:white }
      th.style1 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11.0pt; background-color:white }
      td.style2 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11.0pt; background-color:white }
      th.style2 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11.0pt; background-color:white }
      td.style3 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:24.0pt; background-color:white }
      th.style3 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:24.0pt; background-color:white }
      td.style4 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style4 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style5 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:16.0pt; background-color:white }
      th.style5 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:16.0pt; background-color:white }
      td.style6 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style6 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style7 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:11.0pt; background-color:white }
      th.style7 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:11.0pt; background-color:white }
      td.style8 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:22.0pt; background-color:white }
      th.style8 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:22.0pt; background-color:white }
      td.style9 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:18.0pt; background-color:white }
      th.style9 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:18.0pt; background-color:white }
      td.style10 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style10 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style11 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:18.0pt; background-color:white }
      th.style11 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:18.0pt; background-color:white }
      td.style12 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style12 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style13 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10.0pt; background-color:white }
      th.style13 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10.0pt; background-color:white }
      td.style14 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10.0pt; background-color:white }
      th.style14 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10.0pt; background-color:white }
      td.style15 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11.0pt; background-color:white }
      th.style15 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11.0pt; background-color:white }
      td.style16 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style16 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style17 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:14.0pt; background-color:white }
      th.style17 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:14.0pt; background-color:white }
      td.style18 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style18 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style19 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:14.0pt; background-color:white }
      th.style19 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:14.0pt; background-color:white }
      td.style20 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:14.0pt; background-color:white }
      th.style20 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:14.0pt; background-color:white }
      td.style21 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:14.0pt; background-color:white }
      th.style21 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:14.0pt; background-color:white }
      td.style22 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:14.0pt; background-color:white }
      th.style22 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:14.0pt; background-color:white }
      td.style23 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style23 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style24 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11.0pt; background-color:white }
      th.style24 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11.0pt; background-color:white }
      td.style25 { vertical-align:bottom; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style25 { vertical-align:bottom; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style26 { vertical-align:bottom; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style26 { vertical-align:bottom; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style27 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:12.0pt; background-color:white }
      th.style27 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:12.0pt; background-color:white }
      td.style28 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:12.0pt; background-color:white }
      th.style28 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:12.0pt; background-color:white }
      td.style29 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:10.0pt; background-color:white }
      th.style29 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:10.0pt; background-color:white }
      td.style30 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:10.0pt; background-color:white }
      th.style30 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:10.0pt; background-color:white }
      td.style31 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11.0pt; background-color:white }
      th.style31 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11.0pt; background-color:white }
      td.style32 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11.0pt; background-color:white }
      th.style32 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11.0pt; background-color:white }
      td.style33 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:14.0pt; background-color:white }
      th.style33 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:14.0pt; background-color:white }
      td.style34 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:14.0pt; background-color:white }
      th.style34 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:14.0pt; background-color:white }
      td.style35 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:14.0pt; background-color:white }
      th.style35 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:14.0pt; background-color:white }
      td.style36 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11.0pt; background-color:white }
      th.style36 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11.0pt; background-color:white }
      td.style37 { vertical-align:bottom; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style37 { vertical-align:bottom; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style38 { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11.0pt; background-color:white }
      th.style38 { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11.0pt; background-color:white }
      td.style39 { vertical-align:bottom; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style39 { vertical-align:bottom; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style40 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:7.0pt; background-color:white }
      th.style40 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:7.0pt; background-color:white }
      td.style41 { vertical-align:bottom; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style41 { vertical-align:bottom; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style42 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:11.0pt; background-color:white }
      th.style42 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:11.0pt; background-color:white }
      td.style43 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:11.0pt; background-color:white }
      th.style43 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:11.0pt; background-color:white }
      td.style44 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12.0pt; background-color:white }
      th.style44 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12.0pt; background-color:white }
      td.style45 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:11.0pt; background-color:white }
      th.style45 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:11.0pt; background-color:white }
      td.style46 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style46 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style47 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style47 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style48 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:14.0pt; background-color:white }
      th.style48 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:14.0pt; background-color:white }
      td.style49 { vertical-align:bottom; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style49 { vertical-align:bottom; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style50 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:24.0pt; background-color:white }
      th.style50 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:24.0pt; background-color:white }
      td.style51 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:6.0pt; background-color:white }
      th.style51 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:6.0pt; background-color:white }
      td.style52 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:11.0pt; background-color:white }
      th.style52 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:11.0pt; background-color:white }
      td.style53 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:9.0pt; background-color:white }
      th.style53 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:9.0pt; background-color:white }
      td.style54 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style54 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style55 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style55 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style56 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style56 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style57 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style57 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style58 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style58 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style59 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style59 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style60 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:8.0pt; background-color:white }
      th.style60 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:8.0pt; background-color:white }
      td.style61 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:8.0pt; background-color:white }
      th.style61 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:8.0pt; background-color:white }
      td.style62 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:10.0pt; background-color:white }
      th.style62 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:10.0pt; background-color:white }
      td.style63 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:10.0pt; background-color:white }
      th.style63 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Arial'; font-size:10.0pt; background-color:white }
      td.style64 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:10.0pt; background-color:white }
      th.style64 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:10.0pt; background-color:white }
      td.style65 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:14.0pt; background-color:white }
      th.style65 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:14.0pt; background-color:white }
      td.style66 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:14.0pt; background-color:white }
      th.style66 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:14.0pt; background-color:white }
      td.style67 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:10.0pt; background-color:white }
      th.style67 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:10.0pt; background-color:white }
      td.style68 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:10.0pt; background-color:white }
      th.style68 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:10.0pt; background-color:white }
      td.style69 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:10.0pt; background-color:white }
      th.style69 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:10.0pt; background-color:white }
      td.style70 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style70 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style71 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:10.0pt; background-color:white }
      th.style71 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:10.0pt; background-color:white }
      td.style72 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:24.0pt; background-color:white }
      th.style72 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:24.0pt; background-color:white }
      td.style73 { vertical-align:bottom; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style73 { vertical-align:bottom; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style74 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:24.0pt; background-color:white }
      th.style74 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:24.0pt; background-color:white }
      td.style75 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style75 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style76 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style76 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style77 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:10.0pt; background-color:white }
      th.style77 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:10.0pt; background-color:white }
      td.style78 { vertical-align:bottom; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style78 { vertical-align:bottom; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style79 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:11.0pt; background-color:white }
      th.style79 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:11.0pt; background-color:white }
      td.style80 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11.0pt; background-color:white }
      th.style80 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11.0pt; background-color:white }
      td.style81 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:14.0pt; background-color:white }
      th.style81 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:14.0pt; background-color:white }
      td.style82 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:14.0pt; background-color:white }
      th.style82 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:14.0pt; background-color:white }
      td.style83 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11.0pt; background-color:white }
      th.style83 { vertical-align:middle; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11.0pt; background-color:white }
      td.style84 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:10.0pt; background-color:white }
      th.style84 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:10.0pt; background-color:white }
      td.style85 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11.0pt; background-color:white }
      th.style85 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11.0pt; background-color:white }
      td.style86 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11.0pt; background-color:white }
      th.style86 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11.0pt; background-color:white }
      td.style87 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style87 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style88 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:24.0pt; background-color:white }
      th.style88 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:24.0pt; background-color:white }
      td.style89 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:10.0pt; background-color:white }
      th.style89 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:10.0pt; background-color:white }
      td.style90 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:14.0pt; background-color:white }
      th.style90 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:14.0pt; background-color:white }
      td.style91 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:14.0pt; background-color:white }
      th.style91 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:14.0pt; background-color:white }
      td.style92 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:10.0pt; background-color:white }
      th.style92 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Arial'; font-size:10.0pt; background-color:white }
      td.style93 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:24.0pt; background-color:white }
      th.style93 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:24.0pt; background-color:white }
      td.style94 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:10.0pt; background-color:white }
      th.style94 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:10.0pt; background-color:white }
      td.style95 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:10.0pt; background-color:white }
      th.style95 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:10.0pt; background-color:white }
      td.style96 { vertical-align:middle; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:11.0pt; background-color:white }
      th.style96 { vertical-align:middle; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:11.0pt; background-color:white }
      td.style97 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:14.0pt; background-color:white }
      th.style97 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:14.0pt; background-color:white }
      td.style98 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:10.0pt; background-color:white }
      th.style98 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:10.0pt; background-color:white }
      td.style99 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:10.0pt; background-color:white }
      th.style99 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:10.0pt; background-color:white }
      td.style100 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:22.0pt; background-color:white }
      th.style100 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:22.0pt; background-color:white }
      td.style101 { vertical-align:middle; text-align:center; border-bottom:3px solid #000000 !important; border-top:3px solid #000000 !important; border-left:3px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:48.0pt; background-color:white }
      th.style101 { vertical-align:middle; text-align:center; border-bottom:3px solid #000000 !important; border-top:3px solid #000000 !important; border-left:3px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:48.0pt; background-color:white }
      td.style102 { vertical-align:bottom; border-bottom:3px solid #000000 !important; border-top:3px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style102 { vertical-align:bottom; border-bottom:3px solid #000000 !important; border-top:3px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      td.style103 { vertical-align:bottom; border-bottom:3px solid #000000 !important; border-top:3px solid #000000 !important; border-left:none #000000; border-right:3px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      th.style103 { vertical-align:bottom; border-bottom:3px solid #000000 !important; border-top:3px solid #000000 !important; border-left:none #000000; border-right:3px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:10pt; background-color:white }
      table.sheet0 col.col0 { width:27.1111108pt }
      table.sheet0 col.col1 { width:27.1111108pt }
      table.sheet0 col.col2 { width:27.1111108pt }
      table.sheet0 col.col3 { width:27.1111108pt }
      table.sheet0 col.col4 { width:27.1111108pt }
      table.sheet0 col.col5 { width:27.1111108pt }
      table.sheet0 col.col6 { width:27.1111108pt }
      table.sheet0 col.col7 { width:27.1111108pt }
      table.sheet0 col.col8 { width:27.1111108pt }
      table.sheet0 col.col9 { width:27.1111108pt }
      table.sheet0 col.col10 { width:30.49999965pt }
      table.sheet0 col.col11 { width:34.56666627pt }
      table.sheet0 col.col12 { width:27.1111108pt }
      table.sheet0 col.col13 { width:27.1111108pt }
      table.sheet0 col.col14 { width:27.1111108pt }
      table.sheet0 col.col15 { width:27.1111108pt }
      table.sheet0 col.col16 { width:27.1111108pt }
      table.sheet0 col.col17 { width:27.1111108pt }
      table.sheet0 col.col18 { width:27.1111108pt }
      table.sheet0 col.col19 { width:27.1111108pt }
      table.sheet0 col.col20 { width:27.1111108pt }
      table.sheet0 col.col21 { width:27.1111108pt }
      table.sheet0 col.col22 { width:27.1111108pt }
      table.sheet0 col.col23 { width:26.43333303pt }
      table.sheet0 col.col24 { width:27.1111108pt }
      table.sheet0 col.col25 { width:27.1111108pt }
      table.sheet0 col.col26 { width:42.02222174pt }
      table.sheet0 col.col27 { width:17.62222202pt }
      table.sheet0 col.col28 { width:23.04444418pt }
      table.sheet0 col.col29 { width:17.62222202pt }
      table.sheet0 col.col30 { width:23.72222195pt }
      table.sheet0 col.col31 { width:17.62222202pt }
      table.sheet0 col.col32 { width:17.62222202pt }
      table.sheet0 col.col33 { width:17.62222202pt }
      table.sheet0 col.col34 { width:17.62222202pt }
      table.sheet0 col.col35 { width:17.62222202pt }
      table.sheet0 col.col36 { width:17.62222202pt }
      table.sheet0 tr { height:15pt }
      table.sheet0 tr.row1 { height:24.75pt }
      table.sheet0 tr.row2 { height:24.75pt }
      table.sheet0 tr.row3 { height:24.75pt }
      table.sheet0 tr.row4 { height:24.75pt }
      table.sheet0 tr.row5 { height:19.5pt }
      table.sheet0 tr.row6 { height:21pt }
      table.sheet0 tr.row7 { height:21pt }
      table.sheet0 tr.row8 { height:21pt }
      table.sheet0 tr.row9 { height:21pt }
      table.sheet0 tr.row10 { height:21pt }
      table.sheet0 tr.row11 { height:21pt }
      table.sheet0 tr.row12 { height:21pt }
      table.sheet0 tr.row13 { height:21pt }
      table.sheet0 tr.row14 { height:21pt }
      table.sheet0 tr.row15 { height:21pt }
      table.sheet0 tr.row16 { height:19.5pt }
      table.sheet0 tr.row17 { height:19.5pt }
      table.sheet0 tr.row18 { height:19.5pt }
      table.sheet0 tr.row19 { height:19.5pt }
      table.sheet0 tr.row20 { height:19.5pt }
      table.sheet0 tr.row21 { height:22.5pt }
      table.sheet0 tr.row22 { height:22.5pt }
      table.sheet0 tr.row23 { height:22.5pt }
      table.sheet0 tr.row24 { height:22.5pt }
      table.sheet0 tr.row25 { height:22.5pt }
      table.sheet0 tr.row26 { height:22.5pt }
      table.sheet0 tr.row27 { height:22.5pt }
      table.sheet0 tr.row28 { height:19.5pt }
      table.sheet0 tr.row29 { height:19.5pt }
      table.sheet0 tr.row30 { height:19.5pt }
      table.sheet0 tr.row31 { height:19.5pt }
      table.sheet0 tr.row32 { height:19.5pt }
      table.sheet0 tr.row33 { height:22.5pt }
      table.sheet0 tr.row34 { height:22.5pt }
      table.sheet0 tr.row35 { height:22.5pt }
      table.sheet0 tr.row36 { height:22.5pt }
      table.sheet0 tr.row37 { height:22.5pt }
      table.sheet0 tr.row38 { height:22.5pt }
      table.sheet0 tr.row39 { height:19.5pt }
      table.sheet0 tr.row40 { height:19.5pt }
      table.sheet0 tr.row41 { height:19.5pt }
      table.sheet0 tr.row42 { height:19.5pt }
      table.sheet0 tr.row43 { height:19.5pt }
      table.sheet0 tr.row44 { height:22.5pt }
      table.sheet0 tr.row45 { height:22.5pt }
      table.sheet0 tr.row46 { height:22.5pt }
      table.sheet0 tr.row47 { height:22.5pt }
      table.sheet0 tr.row48 { height:22.5pt }
      table.sheet0 tr.row49 { height:22.5pt }
      table.sheet0 tr.row50 { height:22.5pt }
      table.sheet0 tr.row51 { height:19.5pt }
      table.sheet0 tr.row52 { height:19.5pt }
      table.sheet0 tr.row53 { height:19.5pt }
      table.sheet0 tr.row54 { height:19.5pt }
      table.sheet0 tr.row55 { height:19.5pt }
      table.sheet0 tr.row56 { height:22.5pt }
      table.sheet0 tr.row57 { height:22.5pt }
      table.sheet0 tr.row58 { height:22.5pt }
      table.sheet0 tr.row59 { height:22.5pt }
      table.sheet0 tr.row60 { height:22.5pt }
      table.sheet0 tr.row61 { height:22.5pt }
      table.sheet0 tr.row62 { height:22.5pt }
      table.sheet0 tr.row63 { height:22.5pt }
      table.sheet0 tr.row64 { height:19.5pt }
      table.sheet0 tr.row65 { height:19.5pt }
      table.sheet0 tr.row66 { height:19.5pt }
      table.sheet0 tr.row67 { height:19.5pt }
      table.sheet0 tr.row68 { height:19.5pt }
      table.sheet0 tr.row69 { height:19.5pt }
      table.sheet0 tr.row70 { height:19.5pt }
      table.sheet0 tr.row71 { height:19.5pt }
      table.sheet0 tr.row72 { height:19.5pt }
      table.sheet0 tr.row73 { height:19.5pt }
      table.sheet0 tr.row74 { height:19.5pt }
      table.sheet0 tr.row75 { height:19.5pt }
      table.sheet0 tr.row76 { height:19.5pt }
      table.sheet0 tr.row77 { height:19.5pt }
      table.sheet0 tr.row78 { height:19.5pt }
      table.sheet0 tr.row79 { height:19.5pt }
      table.sheet0 tr.row80 { height:19.5pt }
      table.sheet0 tr.row81 { height:19.5pt }
      table.sheet0 tr.row82 { height:19.5pt }
      table.sheet0 tr.row83 { height:19.5pt }
      table.sheet0 tr.row84 { height:19.5pt }
      table.sheet0 tr.row85 { height:19.5pt }
      table.sheet0 tr.row86 { height:19.5pt }
      table.sheet0 tr.row87 { height:19.5pt }
      table.sheet0 tr.row88 { height:19.5pt }
      table.sheet0 tr.row89 { height:19.5pt }
      table.sheet0 tr.row90 { height:19.5pt }
      table.sheet0 tr.row91 { height:19.5pt }
      table.sheet0 tr.row92 { height:19.5pt }
      table.sheet0 tr.row93 { height:19.5pt }
      table.sheet0 tr.row94 { height:19.5pt }
      table.sheet0 tr.row95 { height:19.5pt }
      table.sheet0 tr.row96 { height:19.5pt }
      table.sheet0 tr.row97 { height:19.5pt }
      table.sheet0 tr.row98 { height:19.5pt }
      table.sheet0 tr.row99 { height:19.5pt }
      table.sheet0 tr.row100 { height:19.5pt }
      table.sheet0 tr.row101 { height:19.5pt }
      table.sheet0 tr.row102 { height:19.5pt }
      table.sheet0 tr.row103 { height:19.5pt }
      table.sheet0 tr.row104 { height:19.5pt }
      table.sheet0 tr.row105 { height:19.5pt }
      table.sheet0 tr.row106 { height:19.5pt }
      table.sheet0 tr.row107 { height:19.5pt }
      table.sheet0 tr.row108 { height:60.75pt }
      table.sheet0 tr.row109 { height:15.75pt }
      table.sheet0 tr.row110 { height:15.75pt }
      table.sheet0 tr.row111 { height:15.75pt }
      table.sheet0 tr.row112 { height:15.75pt }
      table.sheet0 tr.row113 { height:15.75pt }
      table.sheet0 tr.row114 { height:15.75pt }
      table.sheet0 tr.row115 { height:15.75pt }
      table.sheet0 tr.row116 { height:15.75pt }
      table.sheet0 tr.row117 { height:15.75pt }
      table.sheet0 tr.row118 { height:15.75pt }
      table.sheet0 tr.row119 { height:15.75pt }
      table.sheet0 tr.row120 { height:15.75pt }
      table.sheet0 tr.row121 { height:15.75pt }
      table.sheet0 tr.row122 { height:15.75pt }
      table.sheet0 tr.row123 { height:15.75pt }
      table.sheet0 tr.row124 { height:15.75pt }
      table.sheet0 tr.row125 { height:15.75pt }
      table.sheet0 tr.row126 { height:15.75pt }
      table.sheet0 tr.row127 { height:15.75pt }
      table.sheet0 tr.row128 { height:15.75pt }
      table.sheet0 tr.row129 { height:15.75pt }
      table.sheet0 tr.row130 { height:15.75pt }
      table.sheet0 tr.row131 { height:15.75pt }
      table.sheet0 tr.row 2 { height:15.75pt }
      table.sheet0 tr.row133 { height:15.75pt }
      table.sheet0 tr.row134 { height:15.75pt }
      table.sheet0 tr.row135 { height:15.75pt }
      table.sheet0 tr.row136 { height:15.75pt }
      table.sheet0 tr.row137 { height:15.75pt }
      table.sheet0 tr.row138 { height:15.75pt }
      table.sheet0 tr.row139 { height:15.75pt }
      table.sheet0 tr.row140 { height:15.75pt }
      table.sheet0 tr.row141 { height:15.75pt }
      table.sheet0 tr.row142 { height:15.75pt }
      table.sheet0 tr.row143 { height:15.75pt }
      table.sheet0 tr.row144 { height:15.75pt }
      table.sheet0 tr.row145 { height:15.75pt }
      table.sheet0 tr.row146 { height:15.75pt }
      table.sheet0 tr.row147 { height:15.75pt }
      table.sheet0 tr.row148 { height:15.75pt }
      table.sheet0 tr.row149 { height:15.75pt }
      table.sheet0 tr.row150 { height:15.75pt }
      table.sheet0 tr.row151 { height:15.75pt }
      table.sheet0 tr.row152 { height:15.75pt }
      table.sheet0 tr.row153 { height:15.75pt }
      table.sheet0 tr.row154 { height:15.75pt }
      table.sheet0 tr.row155 { height:15.75pt }
      table.sheet0 tr.row156 { height:15.75pt }
      table.sheet0 tr.row157 { height:15.75pt }
      table.sheet0 tr.row158 { height:15.75pt }
      table.sheet0 tr.row159 { height:15.75pt }
      table.sheet0 tr.row160 { height:15.75pt }
      table.sheet0 tr.row161 { height:15.75pt }
      table.sheet0 tr.row162 { height:15.75pt }
      table.sheet0 tr.row163 { height:15.75pt }
      table.sheet0 tr.row164 { height:15.75pt }
      table.sheet0 tr.row165 { height:15.75pt }
      table.sheet0 tr.row166 { height:15.75pt }
      table.sheet0 tr.row167 { height:15.75pt }
      table.sheet0 tr.row168 { height:15.75pt }
      table.sheet0 tr.row169 { height:15.75pt }
      table.sheet0 tr.row170 { height:15.75pt }
      table.sheet0 tr.row171 { height:15.75pt }
      table.sheet0 tr.row172 { height:15.75pt }
      table.sheet0 tr.row173 { height:15.75pt }
      table.sheet0 tr.row174 { height:15.75pt }
      table.sheet0 tr.row175 { height:15.75pt }
      table.sheet0 tr.row176 { height:15.75pt }
      table.sheet0 tr.row177 { height:15.75pt }
      table.sheet0 tr.row178 { height:15.75pt }
      table.sheet0 tr.row179 { height:15.75pt }
      table.sheet0 tr.row180 { height:15.75pt }
      table.sheet0 tr.row181 { height:15.75pt }
      table.sheet0 tr.row182 { height:15.75pt }
      table.sheet0 tr.row183 { height:15.75pt }
      table.sheet0 tr.row184 { height:15.75pt }
      table.sheet0 tr.row185 { height:15.75pt }
      table.sheet0 tr.row186 { height:15.75pt }
      table.sheet0 tr.row187 { height:15.75pt }
      table.sheet0 tr.row188 { height:15.75pt }
      table.sheet0 tr.row189 { height:15.75pt }
      table.sheet0 tr.row190 { height:15.75pt }
      table.sheet0 tr.row191 { height:15.75pt }
      table.sheet0 tr.row192 { height:15.75pt }
      table.sheet0 tr.row193 { height:15.75pt }
      table.sheet0 tr.row194 { height:15.75pt }
      table.sheet0 tr.row195 { height:15.75pt }
      table.sheet0 tr.row196 { height:15.75pt }
      table.sheet0 tr.row197 { height:15.75pt }
      table.sheet0 tr.row198 { height:15.75pt }
      table.sheet0 tr.row199 { height:15.75pt }
      table.sheet0 tr.row200 { height:15.75pt }
      table.sheet0 tr.row201 { height:15.75pt }
      table.sheet0 tr.row202 { height:15.75pt }
      table.sheet0 tr.row203 { height:15.75pt }
      table.sheet0 tr.row204 { height:15.75pt }
      table.sheet0 tr.row205 { height:15.75pt }
      table.sheet0 tr.row206 { height:15.75pt }
      table.sheet0 tr.row207 { height:15.75pt }
      table.sheet0 tr.row208 { height:15.75pt }
      table.sheet0 tr.row209 { height:15.75pt }
      table.sheet0 tr.row210 { height:15.75pt }
      table.sheet0 tr.row211 { height:15.75pt }
      table.sheet0 tr.row212 { height:15.75pt }
      table.sheet0 tr.row213 { height:15.75pt }
      table.sheet0 tr.row214 { height:15.75pt }
      table.sheet0 tr.row215 { height:15.75pt }
      table.sheet0 tr.row216 { height:15.75pt }
      table.sheet0 tr.row217 { height:15.75pt }
      table.sheet0 tr.row218 { height:15.75pt }
      table.sheet0 tr.row219 { height:15.75pt }
      table.sheet0 tr.row220 { height:15.75pt }
      table.sheet0 tr.row221 { height:15.75pt }
      table.sheet0 tr.row222 { height:15.75pt }
      table.sheet0 tr.row223 { height:15.75pt }
      table.sheet0 tr.row224 { height:15.75pt }
      table.sheet0 tr.row225 { height:15.75pt }
      table.sheet0 tr.row226 { height:15.75pt }
      table.sheet0 tr.row227 { height:15.75pt }
      table.sheet0 tr.row228 { height:15.75pt }
      table.sheet0 tr.row229 { height:15.75pt }
      table.sheet0 tr.row230 { height:15.75pt }
      table.sheet0 tr.row231 { height:15.75pt }
      table.sheet0 tr.row232 { height:15.75pt }
      table.sheet0 tr.row233 { height:15.75pt }
      table.sheet0 tr.row234 { height:15.75pt }
      table.sheet0 tr.row235 { height:15.75pt }
      table.sheet0 tr.row236 { height:15.75pt }
      table.sheet0 tr.row237 { height:15.75pt }
      table.sheet0 tr.row238 { height:15.75pt }
      table.sheet0 tr.row239 { height:15.75pt }
      table.sheet0 tr.row240 { height:15.75pt }
      table.sheet0 tr.row241 { height:15.75pt }
      table.sheet0 tr.row242 { height:15.75pt }
      table.sheet0 tr.row243 { height:15.75pt }
      table.sheet0 tr.row244 { height:15.75pt }
      table.sheet0 tr.row245 { height:15.75pt }
      table.sheet0 tr.row246 { height:15.75pt }
      table.sheet0 tr.row247 { height:15.75pt }
      table.sheet0 tr.row248 { height:15.75pt }
      table.sheet0 tr.row249 { height:15.75pt }
      table.sheet0 tr.row250 { height:15.75pt }
      table.sheet0 tr.row251 { height:15.75pt }
      table.sheet0 tr.row252 { height:15.75pt }
      table.sheet0 tr.row253 { height:15.75pt }
      table.sheet0 tr.row254 { height:15.75pt }
      table.sheet0 tr.row255 { height:15.75pt }
      table.sheet0 tr.row256 { height:15.75pt }
      table.sheet0 tr.row257 { height:15.75pt }
      table.sheet0 tr.row258 { height:15.75pt }
      table.sheet0 tr.row259 { height:15.75pt }
      table.sheet0 tr.row260 { height:15.75pt }
      table.sheet0 tr.row261 { height:15.75pt }
      table.sheet0 tr.row262 { height:15.75pt }
      table.sheet0 tr.row263 { height:15.75pt }
      table.sheet0 tr.row264 { height:15.75pt }
      table.sheet0 tr.row265 { height:15.75pt }
      table.sheet0 tr.row266 { height:15.75pt }
      table.sheet0 tr.row267 { height:15.75pt }
      table.sheet0 tr.row268 { height:15.75pt }
      table.sheet0 tr.row269 { height:15.75pt }
      table.sheet0 tr.row270 { height:15.75pt }
      table.sheet0 tr.row271 { height:15.75pt }
      table.sheet0 tr.row272 { height:15.75pt }
      table.sheet0 tr.row273 { height:15.75pt }
      table.sheet0 tr.row274 { height:15.75pt }
      table.sheet0 tr.row275 { height:15.75pt }
      table.sheet0 tr.row276 { height:15.75pt }
      table.sheet0 tr.row277 { height:15.75pt }
      table.sheet0 tr.row278 { height:15.75pt }
      table.sheet0 tr.row279 { height:15.75pt }
      table.sheet0 tr.row280 { height:15.75pt }
      table.sheet0 tr.row281 { height:15.75pt }
      table.sheet0 tr.row282 { height:15.75pt }
      table.sheet0 tr.row283 { height:15.75pt }
      table.sheet0 tr.row284 { height:15.75pt }
      table.sheet0 tr.row285 { height:15.75pt }
      table.sheet0 tr.row286 { height:15.75pt }
      table.sheet0 tr.row287 { height:15.75pt }
      table.sheet0 tr.row288 { height:15.75pt }
      table.sheet0 tr.row289 { height:15.75pt }
      table.sheet0 tr.row290 { height:15.75pt }
      table.sheet0 tr.row291 { height:15.75pt }
      table.sheet0 tr.row292 { height:15.75pt }
      table.sheet0 tr.row293 { height:15.75pt }
      table.sheet0 tr.row294 { height:15.75pt }
      table.sheet0 tr.row295 { height:15.75pt }
      table.sheet0 tr.row296 { height:15.75pt }
      table.sheet0 tr.row297 { height:15.75pt }
      table.sheet0 tr.row298 { height:15.75pt }
      table.sheet0 tr.row299 { height:15.75pt }
      table.sheet0 tr.row300 { height:15.75pt }
      table.sheet0 tr.row301 { height:15.75pt }
      table.sheet0 tr.row302 { height:15.75pt }
      table.sheet0 tr.row303 { height:15.75pt }
      table.sheet0 tr.row304 { height:15.75pt }
      table.sheet0 tr.row305 { height:15.75pt }
      table.sheet0 tr.row306 { height:15.75pt }
      table.sheet0 tr.row307 { height:15.75pt }
      table.sheet0 tr.row308 { height:15.75pt }
      table.sheet0 tr.row309 { height:15.75pt }
      table.sheet0 tr.row310 { height:15.75pt }
      table.sheet0 tr.row311 { height:15.75pt }
      table.sheet0 tr.row312 { height:15.75pt }
      table.sheet0 tr.row313 { height:15.75pt }
      table.sheet0 tr.row314 { height:15.75pt }
      table.sheet0 tr.row315 { height:15.75pt }
      table.sheet0 tr.row316 { height:15.75pt }
      table.sheet0 tr.row317 { height:15.75pt }
      table.sheet0 tr.row318 { height:15.75pt }
      table.sheet0 tr.row319 { height:15.75pt }
      table.sheet0 tr.row320 { height:15.75pt }
      table.sheet0 tr.row321 { height:15.75pt }
      table.sheet0 tr.row322 { height:15.75pt }
      table.sheet0 tr.row323 { height:15.75pt }
      table.sheet0 tr.row324 { height:15.75pt }
      table.sheet0 tr.row325 { height:15.75pt }
      table.sheet0 tr.row326 { height:15.75pt }
      table.sheet0 tr.row327 { height:15.75pt }
      table.sheet0 tr.row328 { height:15.75pt }
      table.sheet0 tr.row329 { height:15.75pt }
      table.sheet0 tr.row330 { height:15.75pt }
      table.sheet0 tr.row331 { height:15.75pt }
      table.sheet0 tr.row332 { height:15.75pt }
      table.sheet0 tr.row333 { height:15.75pt }
      table.sheet0 tr.row334 { height:15.75pt }
      table.sheet0 tr.row335 { height:15.75pt }
      table.sheet0 tr.row336 { height:15.75pt }
      table.sheet0 tr.row337 { height:15.75pt }
      table.sheet0 tr.row338 { height:15.75pt }
      table.sheet0 tr.row339 { height:15.75pt }
      table.sheet0 tr.row340 { height:15.75pt }
      table.sheet0 tr.row341 { height:15.75pt }
      table.sheet0 tr.row342 { height:15.75pt }
      table.sheet0 tr.row343 { height:15.75pt }
      table.sheet0 tr.row344 { height:15.75pt }
      table.sheet0 tr.row345 { height:15.75pt }
      table.sheet0 tr.row346 { height:15.75pt }
      table.sheet0 tr.row347 { height:15.75pt }
      table.sheet0 tr.row348 { height:15.75pt }
      table.sheet0 tr.row349 { height:15.75pt }
      table.sheet0 tr.row350 { height:15.75pt }
      table.sheet0 tr.row351 { height:15.75pt }
      table.sheet0 tr.row352 { height:15.75pt }
      table.sheet0 tr.row353 { height:15.75pt }
      table.sheet0 tr.row354 { height:15.75pt }
      table.sheet0 tr.row355 { height:15.75pt }
      table.sheet0 tr.row356 { height:15.75pt }
      table.sheet0 tr.row357 { height:15.75pt }
      table.sheet0 tr.row358 { height:15.75pt }
      table.sheet0 tr.row359 { height:15.75pt }
      table.sheet0 tr.row360 { height:15.75pt }
      table.sheet0 tr.row361 { height:15.75pt }
      table.sheet0 tr.row362 { height:15.75pt }
      table.sheet0 tr.row363 { height:15.75pt }
      table.sheet0 tr.row364 { height:15.75pt }
      table.sheet0 tr.row365 { height:15.75pt }
      table.sheet0 tr.row366 { height:15.75pt }
      table.sheet0 tr.row367 { height:15.75pt }
      table.sheet0 tr.row368 { height:15.75pt }
      table.sheet0 tr.row369 { height:15.75pt }
      table.sheet0 tr.row370 { height:15.75pt }
      table.sheet0 tr.row371 { height:15.75pt }
      table.sheet0 tr.row372 { height:15.75pt }
      table.sheet0 tr.row373 { height:15.75pt }
      table.sheet0 tr.row374 { height:15.75pt }
      table.sheet0 tr.row375 { height:15.75pt }
      table.sheet0 tr.row376 { height:15.75pt }
      table.sheet0 tr.row377 { height:15.75pt }
      table.sheet0 tr.row378 { height:15.75pt }
      table.sheet0 tr.row379 { height:15.75pt }
      table.sheet0 tr.row380 { height:15.75pt }
      table.sheet0 tr.row381 { height:15.75pt }
      table.sheet0 tr.row382 { height:15.75pt }
      table.sheet0 tr.row383 { height:15.75pt }
      table.sheet0 tr.row384 { height:15.75pt }
      table.sheet0 tr.row385 { height:15.75pt }
      table.sheet0 tr.row386 { height:15.75pt }
      table.sheet0 tr.row387 { height:15.75pt }
      table.sheet0 tr.row388 { height:15.75pt }
      table.sheet0 tr.row389 { height:15.75pt }
      table.sheet0 tr.row390 { height:15.75pt }
      table.sheet0 tr.row391 { height:15.75pt }
      table.sheet0 tr.row392 { height:15.75pt }
      table.sheet0 tr.row393 { height:15.75pt }
      table.sheet0 tr.row394 { height:15.75pt }
      table.sheet0 tr.row395 { height:15.75pt }
      table.sheet0 tr.row396 { height:15.75pt }
      table.sheet0 tr.row397 { height:15.75pt }
      table.sheet0 tr.row398 { height:15.75pt }
      table.sheet0 tr.row399 { height:15.75pt }
      table.sheet0 tr.row400 { height:15.75pt }
      table.sheet0 tr.row401 { height:15.75pt }
      table.sheet0 tr.row402 { height:15.75pt }
      table.sheet0 tr.row403 { height:15.75pt }
      table.sheet0 tr.row404 { height:15.75pt }
      table.sheet0 tr.row405 { height:15.75pt }
      table.sheet0 tr.row406 { height:15.75pt }
      table.sheet0 tr.row407 { height:15.75pt }
      table.sheet0 tr.row408 { height:15.75pt }
      table.sheet0 tr.row409 { height:15.75pt }
      table.sheet0 tr.row410 { height:15.75pt }
      table.sheet0 tr.row411 { height:15.75pt }
      table.sheet0 tr.row412 { height:15.75pt }
      table.sheet0 tr.row413 { height:15.75pt }
      table.sheet0 tr.row414 { height:15.75pt }
      table.sheet0 tr.row415 { height:15.75pt }
      table.sheet0 tr.row416 { height:15.75pt }
      table.sheet0 tr.row417 { height:15.75pt }
      table.sheet0 tr.row418 { height:15.75pt }
      table.sheet0 tr.row419 { height:15.75pt }
      table.sheet0 tr.row420 { height:15.75pt }
      table.sheet0 tr.row421 { height:15.75pt }
      table.sheet0 tr.row422 { height:15.75pt }
      table.sheet0 tr.row423 { height:15.75pt }
      table.sheet0 tr.row424 { height:15.75pt }
      table.sheet0 tr.row425 { height:15.75pt }
      table.sheet0 tr.row426 { height:15.75pt }
      table.sheet0 tr.row427 { height:15.75pt }
      table.sheet0 tr.row428 { height:15.75pt }
      table.sheet0 tr.row429 { height:15.75pt }
      table.sheet0 tr.row430 { height:15.75pt }
      table.sheet0 tr.row431 { height:15.75pt }
      table.sheet0 tr.row432 { height:15.75pt }
      table.sheet0 tr.row433 { height:15.75pt }
      table.sheet0 tr.row434 { height:15.75pt }
      table.sheet0 tr.row435 { height:15.75pt }
      table.sheet0 tr.row436 { height:15.75pt }
      table.sheet0 tr.row437 { height:15.75pt }
      table.sheet0 tr.row438 { height:15.75pt }
      table.sheet0 tr.row439 { height:15.75pt }
      table.sheet0 tr.row440 { height:15.75pt }
      table.sheet0 tr.row441 { height:15.75pt }
      table.sheet0 tr.row442 { height:15.75pt }
      table.sheet0 tr.row443 { height:15.75pt }
      table.sheet0 tr.row444 { height:15.75pt }
      table.sheet0 tr.row445 { height:15.75pt }
      table.sheet0 tr.row446 { height:15.75pt }
      table.sheet0 tr.row447 { height:15.75pt }
      table.sheet0 tr.row448 { height:15.75pt }
      table.sheet0 tr.row449 { height:15.75pt }
      table.sheet0 tr.row450 { height:15.75pt }
      table.sheet0 tr.row451 { height:15.75pt }
      table.sheet0 tr.row452 { height:15.75pt }
      table.sheet0 tr.row453 { height:15.75pt }
      table.sheet0 tr.row454 { height:15.75pt }
      table.sheet0 tr.row455 { height:15.75pt }
      table.sheet0 tr.row456 { height:15.75pt }
      table.sheet0 tr.row457 { height:15.75pt }
      table.sheet0 tr.row458 { height:15.75pt }
      table.sheet0 tr.row459 { height:15.75pt }
      table.sheet0 tr.row460 { height:15.75pt }
      table.sheet0 tr.row461 { height:15.75pt }
      table.sheet0 tr.row462 { height:15.75pt }
      table.sheet0 tr.row463 { height:15.75pt }
      table.sheet0 tr.row464 { height:15.75pt }
      table.sheet0 tr.row465 { height:15.75pt }
      table.sheet0 tr.row466 { height:15.75pt }
      table.sheet0 tr.row467 { height:15.75pt }
      table.sheet0 tr.row468 { height:15.75pt }
      table.sheet0 tr.row469 { height:15.75pt }
      table.sheet0 tr.row470 { height:15.75pt }
      table.sheet0 tr.row471 { height:15.75pt }
      table.sheet0 tr.row472 { height:15.75pt }
      table.sheet0 tr.row473 { height:15.75pt }
      table.sheet0 tr.row474 { height:15.75pt }
      table.sheet0 tr.row475 { height:15.75pt }
      table.sheet0 tr.row476 { height:15.75pt }
      table.sheet0 tr.row477 { height:15.75pt }
      table.sheet0 tr.row478 { height:15.75pt }
      table.sheet0 tr.row479 { height:15.75pt }
      table.sheet0 tr.row480 { height:15.75pt }
      table.sheet0 tr.row481 { height:15.75pt }
      table.sheet0 tr.row482 { height:15.75pt }
      table.sheet0 tr.row483 { height:15.75pt }
      table.sheet0 tr.row484 { height:15.75pt }
      table.sheet0 tr.row485 { height:15.75pt }
      table.sheet0 tr.row486 { height:15.75pt }
      table.sheet0 tr.row487 { height:15.75pt }
      table.sheet0 tr.row488 { height:15.75pt }
      table.sheet0 tr.row489 { height:15.75pt }
      table.sheet0 tr.row490 { height:15.75pt }
      table.sheet0 tr.row491 { height:15.75pt }
      table.sheet0 tr.row492 { height:15.75pt }
      table.sheet0 tr.row493 { height:15.75pt }
      table.sheet0 tr.row494 { height:15.75pt }
      table.sheet0 tr.row495 { height:15.75pt }
      table.sheet0 tr.row496 { height:15.75pt }
      table.sheet0 tr.row497 { height:15.75pt }
      table.sheet0 tr.row498 { height:15.75pt }
      table.sheet0 tr.row499 { height:15.75pt }
      table.sheet0 tr.row500 { height:15.75pt }
      table.sheet0 tr.row501 { height:15.75pt }
      table.sheet0 tr.row502 { height:15.75pt }
      table.sheet0 tr.row503 { height:15.75pt }
      table.sheet0 tr.row504 { height:15.75pt }
      table.sheet0 tr.row505 { height:15.75pt }
      table.sheet0 tr.row506 { height:15.75pt }
      table.sheet0 tr.row507 { height:15.75pt }
      table.sheet0 tr.row508 { height:15.75pt }
      table.sheet0 tr.row509 { height:15.75pt }
      table.sheet0 tr.row510 { height:15.75pt }
      table.sheet0 tr.row511 { height:15.75pt }
      table.sheet0 tr.row512 { height:15.75pt }
      table.sheet0 tr.row513 { height:15.75pt }
      table.sheet0 tr.row514 { height:15.75pt }
      table.sheet0 tr.row515 { height:15.75pt }
      table.sheet0 tr.row516 { height:15.75pt }
      table.sheet0 tr.row517 { height:15.75pt }
      table.sheet0 tr.row518 { height:15.75pt }
      table.sheet0 tr.row519 { height:15.75pt }
      table.sheet0 tr.row520 { height:15.75pt }
      table.sheet0 tr.row521 { height:15.75pt }
      table.sheet0 tr.row522 { height:15.75pt }
      table.sheet0 tr.row523 { height:15.75pt }
      table.sheet0 tr.row524 { height:15.75pt }
      table.sheet0 tr.row525 { height:15.75pt }
      table.sheet0 tr.row526 { height:15.75pt }
      table.sheet0 tr.row527 { height:15.75pt }
      table.sheet0 tr.row528 { height:15.75pt }
      table.sheet0 tr.row529 { height:15.75pt }
      table.sheet0 tr.row530 { height:15.75pt }
      table.sheet0 tr.row531 { height:15.75pt }
      table.sheet0 tr.row532 { height:15.75pt }
      table.sheet0 tr.row533 { height:15.75pt }
      table.sheet0 tr.row534 { height:15.75pt }
      table.sheet0 tr.row535 { height:15.75pt }
      table.sheet0 tr.row536 { height:15.75pt }
      table.sheet0 tr.row537 { height:15.75pt }
      table.sheet0 tr.row538 { height:15.75pt }
      table.sheet0 tr.row539 { height:15.75pt }
      table.sheet0 tr.row540 { height:15.75pt }
      table.sheet0 tr.row541 { height:15.75pt }
      table.sheet0 tr.row542 { height:15.75pt }
      table.sheet0 tr.row543 { height:15.75pt }
      table.sheet0 tr.row544 { height:15.75pt }
      table.sheet0 tr.row545 { height:15.75pt }
      table.sheet0 tr.row546 { height:15.75pt }
      table.sheet0 tr.row547 { height:15.75pt }
      table.sheet0 tr.row548 { height:15.75pt }
      table.sheet0 tr.row549 { height:15.75pt }
      table.sheet0 tr.row550 { height:15.75pt }
      table.sheet0 tr.row551 { height:15.75pt }
      table.sheet0 tr.row552 { height:15.75pt }
      table.sheet0 tr.row553 { height:15.75pt }
      table.sheet0 tr.row554 { height:15.75pt }
      table.sheet0 tr.row555 { height:15.75pt }
      table.sheet0 tr.row556 { height:15.75pt }
      table.sheet0 tr.row557 { height:15.75pt }
      table.sheet0 tr.row558 { height:15.75pt }
      table.sheet0 tr.row559 { height:15.75pt }
      table.sheet0 tr.row560 { height:15.75pt }
      table.sheet0 tr.row561 { height:15.75pt }
      table.sheet0 tr.row562 { height:15.75pt }
      table.sheet0 tr.row563 { height:15.75pt }
      table.sheet0 tr.row564 { height:15.75pt }
      table.sheet0 tr.row565 { height:15.75pt }
      table.sheet0 tr.row566 { height:15.75pt }
      table.sheet0 tr.row567 { height:15.75pt }
      table.sheet0 tr.row568 { height:15.75pt }
      table.sheet0 tr.row569 { height:15.75pt }
      table.sheet0 tr.row570 { height:15.75pt }
      table.sheet0 tr.row571 { height:15.75pt }
      table.sheet0 tr.row572 { height:15.75pt }
      table.sheet0 tr.row573 { height:15.75pt }
      table.sheet0 tr.row574 { height:15.75pt }
      table.sheet0 tr.row575 { height:15.75pt }
      table.sheet0 tr.row576 { height:15.75pt }
      table.sheet0 tr.row577 { height:15.75pt }
      table.sheet0 tr.row578 { height:15.75pt }
      table.sheet0 tr.row579 { height:15.75pt }
      table.sheet0 tr.row580 { height:15.75pt }
      table.sheet0 tr.row581 { height:15.75pt }
      table.sheet0 tr.row582 { height:15.75pt }
      table.sheet0 tr.row583 { height:15.75pt }
      table.sheet0 tr.row584 { height:15.75pt }
      table.sheet0 tr.row585 { height:15.75pt }
      table.sheet0 tr.row586 { height:15.75pt }
      table.sheet0 tr.row587 { height:15.75pt }
      table.sheet0 tr.row588 { height:15.75pt }
      table.sheet0 tr.row589 { height:15.75pt }
      table.sheet0 tr.row590 { height:15.75pt }
      table.sheet0 tr.row591 { height:15.75pt }
      table.sheet0 tr.row592 { height:15.75pt }
      table.sheet0 tr.row593 { height:15.75pt }
      table.sheet0 tr.row594 { height:15.75pt }
      table.sheet0 tr.row595 { height:15.75pt }
      table.sheet0 tr.row596 { height:15.75pt }
      table.sheet0 tr.row597 { height:15.75pt }
      table.sheet0 tr.row598 { height:15.75pt }
      table.sheet0 tr.row599 { height:15.75pt }
      table.sheet0 tr.row600 { height:15.75pt }
      table.sheet0 tr.row601 { height:15.75pt }
      table.sheet0 tr.row602 { height:15.75pt }
      table.sheet0 tr.row603 { height:15.75pt }
      table.sheet0 tr.row604 { height:15.75pt }
      table.sheet0 tr.row605 { height:15.75pt }
      table.sheet0 tr.row606 { height:15.75pt }
      table.sheet0 tr.row607 { height:15.75pt }
      table.sheet0 tr.row608 { height:15.75pt }
      table.sheet0 tr.row609 { height:15.75pt }
      table.sheet0 tr.row610 { height:15.75pt }
      table.sheet0 tr.row611 { height:15.75pt }
      table.sheet0 tr.row612 { height:15.75pt }
      table.sheet0 tr.row613 { height:15.75pt }
      table.sheet0 tr.row614 { height:15.75pt }
      table.sheet0 tr.row615 { height:15.75pt }
      table.sheet0 tr.row616 { height:15.75pt }
      table.sheet0 tr.row617 { height:15.75pt }
      table.sheet0 tr.row618 { height:15.75pt }
      table.sheet0 tr.row619 { height:15.75pt }
      table.sheet0 tr.row620 { height:15.75pt }
      table.sheet0 tr.row621 { height:15.75pt }
      table.sheet0 tr.row622 { height:15.75pt }
      table.sheet0 tr.row623 { height:15.75pt }
      table.sheet0 tr.row624 { height:15.75pt }
      table.sheet0 tr.row625 { height:15.75pt }
      table.sheet0 tr.row626 { height:15.75pt }
      table.sheet0 tr.row627 { height:15.75pt }
      table.sheet0 tr.row628 { height:15.75pt }
      table.sheet0 tr.row629 { height:15.75pt }
      table.sheet0 tr.row630 { height:15.75pt }
      table.sheet0 tr.row631 { height:15.75pt }
      table.sheet0 tr.row632 { height:15.75pt }
      table.sheet0 tr.row633 { height:15.75pt }
      table.sheet0 tr.row634 { height:15.75pt }
      table.sheet0 tr.row635 { height:15.75pt }
      table.sheet0 tr.row636 { height:15.75pt }
      table.sheet0 tr.row637 { height:15.75pt }
      table.sheet0 tr.row638 { height:15.75pt }
      table.sheet0 tr.row639 { height:15.75pt }
      table.sheet0 tr.row640 { height:15.75pt }
      table.sheet0 tr.row641 { height:15.75pt }
      table.sheet0 tr.row642 { height:15.75pt }
      table.sheet0 tr.row643 { height:15.75pt }
      table.sheet0 tr.row644 { height:15.75pt }
      table.sheet0 tr.row645 { height:15.75pt }
      table.sheet0 tr.row646 { height:15.75pt }
      table.sheet0 tr.row647 { height:15.75pt }
      table.sheet0 tr.row648 { height:15.75pt }
      table.sheet0 tr.row649 { height:15.75pt }
      table.sheet0 tr.row650 { height:15.75pt }
      table.sheet0 tr.row651 { height:15.75pt }
      table.sheet0 tr.row652 { height:15.75pt }
      table.sheet0 tr.row653 { height:15.75pt }
      table.sheet0 tr.row654 { height:15.75pt }
      table.sheet0 tr.row655 { height:15.75pt }
      table.sheet0 tr.row656 { height:15.75pt }
      table.sheet0 tr.row657 { height:15.75pt }
      table.sheet0 tr.row658 { height:15.75pt }
      table.sheet0 tr.row659 { height:15.75pt }
      table.sheet0 tr.row660 { height:15.75pt }
      table.sheet0 tr.row661 { height:15.75pt }
      table.sheet0 tr.row662 { height:15.75pt }
      table.sheet0 tr.row663 { height:15.75pt }
      table.sheet0 tr.row664 { height:15.75pt }
      table.sheet0 tr.row665 { height:15.75pt }
      table.sheet0 tr.row666 { height:15.75pt }
      table.sheet0 tr.row667 { height:15.75pt }
      table.sheet0 tr.row668 { height:15.75pt }
      table.sheet0 tr.row669 { height:15.75pt }
      table.sheet0 tr.row670 { height:15.75pt }
      table.sheet0 tr.row671 { height:15.75pt }
      table.sheet0 tr.row672 { height:15.75pt }
      table.sheet0 tr.row673 { height:15.75pt }
      table.sheet0 tr.row674 { height:15.75pt }
      table.sheet0 tr.row675 { height:15.75pt }
      table.sheet0 tr.row676 { height:15.75pt }
      table.sheet0 tr.row677 { height:15.75pt }
      table.sheet0 tr.row678 { height:15.75pt }
      table.sheet0 tr.row679 { height:15.75pt }
      table.sheet0 tr.row680 { height:15.75pt }
      table.sheet0 tr.row681 { height:15.75pt }
      table.sheet0 tr.row682 { height:15.75pt }
      table.sheet0 tr.row683 { height:15.75pt }
      table.sheet0 tr.row684 { height:15.75pt }
      table.sheet0 tr.row685 { height:15.75pt }
      table.sheet0 tr.row686 { height:15.75pt }
      table.sheet0 tr.row687 { height:15.75pt }
      table.sheet0 tr.row688 { height:15.75pt }
      table.sheet0 tr.row689 { height:15.75pt }
      table.sheet0 tr.row690 { height:15.75pt }
      table.sheet0 tr.row691 { height:15.75pt }
      table.sheet0 tr.row692 { height:15.75pt }
      table.sheet0 tr.row693 { height:15.75pt }
      table.sheet0 tr.row694 { height:15.75pt }
      table.sheet0 tr.row695 { height:15.75pt }
      table.sheet0 tr.row696 { height:15.75pt }
      table.sheet0 tr.row697 { height:15.75pt }
      table.sheet0 tr.row698 { height:15.75pt }
      table.sheet0 tr.row699 { height:15.75pt }
      table.sheet0 tr.row700 { height:15.75pt }
      table.sheet0 tr.row701 { height:15.75pt }
      table.sheet0 tr.row702 { height:15.75pt }
      table.sheet0 tr.row703 { height:15.75pt }
      table.sheet0 tr.row704 { height:15.75pt }
      table.sheet0 tr.row705 { height:15.75pt }
      table.sheet0 tr.row706 { height:15.75pt }
      table.sheet0 tr.row707 { height:15.75pt }
      table.sheet0 tr.row708 { height:15.75pt }
      table.sheet0 tr.row709 { height:15.75pt }
      table.sheet0 tr.row710 { height:15.75pt }
      table.sheet0 tr.row711 { height:15.75pt }
      table.sheet0 tr.row712 { height:15.75pt }
      table.sheet0 tr.row713 { height:15.75pt }
      table.sheet0 tr.row714 { height:15.75pt }
      table.sheet0 tr.row715 { height:15.75pt }
      table.sheet0 tr.row716 { height:15.75pt }
      table.sheet0 tr.row717 { height:15.75pt }
      table.sheet0 tr.row718 { height:15.75pt }
      table.sheet0 tr.row719 { height:15.75pt }
      table.sheet0 tr.row720 { height:15.75pt }
      table.sheet0 tr.row721 { height:15.75pt }
      table.sheet0 tr.row722 { height:15.75pt }
      table.sheet0 tr.row723 { height:15.75pt }
      table.sheet0 tr.row724 { height:15.75pt }
      table.sheet0 tr.row725 { height:15.75pt }
      table.sheet0 tr.row726 { height:15.75pt }
      table.sheet0 tr.row727 { height:15.75pt }
      table.sheet0 tr.row728 { height:15.75pt }
      table.sheet0 tr.row729 { height:15.75pt }
      table.sheet0 tr.row730 { height:15.75pt }
      table.sheet0 tr.row731 { height:15.75pt }
      table.sheet0 tr.row732 { height:15.75pt }
      table.sheet0 tr.row733 { height:15.75pt }
      table.sheet0 tr.row734 { height:15.75pt }
      table.sheet0 tr.row735 { height:15.75pt }
      table.sheet0 tr.row736 { height:15.75pt }
      table.sheet0 tr.row737 { height:15.75pt }
      table.sheet0 tr.row738 { height:15.75pt }
      table.sheet0 tr.row739 { height:15.75pt }
      table.sheet0 tr.row740 { height:15.75pt }
      table.sheet0 tr.row741 { height:15.75pt }
      table.sheet0 tr.row742 { height:15.75pt }
      table.sheet0 tr.row743 { height:15.75pt }
      table.sheet0 tr.row744 { height:15.75pt }
      table.sheet0 tr.row745 { height:15.75pt }
      table.sheet0 tr.row746 { height:15.75pt }
      table.sheet0 tr.row747 { height:15.75pt }
      table.sheet0 tr.row748 { height:15.75pt }
      table.sheet0 tr.row749 { height:15.75pt }
      table.sheet0 tr.row750 { height:15.75pt }
      table.sheet0 tr.row751 { height:15.75pt }
      table.sheet0 tr.row752 { height:15.75pt }
      table.sheet0 tr.row753 { height:15.75pt }
      table.sheet0 tr.row754 { height:15.75pt }
      table.sheet0 tr.row755 { height:15.75pt }
      table.sheet0 tr.row756 { height:15.75pt }
      table.sheet0 tr.row757 { height:15.75pt }
      table.sheet0 tr.row758 { height:15.75pt }
      table.sheet0 tr.row759 { height:15.75pt }
      table.sheet0 tr.row760 { height:15.75pt }
      table.sheet0 tr.row761 { height:15.75pt }
      table.sheet0 tr.row762 { height:15.75pt }
      table.sheet0 tr.row763 { height:15.75pt }
      table.sheet0 tr.row764 { height:15.75pt }
      table.sheet0 tr.row765 { height:15.75pt }
      table.sheet0 tr.row766 { height:15.75pt }
      table.sheet0 tr.row767 { height:15.75pt }
      table.sheet0 tr.row768 { height:15.75pt }
      table.sheet0 tr.row769 { height:15.75pt }
      table.sheet0 tr.row770 { height:15.75pt }
      table.sheet0 tr.row771 { height:15.75pt }
      table.sheet0 tr.row772 { height:15.75pt }
      table.sheet0 tr.row773 { height:15.75pt }
      table.sheet0 tr.row774 { height:15.75pt }
      table.sheet0 tr.row775 { height:15.75pt }
      table.sheet0 tr.row776 { height:15.75pt }
      table.sheet0 tr.row777 { height:15.75pt }
      table.sheet0 tr.row778 { height:15.75pt }
      table.sheet0 tr.row779 { height:15.75pt }
      table.sheet0 tr.row780 { height:15.75pt }
      table.sheet0 tr.row781 { height:15.75pt }
      table.sheet0 tr.row782 { height:15.75pt }
      table.sheet0 tr.row783 { height:15.75pt }
      table.sheet0 tr.row784 { height:15.75pt }
      table.sheet0 tr.row785 { height:15.75pt }
      table.sheet0 tr.row786 { height:15.75pt }
      table.sheet0 tr.row787 { height:15.75pt }
      table.sheet0 tr.row788 { height:15.75pt }
      table.sheet0 tr.row789 { height:15.75pt }
      table.sheet0 tr.row790 { height:15.75pt }
      table.sheet0 tr.row791 { height:15.75pt }
      table.sheet0 tr.row792 { height:15.75pt }
      table.sheet0 tr.row793 { height:15.75pt }
      table.sheet0 tr.row794 { height:15.75pt }
      table.sheet0 tr.row795 { height:15.75pt }
      table.sheet0 tr.row796 { height:15.75pt }
      table.sheet0 tr.row797 { height:15.75pt }
      table.sheet0 tr.row798 { height:15.75pt }
      table.sheet0 tr.row799 { height:15.75pt }
      table.sheet0 tr.row800 { height:15.75pt }
      table.sheet0 tr.row801 { height:15.75pt }
      table.sheet0 tr.row802 { height:15.75pt }
      table.sheet0 tr.row803 { height:15.75pt }
      table.sheet0 tr.row804 { height:15.75pt }
      table.sheet0 tr.row805 { height:15.75pt }
      table.sheet0 tr.row806 { height:15.75pt }
      table.sheet0 tr.row807 { height:15.75pt }
      table.sheet0 tr.row808 { height:15.75pt }
      table.sheet0 tr.row809 { height:15.75pt }
      table.sheet0 tr.row810 { height:15.75pt }
      table.sheet0 tr.row811 { height:15.75pt }
      table.sheet0 tr.row812 { height:15.75pt }
      table.sheet0 tr.row813 { height:15.75pt }
      table.sheet0 tr.row814 { height:15.75pt }
      table.sheet0 tr.row815 { height:15.75pt }
      table.sheet0 tr.row816 { height:15.75pt }
      table.sheet0 tr.row817 { height:15.75pt }
      table.sheet0 tr.row818 { height:15.75pt }
      table.sheet0 tr.row819 { height:15.75pt }
      table.sheet0 tr.row820 { height:15.75pt }
      table.sheet0 tr.row821 { height:15.75pt }
      table.sheet0 tr.row822 { height:15.75pt }
      table.sheet0 tr.row823 { height:15.75pt }
      table.sheet0 tr.row824 { height:15.75pt }
      table.sheet0 tr.row825 { height:15.75pt }
      table.sheet0 tr.row826 { height:15.75pt }
      table.sheet0 tr.row827 { height:15.75pt }
      table.sheet0 tr.row828 { height:15.75pt }
      table.sheet0 tr.row829 { height:15.75pt }
      table.sheet0 tr.row830 { height:15.75pt }
      table.sheet0 tr.row831 { height:15.75pt }
      table.sheet0 tr.row832 { height:15.75pt }
      table.sheet0 tr.row833 { height:15.75pt }
      table.sheet0 tr.row834 { height:15.75pt }
      table.sheet0 tr.row835 { height:15.75pt }
      table.sheet0 tr.row836 { height:15.75pt }
      table.sheet0 tr.row837 { height:15.75pt }
      table.sheet0 tr.row838 { height:15.75pt }
      table.sheet0 tr.row839 { height:15.75pt }
      table.sheet0 tr.row840 { height:15.75pt }
      table.sheet0 tr.row841 { height:15.75pt }
      table.sheet0 tr.row842 { height:15.75pt }
      table.sheet0 tr.row843 { height:15.75pt }
      table.sheet0 tr.row844 { height:15.75pt }
      table.sheet0 tr.row845 { height:15.75pt }
      table.sheet0 tr.row846 { height:15.75pt }
      table.sheet0 tr.row847 { height:15.75pt }
      table.sheet0 tr.row848 { height:15.75pt }
      table.sheet0 tr.row849 { height:15.75pt }
      table.sheet0 tr.row850 { height:15.75pt }
      table.sheet0 tr.row851 { height:15.75pt }
      table.sheet0 tr.row852 { height:15.75pt }
      table.sheet0 tr.row853 { height:15.75pt }
      table.sheet0 tr.row854 { height:15.75pt }
      table.sheet0 tr.row855 { height:15.75pt }
      table.sheet0 tr.row856 { height:15.75pt }
      table.sheet0 tr.row857 { height:15.75pt }
      table.sheet0 tr.row858 { height:15.75pt }
      table.sheet0 tr.row859 { height:15.75pt }
      table.sheet0 tr.row860 { height:15.75pt }
      table.sheet0 tr.row861 { height:15.75pt }
      table.sheet0 tr.row862 { height:15.75pt }
      table.sheet0 tr.row863 { height:15.75pt }
      table.sheet0 tr.row864 { height:15.75pt }
      table.sheet0 tr.row865 { height:15.75pt }
      table.sheet0 tr.row866 { height:15.75pt }
      table.sheet0 tr.row867 { height:15.75pt }
      table.sheet0 tr.row868 { height:15.75pt }
      table.sheet0 tr.row869 { height:15.75pt }
      table.sheet0 tr.row870 { height:15.75pt }
      table.sheet0 tr.row871 { height:15.75pt }
      table.sheet0 tr.row872 { height:15.75pt }
      table.sheet0 tr.row873 { height:15.75pt }
      table.sheet0 tr.row874 { height:15.75pt }
      table.sheet0 tr.row875 { height:15.75pt }
      table.sheet0 tr.row876 { height:15.75pt }
      table.sheet0 tr.row877 { height:15.75pt }
      table.sheet0 tr.row878 { height:15.75pt }
      table.sheet0 tr.row879 { height:15.75pt }
      table.sheet0 tr.row880 { height:15.75pt }
      table.sheet0 tr.row881 { height:15.75pt }
      table.sheet0 tr.row882 { height:15.75pt }
      table.sheet0 tr.row883 { height:15.75pt }
      table.sheet0 tr.row884 { height:15.75pt }
      table.sheet0 tr.row885 { height:15.75pt }
      table.sheet0 tr.row886 { height:15.75pt }
      table.sheet0 tr.row887 { height:15.75pt }
      table.sheet0 tr.row888 { height:15.75pt }
      table.sheet0 tr.row889 { height:15.75pt }
      table.sheet0 tr.row890 { height:15.75pt }
      table.sheet0 tr.row891 { height:15.75pt }
      table.sheet0 tr.row892 { height:15.75pt }
      table.sheet0 tr.row893 { height:15.75pt }
      table.sheet0 tr.row894 { height:15.75pt }
      table.sheet0 tr.row895 { height:15.75pt }
      table.sheet0 tr.row896 { height:15.75pt }
      table.sheet0 tr.row897 { height:15.75pt }
      table.sheet0 tr.row898 { height:15.75pt }
      table.sheet0 tr.row899 { height:15.75pt }
      table.sheet0 tr.row900 { height:15.75pt }
      table.sheet0 tr.row901 { height:15.75pt }
      table.sheet0 tr.row902 { height:15.75pt }
      table.sheet0 tr.row903 { height:15.75pt }
      table.sheet0 tr.row904 { height:15.75pt }
      table.sheet0 tr.row905 { height:15.75pt }
      table.sheet0 tr.row906 { height:15.75pt }
      table.sheet0 tr.row907 { height:15.75pt }
      table.sheet0 tr.row908 { height:15.75pt }
      table.sheet0 tr.row909 { height:15.75pt }
      table.sheet0 tr.row910 { height:15.75pt }
      table.sheet0 tr.row911 { height:15.75pt }
      table.sheet0 tr.row912 { height:15.75pt }
      table.sheet0 tr.row913 { height:15.75pt }
      table.sheet0 tr.row914 { height:15.75pt }
      table.sheet0 tr.row915 { height:15.75pt }
      table.sheet0 tr.row916 { height:15.75pt }
      table.sheet0 tr.row917 { height:15.75pt }
      table.sheet0 tr.row918 { height:15.75pt }
      table.sheet0 tr.row919 { height:15.75pt }
      table.sheet0 tr.row920 { height:15.75pt }
      table.sheet0 tr.row921 { height:15.75pt }
      table.sheet0 tr.row922 { height:15.75pt }
      table.sheet0 tr.row923 { height:15.75pt }
      table.sheet0 tr.row924 { height:15.75pt }
      table.sheet0 tr.row925 { height:15.75pt }
      table.sheet0 tr.row926 { height:15.75pt }
      table.sheet0 tr.row927 { height:15.75pt }
      table.sheet0 tr.row928 { height:15.75pt }
      table.sheet0 tr.row929 { height:15.75pt }
      table.sheet0 tr.row930 { height:15.75pt }
      table.sheet0 tr.row931 { height:15.75pt }
      table.sheet0 tr.row932 { height:15.75pt }
      table.sheet0 tr.row933 { height:15.75pt }
      table.sheet0 tr.row934 { height:15.75pt }
      table.sheet0 tr.row935 { height:15.75pt }
      table.sheet0 tr.row936 { height:15.75pt }
      table.sheet0 tr.row937 { height:15.75pt }
      table.sheet0 tr.row938 { height:15.75pt }
      table.sheet0 tr.row939 { height:15.75pt }
      table.sheet0 tr.row940 { height:15.75pt }
      table.sheet0 tr.row941 { height:15.75pt }
      table.sheet0 tr.row942 { height:15.75pt }
      table.sheet0 tr.row943 { height:15.75pt }
      table.sheet0 tr.row944 { height:15.75pt }
      table.sheet0 tr.row945 { height:15.75pt }
      table.sheet0 tr.row946 { height:15.75pt }
      table.sheet0 tr.row947 { height:15.75pt }
      table.sheet0 tr.row948 { height:15.75pt }
      table.sheet0 tr.row949 { height:15.75pt }
      table.sheet0 tr.row950 { height:15.75pt }
      table.sheet0 tr.row951 { height:15.75pt }
      table.sheet0 tr.row952 { height:15.75pt }
      table.sheet0 tr.row953 { height:15.75pt }
      table.sheet0 tr.row954 { height:15.75pt }
      table.sheet0 tr.row955 { height:15.75pt }
      table.sheet0 tr.row956 { height:15.75pt }
      table.sheet0 tr.row957 { height:15.75pt }
      table.sheet0 tr.row958 { height:15.75pt }
      table.sheet0 tr.row959 { height:15.75pt }
      table.sheet0 tr.row960 { height:15.75pt }
      table.sheet0 tr.row961 { height:15.75pt }
      table.sheet0 tr.row962 { height:15.75pt }
      table.sheet0 tr.row963 { height:15.75pt }
      table.sheet0 tr.row964 { height:15.75pt }
      table.sheet0 tr.row965 { height:15.75pt }
      table.sheet0 tr.row966 { height:15.75pt }
      table.sheet0 tr.row967 { height:15.75pt }
      table.sheet0 tr.row968 { height:15.75pt }
      table.sheet0 tr.row969 { height:15.75pt }
      table.sheet0 tr.row970 { height:15.75pt }
      table.sheet0 tr.row971 { height:15.75pt }
      table.sheet0 tr.row972 { height:15.75pt }
      table.sheet0 tr.row973 { height:15.75pt }
      table.sheet0 tr.row974 { height:15.75pt }
      table.sheet0 tr.row975 { height:15.75pt }
      table.sheet0 tr.row976 { height:15.75pt }
      table.sheet0 tr.row977 { height:15.75pt }
      table.sheet0 tr.row978 { height:15.75pt }
      table.sheet0 tr.row979 { height:15.75pt }
      table.sheet0 tr.row980 { height:15.75pt }
      table.sheet0 tr.row981 { height:15.75pt }
      table.sheet0 tr.row982 { height:15.75pt }
      table.sheet0 tr.row983 { height:15.75pt }
      table.sheet0 tr.row984 { height:15.75pt }
      table.sheet0 tr.row985 { height:15.75pt }
      table.sheet0 tr.row986 { height:15.75pt }
      table.sheet0 tr.row987 { height:15.75pt }
      table.sheet0 tr.row988 { height:15.75pt }
      table.sheet0 tr.row989 { height:15.75pt }
      table.sheet0 tr.row990 { height:15.75pt }
      table.sheet0 tr.row991 { height:15.75pt }
      table.sheet0 tr.row992 { height:15.75pt }
      table.sheet0 tr.row993 { height:15.75pt }
      table.sheet0 tr.row994 { height:15.75pt }
      table.sheet0 tr.row995 { height:15.75pt }
      table.sheet0 tr.row996 { height:15.75pt }
      table.sheet0 tr.row997 { height:15.75pt }
      table.sheet0 tr.row998 { height:15.75pt }
    </style>
  </head>

  <body>
<style>
@page { margin-left: 0.33in; margin-right: 0.25in; margin-top: 0.34in; margin-bottom: 0.26in; }
body { margin-left: 0.33in; margin-right: 0.25in; margin-top: 0.34in; margin-bottom: 0.26in; }
</style>
    <table border="0" cellpadding="0" cellspacing="0" id="sheet0" class="sheet0 gridlines">
        <col class="col0">
        <col class="col1">
        <col class="col2">
        <col class="col3">
        <col class="col4">
        <col class="col5">
        <col class="col6">
        <col class="col7">
        <col class="col8">
        <col class="col9">
        <col class="col10">
        <col class="col11">
        <col class="col12">
        <col class="col13">
        <col class="col14">
        <col class="col15">
        <col class="col16">
        <col class="col17">
        <col class="col18">
        <col class="col19">
        <col class="col20">
        <col class="col21">
        <col class="col22">
        <col class="col23">
        <col class="col24">
        <col class="col25">
        <col class="col26">
        <col class="col27">
        <col class="col28">
        <col class="col29">
        <col class="col30">
        <col class="col31">
        <col class="col32">
        <col class="col33">
        <col class="col34">
        <col class="col35">
        <col class="col36">
        <tbody>
          <tr class="row0">
            <td class="column0 style1 null">
<div style="position: relative;"><img style="position: absolute; z-index: 1; left: 0px; top: 0px; width: 167px; height: 168px;" src="zip:///home/CloudConvertio/tmp/in_work/f994b490051947aeb3f52c1aafb38cc3.xlsx#xl/media/image1.png" border="0" /></div></td>
            <td class="column1 style1 null"></td>
            <td class="column2 style1 null"></td>
            <td class="column3 style1 null"></td>
            <td class="column4 style1 null"></td>
            <td class="column5 style1 null"></td>
            <td class="column6 style1 null"></td>
            <td class="column7 style1 null"></td>
            <td class="column8 style1 null"></td>
            <td class="column9 style1 null"></td>
            <td class="column10 style1 null"></td>
            <td class="column11 style1 null"></td>
            <td class="column12 style1 null"></td>
            <td class="column13 style1 null"></td>
            <td class="column14 style1 null"></td>
            <td class="column15 style1 null"></td>
            <td class="column16 style1 null"></td>
            <td class="column17 style1 null"></td>
            <td class="column18 style1 null"></td>
            <td class="column19 style1 null"></td>
            <td class="column20 style1 null"></td>
            <td class="column21 style2 null style0" colspan="4" rowspan="6">
<div style="position: relative;"><img style="position: absolute; z-index: 1; left: 0px; top: 0px; width: 16px; height: 20px;" src="zip:///home/CloudConvertio/tmp/in_work/f994b490051947aeb3f52c1aafb38cc3.xlsx#xl/media/image2.jpg" border="0" /></div></td>
            <td class="column25 style1 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style1 null"></td>
            <td class="column28 style2 null"></td>
            <td class="column29 style2 null"></td>
            <td class="column30 style1 null"></td>
            <td class="column31 style1 null"></td>
            <td class="column32 style1 null"></td>
            <td class="column33 style1 null"></td>
            <td class="column34 style1 null"></td>
            <td class="column35 style1 null"></td>
            <td class="column36 style1 null"></td>
          </tr>
          <tr class="row1">
            <td class="column0 style4 null"></td>
            <td class="column1 style4 null"></td>
            <td class="column2 style4 null"></td>
            <td class="column3 style4 null"></td>
            <td class="column4 style4 null"></td>
            <td class="column5 style5 s style0" colspan="16" rowspan="3">&nbsp;&nbsp;REGISTRO DE CALIFICACIONES                                                                                              MODALIDAD  ESCOLARIZADA                                                                  (PLAN 2018)</td>
            <td class="column25 style1 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style4 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row2">
            <td class="column0 style4 null"></td>
            <td class="column1 style4 null"></td>
            <td class="column2 style4 null"></td>
            <td class="column3 style4 null"></td>
            <td class="column4 style4 null"></td>
            <td class="column25 style1 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style4 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row3">
            <td class="column0 style4 null"></td>
            <td class="column1 style4 null"></td>
            <td class="column2 style4 null"></td>
            <td class="column3 style4 null"></td>
            <td class="column4 style4 null"></td>
            <td class="column25 style1 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style4 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row4">
            <td class="column0 style1 null"></td>
            <td class="column1 style1 null"></td>
            <td class="column2 style1 null"></td>
            <td class="column3 style1 null"></td>
            <td class="column4 style1 null"></td>
            <td class="column5 style1 null"></td>
            <td class="column6 style7 null"></td>
            <td class="column7 style7 null"></td>
            <td class="column8 style7 null"></td>
            <td class="column9 style7 null"></td>
            <td class="column10 style7 null"></td>
            <td class="column11 style7 null"></td>
            <td class="column12 style7 null"></td>
            <td class="column13 style7 null"></td>
            <td class="column14 style7 null"></td>
            <td class="column15 style7 null"></td>
            <td class="column16 style7 null"></td>
            <td class="column17 style7 null"></td>
            <td class="column18 style7 null"></td>
            <td class="column19 style7 null"></td>
            <td class="column20 style7 null"></td>
            <td class="column25 style1 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style1 null"></td>
            <td class="column28 style2 null"></td>
            <td class="column29 style2 null"></td>
            <td class="column30 style1 null"></td>
            <td class="column31 style1 null"></td>
            <td class="column32 style1 null"></td>
            <td class="column33 style1 null"></td>
            <td class="column34 style1 null"></td>
            <td class="column35 style1 null"></td>
            <td class="column36 style1 null"></td>
          </tr>
          <tr class="row5">
            <td class="column0 style4 null"></td>
            <td class="column1 style8 null"></td>
            <td class="column2 style8 null"></td>
            <td class="column3 style8 null"></td>
            <td class="column4 style8 null"></td>
            <td class="column5 style4 null"></td>
            <td class="column6 style4 null"></td>
            <td class="column7 style4 null"></td>
            <td class="column8 style4 null"></td>
            <td class="column9 style4 null"></td>
            <td class="column10 style4 null"></td>
            <td class="column11 style4 null"></td>
            <td class="column12 style4 null"></td>
            <td class="column13 style4 null"></td>
            <td class="column14 style4 null"></td>
            <td class="column15 style4 null"></td>
            <td class="column16 style4 null"></td>
            <td class="column17 style4 null"></td>
            <td class="column18 style4 null"></td>
            <td class="column19 style8 null"></td>
            <td class="column20 style8 null"></td>
            <td class="column25 style1 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style1 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row6">
            <td class="column0 style9 s style10" colspan="17">BENEMÉRITA  Y  CENTENARIA  ESCUELA  NORMAL  DE  JALISCO  </td>
            <td class="column17 style11 s style12" colspan="8">&nbsp;&nbsp;&nbsp;&nbsp;14ENL0008Z</td>
            <td class="column25 style1 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style1 null"></td>
            <td class="column28 style13 null"></td>
            <td class="column29 style13 null"></td>
            <td class="column30 style14 null"></td>
            <td class="column31 style14 null"></td>
            <td class="column32 style14 null"></td>
            <td class="column33 style14 null"></td>
            <td class="column34 style14 null"></td>
            <td class="column35 style14 null"></td>
            <td class="column36 style14 null"></td>
          </tr>
          <tr class="row7">
            <td class="column0 style15 s style16" colspan="25">NOMBRE DE LA ESCUELA:                                                                                                                                                                                                                                 CLAVE:</td>
            <td class="column25 style1 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style1 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
<?php

// Verificar conexión
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

$user_id = $_SESSION["Matricula"]; // Obtener el ID de usuario de la sesión

// Consulta SQL para obtener el dato de CURP del usuario
$sql = "SELECT CURP
      FROM alumnos
      WHERE Matricula = $user_id";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
  // Imprimir el dato de CURP en el lugar correspondiente en HTML
  while ($fila = $resultado->fetch_assoc()) {
      echo '<tr class="row8">
              <td class="column0 style17 s style18" colspan="6">AVENIDA ALCALDE 1190</td>
              <td class="column6 style19 s style18" colspan="3">MIRAFLORES</td>
              <td class="column9 style20 s style18" colspan="4"><span style="color:#000000; font-family:\'Calibri\'; font-size:14pt"> </span><span style="font-weight:bold; color:#000000; font-family:\'Calibri\'; font-size:11pt">GUADALAJARA </span></td>
              <td class="column13 style21 s style18" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;JALISCO</td>
              <td class="column16 style22 s style23" colspan="9">' . $fila["CURP"] . '</td>
              <td class="column25 style1 null"></td>
              <td class="column26 style3 null"></td>
              <td class="column27 style1 null"></td>
              <td class="column28 style13 null"></td>
              <td class="column29 style13 null"></td>
              <td class="column30 style14 null"></td>
              <td class="column31 style14 null"></td>
              <td class="column32 style14 null"></td>
              <td class="column33 style14 null"></td>
              <td class="column34 style14 null"></td>
              <td class="column35 style14 null"></td>
              <td class="column36 style14 null"></td>
            </tr>';
  }
} else {
  echo "No se encontraron resultados";
}

$conn->close();
?>

          <tr class="row9">
            <td class="column0 style24 s style26" colspan="25">DOMICILIO                                                             COLONIA                     MUNICIPIO                  ENTIDAD FEDERATIVA                   CLAVE UNICA DE REGISTRO DE POBLACIÓN  (CURP)</td>
            <td class="column25 style1 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style1 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>

          <?php
          // Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "controlescolar";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$user_id = $_SESSION["Matricula"]; // Obtener el ID de usuario de la sesión

// Consulta SQL para obtener los datos del usuario
$sql = "SELECT ApellidoPaterno, ApellidoMaterno, NombreCompleto
        FROM alumnos
        WHERE Matricula = $user_id";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    // Imprimir los datos en los campos correspondientes en HTML
    while ($fila = $resultado->fetch_assoc()) {
        echo '<tr class="row10">
                <td class="column0 style27 s style18" colspan="5">' . $fila["ApellidoPaterno"] . '</td>
                <td class="column5 style28 s style18" colspan="6">' . $fila["ApellidoMaterno"] . '</td>
                <td class="column11 style28 s style18" colspan="8">' . $fila["NombreCompleto"] . '</td>
                <td class="column19 style28 s style23" colspan="6">M</td>
                <td class="column25 style1 null"></td>
                <td class="column26 style3 null"></td>
                <td class="column27 style1 null"></td>
                <td class="column28 style29 null"></td>
                <td class="column29 style29 null"></td>
                <td class="column30 style30 null"></td>
                <td class="column31 style30 null"></td>
                <td class="column32 style30 null"></td>
                <td class="column33 style30 null"></td>
                <td class="column34 style30 null"></td>
                <td class="column35 style30 null"></td>
                <td class="column36 style30 null"></td>
              </tr>';
    }
} else {
    echo "No se encontraron resultados";
}

$conn->close();
?>

          <tr class="row11">
            <td class="column0 style31 s style25" colspan="5">PRIMER APELLIDO</td>
            <td class="column5 style32 s style25" colspan="6">SEGUNDO APELLIDO</td>
            <td class="column11 style32 s style25" colspan="8">NOMBRE(S)</td>
            <td class="column19 style32 s style26" colspan="6">SEXO (H o M)</td>
            <td class="column25 style1 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style1 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <?php
          // Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "controlescolar";
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
$user_id = $_SESSION["Matricula"]; // Obtener el ID de usuario de la sesión
         // Consulta SQL para obtener la matrícula del usuario
$sql = "SELECT Matricula
FROM alumnos
WHERE Matricula = $user_id";
$resultado = $conn->query($sql);
if ($resultado->num_rows > 0) {
// Imprimir la matrícula en el lugar correspondiente en HTML
while ($fila = $resultado->fetch_assoc()) {
echo '<tr class="row12">
        <td class="column0 style33 s style18" colspan="17">EDUCACION PRIMARIA PLAN 2018</td>
        <td class="column17 style34 n style23" colspan="8">' . $fila["Matricula"] . '</td>
        <td class="column25 style1 null"></td>
        <td class="column26 style3 null"></td>
        <td class="column27 style1 null"></td>
        <td class="column28 style29 null"></td>
        <td class="column29 style29 null"></td>
        <td class="column30 style30 null"></td>
        <td class="column31 style30 null"></td>
        <td class="column32 style30 null"></td>
        <td class="column33 style30 null"></td>
        <td class="column34 style30 null"></td>
        <td class="column35 style30 null"></td>
        <td class="column36 style30 null"></td>
      </tr>';
}
} else {
echo "No se encontraron resultados";
}

?>
          <tr class="row13">
            <td class="column0 style24 s style25" colspan="18">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LICENCIATURA              Y                  PLAN DE ESTUDIOS</td>
            <td class="column18 style32 s style26" colspan="7">MATRÍCULA</td>
            <td class="column25 style1 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style1 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
<?php
// Configurar la codificación de caracteres para la conexión a la base de datos
$conn->set_charset("utf8");

// Obtener la matrícula del usuario desde la sesión
$user_id = $_SESSION["Matricula"]; // Obtener el ID de usuario de la sesión

// Consulta SQL para obtener los datos de lugar de nacimiento y turno del usuario
$sql = "SELECT 
            alumnos.lugar_nacimiento,
            grupos.Turno
        FROM 
            alumnos
        JOIN 
            grupos ON alumnos.id_grupo = grupos.id_grupo
        WHERE 
            alumnos.Matricula = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    // Imprimir los datos en los campos correspondientes en HTML
    while ($fila = $resultado->fetch_assoc()) {
        echo '<tr class="row14">
                <td class="column0 style35 s style18" colspan="16">' . $fila["lugar_nacimiento"] . '</td>
                <td class="column16 style22 s style23" colspan="9">' . $fila["Turno"] . '</td>
                <td class="column25 style1 null"></td>
                <td class="column26 style3 null"></td>
                <td class="column27 style1 null"></td>
                <td class="column28 style29 null"></td>
                <td class="column29 style29 null"></td>
                <td class="column30 style30 null"></td>
                <td class="column31 style30 null"></td>
                <td class="column32 style30 null"></td>
                <td class="column33 style30 null"></td>
                <td class="column34 style30 null"></td>
                <td class="column35 style30 null"></td>
                <td class="column36 style30 null"></td>
              </tr>';
    }
} else {
    echo "No se encontraron resultados";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

          <tr class="row15">
            <td class="column0 style36 s style37" colspan="18">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LUGAR Y FECHA DE NACIMIENTO</td>
            <td class="column18 style38 s style39" colspan="7">TURNO</td>
            <td class="column25 style1 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style1 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row16">
            <td class="column0 style40 null style41" colspan="25"></td>
            <td class="column25 style1 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style1 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row17">
            <td class="column0 style42 s style0" colspan="2">I</td>
            <td class="column2 style1 null style0" colspan="12"></td>
            <td class="column14 style43 s style0" colspan="6">FECHA DE BAJA</td>
            <td class="column20 style43 null style0" colspan="5"></td>
            <td class="column25 style1 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style1 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "controlescolar";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Configurar la codificación de caracteres para la conexión a la base de datos
$conn->set_charset("utf8");

// Obtener la matrícula del usuario desde la sesión
$user_id = $_SESSION["Matricula"]; // Obtener el ID de usuario de la sesión

// Consulta SQL para obtener las calificaciones del estudiante
$sql_calificaciones = "SELECT calificacion FROM calificaciones WHERE Matricula = ?";
$stmt_calificaciones = $conn->prepare($sql_calificaciones);
$stmt_calificaciones->bind_param("i", $user_id);
$stmt_calificaciones->execute();
$result_calificaciones = $stmt_calificaciones->get_result();

// Inicializar variables para calcular el promedio
$total_calificaciones = 0;
$num_calificaciones = 0;

// Calcular el promedio
while ($row_calificacion = $result_calificaciones->fetch_assoc()) {
    $total_calificaciones += $row_calificacion["calificacion"];
    $num_calificaciones++;
}

// Verificar si hay calificaciones para evitar división por cero
if ($num_calificaciones > 0) {
    $promedio = $total_calificaciones / $num_calificaciones;
} else {
    $promedio = 0; // Si no hay calificaciones, el promedio es cero
}

// Formatear el promedio con dos decimales sin redondear
$promedio_formateado = number_format($promedio, 2, '.', '');

// Consulta SQL para obtener los datos del semestre, período escolar y grupo del usuario
$sql = "SELECT 
            grupos.semestre AS Semestre, 
            grupos.periodo_escolar AS PeriodoEscolar, 
            grupos.nombre_grupo AS Grupo
        FROM 
            alumnos
        JOIN 
            grupos ON alumnos.id_grupo = grupos.id_grupo
        WHERE 
            alumnos.Matricula = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    // Imprimir los datos en los campos correspondientes en HTML
    while ($fila = $resultado->fetch_assoc()) {
        echo '<tr class="row18">
    <td class="column0 style43 s style0" colspan="2">SEMESTRE</td>
    <td class="column2 style43 s style0" colspan="4">' . $fila["Semestre"] . '</td>
    <td class="column6 style42 s style0" colspan="4">' . $fila["PeriodoEscolar"] . '</td>
    <td class="column10 style43 s style0" colspan="2">GRUPO:</td>
    <td class="column12 style44 s style0" colspan="2">' . $fila["Grupo"] . '</td>
    <td class="column14 style45 s style47" colspan="3">TEMPORAL</td>
    <td class="column17 style45 s style47" colspan="3">DEFINITIVA</td>
    <td class="column20 style48 s style55" colspan="5" rowspan="2">GRUPO ESPECIAL</td>
    <td class="column25 style2 null style0" rowspan="88"></td>
    <td class="column26 style50 n style56" rowspan="10">' . $promedio_formateado . '</td>
    <td class="column27 style2 null style0" rowspan="88"></td>
    <td class="column28 style6 null"></td>
    <td class="column29 style6 null"></td>
    <td class="column30 style4 null"></td>
    <td class="column31 style4 null"></td>
    <td class="column32 style4 null"></td>
    <td class="column33 style4 null"></td>
    <td class="column34 style4 null"></td>
    <td class="column35 style4 null"></td>
    <td class="column36 style4 null"></td>
  </tr>';
    }
} else {
    echo "No se encontraron resultados";
}

?>

          <tr class="row19">
            <td class="column0 style51 s style57" rowspan="2">CLAVE</td>
            <td class="column1 style52 s style59" colspan="9" rowspan="2">ASIGNATURAS</td>
            <td class="column10 style53 s style55" colspan="2" rowspan="2">CALIFICACIÓN  FINAL</td>
            <td class="column12 style53 s style55" colspan="2" rowspan="2">% DE  ASISTENCIA</td>
            <td class="column14 style45 s style47" colspan="6">PERIODOS DE REGULARIZACIÓN</td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row20">
            <td class="column14 style60 s style47" colspan="2">FECHA</td>
            <td class="column16 style61 s">CALIF.</td>
            <td class="column17 style60 s style47" colspan="2">FECHA</td>
            <td class="column19 style61 s">CALIF.</td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>

          <?php
$user_id = $_SESSION["Matricula"]; // Obtener el ID de usuario de la sesión

// Consulta SQL para obtener la calificación y la asistencia del usuario para la materia con codigo_materia = '11'
$sql = "SELECT c.calificacion, c.asistencia, m.nombre_materia
        FROM calificaciones c
        JOIN materias m ON c.id_materia = m.id_materia
        WHERE c.Matricula = ? AND m.codigo_materia = ?";

$stmt = $conn->prepare($sql);
$codigo_materia = '11'; // Especificar el codigo_materia
$stmt->bind_param("is", $user_id, $codigo_materia); // 's' for string parameter
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    // Imprimir los datos en los campos correspondientes en HTML
    while ($fila = $resultado->fetch_assoc()) {
        echo '<tr class="row21">
                <td class="column0 style63 n">' . $codigo_materia . '</td>
                <td class="column1 style64 s style47" colspan="9">' . $fila["nombre_materia"] . '</td>
                <td class="column10 style65 n style47" colspan="2">' . $fila["calificacion"] . '</td>
                <td class="column12 style66 n style47" colspan="2">' . $fila["asistencia"] . '%</td>
                <td class="column14 style67 null style47" colspan="2"></td>
                <td class="column16 style68 null"></td>
                <td class="column17 style69 null style47" colspan="2"></td>
                <td class="column19 style68 null"></td>
                <td class="column20 style62 null style47" colspan="5"></td>
                <td class="column28 style6 null"></td>
                <td class="column29 style6 null"></td>
                <td class="column30 style4 null"></td>
                <td class="column31 style4 null"></td>
                <td class="column32 style4 null"></td>
                <td class="column33 style4 null"></td>
                <td class="column34 style4 null"></td>
                <td class="column35 style4 null"></td>
                <td class="column36 style4 null"></td>
              </tr>';
    }
} else {
    echo "No se encontraron resultados";
}
?>

<?php
$user_id = $_SESSION["Matricula"]; // Obtener el ID de usuario de la sesión

// Consulta SQL para obtener la calificación y la asistencia del usuario para la materia con codigo_materia = '11'
$sql = "SELECT c.calificacion, c.asistencia, m.nombre_materia
        FROM calificaciones c
        JOIN materias m ON c.id_materia = m.id_materia
        WHERE c.Matricula = ? AND m.codigo_materia = ?";

$stmt = $conn->prepare($sql);
$codigo_materia = '12'; // Especificar el codigo_materia
$stmt->bind_param("is", $user_id, $codigo_materia); // 's' for string parameter
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    // Imprimir los datos en los campos correspondientes en HTML
    while ($fila = $resultado->fetch_assoc()) {
        echo '<tr class="row21">
                <td class="column0 style63 n">' . $codigo_materia . '</td>
                <td class="column1 style64 s style47" colspan="9">' . $fila["nombre_materia"] . '</td>
                <td class="column10 style65 n style47" colspan="2">' . $fila["calificacion"] . '</td>
                <td class="column12 style66 n style47" colspan="2">' . $fila["asistencia"] . '%</td>
                <td class="column14 style67 null style47" colspan="2"></td>
                <td class="column16 style68 null"></td>
                <td class="column17 style69 null style47" colspan="2"></td>
                <td class="column19 style68 null"></td>
                <td class="column20 style62 null style47" colspan="5"></td>
                <td class="column28 style6 null"></td>
                <td class="column29 style6 null"></td>
                <td class="column30 style4 null"></td>
                <td class="column31 style4 null"></td>
                <td class="column32 style4 null"></td>
                <td class="column33 style4 null"></td>
                <td class="column34 style4 null"></td>
                <td class="column35 style4 null"></td>
                <td class="column36 style4 null"></td>
              </tr>';
    }
} else {
    echo "No se encontraron resultados";
}
?>
       <?php
$user_id = $_SESSION["Matricula"]; // Obtener el ID de usuario de la sesión

// Consulta SQL para obtener la calificación y la asistencia del usuario para la materia con codigo_materia = '11'
$sql = "SELECT c.calificacion, c.asistencia, m.nombre_materia
        FROM calificaciones c
        JOIN materias m ON c.id_materia = m.id_materia
        WHERE c.Matricula = ? AND m.codigo_materia = ?";

$stmt = $conn->prepare($sql);
$codigo_materia = '13'; // Especificar el codigo_materia
$stmt->bind_param("is", $user_id, $codigo_materia); // 's' for string parameter
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    // Imprimir los datos en los campos correspondientes en HTML
    while ($fila = $resultado->fetch_assoc()) {
        echo '<tr class="row21">
                <td class="column0 style63 n">' . $codigo_materia . '</td>
                <td class="column1 style64 s style47" colspan="9">' . $fila["nombre_materia"] . '</td>
                <td class="column10 style65 n style47" colspan="2">' . $fila["calificacion"] . '</td>
                <td class="column12 style66 n style47" colspan="2">' . $fila["asistencia"] . '%</td>
                <td class="column14 style67 null style47" colspan="2"></td>
                <td class="column16 style68 null"></td>
                <td class="column17 style69 null style47" colspan="2"></td>
                <td class="column19 style68 null"></td>
                <td class="column20 style62 null style47" colspan="5"></td>
                <td class="column28 style6 null"></td>
                <td class="column29 style6 null"></td>
                <td class="column30 style4 null"></td>
                <td class="column31 style4 null"></td>
                <td class="column32 style4 null"></td>
                <td class="column33 style4 null"></td>
                <td class="column34 style4 null"></td>
                <td class="column35 style4 null"></td>
                <td class="column36 style4 null"></td>
              </tr>';
    }
} else {
    echo "No se encontraron resultados";
}
?>


<?php
$user_id = $_SESSION["Matricula"]; // Obtener el ID de usuario de la sesión

// Consulta SQL para obtener la calificación y la asistencia del usuario para la materia con codigo_materia = '11'
$sql = "SELECT c.calificacion, c.asistencia, m.nombre_materia
        FROM calificaciones c
        JOIN materias m ON c.id_materia = m.id_materia
        WHERE c.Matricula = ? AND m.codigo_materia = ?";

$stmt = $conn->prepare($sql);
$codigo_materia = '14'; // Especificar el codigo_materia
$stmt->bind_param("is", $user_id, $codigo_materia); // 's' for string parameter
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    // Imprimir los datos en los campos correspondientes en HTML
    while ($fila = $resultado->fetch_assoc()) {
        echo '<tr class="row21">
                <td class="column0 style63 n">' . $codigo_materia . '</td>
                <td class="column1 style64 s style47" colspan="9">' . $fila["nombre_materia"] . '</td>
                <td class="column10 style65 n style47" colspan="2">' . $fila["calificacion"] . '</td>
                <td class="column12 style66 n style47" colspan="2">' . $fila["asistencia"] . '%</td>
                <td class="column14 style67 null style47" colspan="2"></td>
                <td class="column16 style68 null"></td>
                <td class="column17 style69 null style47" colspan="2"></td>
                <td class="column19 style68 null"></td>
                <td class="column20 style62 null style47" colspan="5"></td>
                <td class="column28 style6 null"></td>
                <td class="column29 style6 null"></td>
                <td class="column30 style4 null"></td>
                <td class="column31 style4 null"></td>
                <td class="column32 style4 null"></td>
                <td class="column33 style4 null"></td>
                <td class="column34 style4 null"></td>
                <td class="column35 style4 null"></td>
                <td class="column36 style4 null"></td>
              </tr>';
    }
} else {
    echo "No se encontraron resultados";
}
?>

<?php
$user_id = $_SESSION["Matricula"]; // Obtener el ID de usuario de la sesión

// Consulta SQL para obtener la calificación y la asistencia del usuario para la materia con codigo_materia = '11'
$sql = "SELECT c.calificacion, c.asistencia, m.nombre_materia
        FROM calificaciones c
        JOIN materias m ON c.id_materia = m.id_materia
        WHERE c.Matricula = ? AND m.codigo_materia = ?";

$stmt = $conn->prepare($sql);
$codigo_materia = '15'; // Especificar el codigo_materia
$stmt->bind_param("is", $user_id, $codigo_materia); // 's' for string parameter
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    // Imprimir los datos en los campos correspondientes en HTML
    while ($fila = $resultado->fetch_assoc()) {
        echo '<tr class="row21">
                <td class="column0 style63 n">' . $codigo_materia . '</td>
                <td class="column1 style64 s style47" colspan="9">' . $fila["nombre_materia"] . '</td>
                <td class="column10 style65 n style47" colspan="2">' . $fila["calificacion"] . '</td>
                <td class="column12 style66 n style47" colspan="2">' . $fila["asistencia"] . '%</td>
                <td class="column14 style67 null style47" colspan="2"></td>
                <td class="column16 style68 null"></td>
                <td class="column17 style69 null style47" colspan="2"></td>
                <td class="column19 style68 null"></td>
                <td class="column20 style62 null style47" colspan="5"></td>
                <td class="column28 style6 null"></td>
                <td class="column29 style6 null"></td>
                <td class="column30 style4 null"></td>
                <td class="column31 style4 null"></td>
                <td class="column32 style4 null"></td>
                <td class="column33 style4 null"></td>
                <td class="column34 style4 null"></td>
                <td class="column35 style4 null"></td>
                <td class="column36 style4 null"></td>
              </tr>';
    }
} else {
    echo "No se encontraron resultados";
}
?>


       
<?php
$user_id = $_SESSION["Matricula"]; // Obtener el ID de usuario de la sesión

// Consulta SQL para obtener la calificación y la asistencia del usuario para la materia con codigo_materia = '11'
$sql = "SELECT c.calificacion, c.asistencia, m.nombre_materia
        FROM calificaciones c
        JOIN materias m ON c.id_materia = m.id_materia
        WHERE c.Matricula = ? AND m.codigo_materia = ?";

$stmt = $conn->prepare($sql);
$codigo_materia = '16'; // Especificar el codigo_materia
$stmt->bind_param("is", $user_id, $codigo_materia); // 's' for string parameter
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    // Imprimir los datos en los campos correspondientes en HTML
    while ($fila = $resultado->fetch_assoc()) {
        echo '<tr class="row21">
                <td class="column0 style63 n">' . $codigo_materia . '</td>
                <td class="column1 style64 s style47" colspan="9">' . $fila["nombre_materia"] . '</td>
                <td class="column10 style65 n style47" colspan="2">' . $fila["calificacion"] . '</td>
                <td class="column12 style66 n style47" colspan="2">' . $fila["asistencia"] . '%</td>
                <td class="column14 style67 null style47" colspan="2"></td>
                <td class="column16 style68 null"></td>
                <td class="column17 style69 null style47" colspan="2"></td>
                <td class="column19 style68 null"></td>
                <td class="column20 style62 null style47" colspan="5"></td>
                <td class="column28 style6 null"></td>
                <td class="column29 style6 null"></td>
                <td class="column30 style4 null"></td>
                <td class="column31 style4 null"></td>
                <td class="column32 style4 null"></td>
                <td class="column33 style4 null"></td>
                <td class="column34 style4 null"></td>
                <td class="column35 style4 null"></td>
                <td class="column36 style4 null"></td>
              </tr>';
    }
} else {
    echo "No se encontraron resultados";
}
?>


<?php
$user_id = $_SESSION["Matricula"]; // Obtener el ID de usuario de la sesión

// Consulta SQL para obtener la calificación y la asistencia del usuario para la materia con codigo_materia = '11'
$sql = "SELECT c.calificacion, c.asistencia, m.nombre_materia
        FROM calificaciones c
        JOIN materias m ON c.id_materia = m.id_materia
        WHERE c.Matricula = ? AND m.codigo_materia = ?";

$stmt = $conn->prepare($sql);
$codigo_materia = '17'; // Especificar el codigo_materia
$stmt->bind_param("is", $user_id, $codigo_materia); // 's' for string parameter
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    // Imprimir los datos en los campos correspondientes en HTML
    while ($fila = $resultado->fetch_assoc()) {
        echo '<tr class="row21">
                <td class="column0 style63 n">' . $codigo_materia . '</td>
                <td class="column1 style64 s style47" colspan="9">' . $fila["nombre_materia"] . '</td>
                <td class="column10 style65 n style47" colspan="2">' . $fila["calificacion"] . '</td>
                <td class="column12 style66 n style47" colspan="2">' . $fila["asistencia"] . '%</td>
                <td class="column14 style67 null style47" colspan="2"></td>
                <td class="column16 style68 null"></td>
                <td class="column17 style69 null style47" colspan="2"></td>
                <td class="column19 style68 null"></td>
                <td class="column20 style62 null style47" colspan="5"></td>
                <td class="column28 style6 null"></td>
                <td class="column29 style6 null"></td>
                <td class="column30 style4 null"></td>
                <td class="column31 style4 null"></td>
                <td class="column32 style4 null"></td>
                <td class="column33 style4 null"></td>
                <td class="column34 style4 null"></td>
                <td class="column35 style4 null"></td>
                <td class="column36 style4 null"></td>
              </tr>';
    }
} else {
    echo "No se encontraron resultados";
}
?>

          <tr class="row28">
            <td class="column0 style71 null style0" colspan="25"></td>
            <td class="column26 style72 null style73" rowspan="2"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row29">
            <td class="column0 style42 s style0" colspan="2">II</td>
            <td class="column2 style1 null style0" colspan="12"></td>
            <td class="column14 style43 s style0" colspan="6">FECHA DE BAJA</td>
            <td class="column20 style43 null style0" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row30">
            <td class="column0 style43 s style0" colspan="2">SEMESTRE</td>
            <td class="column2 style43 s style0" colspan="4">PERIODO ESCOLAR:</td>
            <td class="column6 style42 s style0" colspan="4">2021-2022</td>
            <td class="column10 style43 s style0" colspan="2">GRUPO:</td>
            <td class="column12 style44 s style0" colspan="2">A</td>
            <td class="column14 style45 s style47" colspan="3">TEMPORAL</td>
            <td class="column17 style45 s style47" colspan="3">DEFINITIVA</td>
            <td class="column20 style48 s style55" colspan="5" rowspan="2">GRUPO ESPECIAL</td>
            <td class="column26 style74 n style56" rowspan="9">Promedio2</td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row31">
            <td class="column0 style51 s style75" rowspan="2">CLAVE</td>
            <td class="column1 style52 s style59" colspan="9" rowspan="2">ASIGNATURAS</td>
            <td class="column10 style53 s style55" colspan="2" rowspan="2">CALIFICACIÓN  FINAL</td>
            <td class="column12 style53 s style55" colspan="2" rowspan="2">% DE  ASISTENCIA</td>
            <td class="column14 style45 s style47" colspan="6">PERIODOS DE REGULARIZACIÓN</td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row32">
            <td class="column14 style60 s style47" colspan="2">FECHA</td>
            <td class="column16 style61 s">CALIF.</td>
            <td class="column17 style60 s style47" colspan="2">FECHA</td>
            <td class="column19 style61 s">CALIF.</td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row33">
            <td class="column0 style63 n">21</td>
            <td class="column1 style64 s style47" colspan="9">Planeación y evaluación de la enseñanza y el aprendizaje</td>
            <td class="column10 style65 n style47" colspan="2">0</td>
            <td class="column12 style66 n style47" colspan="2">0%</td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style68 null"></td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row34">
            <td class="column0 style63 n">23</td>
            <td class="column1 style64 s style47" colspan="9">Prácticas sociales del lenguaje</td>
            <td class="column10 style65 n style47" colspan="2">0</td>
            <td class="column12 style66 n style47" colspan="2">0%</td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column20 style48 s style55" colspan="5" rowspan="2">TALLER</td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row35">
            <td class="column0 style63 n">24</td>
            <td class="column1 style64 s style47" colspan="9">Aritmética. Números decimales y fracciones</td>
            <td class="column10 style65 n style47" colspan="2">0</td>
            <td class="column12 style66 n style47" colspan="2">0%</td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row36">
            <td class="column0 style63 n">25</td>
            <td class="column1 style64 s style47" colspan="9">Estudio del medio ambiente y la naturaleza</td>
            <td class="column10 style65 n style47" colspan="2">0</td>
            <td class="column12 style66 n style47" colspan="2">0%</td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row37">
            <td class="column0 style63 n">26</td>
            <td class="column1 style64 s style47" colspan="9">Observación y análisis de prácticas y contextos escolares</td>
            <td class="column10 style65 n style47" colspan="2">0</td>
            <td class="column12 style66 n style47" colspan="2">0%</td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style76 n">13</td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row38">
            <td class="column0 style63 n">27</td>
            <td class="column1 style64 s style47" colspan="9">Inglés. Desarrollo de conversaciones elementales</td>
            <td class="column10 style65 n style47" colspan="2">0</td>
            <td class="column12 style66 n style47" colspan="2">0%</td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style70 n">58</td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row39">
            <td class="column0 style71 null style0" colspan="25"></td>
            <td class="column26 style72 null style73" rowspan="2"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style70 n">122</td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row40">
            <td class="column0 style42 s style0" colspan="2">III</td>
            <td class="column2 style1 null style0" colspan="12"></td>
            <td class="column14 style43 s style0" colspan="6">FECHA DE BAJA</td>
            <td class="column20 style43 null style0" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style70 n">9.38</td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row41">
            <td class="column0 style43 s style0" colspan="2">SEMESTRE</td>
            <td class="column2 style43 s style0" colspan="4">PERIODO ESCOLAR:</td>
            <td class="column6 style42 s style0" colspan="4">2022-2023</td>
            <td class="column10 style43 s style0" colspan="2">GRUPO:</td>
            <td class="column12 style44 s style0" colspan="2">A</td>
            <td class="column14 style45 s style47" colspan="3">TEMPORAL</td>
            <td class="column17 style45 s style47" colspan="3">DEFINITIVA</td>
            <td class="column20 style48 s style55" colspan="5" rowspan="2">GRUPO ESPECIAL</td>
            <td class="column26 style50 n style56" rowspan="10">Promedio3</td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row42">
            <td class="column0 style51 s style75" rowspan="2">CLAVE</td>
            <td class="column1 style52 s style59" colspan="9" rowspan="2">ASIGNATURAS</td>
            <td class="column10 style53 s style55" colspan="2" rowspan="2">CALIFICACIÓN  FINAL</td>
            <td class="column12 style53 s style55" colspan="2" rowspan="2">% DE  ASISTENCIA</td>
            <td class="column14 style45 s style47" colspan="6">PERIODOS DE REGULARIZACIÓN</td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row43">
            <td class="column14 style60 s style47" colspan="2">FECHA</td>
            <td class="column16 style61 s">CALIF.</td>
            <td class="column17 style60 s style47" colspan="2">FECHA</td>
            <td class="column19 style61 s">CALIF.</td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row44">
            <td class="column0 style63 n">31</td>
            <td class="column1 style64 s style47" colspan="9">Educación Socioemocional</td>
            <td class="column10 style65 n style47" colspan="2">0</td>
            <td class="column12 style66 n style47" colspan="2">0%</td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style68 null"></td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row45">
            <td class="column0 style63 n">33</td>
            <td class="column1 style64 s style47" colspan="9">Desarrollo de competencia lectora</td>
            <td class="column10 style65 n style47" colspan="2">0</td>
            <td class="column12 style66 n style47" colspan="2">0%</td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row46">
            <td class="column0 style63 n">34</td>
            <td class="column1 style77 s style47" colspan="9">Álgebra</td>
            <td class="column10 style65 n style47" colspan="2">0</td>
            <td class="column12 style66 n style47" colspan="2">0%</td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column20 style48 s style55" colspan="5" rowspan="2">TALLER</td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row47">
            <td class="column0 style63 n">35</td>
            <td class="column1 style64 s style47" colspan="9">Geografía</td>
            <td class="column10 style65 n style47" colspan="2">0</td>
            <td class="column12 style66 n style47" colspan="2">0%</td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row48">
            <td class="column0 style63 n">36</td>
            <td class="column1 style64 s style47" colspan="9">Iniciación al trabajo docente</td>
            <td class="column10 style65 n style47" colspan="2">0</td>
            <td class="column12 style66 n style47" colspan="2">0%</td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style76 n">20</td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row49">
            <td class="column0 style63 n">37</td>
            <td class="column1 style64 s style47" colspan="9">Inglés. Intercambio de información e ideas</td>
            <td class="column10 style65 n style47" colspan="2">0</td>
            <td class="column12 style66 n style47" colspan="2">0%</td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style70 n">183</td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row50">
            <td class="column0 style63 n">38</td>
            <td class="column1 style64 s style47" colspan="9">Optativo I</td>
            <td class="column10 style65 n style47" colspan="2">0</td>
            <td class="column12 style66 n style47" colspan="2">0%</td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style70 n">61</td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row51">
            <td class="column0 style71 null style0" colspan="25"></td>
            <td class="column26 style72 null style73" rowspan="2"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style70 n">9.15</td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row52">
            <td class="column0 style42 s style0" colspan="2">IV</td>
            <td class="column2 style1 null style0" colspan="12"></td>
            <td class="column14 style43 s style0" colspan="6">FECHA DE BAJA</td>
            <td class="column20 style43 null style0" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row53">
            <td class="column0 style43 s style0" colspan="2">SEMESTRE</td>
            <td class="column2 style43 s style0" colspan="4">PERIODO ESCOLAR:</td>
            <td class="column6 style42 s style0" colspan="4">2022-2023</td>
            <td class="column10 style43 s style0" colspan="2">GRUPO:</td>
            <td class="column12 style44 s style0" colspan="2">A</td>
            <td class="column14 style45 s style47" colspan="3">TEMPORAL</td>
            <td class="column17 style45 s style47" colspan="3">DEFINITIVA</td>
            <td class="column20 style48 s style55" colspan="5" rowspan="2">GRUPO ESPECIAL</td>
            <td class="column26 style50 n style78" rowspan="11">Promedio4</td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row54">
            <td class="column0 style51 s style75" rowspan="2">CLAVE</td>
            <td class="column1 style52 s style59" colspan="9" rowspan="2">ASIGNATURAS</td>
            <td class="column10 style53 s style55" colspan="2" rowspan="2">CALIFICACIÓN  FINAL</td>
            <td class="column12 style53 s style55" colspan="2" rowspan="2">% DE  ASISTENCIA</td>
            <td class="column14 style45 s style47" colspan="6">PERIODOS DE REGULARIZACIÓN</td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row55">
            <td class="column14 style60 s style47" colspan="2">FECHA</td>
            <td class="column16 style61 s">CALIF.</td>
            <td class="column17 style60 s style47" colspan="2">FECHA</td>
            <td class="column19 style61 s">CALIF.</td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row56">
            <td class="column0 style63 n">41</td>
            <td class="column1 style64 s style47" colspan="9">Atención a la diversidad</td>
            <td class="column10 style65 n style47" colspan="2">0</td>
            <td class="column12 style66 n style47" colspan="2">0%</td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style68 null"></td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row57">
            <td class="column0 style63 n">42</td>
            <td class="column1 style64 s style47" colspan="9">Modelos pedagógicos</td>
            <td class="column10 style65 n style47" colspan="2">0</td>
            <td class="column12 style66 n style47" colspan="2">0%</td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row58">
            <td class="column0 style63 n">43</td>
            <td class="column1 style64 s style47" colspan="9">Producción de textos escritos</td>
            <td class="column10 style65 n style47" colspan="2">0</td>
            <td class="column12 style66 n style47" colspan="2">0%</td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column20 style48 s style55" colspan="5" rowspan="2">TALLER</td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row59">
            <td class="column0 style63 n">44</td>
            <td class="column1 style64 s style47" colspan="9">Geometría</td>
            <td class="column10 style65 n style47" colspan="2">0</td>
            <td class="column12 style66 n style47" colspan="2">0%</td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row60">
            <td class="column0 style63 n">45</td>
            <td class="column1 style64 s style47" colspan="9">Historia</td>
            <td class="column10 style65 n style47" colspan="2">0</td>
            <td class="column12 style66 n style47" colspan="2">0%</td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row61">
            <td class="column0 style63 n">46</td>
            <td class="column1 style64 s style47" colspan="9">Estrategias de trabajo docente</td>
            <td class="column10 style65 n style47" colspan="2">0</td>
            <td class="column12 style66 n style47" colspan="2">0%</td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style76 s">28M</td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row62">
            <td class="column0 style63 n">47</td>
            <td class="column1 style64 s style47" colspan="9">Inglés. Fortalecimiento de la confianza en la conversación</td>
            <td class="column10 style65 n style47" colspan="2">0</td>
            <td class="column12 style66 n style47" colspan="2">0%</td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row63">
            <td class="column0 style63 n">48</td>
            <td class="column1 style64 s style47" colspan="9">Optativo II</td>
            <td class="column10 style65 n style47" colspan="2">0</td>
            <td class="column12 style66 n style47" colspan="2">0%</td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style70 n">75</td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row64">
            <td class="column0 style71 null"></td>
            <td class="column1 style79 null"></td>
            <td class="column2 style80 null"></td>
            <td class="column3 style80 null"></td>
            <td class="column4 style80 null"></td>
            <td class="column5 style80 null"></td>
            <td class="column6 style80 null"></td>
            <td class="column7 style80 null"></td>
            <td class="column8 style80 null"></td>
            <td class="column9 style80 null"></td>
            <td class="column10 style81 null"></td>
            <td class="column11 style80 null"></td>
            <td class="column12 style82 null"></td>
            <td class="column13 style83 null"></td>
            <td class="column14 style81 null"></td>
            <td class="column15 style81 null"></td>
            <td class="column16 style81 null"></td>
            <td class="column17 style81 null"></td>
            <td class="column18 style81 null"></td>
            <td class="column19 style81 null"></td>
            <td class="column20 style84 null"></td>
            <td class="column21 style80 null"></td>
            <td class="column22 style80 null"></td>
            <td class="column23 style80 null"></td>
            <td class="column24 style80 null"></td>
            <td class="column26 style85 null style73" rowspan="2"></td>
            <td class="column28 style2 null"></td>
            <td class="column29 style86 n">258</td>
            <td class="column30 style1 null"></td>
            <td class="column31 style1 null"></td>
            <td class="column32 style1 null"></td>
            <td class="column33 style1 null"></td>
            <td class="column34 style1 null"></td>
            <td class="column35 style1 null"></td>
            <td class="column36 style1 null"></td>
          </tr>
          <tr class="row65">
            <td class="column0 style42 s style0" colspan="2">V</td>
            <td class="column2 style1 null style0" colspan="12"></td>
            <td class="column14 style43 s style0" colspan="6">FECHA DE BAJA</td>
            <td class="column20 style43 null style0" colspan="5"></td>
            <td class="column28 style87 n">9.21</td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row66">
            <td class="column0 style43 s style0" colspan="2">SEMESTRE</td>
            <td class="column2 style43 s style0" colspan="4">PERIODO ESCOLAR:</td>
            <td class="column6 style42 s style0" colspan="4">2023-2024</td>
            <td class="column10 style43 s style0" colspan="2">GRUPO:</td>
            <td class="column12 style44 null style0" colspan="2"></td>
            <td class="column14 style45 s style47" colspan="3">TEMPORAL</td>
            <td class="column17 style45 s style47" colspan="3">DEFINITIVA</td>
            <td class="column20 style48 s style55" colspan="5" rowspan="2">GRUPO ESPECIAL</td>
            <td class="column26 style88 null style78" rowspan="11"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row67">
            <td class="column0 style51 s style75" rowspan="2">CLAVE</td>
            <td class="column1 style52 s style59" colspan="9" rowspan="2">ASIGNATURAS</td>
            <td class="column10 style53 s style55" colspan="2" rowspan="2">CALIFICACIÓN  FINAL</td>
            <td class="column12 style53 s style55" colspan="2" rowspan="2">% DE  ASISTENCIA</td>
            <td class="column14 style45 s style47" colspan="6">PERIODOS DE REGULARIZACIÓN</td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row68">
            <td class="column14 style60 s style47" colspan="2">FECHA</td>
            <td class="column16 style61 s">CALIF.</td>
            <td class="column17 style60 s style47" colspan="2">FECHA</td>
            <td class="column19 style61 s">CALIF.</td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row69">
            <td class="column0 style63 n">51</td>
            <td class="column1 style89 s style47" colspan="9">Educación inclusiva</td>
            <td class="column10 style90 null style47" colspan="2"></td>
            <td class="column12 style91 null style47" colspan="2"></td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style68 null"></td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row70">
            <td class="column0 style63 n">52</td>
            <td class="column1 style89 s style47" colspan="9">Herramientas básicas para la investigación educativa</td>
            <td class="column10 style90 null style47" colspan="2"></td>
            <td class="column12 style91 null style47" colspan="2"></td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row71">
            <td class="column0 style63 n">53</td>
            <td class="column1 style92 s style47" colspan="9">Literatura</td>
            <td class="column10 style90 null style47" colspan="2"></td>
            <td class="column12 style91 null style47" colspan="2"></td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column20 style48 s style55" colspan="5" rowspan="2">TALLER</td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row72">
            <td class="column0 style63 n">54</td>
            <td class="column1 style89 s style47" colspan="9">Probabilidad y estadística</td>
            <td class="column10 style90 null style47" colspan="2"></td>
            <td class="column12 style91 null style47" colspan="2"></td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row73">
            <td class="column0 style63 n">55</td>
            <td class="column1 style89 s style47" colspan="9">Estrategias para la enseñanza de la historia</td>
            <td class="column10 style90 null style47" colspan="2"></td>
            <td class="column12 style91 null style47" colspan="2"></td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row74">
            <td class="column0 style63 n">56</td>
            <td class="column1 style89 s style47" colspan="9">Innovación y trabajo docente</td>
            <td class="column10 style90 null style47" colspan="2"></td>
            <td class="column12 style91 null style47" colspan="2"></td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row75">
            <td class="column0 style63 n">57</td>
            <td class="column1 style92 s style47" colspan="9">Inglés. Hacia nuevas perspectivas globales</td>
            <td class="column10 style90 null style47" colspan="2"></td>
            <td class="column12 style91 null style47" colspan="2"></td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row76">
            <td class="column0 style63 n">58</td>
            <td class="column1 style89 s style47" colspan="9">Optativo III</td>
            <td class="column10 style90 null style47" colspan="2"></td>
            <td class="column12 style91 null style47" colspan="2"></td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row77">
            <td class="column0 style71 null style0" colspan="25"></td>
            <td class="column26 style72 null style73" rowspan="2"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row78">
            <td class="column0 style42 s style0" colspan="2">VI</td>
            <td class="column2 style1 null style0" colspan="12"></td>
            <td class="column14 style43 s style0" colspan="6">FECHA DE BAJA</td>
            <td class="column20 style43 null style0" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row79">
            <td class="column0 style43 s style0" colspan="2">SEMESTRE</td>
            <td class="column2 style43 s style0" colspan="4">PERIODO ESCOLAR:</td>
            <td class="column6 style42 s style0" colspan="4">2023-2024</td>
            <td class="column10 style43 s style0" colspan="2">GRUPO:</td>
            <td class="column12 style44 null style0" colspan="2"></td>
            <td class="column14 style45 s style47" colspan="3">TEMPORAL</td>
            <td class="column17 style45 s style47" colspan="3">DEFINITIVA</td>
            <td class="column20 style48 s style55" colspan="5" rowspan="2">GRUPO ESPECIAL</td>
            <td class="column26 style93 null style56" rowspan="10"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row80">
            <td class="column0 style51 s style75" rowspan="2">CLAVE</td>
            <td class="column1 style52 s style59" colspan="9" rowspan="2">ASIGNATURAS</td>
            <td class="column10 style53 s style55" colspan="2" rowspan="2">CALIFICACIÓN  FINAL</td>
            <td class="column12 style53 s style55" colspan="2" rowspan="2">% DE  ASISTENCIA</td>
            <td class="column14 style45 s style47" colspan="6">PERIODOS DE REGULARIZACIÓN</td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row81">
            <td class="column14 style60 s style47" colspan="2">FECHA</td>
            <td class="column16 style61 s">CALIF.</td>
            <td class="column17 style60 s style47" colspan="2">FECHA</td>
            <td class="column19 style61 s">CALIF.</td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row82">
            <td class="column0 style63 n">61</td>
            <td class="column1 style64 s style47" colspan="9">Bases legales y normativas de la educación básica</td>
            <td class="column10 style90 null style47" colspan="2"></td>
            <td class="column12 style91 null style47" colspan="2"></td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style68 null"></td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row83">
            <td class="column0 style63 n">63</td>
            <td class="column1 style64 s style47" colspan="9">Estrategias para el desarrollo socioemocional</td>
            <td class="column10 style90 null style47" colspan="2"></td>
            <td class="column12 style91 null style47" colspan="2"></td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row84">
            <td class="column0 style63 n">64</td>
            <td class="column1 style77 s style47" colspan="9">Música, expresión corporal y danza</td>
            <td class="column10 style90 null style47" colspan="2"></td>
            <td class="column12 style91 null style47" colspan="2"></td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column20 style48 s style55" colspan="5" rowspan="2">TALLER</td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row85">
            <td class="column0 style63 n">65</td>
            <td class="column1 style64 s style47" colspan="9">Formación cívica y ética</td>
            <td class="column10 style90 null style47" colspan="2"></td>
            <td class="column12 style91 null style47" colspan="2"></td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row86">
            <td class="column0 style63 n">66</td>
            <td class="column1 style64 s style47" colspan="9">Trabajo docente y proyectos de mejora escolar</td>
            <td class="column10 style90 null style47" colspan="2"></td>
            <td class="column12 style91 null style47" colspan="2"></td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row87">
            <td class="column0 style63 n">67</td>
            <td class="column1 style64 s style47" colspan="9">Inglés. Convertirse en comunicadores independientes</td>
            <td class="column10 style90 null style47" colspan="2"></td>
            <td class="column12 style91 null style47" colspan="2"></td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row88">
            <td class="column0 style63 n">68</td>
            <td class="column1 style64 s style47" colspan="9">Optativo IV</td>
            <td class="column10 style90 null style47" colspan="2"></td>
            <td class="column12 style91 null style47" colspan="2"></td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row89">
            <td class="column0 style71 null style0" colspan="25"></td>
            <td class="column26 style72 null style73" rowspan="2"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row90">
            <td class="column0 style42 s style0" colspan="2">VII</td>
            <td class="column2 style1 null style0" colspan="12"></td>
            <td class="column14 style43 s style0" colspan="6">FECHA DE BAJA</td>
            <td class="column20 style43 null style0" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row91">
            <td class="column0 style43 s style0" colspan="2">SEMESTRE</td>
            <td class="column2 style43 s style0" colspan="4">PERIODO ESCOLAR:</td>
            <td class="column6 style42 s style0" colspan="4">2024-2025</td>
            <td class="column10 style43 s style0" colspan="2">GRUPO:</td>
            <td class="column12 style44 null style0" colspan="2"></td>
            <td class="column14 style45 s style47" colspan="3">TEMPORAL</td>
            <td class="column17 style45 s style47" colspan="3">DEFINITIVA</td>
            <td class="column20 style48 s style55" colspan="5" rowspan="2">GRUPO ESPECIAL</td>
            <td class="column26 style93 null style56" rowspan="7"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row92">
            <td class="column0 style51 s style75" rowspan="2">CLAVE</td>
            <td class="column1 style52 s style59" colspan="9" rowspan="2">ASIGNATURAS</td>
            <td class="column10 style53 s style55" colspan="2" rowspan="2">CALIFICACIÓN  FINAL</td>
            <td class="column12 style53 s style55" colspan="2" rowspan="2">% DE  ASISTENCIA</td>
            <td class="column14 style45 s style47" colspan="6">PERIODOS DE REGULARIZACIÓN</td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row93">
            <td class="column14 style60 s style47" colspan="2">FECHA</td>
            <td class="column16 style61 s">CALIF.</td>
            <td class="column17 style60 s style47" colspan="2">FECHA</td>
            <td class="column19 style61 s">CALIF.</td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row94">
            <td class="column0 style63 n">71</td>
            <td class="column1 style64 s style47" colspan="9">Gestión educativa centrada en la mejora del aprendizaje</td>
            <td class="column10 style90 null style47" colspan="2"></td>
            <td class="column12 style91 null style47" colspan="2"></td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style68 null"></td>
            <td class="column20 style48 s style55" colspan="5" rowspan="2">TALLER</td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row95">
            <td class="column0 style63 n">73</td>
            <td class="column1 style64 s style47" colspan="9">Teatro y artes visuales</td>
            <td class="column10 style90 null style47" colspan="2"></td>
            <td class="column12 style91 null style47" colspan="2"></td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row96">
            <td class="column0 style63 n">74</td>
            <td class="column1 style77 s style47" colspan="9">Educación Física</td>
            <td class="column10 style90 null style47" colspan="2"></td>
            <td class="column12 style91 null style47" colspan="2"></td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row97">
            <td class="column0 style63 n">76</td>
            <td class="column1 style64 s style47" colspan="9">Aprendizaje en el Servicio</td>
            <td class="column10 style90 null style47" colspan="2"></td>
            <td class="column12 style91 null style47" colspan="2"></td>
            <td class="column14 style69 null style47" colspan="2"></td>
            <td class="column16 style68 null"></td>
            <td class="column17 style69 null style47" colspan="2"></td>
            <td class="column19 style69 null"></td>
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row98">
            <td class="column0 style71 null style0" colspan="25"></td>
            <td class="column26 style72 null style0" rowspan="2"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row99">
            <td class="column0 style42 s style0" colspan="2">VIII</td>
            <td class="column2 style1 null style0" colspan="12"></td>
            <td class="column14 style43 s style0" colspan="6">FECHA DE BAJA</td>
            <td class="column20 style43 null style0" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row100">
            <td class="column0 style43 s style0" colspan="2">SEMESTRE</td>
            <td class="column2 style43 s style0" colspan="4">PERIODO ESCOLAR:</td>
            <td class="column6 style42 s style0" colspan="4">2024-2025</td>
            <td class="column10 style43 s style0" colspan="2">GRUPO:</td>
            <td class="column12 style44 null style0" colspan="2"></td>
            <td class="column14 style45 s style47" colspan="3">TEMPORAL</td>
            <td class="column17 style45 s style47" colspan="3">DEFINITIVA</td>
            <td class="column20 style48 s style55" colspan="5" rowspan="2">GRUPO ESPECIAL</td>
            <td class="column26 style93 null style78" rowspan="6"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row101">
            <td class="column0 style51 s style75" rowspan="2">CLAVE</td>
            <td class="column1 style52 s style59" colspan="9" rowspan="2">ASIGNATURAS</td>
            <td class="column10 style53 s style55" colspan="2" rowspan="2">CALIFICACIÓN  FINAL</td>
            <td class="column12 style53 s style55" colspan="2" rowspan="2">% DE  ASISTENCIA</td>
            <td class="column14 style45 s style47" colspan="6">PERIODOS DE REGULARIZACIÓN</td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row102">
            <td class="column14 style60 s style47" colspan="2">FECHA</td>
            <td class="column16 style61 s">CALIF.</td>
            <td class="column17 style60 s style47" colspan="2">FECHA</td>
            <td class="column19 style61 s">CALIF.</td>
            <td class="column20 style94 null style49" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row103">
            <td class="column0 style95 n style57" rowspan="3">86</td>
            <td class="column1 style96 s style55" colspan="9" rowspan="3">Aprendizaje en el Servicio</td>
            <td class="column10 style48 null style55" colspan="2" rowspan="3"></td>
            <td class="column12 style97 null style55" colspan="2" rowspan="3"></td>
            <td class="column14 style98 null style55" colspan="2" rowspan="3"></td>
            <td class="column16 style99 null style57" rowspan="3"></td>
            <td class="column17 style98 null style55" colspan="2" rowspan="3"></td>
            <td class="column19 style99 null style57" rowspan="3"></td>
            <td class="column20 style48 s style55" colspan="5" rowspan="2">TALLER</td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row104">
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row105">
            <td class="column20 style62 null style47" colspan="5"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row106">
            <td class="column0 style2 null style0" colspan="25"></td>
            <td class="column25 style1 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style1 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row107">
            <td class="column0 style2 null style0" colspan="25"></td>
            <td class="column25 style1 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style1 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row108">
            <td class="column0 style100 s style47" colspan="13">PROMEDIO  GENERAL  DE  APROVECHAMIENTO</td>
            <td class="column13 style101 n style103" colspan="12">9.21</td>
            <td class="column25 style4 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style4 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row109">
            <td class="column0 style4 null"></td>
            <td class="column1 style4 null"></td>
            <td class="column2 style4 null"></td>
            <td class="column3 style4 null"></td>
            <td class="column4 style4 null"></td>
            <td class="column5 style4 null"></td>
            <td class="column6 style4 null"></td>
            <td class="column7 style4 null"></td>
            <td class="column8 style4 null"></td>
            <td class="column9 style4 null"></td>
            <td class="column10 style4 null"></td>
            <td class="column11 style4 null"></td>
            <td class="column12 style4 null"></td>
            <td class="column13 style4 null"></td>
            <td class="column14 style4 null"></td>
            <td class="column15 style4 null"></td>
            <td class="column16 style4 null"></td>
            <td class="column17 style4 null"></td>
            <td class="column18 style4 null"></td>
            <td class="column19 style4 null"></td>
            <td class="column20 style4 null"></td>
            <td class="column21 style4 null"></td>
            <td class="column22 style4 null"></td>
            <td class="column23 style4 null"></td>
            <td class="column24 style4 null"></td>
            <td class="column25 style4 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style4 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row110">
            <td class="column0 style4 null"></td>
            <td class="column1 style4 null"></td>
            <td class="column2 style4 null"></td>
            <td class="column3 style4 null"></td>
            <td class="column4 style4 null"></td>
            <td class="column5 style4 null"></td>
            <td class="column6 style4 null"></td>
            <td class="column7 style4 null"></td>
            <td class="column8 style4 null"></td>
            <td class="column9 style4 null"></td>
            <td class="column10 style4 null"></td>
            <td class="column11 style4 null"></td>
            <td class="column12 style4 null"></td>
            <td class="column13 style4 null"></td>
            <td class="column14 style4 null"></td>
            <td class="column15 style4 null"></td>
            <td class="column16 style4 null"></td>
            <td class="column17 style4 null"></td>
            <td class="column18 style4 null"></td>
            <td class="column19 style4 null"></td>
            <td class="column20 style4 null"></td>
            <td class="column21 style4 null"></td>
            <td class="column22 style4 null"></td>
            <td class="column23 style4 null"></td>
            <td class="column24 style4 null"></td>
            <td class="column25 style4 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style4 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row111">
            <td class="column0 style4 null"></td>
            <td class="column1 style4 null"></td>
            <td class="column2 style4 null"></td>
            <td class="column3 style4 null"></td>
            <td class="column4 style4 null"></td>
            <td class="column5 style4 null"></td>
            <td class="column6 style4 null"></td>
            <td class="column7 style4 null"></td>
            <td class="column8 style4 null"></td>
            <td class="column9 style4 null"></td>
            <td class="column10 style4 null"></td>
            <td class="column11 style4 null"></td>
            <td class="column12 style4 null"></td>
            <td class="column13 style4 null"></td>
            <td class="column14 style4 null"></td>
            <td class="column15 style4 null"></td>
            <td class="column16 style4 null"></td>
            <td class="column17 style4 null"></td>
            <td class="column18 style4 null"></td>
            <td class="column19 style4 null"></td>
            <td class="column20 style4 null"></td>
            <td class="column21 style4 null"></td>
            <td class="column22 style4 null"></td>
            <td class="column23 style4 null"></td>
            <td class="column24 style4 null"></td>
            <td class="column25 style4 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style4 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row112">
            <td class="column0 style4 null"></td>
            <td class="column1 style4 null"></td>
            <td class="column2 style4 null"></td>
            <td class="column3 style4 null"></td>
            <td class="column4 style4 null"></td>
            <td class="column5 style4 null"></td>
            <td class="column6 style4 null"></td>
            <td class="column7 style4 null"></td>
            <td class="column8 style4 null"></td>
            <td class="column9 style4 null"></td>
            <td class="column10 style4 null"></td>
            <td class="column11 style4 null"></td>
            <td class="column12 style4 null"></td>
            <td class="column13 style4 null"></td>
            <td class="column14 style4 null"></td>
            <td class="column15 style4 null"></td>
            <td class="column16 style4 null"></td>
            <td class="column17 style4 null"></td>
            <td class="column18 style4 null"></td>
            <td class="column19 style4 null"></td>
            <td class="column20 style4 null"></td>
            <td class="column21 style4 null"></td>
            <td class="column22 style4 null"></td>
            <td class="column23 style4 null"></td>
            <td class="column24 style4 null"></td>
            <td class="column25 style4 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style4 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row113">
            <td class="column0 style4 null"></td>
            <td class="column1 style4 null"></td>
            <td class="column2 style4 null"></td>
            <td class="column3 style4 null"></td>
            <td class="column4 style4 null"></td>
            <td class="column5 style4 null"></td>
            <td class="column6 style4 null"></td>
            <td class="column7 style4 null"></td>
            <td class="column8 style4 null"></td>
            <td class="column9 style4 null"></td>
            <td class="column10 style4 null"></td>
            <td class="column11 style4 null"></td>
            <td class="column12 style4 null"></td>
            <td class="column13 style4 null"></td>
            <td class="column14 style4 null"></td>
            <td class="column15 style4 null"></td>
            <td class="column16 style4 null"></td>
            <td class="column17 style4 null"></td>
            <td class="column18 style4 null"></td>
            <td class="column19 style4 null"></td>
            <td class="column20 style4 null"></td>
            <td class="column21 style4 null"></td>
            <td class="column22 style4 null"></td>
            <td class="column23 style4 null"></td>
            <td class="column24 style4 null"></td>
            <td class="column25 style4 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style4 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row114">
            <td class="column0 style4 null"></td>
            <td class="column1 style4 null"></td>
            <td class="column2 style4 null"></td>
            <td class="column3 style4 null"></td>
            <td class="column4 style4 null"></td>
            <td class="column5 style4 null"></td>
            <td class="column6 style4 null"></td>
            <td class="column7 style4 null"></td>
            <td class="column8 style4 null"></td>
            <td class="column9 style4 null"></td>
            <td class="column10 style4 null"></td>
            <td class="column11 style4 null"></td>
            <td class="column12 style4 null"></td>
            <td class="column13 style4 null"></td>
            <td class="column14 style4 null"></td>
            <td class="column15 style4 null"></td>
            <td class="column16 style4 null"></td>
            <td class="column17 style4 null"></td>
            <td class="column18 style4 null"></td>
            <td class="column19 style4 null"></td>
            <td class="column20 style4 null"></td>
            <td class="column21 style4 null"></td>
            <td class="column22 style4 null"></td>
            <td class="column23 style4 null"></td>
            <td class="column24 style4 null"></td>
            <td class="column25 style4 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style4 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row115">
            <td class="column0 style4 null"></td>
            <td class="column1 style4 null"></td>
            <td class="column2 style4 null"></td>
            <td class="column3 style4 null"></td>
            <td class="column4 style4 null"></td>
            <td class="column5 style4 null"></td>
            <td class="column6 style4 null"></td>
            <td class="column7 style4 null"></td>
            <td class="column8 style4 null"></td>
            <td class="column9 style4 null"></td>
            <td class="column10 style4 null"></td>
            <td class="column11 style4 null"></td>
            <td class="column12 style4 null"></td>
            <td class="column13 style4 null"></td>
            <td class="column14 style4 null"></td>
            <td class="column15 style4 null"></td>
            <td class="column16 style4 null"></td>
            <td class="column17 style4 null"></td>
            <td class="column18 style4 null"></td>
            <td class="column19 style4 null"></td>
            <td class="column20 style4 null"></td>
            <td class="column21 style4 null"></td>
            <td class="column22 style4 null"></td>
            <td class="column23 style4 null"></td>
            <td class="column24 style4 null"></td>
            <td class="column25 style4 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style4 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row116">
            <td class="column0 style4 null"></td>
            <td class="column1 style4 null"></td>
            <td class="column2 style4 null"></td>
            <td class="column3 style4 null"></td>
            <td class="column4 style4 null"></td>
            <td class="column5 style4 null"></td>
            <td class="column6 style4 null"></td>
            <td class="column7 style4 null"></td>
            <td class="column8 style4 null"></td>
            <td class="column9 style4 null"></td>
            <td class="column10 style4 null"></td>
            <td class="column11 style4 null"></td>
            <td class="column12 style4 null"></td>
            <td class="column13 style4 null"></td>
            <td class="column14 style4 null"></td>
            <td class="column15 style4 null"></td>
            <td class="column16 style4 null"></td>
            <td class="column17 style4 null"></td>
            <td class="column18 style4 null"></td>
            <td class="column19 style4 null"></td>
            <td class="column20 style4 null"></td>
            <td class="column21 style4 null"></td>
            <td class="column22 style4 null"></td>
            <td class="column23 style4 null"></td>
            <td class="column24 style4 null"></td>
            <td class="column25 style4 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style4 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row117">
            <td class="column0 style4 null"></td>
            <td class="column1 style4 null"></td>
            <td class="column2 style4 null"></td>
            <td class="column3 style4 null"></td>
            <td class="column4 style4 null"></td>
            <td class="column5 style4 null"></td>
            <td class="column6 style4 null"></td>
            <td class="column7 style4 null"></td>
            <td class="column8 style4 null"></td>
            <td class="column9 style4 null"></td>
            <td class="column10 style4 null"></td>
            <td class="column11 style4 null"></td>
            <td class="column12 style4 null"></td>
            <td class="column13 style4 null"></td>
            <td class="column14 style4 null"></td>
            <td class="column15 style4 null"></td>
            <td class="column16 style4 null"></td>
            <td class="column17 style4 null"></td>
            <td class="column18 style4 null"></td>
            <td class="column19 style4 null"></td>
            <td class="column20 style4 null"></td>
            <td class="column21 style4 null"></td>
            <td class="column22 style4 null"></td>
            <td class="column23 style4 null"></td>
            <td class="column24 style4 null"></td>
            <td class="column25 style4 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style4 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row118">
            <td class="column0 style4 null"></td>
            <td class="column1 style4 null"></td>
            <td class="column2 style4 null"></td>
            <td class="column3 style4 null"></td>
            <td class="column4 style4 null"></td>
            <td class="column5 style4 null"></td>
            <td class="column6 style4 null"></td>
            <td class="column7 style4 null"></td>
            <td class="column8 style4 null"></td>
            <td class="column9 style4 null"></td>
            <td class="column10 style4 null"></td>
            <td class="column11 style4 null"></td>
            <td class="column12 style4 null"></td>
            <td class="column13 style4 null"></td>
            <td class="column14 style4 null"></td>
            <td class="column15 style4 null"></td>
            <td class="column16 style4 null"></td>
            <td class="column17 style4 null"></td>
            <td class="column18 style4 null"></td>
            <td class="column19 style4 null"></td>
            <td class="column20 style4 null"></td>
            <td class="column21 style4 null"></td>
            <td class="column22 style4 null"></td>
            <td class="column23 style4 null"></td>
            <td class="column24 style4 null"></td>
            <td class="column25 style4 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style4 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row119">
            <td class="column0 style4 null"></td>
            <td class="column1 style4 null"></td>
            <td class="column2 style4 null"></td>
            <td class="column3 style4 null"></td>
            <td class="column4 style4 null"></td>
            <td class="column5 style4 null"></td>
            <td class="column6 style4 null"></td>
            <td class="column7 style4 null"></td>
            <td class="column8 style4 null"></td>
            <td class="column9 style4 null"></td>
            <td class="column10 style4 null"></td>
            <td class="column11 style4 null"></td>
            <td class="column12 style4 null"></td>
            <td class="column13 style4 null"></td>
            <td class="column14 style4 null"></td>
            <td class="column15 style4 null"></td>
            <td class="column16 style4 null"></td>
            <td class="column17 style4 null"></td>
            <td class="column18 style4 null"></td>
            <td class="column19 style4 null"></td>
            <td class="column20 style4 null"></td>
            <td class="column21 style4 null"></td>
            <td class="column22 style4 null"></td>
            <td class="column23 style4 null"></td>
            <td class="column24 style4 null"></td>
            <td class="column25 style4 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style4 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row120">
            <td class="column0 style4 null"></td>
            <td class="column1 style4 null"></td>
            <td class="column2 style4 null"></td>
            <td class="column3 style4 null"></td>
            <td class="column4 style4 null"></td>
            <td class="column5 style4 null"></td>
            <td class="column6 style4 null"></td>
            <td class="column7 style4 null"></td>
            <td class="column8 style4 null"></td>
            <td class="column9 style4 null"></td>
            <td class="column10 style4 null"></td>
            <td class="column11 style4 null"></td>
            <td class="column12 style4 null"></td>
            <td class="column13 style4 null"></td>
            <td class="column14 style4 null"></td>
            <td class="column15 style4 null"></td>
            <td class="column16 style4 null"></td>
            <td class="column17 style4 null"></td>
            <td class="column18 style4 null"></td>
            <td class="column19 style4 null"></td>
            <td class="column20 style4 null"></td>
            <td class="column21 style4 null"></td>
            <td class="column22 style4 null"></td>
            <td class="column23 style4 null"></td>
            <td class="column24 style4 null"></td>
            <td class="column25 style4 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style4 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row121">
            <td class="column0 style4 null"></td>
            <td class="column1 style4 null"></td>
            <td class="column2 style4 null"></td>
            <td class="column3 style4 null"></td>
            <td class="column4 style4 null"></td>
            <td class="column5 style4 null"></td>
            <td class="column6 style4 null"></td>
            <td class="column7 style4 null"></td>
            <td class="column8 style4 null"></td>
            <td class="column9 style4 null"></td>
            <td class="column10 style4 null"></td>
            <td class="column11 style4 null"></td>
            <td class="column12 style4 null"></td>
            <td class="column13 style4 null"></td>
            <td class="column14 style4 null"></td>
            <td class="column15 style4 null"></td>
            <td class="column16 style4 null"></td>
            <td class="column17 style4 null"></td>
            <td class="column18 style4 null"></td>
            <td class="column19 style4 null"></td>
            <td class="column20 style4 null"></td>
            <td class="column21 style4 null"></td>
            <td class="column22 style4 null"></td>
            <td class="column23 style4 null"></td>
            <td class="column24 style4 null"></td>
            <td class="column25 style4 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style4 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row122">
            <td class="column0 style4 null"></td>
            <td class="column1 style4 null"></td>
            <td class="column2 style4 null"></td>
            <td class="column3 style4 null"></td>
            <td class="column4 style4 null"></td>
            <td class="column5 style4 null"></td>
            <td class="column6 style4 null"></td>
            <td class="column7 style4 null"></td>
            <td class="column8 style4 null"></td>
            <td class="column9 style4 null"></td>
            <td class="column10 style4 null"></td>
            <td class="column11 style4 null"></td>
            <td class="column12 style4 null"></td>
            <td class="column13 style4 null"></td>
            <td class="column14 style4 null"></td>
            <td class="column15 style4 null"></td>
            <td class="column16 style4 null"></td>
            <td class="column17 style4 null"></td>
            <td class="column18 style4 null"></td>
            <td class="column19 style4 null"></td>
            <td class="column20 style4 null"></td>
            <td class="column21 style4 null"></td>
            <td class="column22 style4 null"></td>
            <td class="column23 style4 null"></td>
            <td class="column24 style4 null"></td>
            <td class="column25 style4 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style4 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row123">
            <td class="column0 style4 null"></td>
            <td class="column1 style4 null"></td>
            <td class="column2 style4 null"></td>
            <td class="column3 style4 null"></td>
            <td class="column4 style4 null"></td>
            <td class="column5 style4 null"></td>
            <td class="column6 style4 null"></td>
            <td class="column7 style4 null"></td>
            <td class="column8 style4 null"></td>
            <td class="column9 style4 null"></td>
            <td class="column10 style4 null"></td>
            <td class="column11 style4 null"></td>
            <td class="column12 style4 null"></td>
            <td class="column13 style4 null"></td>
            <td class="column14 style4 null"></td>
            <td class="column15 style4 null"></td>
            <td class="column16 style4 null"></td>
            <td class="column17 style4 null"></td>
            <td class="column18 style4 null"></td>
            <td class="column19 style4 null"></td>
            <td class="column20 style4 null"></td>
            <td class="column21 style4 null"></td>
            <td class="column22 style4 null"></td>
            <td class="column23 style4 null"></td>
            <td class="column24 style4 null"></td>
            <td class="column25 style4 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style4 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row124">
            <td class="column0 style4 null"></td>
            <td class="column1 style4 null"></td>
            <td class="column2 style4 null"></td>
            <td class="column3 style4 null"></td>
            <td class="column4 style4 null"></td>
            <td class="column5 style4 null"></td>
            <td class="column6 style4 null"></td>
            <td class="column7 style4 null"></td>
            <td class="column8 style4 null"></td>
            <td class="column9 style4 null"></td>
            <td class="column10 style4 null"></td>
            <td class="column11 style4 null"></td>
            <td class="column12 style4 null"></td>
            <td class="column13 style4 null"></td>
            <td class="column14 style4 null"></td>
            <td class="column15 style4 null"></td>
            <td class="column16 style4 null"></td>
            <td class="column17 style4 null"></td>
            <td class="column18 style4 null"></td>
            <td class="column19 style4 null"></td>
            <td class="column20 style4 null"></td>
            <td class="column21 style4 null"></td>
            <td class="column22 style4 null"></td>
            <td class="column23 style4 null"></td>
            <td class="column24 style4 null"></td>
            <td class="column25 style4 null"></td>
            <td class="column26 style3 null"></td>
            <td class="column27 style4 null"></td>
            <td class="column28 style6 null"></td>
            <td class="column29 style6 null"></td>
            <td class="column30 style4 null"></td>
            <td class="column31 style4 null"></td>
            <td class="column32 style4 null"></td>
            <td class="column33 style4 null"></td>
            <td class="column34 style4 null"></td>
            <td class="column35 style4 null"></td>
            <td class="column36 style4 null"></td>
          </tr>
          <tr class="row125">
            <td class="column0 style4 null"