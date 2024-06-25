
<!-- ----- début viewInsert -->
 
<?php 
require ($root . '/app/view/fragment/fragmentPatrimoineHeader.html');
?>

<body>
  <div class="container">
    <?php
        include $root . '/app/view/fragment/fragmentPatrimoineClientMenu.html';
      include $root . '/app/view/fragment/fragmentPatrimoineJumbotron.html';
    ?> 
      <h2> Formulaire de transfert d'argent </h1>
    <form role="form" method='get' action='router2.php'>
      <input type="hidden" name='action' value='transfertcontrol'> 
      <div class="mb-3">
        <label for="source_account" class="form-label">Compte source </label>
       <select id="source_account" name="source_account" class="form-select" aria-label="Selectionner compte source">
            <?php
            foreach ($results as $element) {
                echo "<option value='".$element['id']."'>".$element['label']." (".$element['montant'].")</option>";
            }
            ?>
        </select>
      </div>
       <div class="mb-3">
        <label for="destination_account" class="form-label">Compte destinataire </label>
        <select id="destination_account" name="destination_account" class="form-select" aria-label="Selectionner compte destinataire">
            <?php
            foreach ($results as $element) {
                echo "<option value='".$element['id']."'>".$element['label']." (".$element['montant'].")</option>";
            }
            ?>
        </select>
      </div>
      <div>
        <label for="montant" class="form-label">Montant</label>
        <input type="number" class="form-control" name="montant" value="100">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentPatrimoineFooter.html'; ?>

<!-- ----- fin viewInsert -->



