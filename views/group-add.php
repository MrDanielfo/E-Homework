<?php

if( $_POST['r'] == 'group-add' && $_SESSION['role'] == 'Docente' && !isset($_POST['crud']) ) {
  print('
  <div class="contenedor-login">
      <h2 class="login  add">Agregar Grupo</h2>
      <form class="login-crud"  method="POST">
          <div class="caja">
            <input type="text" class="text" name="group_name" placeholder="Grupo" required>
          </div>
          <div class="caja">
            <input type="submit" class="button add" value="Agregar">
            <input type="hidden" name="r" value="group-add">
            <input type="hidden" name="crud" value="set">
          </div>
      </form>
  </div>'
  );
} else if ($_POST['r'] == 'group-add'  && $_SESSION['role'] == 'Docente' && $_POST['crud'] == 'set' ) {
  $group_controller = new GroupsController();

  $new_group = array(
    'group_id' => 0,
    'group_name' => $_POST['group_name']
  );

  $group = $group_controller->set($new_group);

  $template =
    '<article class="datos-usuario">
        <h2 class="datos">El grupo <b>%s</b> ha sido agregado</h2>
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
