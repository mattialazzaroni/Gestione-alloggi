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

    <?php

    if (isset($_GET['email']) && !empty($_GET['email']) and isset($_GET['hash']) && !empty($_GET['hash'])) {
        // Verify data
        $email = $_GET['email']; // Set email variable
        $hash = $_GET['hash']; // Set hash variable
        $search = $db->prepare("SELECT email, hash, active FROM utente WHERE email=:email AND hash=:hash AND active='0'");
        $search->bindParam(":email", $email, PDO::PARAM_STR);
        $search->bindParam(":hash", $hash, PDO::PARAM_STR);
        $search->execute();
        $match = $search->rowCount();

        if ($match > 0) {
            $update = $db->prepare("UPDATE utente SET active='1' WHERE email='" . $email . "' AND hash='" . $hash . "' AND active='0'");
            $update->execute();
            echo '<div class="form-group text-center card-body mx-auto" style="max-width:450px;">';
            echo '<br><div><b>Congratulazioni!</b> Il tuo account è stato attivato, ora puoi fare il login.</div><br>';
            echo '<a href="login.php" class="btn btn-primary btn-block"> Torna alla home </a>';
            echo '</div>';
        } else { 
            echo '<div class="form-group text-center card-body mx-auto" style="max-width:450px;">';
            echo "<br><div>L'URL non è valido o hai già attivato il tuo account.</div><br>";
            echo '<a href="index.php" class="btn btn-primary btn-block"> Torna alla home </a>';
            echo '</div>';
        }
    } else {
        // Invalid approach
        echo '<br><div class="text-center">Approccio non valido, si prega di utilizzare il link che è stato inviato alla tua email.</div>';
    }

    ?>

</body>

</html>