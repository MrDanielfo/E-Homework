<?php

$group_controller = new GroupsController();

if( $_POST['r'] == 'group-delete' && $_SESSION['role'] == 'Docente' && !isset($_POST['crud']) ) {

  $group = $group_controller->get($_POST['group_id']);

  if( empty($group) ) {

    $template =
    '<article class="datos-usuario">
        <h2 class="datos">No existe El grupo de nombre<b>%s</b></h2>
    </article>
    <script>
        window.onload = function() {
          reloadPage("groups")
        }
    </script>';
  printf($template, $_POST['group_name']);
} else {
  $template_group =
  '<div class="contenedor-login">
      <h2 class="login  delete">Eliminar Grupo</h2>
      <form class="login-crud"  method="POST">
          <div class="caja">
            <h2 class="delete-crud">¿Estás seguro que quieres eliminar el grupo <b>%s</b>?</h2>
          </div>
          <div class="caja">
            <input type="submit" class="button delete" value="Sí">
            <input type="button" class="button add" value="No" onclick="history.back()">
            <input type="hidden" name="group_id" value="%s">
            <input type="hidden" name="r" value="group-delete">
            <input type="hidden" name="crud" value="del">
          </div>
      </form>
  </div>';
  printf(
    $template_group,
    $group[0]['group_name'],
    $group[0]['group_id']
  );

}

} else if ($_POST['r'] == 'group-delete'  && $_SESSION['role'] == 'Docente' && $_POST['crud'] == 'del' ) {

  $delete_group = $_POST['group_id'];

  $group = $group_controller->del($delete_group);

  $template =
    '<article class="datos-usuario">
        <h2 class="datos  delete">El grupo <b>%s</b> ha sido eliminado</h2>
    </article>
    <script>
        window.onload = function() {
          reloadPage("groups")
        }
    </script>';

    printf($template, $_POST['group_id']);
} else {
  $controller = new ViewController();
  $controller->load_view('error401');
}
