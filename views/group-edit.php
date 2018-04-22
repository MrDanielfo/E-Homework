<?php

$group_controller = new GroupsController();

if( $_POST['r'] == 'group-edit' && $_SESSION['role'] == 'Docente' && !isset($_POST['crud']) ) {

  $group = $group_controller->get($_POST['group_id']);

  if( empty($group) ) {

    $template =
    '<article class="datos-usuario">
        <h2 class="datos">El grupo <b>%s</b> ha sido editado</h2>
    </article>
    <script>
        window.onload = function() {
          reloadPage("groups")
        }
    </script>';
  printf($template, $_POST['group_id']);
} else {
  $template_group =
  '<div class="contenedor-login">
      <h2 class="login  edit">Editar Grupo</h2>
      <form class="login-crud"  method="POST">
          <div class="caja">
            <input type="text" class="text" placeholder="group_id" value="%s" disabled required>
            <input type="hidden" name="group_id" value="%s">
          </div>
          <div class="caja">
            <input type="text" class="text" name="group_name" value="%s" placeholder="Grupo" required>
          </div>
          <div class="caja">
            <input type="submit" class="button edit" value="Editar">
            <input type="hidden" name="r" value="group-edit">
            <input type="hidden" name="crud" value="set">
          </div>
      </form>
  </div>';
  printf(
    $template_group,
    $group[0]['group_id'],
    $group[0]['group_id'],
    $group[0]['group_name']
  );

}

} else if ($_POST['r'] == 'group-edit'  && $_SESSION['role'] == 'Docente' && $_POST['crud'] == 'set' ) {

  $save_group = array(
    'group_id' => $_POST['group_id'],
    'group_name' => $_POST['group_name']
  );

  $group = $group_controller->set($save_group);

  $template =
    '<article class="datos-usuario">
        <h2 class="datos edit">El grupo <b>%s</b> ha sido editado</h2>
    </article>
    <script>
        window.onload = function() {
          reloadPage("groups")
        }
    </script>';

    printf($template, $_POST['group_name']);
} else {
  $controller = new ViewController();
  $controller->load_view('error401');
}
