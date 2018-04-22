<?php

if( $_POST['r'] == 'user-add' && $_SESSION['role'] == 'Docente' && !isset($_POST['crud']) ) {
  print('
  <div class="contenedor-login">
      <h2 class="login  add">Agregar Usuario</h2>
      <form class="login-crud"  method="POST">
          <div class="caja">
            <input type="text" class="text" name="user" placeholder="Usuario" required>
          </div>
          <div class="caja">
            <input type="email" class="text" name="email" placeholder="E-mail" required>
          </div>
          <div class="caja">
            <input type="text" class="text" name="name" placeholder="Nombre" required>
          </div>
          <div class="caja">
            <input type="text" class="text" name="cellphone" placeholder="Número Celular" required>
          </div>
          <div class="caja">
            <input type="password" class="text" name="pass" placeholder="Contraseña" required>
          </div>
          <div class="caja">
            <input type="radio" name="role" id="docente" value="Docente" required>
              <label for="docente">Docente</label>
            <input type="radio" name="role" id="tutor" value="Tutor" required>
                <label for="tutor">Tutor</label>
            <input type="radio" name="role" id="padre" value="Padre de Familia" required>
                <label for="padre">Padre de Familia</label>
          </div>
          <div class="caja">
            <input type="submit" class="button add" value="Agregar">
            <input type="hidden" name="r" value="user-add">
            <input type="hidden" name="crud" value="set">
          </div>
      </form>
  </div>'
  );
} else if ($_POST['r'] == 'user-add'  && $_SESSION['role'] == 'Docente' && $_POST['crud'] == 'set' ) {
  $user_controller = new UsersController();

  $new_user = array(
    'user' => $_POST['user'],
    'email' => $_POST['email'],
    'name' => $_POST['name'],
    'cellphone' => $_POST['cellphone'],
    'pass' => $_POST['pass'],
    'role' => $_POST['role'],
  );

  $user = $user_controller->set($new_user);

  $template =
    '<article class="datos-usuario">
        <h2 class="datos">El usuario <b>%s</b> ha sido agregado</h2>
    </article>
    <script>
        window.onload = function() {
          reloadPage("users")
        }
    </script>';

    printf($template, $_POST['name']);
} else {
  $controller = new ViewController();
  $controller->load_view('error401');
}
