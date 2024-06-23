
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
    echo $results;
    if ($results !=-1) {
     echo ("<h3>Le nouveau compte a été ajouté </h3>");
     echo("<ul>");
     echo ("<li>id = " . $results . "</li>");
     echo ("<li>label = " . $_GET['label'] . "</li>");
     echo ("<li>montant = " . $_GET['montant'] . "</li>");
     echo ("<li>banque = " . $_GET['banque'] . "</li>");
     echo("</ul>");
    } else {
     echo ("<h3>Problème d'insertion de la banque</h3>");
     echo ("id = " . $results);
    }

    echo("</div>");
    
   include $root . '/app/view/fragment/fragmentPatrimoineFooter.html'; 

    ?>
    <!-- ----- fin viewInserted -->    

    
    