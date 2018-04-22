<?php

if( $_POST['r'] == 'signature-add' && $_SESSION['role'] == 'Docente' && !isset($_POST['crud']) ) {
  print('
  <div class="contenedor-login">
      <h2 class="login  add">Agregar Materia</h2>
      <form class="login-crud"  method="POST">
          <div class="caja">
            <input type="text" class="text" name="signature" placeholder="Materia" required>
          </div>
          <div class="caja">
            <input type="submit" class="button add" value="Agregar">
            <input type="hidden" name="r" value="signature-add">
            <input type="hidden" name="crud" value="set">
          </div>
      </form>
  </div>'
  );
} else if ($_POST['r'] == 'signature-add'  && $_SESSION['role'] == 'Docente' && $_POST['crud'] == 'set' ) {
  $signature_controller = new SignaturesController();

  $new_signature = array(
    'signature_id' => 0,
    'signature' => $_POST['signature']
  );

  $signature = $signature_controller->set($new_signature);

  $template =
    '<article class="datos-usuario">
        <h2 class="datos">La asignatura <b>%s</b> ha sido agregada</h2>
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
