
<?php
session_start();
$_SESSION['login']='';
header('Location: app/router/router2.php?action=truc');

?>
