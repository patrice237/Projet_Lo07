
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
      
      <label for="id">Liste des comptes de cette banque : <?php echo $results['namebank']; ?> </label> 
    <table class = "table table-striped table-bordered">
      <thead>
        <tr>
          <th scope = "col">Prénom</th>
          <th scope = "col">Nom</th>
          <th scope = "col">Banque</th>
          <th scope = "col">Compte</th>
          <th scope = "col">Montant</th>
        </tr>
      </thead>
      <tbody>
         <?php
          // La liste des vins est dans une variable $results             
          foreach ($results['compte'] as $element) {
           printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%d</td></tr>", $element['prenom'],$element['nom'],
                   $element['label'],$element['lb'],$element['montant']);
          }
          ?>
      </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentPatrimoineFooter.html'; ?>

  <!-- ----- fin viewAll -->
  
  
  