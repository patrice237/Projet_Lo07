<!-- ----- début viewSuccess -->
<?php
require($root . '/app/view/fragment/fragmentPatrimoineHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentPatrimoineClientMenu.html';
        include $root . '/app/view/fragment/fragmentPatrimoineJumbotron.html';
        ?>
        <!-- ===================================================== -->
        <div class="alert alert-success">
            Transfert effectué avec succès.
        </div>

        <div class="details">
            <h3>Détails du transfert</h3>
            <p><strong>Compte source :</strong></p>
            <ul>
                <li>ID : <?php echo $sourceAccountDetails['id']; ?></li>
                <li>Label : <?php echo $sourceAccountDetails['label']; ?></li>
                <li>Montant après transfert : <?php echo $sourceAccountDetails['montant']; ?></li>
            </ul>

            <p><strong>Compte destination :</strong></p>
            <ul>
                <li>ID : <?php echo $destinationAccountDetails['id']; ?></li>
                <li>Label : <?php echo $destinationAccountDetails['label']; ?></li>
                <li>Montant après transfert : <?php echo $destinationAccountDetails['montant']; ?></li>
            </ul>
        </div>
    </div>

<?php
include $root . '/app/view/fragment/fragmentPatrimoineFooter.html';
?>
<!-- ----- fin viewSuccess -->
