
<!-- ----- début viewInsert -->
 
<?php 
require ($root . '/app/view/fragment/fragmentPatrimoineHeader.html');
?>

<body>
  <div class="container">
    <?php
        include $root . '/app/view/fragment/fragmentPatrimoineAdministrateurMenu.html';
      include $root . '/app/view/fragment/fragmentPatrimoineJumbotron.html';
    ?> 
      <h2> Formulaire pour l'ajour d'une banque par l'administrateur </h1>
    <form role="form" method='get' action='router2.php'>
      <input type="hidden" name='action' value='banqueCreated'> 
      <div class="mb-3">
        <label for="labelBanque" class="form-label">Label</label>
        <input type="text" class="form-control" name="labelBanque" value="Credit agricole de Troyes">
      </div>
      <div class="mb-3">
        <label for="pays" class="form-label">Pays</label>
        <input type="text" class="form-control" name="pays" value="France">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentPatrimoineFooter.html'; ?>

<!-- ----- fin viewInsert -->



