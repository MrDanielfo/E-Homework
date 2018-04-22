<?php

$signature_controller = new SignaturesController();

if( $_POST['r'] == 'signature-delete' && $_SESSION['role'] == 'Docente' && !isset($_POST['crud']) ) {

  $signature = $signature_controller->get($_POST['signature_id']);

  if( empty($signature) ) {

    $template =
    '<article class="datos-usuario">
        <h2 class="datos">No existe la asignatura de nombre<b>%s</b></h2>
    </article>
    <script>
        window.onload = function() {
          reloadPage("signatures")
        }
    </script>';
  printf($template, $_POST['signature']);
} else {
  $template_signature =
  '<div class="contenedor-login">
      <h2 class="login  delete">Eliminar Materia</h2>
      <form class="login-crud"  method="POST">
          <div class="caja">
            <h2 class="delete-crud">¿Estás seguro que quieres eliminar la asignatura <b>%s</b>?</h2>
          </div>
          <div class="caja">
            <input type="submit" class="button delete" value="Sí">
            <input type="button" class="button add" value="No" onclick="history.back()">
            <input type="hidden" name="signature_id" value="%s">
            <input type="hidden" name="r" value="signature-delete">
            <input type="hidden" name="crud" value="del">
          </div>
      </form>
  </div>';
  printf(
    $template_signature,
    $signature[0]['signature'],
    $signature[0]['signature_id']
  );

}

} else if ($_POST['r'] == 'signature-delete'  && $_SESSION['role'] == 'Docente' && $_POST['crud'] == 'del' ) {

  $delete_signature = $_POST['signature_id'];

  $signature = $signature_controller->del($delete_signature);

  $template =
    '<article class="datos-usuario">
        <h2 class="datos  delete">La asignatura <b>%s</b> ha sido eliminada</h2>
    </article>
    <script>
        window.onload = function() {
          reloadPage("signatures")
        }
    </script>';

    printf($template, $_POST['signature_id']);
} else {
  $controller = new ViewController();
  $controller->load_view('error401');
}
