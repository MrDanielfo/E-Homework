<?php

$user_controller = new UsersController();

if( $_POST['r'] == 'user-delete' && $_SESSION['role'] == 'Docente' && !isset($_POST['crud']) ) {

  $user = $user_controller->get($_POST['user']);

  if( empty($user) ) {

    $template =
    '<article class="datos-usuario">
        <h2 class="datos">No existe el usuario de nombre<b>%s</b></h2>
    </article>
    <script>
        window.onload = function() {
          reloadPage("users")
        }
    </script>';
  printf($template, $_POST['name']);
} else {
  $template_user =
  '<div class="contenedor-login">
      <h2 class="login  delete">Eliminar Usuario</h2>
      <form class="login-crud"  method="POST">
          <div class="caja">
            <h2 class="delete-crud">¿Estás seguro que quieres eliminar al usuario <b>%s</b>?</h2>
          </div>
          <div class="caja">
            <input type="submit" class="button delete" value="Sí">
            <input type="button" class="button add" value="No" onclick="history.back()">
            <input type="hidden" name="user" value="%s">
            <input type="hidden" name="r" value="user-delete">
            <input type="hidden" name="crud" value="del">
          </div>
      </form>
  </div>';
  printf(
    $template_user,
    $user[0]['name'],
    $user[0]['user']
  );

}

} else if ($_POST['r'] == 'user-delete'  && $_SESSION['role'] == 'Docente' && $_POST['crud'] == 'del' ) {

  $delete_user = $_POST['user'];

  $user = $user_controller->del($delete_user);

  $template =
    '<article class="datos-usuario">
        <h2 class="datos  delete">El usuario <b>%s</b> ha sido eliminado</h2>
    </article>
    <script>
        window.onload = function() {
          reloadPage("users")
        }
    </script>';

    printf($template, $_POST['user']);
} else {
  $controller = new ViewController();
  $controller->load_view('error401');
}
