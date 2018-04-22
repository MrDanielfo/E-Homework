<?php

$user_controller = new UsersController();

if( $_POST['r'] == 'user-edit' && $_SESSION['role'] == 'Docente' && !isset($_POST['crud']) ) {

  $user = $user_controller->get($_POST['user']);

  if( empty($user) ) {

    $template =
    '<article class="datos-usuario">
        <h2 class="datos">El usuario <b>%s</b> ha sido editado</h2>
    </article>
    <script>
        window.onload = function() {
          reloadPage("users")
        }
    </script>';
  printf($template, $_POST['name']);
} else {
  $role_docente = ($user[0]['role'] == 'Docente' ) ? 'checked' : '';
  $role_tutor = ($user[0]['role'] == 'Tutor' ) ? 'checked' : '';
  $role_padre = ($user[0]['role'] == 'Padre de Familia' ) ? 'checked' : '';

  $template_user =
  '<div class="contenedor-login">
      <h2 class="login  edit">Editar Usuario</h2>
      <form class="login-crud"  method="POST">
          <div class="caja">
            <input type="text" class="text" name="user" placeholder="user" value="%s" required>
          </div>
          <div class="caja">
            <input type="email" class="text" name="email" value="%s" placeholder="E-mail" disabled required>
            <input type="hidden" name="email" value="%s">
          </div>
          <div class="caja">
            <input type="text" class="text" name="name" value="%s" placeholder="Grupo" required>
          </div>
          <div class="caja">
            <input type="text" class="text" name="cellphone" value="%s" placeholder="Número Celular" required>
          </div>
          <div class="caja">
            <input type="password" class="text" name="pass" placeholder="Contraseña" required>
          </div>
          <div class="caja">
            <input type="radio" name="role" id="docente" value="Docente" %s required>
              <label for="docente">Docente</label>
            <input type="radio" name="role" id="tutor" value="Tutor" %s required>
              <label for="tutor">Tutor</label>
            <input type="radio" name="role" id="padre" value="Padre de Familia" %s required>
              <label for="padre">Padre de Familia</label>
          </div>
          <div class="caja">
            <input type="submit" class="button edit" value="Editar">
            <input type="hidden" name="r" value="user-edit">
            <input type="hidden" name="crud" value="set">
          </div>
      </form>
  </div>';
  printf(
    $template_user,
    $user[0]['user'],
    $user[0]['email'],
    $user[0]['email'],
    $user[0]['name'],
    $user[0]['cellphone'],
    $role_docente,
    $role_tutor,
    $role_padre
  );

}

} else if ($_POST['r'] == 'user-edit'  && $_SESSION['role'] == 'Docente' && $_POST['crud'] == 'set' ) {

  $save_user = array(
    'user' => $_POST['user'],
    'email' => $_POST['email'],
    'name' => $_POST['name'],
    'cellphone' => $_POST['cellphone'],
    'pass' => $_POST['pass'],
    'role' => $_POST['role'],
  );

  $user = $user_controller->set($save_user);

  $template =
    '<article class="datos-usuario">
        <h2 class="datos edit">El usuario <b>%s</b> ha sido editado</h2>
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
