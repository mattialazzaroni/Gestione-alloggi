<?php

//Se qualcuno prova ad accedere alla seguente pagina viene portato nel file "errore.php".
if(!isset($errors)){
    header("location: errore.php");
}

//Credenziali per lavorare in locale.

$servername = "localhost";
$username = "root";
$password = "";
$database = "gestione_alloggi";

//Credenziali per lavorare online.
/*
$servername = "efof.myd.infomaniak.com";
$username = "efof_i16lazmat";
$password = "Alloggi_Admin2019";
$database = "efof_i16lazmat";
*/
?>