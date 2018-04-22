<?php

if( $_POST['r'] == 'status-add' && $_SESSION['role'] == 'Docente' && !isset($_POST['crud']) ) {
  print('
  <div class="contenedor-login">
      <h2 class="login  add">Agregar Estado de la Tarea</h2>
      <form class="login-crud"  method="POST">
          <div class="caja">
            <input type="text" class="text" name="status" placeholder="Estado" required>
          </div>
          <div class="caja">
            <input type="submit" class="button add" value="Agregar">
            <input type="hidden" name="r" value="status-add">
            <input type="hidden" name="crud" value="set">
          </div>
      </form>
  </div>'
  );
} else if ($_POST['r'] == 'status-add'  && $_SESSION['role'] == 'Docente' && $_POST['crud'] == 'set' ) {
  $status_controller = new StatusController();

  $new_status = array(
    'status_id' => 0,
    'status' => $_POST['status']
  );

  $status = $status_controller->set($new_status);

  $template =
    '<article class="datos-usuario">
        <h2 class="datos">El Estado <b>%s</b> ha sido agregado</h2>
    </article>
    <script>
        window.onload = function() {
          reloadPage("status")
        }
    </script>';

    printf($template, $_POST['status']);
} else {
  $controller = new ViewController();
  $controller->load_view('error401');
}
