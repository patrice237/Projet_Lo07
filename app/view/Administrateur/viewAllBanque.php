
<!-- ----- début viewAll -->
<?php

require ($root . '/app/view/fragment/fragmentPatrimoineHeader.html');
?>

<body>
  <div class="container">
      <?php
      include $root . '/app/view/fragment/fragmentPatrimoineAdministrateurMenu.html';
      include $root . '/app/view/fragment/fragmentPatrimoineJumbotron.html';
      ?>

    <form role="form" method='get' action='router2.php'>
      <div class="form-group">
        <input type="hidden" name='action' value='ReadAllCompteBanque'>
        <label for="id">Sélectionner une Banque dans cette liste : </label> <select class="form-control" id='label' name='label' style="width: 200px">
            <?php
            foreach ($results as $label) {
             echo ("<option>$label</option>");
            }
            ?>
        </select>
      </div>
      <p/><br/>
      <button class="btn btn-primary" type="submit">Submit form</button>
    </form>
    <p/>
  </div>

   <?php include $root . '/app/view/fragment/fragmentPatrimoineFooter.html'; ?>

  <!-- ----- fin viewId -->