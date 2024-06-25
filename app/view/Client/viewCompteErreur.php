<!-- ----- début viewMissingFields -->
<?php
require ($root . '/app/view/fragment/fragmentPatrimoineHeader.html');
?>

<body>
  <div class="container">
    <?php
      include $root . '/app/view/fragment/fragmentPatrimoineClientMenu.html';
      include $root . '/app/view/fragment/fragmentPatrimoineJumbotron.html';
    ?>
    <!-- ===================================================== -->
    <div class="alert alert-danger">
        Tous les champs doivent être remplis.
    </div>
  </div>

<?php
include $root . '/app/view/fragment/fragmentPatrimoineFooter.html';
?>
<!-- ----- fin viewMissingFields -->