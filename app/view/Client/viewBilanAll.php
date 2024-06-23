
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
          foreach ($results['compte'] as $element) {
           printf("<tr><td>Compte</td><td>%s</td><td>%d</td><td></td></tr>",$element[0],
                   $element[1]);
          }
          ?>
          <?php
          foreach ($results['residence'] as $element) {
           printf("<tr><td>Résidence</td><td>%s</td><td>%d</td><td></td></tr>",$element[0],
                   $element[1]);
          }
          ?>
      </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentPatrimoineFooter.html'; ?>

  <!-- ----- fin viewAll -->
  
  
  