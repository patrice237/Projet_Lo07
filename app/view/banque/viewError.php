<!-- ----- début viewError -->
<?php
require($root . '/app/view/fragment/fragmentPatrimoineHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentPatrimoineAdministrateurMenu.html';
    include $root . '/app/view/fragment/fragmentPatrimoineJumbotron.html';
    ?>
    <!-- ===================================================== -->
    <h2>Erreur lors de l'insertion d'une nouvelle banque</h2>
    <p>Vous devez remplir les deux champs : <strong>Nom de la banque</strong> et <strong>Pays</strong>.</p>
    <p><a href="javascript:history.back()" class="btn btn-primary">Retourner au formulaire</a></p>
  </div>
  <?php include $root . '/app/view/fragment/fragmentPatrimoineFooter.html'; ?>
</body>
<!-- ----- fin viewError -->
