
<!-- ----- début viewInsert -->
 
<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require ($root . '/app/view/fragment/fragmentPatrimoineHeader.html')
?>

<body>
  <div class="container">
    <?php
      include $root . '/app/view/fragment/fragmentPatrimoineClientMenu.html';
      include $root . '/app/view/fragment/fragmentPatrimoineJumbotron.html';
      ?>
    
    <form role="form" method='get' action='router2.php'>
      <div class="form-group">
        <input type="hidden" name='action' value='validationPaye'>
        
        <label for="">Achat de la résidence </label><br><br>
        <label class='w-25' for="acheteur">Sélectionner un compte de l'acheteur </label><br>
            <select class="form-control" id='compte_a' name='compte_a' style="width: 400px">
        
                <?php
                    foreach ($results['acheteur'] as $val) {
                    
                        $optionText = htmlspecialchars($val['a']);
                    echo ("<option value='" . htmlspecialchars($val['a']) . "'>$optionText</option>");
                        
                    if($val['id_a']!=''){
                        $_SESSION['id_a']=$val['id_a'];
                        
                    }else{
                        $_SESSION['id_a']='';
                    }
                    
                    }
                        
                      
                       ?> </select> <br/>
        
        <label class='w-25' for="vendeur">Sélectionner un compte du vendeur </label><br>
        <select class="form-control" id='compte_v' name='compte_v' style="width: 400px">
        
                <?php
                    foreach ($results['vendeur'] as $val) {
                    // Construction de l'option avec id, cru, et annee
                     $optionText = htmlspecialchars($val['v']);
                    echo ("<option value='" . htmlspecialchars($val['v']) . "'>$optionText</option>");
                        
                    if($val['id_v']!=''){
                        $_SESSION['id_v']=$val['id_v'];
                    }else{
                        $_SESSION['id_v']='';
                    }
                    }
                       ?> </select> <br/>
                                     
        <label class='w-25' for="prix">Prix de la résidence </label><br>
        <input type="text" name='prix' value="<?php  echo htmlspecialchars($results['prix']); ?>" > <br/> 
      </div>
      <p/>
       <br/> 
      <button class="btn btn-primary" type="submit">Go</button>
    </form>
    <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentPatrimoineFooter.html'; ?>

<!-- ----- fin viewInsert -->



