<?php

$status_controller = new StatusController();

if( $_POST['r'] == 'status-edit' && $_SESSION['role'] == 'Docente' && !isset($_POST['crud']) ) {

  $status = $status_controller->get($_POST['status_id']);

  if( empty($status) ) {

    $template =
    '<article class="datos-usuario">
        <h2 class="datos">El Estado <b>%s</b> ha sido editado</h2>
    </article>
    <script>
        window.onload = function() {
          reloadPage("status")
        }
    </script>';
  printf($template, $_POST['status_id']);
} else {
  $template_status =
  '<div class="contenedor-login">
      <h2 class="login  edit">Editar Estado</h2>
      <form class="login-crud"  method="POST">
          <div class="caja">
            <input type="text" class="text" placeholder="status_id" value="%s" disabled required>
            <input type="hidden" name="status_id" value="%s">
          </div>
          <div class="caja">
            <input type="text" class="text" name="status" value="%s" placeholder="Materia" required>
          </div>
          <div class="caja">
            <input type="submit" class="button edit" value="Editar">
            <input type="hidden" name="r" value="status-edit">
            <input type="hidden" name="crud" value="set">
          </div>
      </form>
  </div>';
  printf(
    $template_status,
    $status[0]['status_id'],
    $status[0]['status_id'],
    $status[0]['status']
  );

}

} else if ($_POST['r'] == 'status-edit'  && $_SESSION['role'] == 'Docente' && $_POST['crud'] == 'set' ) {

  $save_status = array(
    'status_id' => $_POST['status_id'],
    'status' => $_POST['status']
  );

  $status = $status_controller->set($save_status);

  $template =
    '<article class="datos-usuario">
        <h2 class="datos edit">El estado <b>%s</b> ha sido editado</h2>
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
