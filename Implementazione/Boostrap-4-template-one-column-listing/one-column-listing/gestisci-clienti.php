<?php
header("Content-Type: text/html; charset=ISO-8859-1");
ob_start();
//Includo il file amministratore-gerente.php.
include('amministratore-gerente.php');
//Metodo che torna a permette di stampare tutto quello che segue.
ob_end_clean();
?>

<!-- Pagina che viene mostrata quando l'utente si è registrato e deve verificare il suo account -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Gestisci clienti</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.min.css" rel="stylesheet">
    <script src="js/jquery-3.4.1.min.js"></script>
</head>

<body class="container-fluid">

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
                            <a class="nav-link waves-effect" href="amministratore-gerente.php">Amministratore gerente
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
    if (isset($_SESSION['amministratore_gerente'])) :

        $clienti_query = "";

        $stmt = $db->prepare($clienti_query);

        //$stmt->execute();

        //...


        ?>

        <!-- Contenuto visivo della pagina -->
        <!-- <article class="card-body mx-auto" style="max-width:450px; margin-top:10%;">
            <form id="formDisponibilita" method="post" action="gestisci-clienti.php">
                <h4 class="card-title mt-3 text-center">Gestisci i clienti</h4>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fas fa-child"></i> </span>
                    </div>
                    <input name="adulti" class="form-control" placeholder="Inserisci il numero di adulti" type="number" min="0" value="<?php echo $adulti; ?>" title="Numero di adulti">
                </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fas fa-baby"></i> </span>
                    </div>
                    <input name="bambini" class="form-control" placeholder="Inserisci il numero di bambini" type="number" min="0" value="<?php echo $bambini; ?>" title="Numbero di bambini">
                </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fas fa-home"></i> </span>
                    </div>
                    <input name="nome" class="form-control" placeholder="Inserisci il nome del tuo alloggio" type="text" value="<?php echo $nome; ?>" title="Nome dell&apos;alloggio">
                </div>
                <button id="aggiungi" type="submit" name="aggiungi" class="btn btn-primary btn-block">Aggiungi</button>
                <?php //if (count($errors) > 0) : 
                    ?>
                    <br>
                    <div class="error">
                        <?php //foreach ($errors as $error) : 
                            ?>
                            <p style="color:red"><?php //echo $error 
                                                        ?></p>
                        <?php //endforeach 
                            ?>
                    </div>
                <?php //endif 
                    ?>
            </form>
        </article> -->

    <?php else : ?>
        <!-- Contenuto visivo della pagina -->
        <article class="card-body mx-auto" style="max-width: 450px;">
            <h4 class="card-title mt-3 text-center">Errore!</h4>
            <p class="text-center">Non hai il permesso di accedere a questa pagina.</p>
            <form action="index.php">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block"><a href="index.php"></a> Torna alla home </button>
                </div> <!-- form-group// -->
            </form>
        </article>
    <?php endif; ?>


    <?php
    if (isset($_POST['aggiungi'])) {
        if (count($errors) == 0) {
            ob_start();
            //Includo il file che esegue la connessione al database.
            include('server.php');
            ob_end_clean();

            $room_query = "SELECT camera.id
            FROM camera 
            JOIN alloggio
            ON alloggio.nome = '" . $nome . "'
            WHERE alloggio.email_gerente = '" . $email . "'
            ORDER BY id DESC LIMIT 1";

            $id_query = "SELECT alloggio.id
            FROM alloggio
            WHERE alloggio.nome = '" . $nome . "'
            AND alloggio.email_gerente = '" . $email . "'
            LIMIT 1";

            $stmt = $db->prepare($room_query);
            $stmt1 = $db->prepare($id_query);
            //Eseguo la query.
            $stmt->execute();
            $stmt1->execute();
            //Se eseguendo la query viene trovata una riga, preparo una nuova query.
            if ($stmt->rowCount() == 0) {
                echo "<br><div class='error text-center'>
                        <p style='color:red'>Non possiedi nessun alloggio con quel nome. Controlla la sintassi.</p>
                      </div>";
            } else if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_NUM);
                $row1 = $stmt1->fetch(PDO::FETCH_NUM);
                $nextId = $row[0] + 1;
                $idAlloggio = $row1[0];
                $insert_room_query = "INSERT INTO camera values (" . $nextId . ", " . $bambini . ", " . $adulti . ", " . $idAlloggio . ", '" . $email . "')";
                $stmt = $db->prepare($insert_room_query);
                //Eseguo la query.
                $stmt->execute();
                echo "<br><div class='text-success text-center'>
                        <p style='color:green'>La camera &egrave; stata aggiunta con successo.</p>
                      </div>";
            }
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