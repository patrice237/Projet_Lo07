
<!-- ----- début viewInserted -->
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
    
    <?php
    
    if ($results ==-1) {
      echo ("<h3>Impossible d'effectuer la transaction car un des utilisateurs ne possède pas de compte </h3>");
    }else{
     echo ("<h3>L'achat de la nouvelle propriété a été réaliser avec success </h3>");
    }

    echo("</div>");
    
   include $root . '/app/view/fragment/fragmentPatrimoineFooter.html'; 

    ?>
    <!-- ----- fin viewInserted -->    

    
    