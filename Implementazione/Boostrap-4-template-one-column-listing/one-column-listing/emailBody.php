<?php

//Se qualcuno prova ad accedere alla seguente pagina viene portato nel file "errore.php".
if(!isset($mail)){
    header("location: errore.php");
}

//Body per lavorare in locale.

$body = "Grazie per esserti registrato! <br>
Il tuo account è stato creato, puoi accedere con le seguente credenziali dopo aver attivato l'account. <br>

------------------------ <br>
Email: $email <br>
Password: $pointed_password <br>
------------------------ <br>

Fai clic su questo link per attivare il tuo account: <br>
<a href='http://localhost/verify.php?email=$email&hash=$hash'>http://localhost/verify.php?email=$email&hash=$hash</a>";


//Body per lavorare online.    
/*
$body = "Grazie per esserti registrato! <br>
Il tuo account è stato creato, puoi accedere con le seguente credenziali dopo aver attivato l'account. <br>

------------------------ <br>
Email: $email <br>
Password: $pointed_password <br>
------------------------ <br>

Fai clic su questo link per attivare il tuo account: <br>
<a href='http://samtinfo.ch/gestionealloggi2019/verify.php?email=$email&hash=$hash'>http://samtinfo.ch/gestionealloggi2019/verify.php?email=$email&hash=$hash</a>";
*/
?>