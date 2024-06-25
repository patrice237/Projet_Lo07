
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
      
      <label for="id"> </label> 
    <table class = "table table-striped table-bordered">
      <thead>
        <tr>
          <th scope = "col">Prénom</th>
          <th scope = "col">Nom</th>
          <th scope = "col">Compte</th>
        </tr>
      </thead>
      <tbody>
         <?php
          // La liste des vins est dans une variable $results             
          foreach ($results as $element) {
           printf("<tr><td>%s</td><td>%s</td><td>%s</td></tr>", $element[0],$element[1],$element[2]);
          }
          ?>
      </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentPatrimoineFooter.html'; ?>

  <!-- ----- fin viewAll -->
  
  
  