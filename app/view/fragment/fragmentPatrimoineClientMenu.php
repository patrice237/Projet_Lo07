
<!-- ----- début fragmentCaveMenu -->

<nav class="navbar navbar-expand-lg bg-success fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="router2.php?action=PatrimoineAccueil">MBANGUE-TAKAM|Administrateur|Boss|</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Mes comptes bancaires</a>
          <ul class="dropdown-menu">
              
            <li><a class="dropdown-item" href="router2.php?action=compteReadAll">Liste de mes comptes</a></li>
            <li><a class="dropdown-item" href="router2.php?action=compteAdd">Ajouter  un nouveau compte</a></li>
            <li><a class="dropdown-item" href="router2.php?action=compteTransfert">Transfert inter-compte</a></li>
          </ul>
          
        </li>
       
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Mes résidences</a>
          <ul class="dropdown-menu">
              
            <li><a class="dropdown-item" href="router2.php?action=producteurReadAll">Liste de mes résidences </a></li>
            <li><a class="dropdown-item" href="router2.php?action=producteurReadId">Achat d'une nouvelle résidence </a></li>
       
            
          </ul>
        </li>
             
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Mon patrimoine</a>
          <ul class="dropdown-menu">
              
            <li><a class="dropdown-item" href="router2.php?action=producteurReadAll">Bilan de mon patrimoine </a></li>
       
            
          </ul>
        </li>
  
         <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Innovations</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="router2.php?action=producteurReadAll">Innovation 1</a></li>
            <li><a class="dropdown-item" href="router2.php?action=producteurReadAll">Innovation 2</a></li>

          </ul>
        </li>
           
         <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Se connecter</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="router2.php?action=vinReadAll">Login</a></li>
            <li><a class="dropdown-item" href="router2.php?action=vinReadId">S'inscrire</a></li>
            <li><a class="dropdown-item" href="router2.php?action=vinCreate">Deconnexion</a></li> 
          </ul>
        </li>
        
        </li>
      </ul>
    </div>
  </div>
</nav> 

<!-- ----- fin fragmentPatrimoineMenu -->

