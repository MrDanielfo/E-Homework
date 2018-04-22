<?php

print('<div class="contenedor-login">
    <h2 class="login">Inicia Sesión</h2>
    <form class="login-crud"  method="post">
        <div class="caja">
          <input type="text" class="text" name="user" placeholder="Usuario">
        </div>
        <div class="caja">
          <input type="password" class="text" name="pass" placeholder="Contraseña">
        </div>
        <div class="caja">
          <input type="submit" class="button" value="Enviar">
        </div>
    </form>
</div>');

if( isset($_GET['error']) ) {
  $template = '<p>
    %s
  </p>';

  printf($template, $_GET['error']);
}
