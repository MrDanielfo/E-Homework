<?php

$template = '
  <article class="datos-usuario">
    <h2 class="datos">Hola %s</h2>';

    if($_SESSION['role'] == 'Padre de Familia') {
      print( '<h3 class="datos">E-Homework es el administrador de tareas que facilitará tu papel de cabeza del hogar</h3>');
    } elseif($_SESSION['role'] == 'Tutor') {
      print( '<h3 class="datos">E-Homework es el administrador de tareas que facilitará tu labor como tutor</h3>');
    } else {
      print( '<h3 class="datos">E-Homework es el administrador de tareas que facilitará tu labor como docente</h3>');
    }

  $template .= '<p class="datos-personales">Tu nombre es  <b>%s</b></p>
    <p class="datos-personales">Tu email es  <b>%s</b></p>
    <p class="datos-personales">Tu número celular es  <b>%s</b></p>
    <p class="datos-personales">Estás registrad@ como:  <b>%s</b></p>
  </article>
';

printf($template, $_SESSION['user'], $_SESSION['name'],
        $_SESSION['email'], $_SESSION['cellphone'],
        $_SESSION['role'] );
