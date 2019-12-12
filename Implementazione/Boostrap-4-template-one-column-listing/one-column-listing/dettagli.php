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
            } else {
                $_SESSION['checkin'] = date("Y-m-d", strtotime($_POST['checkin']));
            }
        }

        if (empty($checkout)) {
            array_push($errors, "La data del check-out &egrave; richiesta");
        } else {
            if (!empty($checkin)) {
                if (strtotime($checkout) < strtotime($checkin)) {
                    array_push($errors, "La data del check-in deve essere prima del check-out");
                } else {
                    $_SESSION['checkout'] = date("Y-m-d", strtotime($_POST['checkout']));
                }
            }
        }

        if (empty($adulti) && strlen($adulti) == 0) {
            array_push($errors, 'Il numero di adulti &egrave; richiesto (in caso di assenza, inserire "0")');
        } else {
            $_SESSION['adulti'] = $_POST['adulti'];
        }

        if (empty($bambini) && strlen($bambini) == 0) {
            array_push($errors, 'Il numero di bambini &egrave; richiesto (in caso di assenza, inserire "0")');
        } else {
            $_SESSION['bambini'] = $_POST['bambini'];
        }
    }

    $typeDate = "(this.type='date')";
    //All'apertura della pagina tramite invio di form o all'invio del form della seguente pagina.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //Stampo l'alloggio.
        echo '<div class="row wow fadeIn text-center" style="margin-top:12.5vh;">
        
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

            <!-- Contenuto visivo della pagina con form di riservazione -->
            <article class="card-body" style="max-width:450px">
                <form method="post" action="dettagli.php" id="formRiservazione">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fas fa-calendar-alt"></i> </span>
                        </div>
                        <input name="checkin" class="form-control" placeholder="Check-in" type="text" onfocus="' . $typeDate . '" value="' . $checkin . '" title="Data del Check-in">
                        <input name="checkout" class="form-control" placeholder="Check-out" type="text" onfocus="' . $typeDate . '" value="' . $checkout . '" title="Data del Check-out">
                    </div> <!-- form-group// -->
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fas fa-child"></i> </span>
                        </div>
                        <input name="adulti" class="form-control" placeholder="Inserisci il numero di adulti" type="number" min="0" value="' . $adulti . '" title="Numero di adulti">
                    </div> <!-- form-group// -->
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fas fa-baby"></i> </span>
                        </div>
                        <input name="bambini" class="form-control" placeholder="Inserisci il numero di bambini" type="number" min="0" value="' . $bambini . '" title="Numbero di bambini">
                    </div> <!-- form-group// -->
                    <button type="submit" name="cercaDisponibilita" class="btn btn-primary btn-block"> Cerca disponibilit&agrave; </button>';
        //In caso di errori, vado a stamparli quando il bottone viene premuto.
        if (count($errors) > 0) {
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

    if(isset($_POST['cercaDisponibilita'])){
        if (count($errors) == 0) {
            ob_start();
            //Includo il file che esegue la connessione al database.
            include('server.php');
            ob_end_clean();

            $reservation_query = "SELECT camera.id,
            camera.numero_bambini,
            camera.numero_adulti,
            camera.email_gerente
            FROM amministratore_gerente
            JOIN alloggio ON amministratore_gerente.email = alloggio.email_gerente 
            JOIN camera ON alloggio.id = camera.id_alloggio
            JOIN riservazione ON camera.id = riservazione.id_camera
            WHERE camera.numero_adulti = '" . $_SESSION['adulti'] . "'
            AND camera.numero_bambini = '" . $_SESSION['bambini'] . "'
            AND riservazione.data_checkin <= '" . $_SESSION['checkout'] . "'
            AND riservazione.data_checkout >= '" . $_SESSION['checkin'] . "'";

            $stmt = $db->prepare($reservation_query);
            //Eseguo la query.
            $stmt->execute();
            //Se eseguendo la query viene trovata una riga, preparo una nuova query.
            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch(PDO::FETCH_NUM);
                echo "Per quella data &egrave; stata trovata la camera " . $row[0] . ", per " . $row[1] . " bambini, " . $row[2] . " adulti e gestita dal gerente &quot;" . $row[3] . "&quot;.";
            } else if ($stmt->rowCount() > 1) {
                echo "Per quella data sono disponibili le seguenti camere:<br><br>
                <table class='table table-<striped'>
                    <tr>
                        <th>Numero</th> 
                        <th>Adulti</th>
                        <th>Bambini</th>
                        <th>Gerente</th>
                        <th>Riserva</th>
                    </tr>
                    <tr>";
                    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
                        //${"id" . $i}  = $row[0];
                        //${"email_gerente" . $i} = $row[1];
                        echo "<tr>
                            <td>"
                                . $row[0] . 
                            "</td>
                            <td>"
                                . $row[1] .
                            "</td>
                            <td>"
                                . $row[2] .
                            "</td>
                            <td>"
                                . $row[3] .
                            "</td>
                            <td>
                                <input type='checkbox' name='camera".$row[0]."'>
                            </td>
                        </tr>";
                    }
                echo "</table>";
            } else {
                echo "Nessuna camera disponibile in questa data. Prova con un'altra data! <br><br>";
            }
            unset($stmt);
            unset($row);
        }
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