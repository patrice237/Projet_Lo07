
<!-- ----- début fragmentCaveMenu -->

<nav class="navbar navbar-expand-lg bg-success fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="router1.php?action=CaveAccueil">MBANGUE-TAKAM|||</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
         //Banque
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Banques</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="router1.php?action=vinReadAll">Liste des vins</a></li>
            <li><a class="dropdown-item" href="router1.php?action=vinReadId">Sélection d'un vin par son id</a></li>
            <li><a class="dropdown-item" href="router1.php?action=vinCreate">Insertion d'un vin</a></li> 
          </ul>
        </li>
        //Clients
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Clients</a>
          <ul class="dropdown-menu">
              
            <li><a class="dropdown-item" href="router1.php?action=producteurReadAll">Liste des mes comptess</a></li>
            <li><a class="dropdown-item" href="router1.php?action=producteurReadId">Ajouter  un nouveau compte</a></li>
            <li><a class="dropdown-item" href="router1.php?action=producteurCreate">Transfert inter-comptes</a></li>
            
          </ul>
        </li>
        //Innovations
         <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Innovations</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="router1.php?action=producteurReadAll">Liste des producteurs</a></li>

          </ul>
        </li>
                //Se connecter
         <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Se connecter</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="router1.php?action=producteurReadAll">Liste des producteurs</a></li>

          </ul>
        </li>
        
        </li>
      </ul>
    </div>
  </div>
</nav> 

<!-- ----- fin fragmentCaveMenu -->

