<?php
//Inizializzo la sessione.
session_start();
 
//Deseleziono tutte le variabili di sessione.
$_SESSION = array();
 
//Distruggo la sessione.
session_destroy();
 
//Reindirizzo alla pagina di login.
header("location: index.php");
exit;
?>