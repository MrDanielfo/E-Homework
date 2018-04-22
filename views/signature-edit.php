<?php

$signature_controller = new SignaturesController();

if( $_POST['r'] == 'signature-edit' && $_SESSION['role'] == 'Docente' && !isset($_POST['crud']) ) {

  $signature = $signature_controller->get($_POST['signature_id']);

  if( empty($signature) ) {

    $template =
    '<article class="datos-usuario">
        <h2 class="datos">La asignatura <b>%s</b> no existe</h2>
    </article>
    <script>
        window.onload = function() {
          reloadPage("signatures")
        }
    </script>';
  printf($template, $_POST['signature_id']);
} else {
  $template_signature =
  '<div class="contenedor-login">
      <h2 class="login  edit">Editar Materia</h2>
      <form class="login-crud"  method="POST">
          <div class="caja">
            <input type="text" class="text" placeholder="signature_id" value="%s" disabled required>
            <input type="hidden" name="signature_id" value="%s">
          </div>
          <div class="caja">
            <input type="text" class="text" name="signature" value="%s" placeholder="Materia" required>
          </div>
          <div class="caja">
            <input type="submit" class="button edit" value="Editar">
            <input type="hidden" name="r" value="signature-edit">
            <input type="hidden" name="crud" value="set">
          </div>
      </form>
  </div>';
  printf(
    $template_signature,
    $signature[0]['signature_id'],
    $signature[0]['signature_id'],
    $signature[0]['signature']
  );

}

} else if ($_POST['r'] == 'signature-edit'  && $_SESSION['role'] == 'Docente' && $_POST['crud'] == 'set' ) {

  $save_signature = array(
    'signature_id' => $_POST['signature_id'],
    'signature' => $_POST['signature']
  );

  $signature = $signature_controller->set($save_signature);

  $template =
    '<article class="datos-usuario">
        <h2 class="datos edit">La asignatura <b>%s</b> ha sido editada</h2>
    </article>
    <script>
        window.onload = function() {
          reloadPage("signatures")
        }
    </script>';

    printf($template, $_POST['signature']);
} else {
  $controller = new ViewController();
  $controller->load_view('error401');
}
