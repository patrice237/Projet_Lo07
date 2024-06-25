<!-- ----- début viewSameAccount -->
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
        Les comptes source et destination doivent être différents.

    </div>
  </div>

<?php
include $root . '/app/view/fragment/fragmentPatrimoineFooter.html';
?>
<!-- ----- fin viewSameAccount -->