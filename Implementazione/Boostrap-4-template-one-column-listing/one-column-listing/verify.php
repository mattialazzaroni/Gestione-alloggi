<?php
include('server.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Verifica</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.min.css" rel="stylesheet">
</head>

<body class="container-fluid">

    <article class="card-body mx-auto" style="max-width: 450px; margin-top:5%;">
        <h2 class="card-title mt-3 text-center">Il tuo account è stato creato!</h2>
        <p class="text-center">Sei pregato di verificarlo cliccando il link di attivazione che ti è stato mandato per email.</p>
        <img src="img/done.png" style="width:40%; margin-left:auto; margin-right:auto; display:block">
    </article>

    <?php

    if (isset($_GET['email']) && !empty($_GET['email']) and isset($_GET['hash']) && !empty($_GET['hash'])) {
        // Verify data
        $email = mysql_escape_string($_GET['email']); // Set email variable
        $hash = mysql_escape_string($_GET['hash']); // Set hash variable
        $search = mysql_query("SELECT email, hash, active FROM utente WHERE email='" . $email . "' AND hash='" . $hash . "' AND active='0'") or die(mysql_error());
        $match  = mysql_num_rows($search);

        if ($match > 0) {
            mysql_query("UPDATE utente SET active='1' WHERE email='" . $email . "' AND hash='" . $hash . "' AND active='0'") or die(mysql_error());
            echo '<div class="statusmsg text-center">Il tuo account è stato attivato, ora puoi fare il login.</div>';
        } else { 
            echo "<div class='statusmsg text-center'>L'URL non è valido o hai già attivato il tuo account.</div>";
        }
    } else {
        // Invalid approach
        echo '<div class="statusmsg text-center">Approccio non valido, si prega di utilizzare il link che è stato inviato alla tua email.</div>';
    }

    ?>

</body>

</html>