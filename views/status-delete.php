<?php

$status_controller = new StatusController();

if( $_POST['r'] == 'status-delete' && $_SESSION['role'] == 'Docente' && !isset($_POST['crud']) ) {

  $status = $status_controller->get($_POST['status_id']);

  if( empty($status) ) {

    $template =
    '<article class="datos-usuario">
        <h2 class="datos">No existe el estado de nombre<b>%s</b></h2>
    </article>
    <script>
        window.onload = function() {
          reloadPage("status")
        }
    </script>';
  printf($template, $_POST['status']);
} else {
  $template_status =
  '<div class="contenedor-login">
      <h2 class="login  delete">Eliminar Estado</h2>
      <form class="login-crud"  method="POST">
          <div class="caja">
            <h2 class="delete-crud">¿Estás seguro que quieres eliminar el estado <b>%s</b>?</h2>
          </div>
          <div class="caja">
            <input type="submit" class="button delete" value="Sí">
            <input type="button" class="button add" value="No" onclick="history.back()">
            <input type="hidden" name="status_id" value="%s">
            <input type="hidden" name="r" value="status-delete">
            <input type="hidden" name="crud" value="del">
          </div>
      </form>
  </div>';
  printf(
    $template_status,
    $status[0]['status'],
    $status[0]['status_id']
  );

}

} else if ($_POST['r'] == 'status-delete'  && $_SESSION['role'] == 'Docente' && $_POST['crud'] == 'del' ) {

  $delete_status = $_POST['status_id'];

  $status = $status_controller->del($delete_status);

  $template =
    '<article class="datos-usuario">
        <h2 class="datos  delete">El estado <b>%s</b> ha sido eliminado</h2>
    </article>
    <script>
        window.onload = function() {
          reloadPage("status")
        }
    </script>';

    printf($template, $_POST['status_id']);
} else {
  $controller = new ViewController();
  $controller->load_view('error401');
}
