
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
    
    <form role="form" method='get' action='router2.php'>
      <div class="form-group">
        <input type="hidden" name='action' value='compteAdded'>
        
        <label for="">Formulaire pour l'ajout d'un compte pour </label><br><br>
        <label class='w-25' for="label">Label </label><br><input type="text" name='label' style="width: 400px"> <br/> 
        <label class='w-25' for="montant">Montant </label><br><input type="text" name='montant' style="width: 400px"> <br/>         
        <label class='w-25' for="banque">Sélectionner une banque </label><br>
            <select class="form-control" id='banque' name='banque' style="width: 400px">
        
                <?php
                    foreach ($results as $val) {
                    // Construction de l'option avec id, cru, et annee
                     $optionText = htmlspecialchars($val['label']);
                    echo ("<option value='" . htmlspecialchars($val['label']) . "'>$optionText</option>");
                        }
                       ?> </select> <br/>    
                                      
      </div>
      <p/>
       <br/> 
      <button class="btn btn-primary" type="submit">Go</button>
    </form>
    <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentPatrimoineFooter.html'; ?>

<!-- ----- fin viewInsert -->



