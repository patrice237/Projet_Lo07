
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
        <input type="hidden" name='action' value='buyResidence'>
        
        <label for="">Sélection d'une résidence pour un achat </label><br><br>
        <label class='w-25' for="banque">Sélectionnez une résidence </label><br>
            <select class="form-control" id='id' name='id' style="width: 400px">
        
                <?php
                    foreach ($results as $val) {
                    // Construction de l'option avec id, cru, et annee
                     $optionText = htmlspecialchars($val['label']);
                    echo ("<option value='" . htmlspecialchars($val['id']) . "'>$optionText</option>");
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



