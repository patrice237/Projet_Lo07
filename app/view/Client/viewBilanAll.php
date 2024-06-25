
<!-- ----- début viewAll -->
<?php

require ($root . '/app/view/fragment/fragmentPatrimoineHeader.html');
?>

<body>
  <div class="container">
      <?php
      include $root . '/app/view/fragment/fragmentPatrimoineClientMenu.html';
      include $root . '/app/view/fragment/fragmentPatrimoineJumbotron.html';
      ?>
      
      <label for="id">Patrimoine de  </label><br> 
    <table class = "table table-striped table-bordered">
      <thead>
        <tr>
          <th scope = "col">Catégorie</th>
          <th scope = "col">Label</th>
          <th scope = "col">Valeur</th>
          <th scope = "col">Capital</th>
        </tr>
      </thead>
      <tbody>
         <?php
          $s=0;
          $couleurFond = '#ccffcc';
          foreach ($results['compte'] as $element) {
               $s=$s+$element[1];
         echo sprintf('<tr style="background-color: %s;"><td>Compte</td><td>%s</td><td>%d</td><td>%d</td></tr>',$couleurFond, $element[0], $element[1], $s);

          }
          ?>
          <?php
          $s=0;
          $couleurFondBleu = '#cceeff';
          foreach ($results['residence'] as $element) {
              $s=$s+$element[1];
           echo sprintf('<tr style="background-color: %s;"><td>Compte</td><td>%s</td><td>%d</td><td>%d</td></tr>', $couleurFondBleu, $element[0], $element[1], $s);

          }
          ?>
      </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentPatrimoineFooter.html'; ?>

  <!-- ----- fin viewAll -->
  
  
  