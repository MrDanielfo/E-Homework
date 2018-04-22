<?php
print('
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="E-Homework, el perfecto organizador de tareas para el docente y su grupo">
  <title>E-Homework</title>
  <link href="https://fonts.googleapis.com/css?family=Arimo:400,400i,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="./public/css/font-awesome.min.css">
  <link rel="stylesheet" href="./public/css/styles.css">
</head>
<body>
  <div class="contenedor-grande">
    <header class="miheader">
        <div class="logotipo">
          <h1 class="logo">E-Homework</h1>
        </div>');
  if($_SESSION['homework']) {
    print('
          <nav class="menu-navegacion">
            <ul class="lista-menu">
              <li><a  class="enlace-menu" href="./">Inicio</a></li>
              <li><a  class="enlace-menu" href="homeworks">Tareas</a></li>
              <li><a  class="enlace-menu" href="users">Usuarios</a></li>
              <li><a  class="enlace-menu" href="groups">Grupos</a></li>
              <li><a  class="enlace-menu" href="status">Estados</a></li>
              <li><a  class="enlace-menu" href="signatures">Materias</a></li>
              <li><a  class="enlace-menu" href="salir">Salir</a></li>
            </ul>
          </nav>
    ');
  }

print('
    <div class="menu-burguer" id="menu-burguer">
      <i class="fa fa-bars fa-2x" aria-hidden="true"></i>
    </div>
  </header>
</div>

<div class="contenedor-mediano">
    <main class="principal">');
