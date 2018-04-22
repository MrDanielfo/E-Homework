<?php

print('<h1 class="titulos">Materias</h1>');

$signatures_controller = new SignaturesController();

$signatures = $signatures_controller->get();

if( empty($signatures) ) {
  print('
    <article class="datos-usuario">
        <p class="datos-acerca">No hay materias</p>
    </article>
  ');
} else {

$template_signatures = '
  <div class="agregar">
    <form method="POST">
      <input type="hidden" name="r" value="signature-add">
      <input class="button add" type="submit" value="Agregar Materia">
    </form>
  </div>
  <table class="registros">
      <tr>
        <th>Id</th>
        <th>Materia</th>
        <th colspan="2">Opciones</th>
      </tr> ';
    for($n = 0; $n < count($signatures); $n++ ) {
      $template_signatures .=
      '<tr>
        <td>'. $signatures[$n]['signature_id']. '</td>
        <td>'. $signatures[$n]['signature'] .'</td>
        <td>
            <form method="POST">
              <input type="hidden" name="r" value="signature-edit">
              <input type="hidden" name="signature_id" value="'. $signatures[$n]['signature_id'] .'">
              <input class="button edit" type="submit" value="Editar">
            </form>
        </td>
        <td>
            <form method="POST">
              <input type="hidden" name="r" value="signature-delete">
              <input type="hidden" name="signature_id" value="'. $signatures[$n]['signature_id'] .'">
              <input class="button delete" type="submit" value="Eliminar">
            </form>
        </td>
      </tr>';
    }

  $template_signatures .= '
  </table>';

  print($template_signatures);

}
