<?php
header("Content-Type: text/html; charset=ISO-8859-1");
//Metodo che non permette di stampare il contenuto visivo della pagina index.php
ob_start();
//Includo il file che esegue il login.
include('index.php');
//Metodo che torna a permette di stampare tutto quello che segue.
ob_end_clean();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $_SESSION['nomeDettagli']; ?></title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.min.css" rel="stylesheet">
</head>

<body>


    <!--Main Navigation-->
    <header>

        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
            <div class="container">

                <!-- Brand -->
                <!-- <a class="navbar-brand waves-effect" href="https://mdbootstrap.com/docs/jquery/" target="_blank">
                <strong class="blue-text">Progetto gestione alloggi</strong>
                </a> -->

                <!-- Collapse -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Links -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Left -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link waves-effect" href="index.php">Tutte le strutture
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link waves-effect" href="#">Dettagli
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                    </ul>

                </div>

            </div>
        </nav>
        <!-- Navbar -->

    </header>


    <?php

    //Dichiaro le variabili in modo da poterle stampare da subito nel form senza aspettare che venga premuto il bottone.
    $checkin = "";
    $checkout = "";
    $adulti = "";
    $bambini = "";

    //Se viene premuto il bottone per cercare la disponibilità.
    if (isset($_POST['cercaDisponibilita'])) {
        //Ricevo tutti gli input dal form.
        if (!empty($_POST['checkin'])) {
            $checkin = date("d.m.Y", strtotime($_POST['checkin']));
        }
        if (!empty($_POST['checkout'])) {
            $checkout = date("d.m.Y", strtotime($_POST['checkout']));
        }
        $today = strtotime('now');
        $adulti = $_POST['adulti'];
        $bambini = $_POST['bambini'];

        //Eseguo tutti i controlli sugli input.
        if (empty($checkin)) {
            array_push($errors, "La data del check-in &egrave; richiesta");
        } else {
            if ($today > strtotime($checkin)) {
                array_push($errors, "Non puoi riservare nel passato");
            }
        }

        if (empty($checkout)) {
            array_push($errors, "La data del check-out &egrave; richiesta");
        } else {
            if (!empty($checkin)) {
                if (strtotime($checkout) < strtotime($checkin)) {
                    array_push($errors, "La data del check-in deve essere prima del check-out");
                }
            }
        }

        if (empty($adulti) &&  strlen($adulti) == 0) {
            array_push($errors, 'Il numero di adulti &egrave; richiesto (in caso di assenza, inserire "0")');
        }

        if (empty($bambini) && strlen($bambini) == 0) {
            array_push($errors, 'Il numero di bambini &egrave; richiesto (in caso di assenza, inserire "0")');
        }
    }

    $typeDate = "(this.type='date')";
    //All'apertura della pagina tramite invio di form o all'invio del form della seguente pagina.
    if ($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_POST['cercaDisponibilita'])) {
        //Stampo l'alloggio.
        echo ' <div class="row wow fadeIn text-center" style="margin-top:12.5vh;">
        
        <div class="col-lg-12 col-xl-12 ml-xl-4 mb-4">
          <h3 class="mb-3 font-weight-bold dark-grey-text">
            <strong>' . $_SESSION['nomeDettagli'] . '</strong>
          </h3>
          <p>
            <strong>' . $_SESSION['indirizzoDettagli'] . '</strong>
          </p>
            <p class="grey-text">' . $_SESSION['cittaDettagli'] . ', ' . $_SESSION['regioneDettagli'] . '</p>
        </div>

        <div class="col-lg-6 col-xl-6 mb-4">
            <div class="view overlay rounded z-depth-1">
                <img src="' . $_SESSION['linkImmagineDettagli'] . '" class="img-fluid">
            </div>
        </div>
        <div class="col-lg-6 col-xl-6 mb-4">
            <iframe src="' . $_SESSION['linkMappaDettagli'] . '" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen=""></iframe>

            <!-- Contenuto visivo della pagina con form di login -->
            <article class="card-body" style="max-width:450px">
                <form method="post" action="dettagli.php" id="formRiservazione">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fas fa-calendar-alt"></i> </span>
                        </div>
                        <input name="checkin" class="form-control" placeholder="Check-in" type="text" onfocus="' . $typeDate . '" value="' . $checkin . '">
                        <input name="checkout" class="form-control" placeholder="Check-out" type="text" onfocus="' . $typeDate . '" value="' . $checkout . '">
                    </div> <!-- form-group// -->
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fas fa-child"></i> </span>
                        </div>
                        <input name="adulti" class="form-control" placeholder="Inserisci il numero di adulti" type="number" min="0" value="' . $adulti . '">
                    </div> <!-- form-group// -->
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fas fa-baby"></i> </span>
                        </div>
                        <input name="bambini" class="form-control" placeholder="Inserisci il numero di bambini" type="number" min="0" value="' . $bambini . '">
                    </div> <!-- form-group// -->
                    <button type="submit" name="cercaDisponibilita" class="btn btn-primary btn-block"> Cerca disponibilit&agrave; </button><br>';
                    //In caso di errori, vado a stamparli quando il bottone viene premuto.
                    if(count($errors) > 0){
                        echo '<div class="error">';
                        foreach ($errors as $error) :
                            echo '<p style="color:red">' . $error . '</p>';
                        endforeach;
                        echo '</div>';
                    }
                echo '</form>
            </article>
        </div>';
    }

    ?>

    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Initializations -->
    <script type="text/javascript">
        // Animations initialization
        new WOW().init();
    </script>

</body>

</html>