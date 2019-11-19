<!-- Homepage del progetto -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Riserva subito un alloggio!</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.min.css" rel="stylesheet">
</head>

<!-- Contenuto visivo della pagina -->

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
            <li class="nav-item active">
              <a class="nav-link waves-effect" href="#">Tutte le strutture
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link waves-effect" href="amministratore-gerente.php">Amministratore gerente</a>
            </li>
            <li class="nav-item">
              <a class="nav-link waves-effect" href="amministratore.php">Amministratore</a>
            </li>
          </ul>

          <!-- Right -->
          <ul class="navbar-nav nav-flex-icons">
            <?php
            //Imposto il charset.
            header("Content-Type: text/html; charset=ISO-8859-1");
            //Metodo che impedisce a tutto quello che segue di essere stampato a schermo.
            ob_start();
            //Includo il file che esegue il login.
            include('login.php');
            //Metodo che torna a permette di stampare tutto quello che segue.
            ob_end_clean();
            //Stampo il bottone per il logout se l'utente ha effettuato il login.
            if (!isset($_SESSION['loggedin'])) :
              ?>
            <li class="nav-item">
              <a href="signup.php" class="nav-link border border-light rounded waves-effect">
                <i class="fas fa-user-plus"></i>Registrati
              </a>
            </li>&nbsp;
            <li class="nav-item">
              <a href="login.php" class="nav-link border border-light rounded waves-effect">
                <i class="fas fa-sign-in-alt"></i>Login
              </a>
            </li>&nbsp;
            <?php endif; ?>
            <?php
            if (isset($_SESSION['loggedin'])) :
              ?>
              <li class="nav-item">
                <a href="logout.php" class="nav-link border border-light rounded waves-effect">
                  <i class="fas fa-sign-out-alt"></i>Logout
                </a>
              </li>
            <?php endif; ?>
          </ul>

        </div>

      </div>
    </nav>
    <!-- Navbar -->

  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main class="mt-5 pt-5">
    <div class="container">

      <!--Section: Cards-->
      <section class="pt-5">

        <!-- Heading & Description -->
        <div class="wow fadeIn">
          <!--Section heading-->
          <?php
          ob_start();
          //Includo il file che esegue il login.
          include('login.php');
          ob_end_clean();
          //Se l'utente esegue il login cambio il messaggio di benvenuto.
          if (isset($_SESSION['loggedin'])) :
            ?>
            <h2 class="h1 text-center mb-5">Ciao <?php echo $_SESSION['name']; ?>, hai effettuato correttamente l'accesso. Cerca un alloggio</h2>
          <?php else : ?>
            <h2 class="h1 text-center mb-5">Cerca un alloggio </h2>
          <?php endif; ?>
          <!--Section description-->
        </div>
        <!-- Heading & Description -->

        <!-- Stampo la barra di ricerca dell'alloggio con i filtri. -->
        <div class="container" id="applyCSS">
          <div class="row">
            <div class="col-md-12">
              <div class="input-group" id="adv-search">
                <input type="text" class="form-control" placeholder="Cerca un alloggio" />
                <div class="input-group-btn">
                  <div class="btn-group" role="group">
                    <div class="dropdown dropdown-lg">
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                      <div class="dropdown-menu dropdown-menu-right" role="menu">
                        <form class="form-horizontal" action="index.php" role="form" method="post">
                          <h3>Filtri</h3>
                          <div class="form-group">
                            <label for="tipologia">Tipologia</label>
                            <select class="form-control" name="tipologia" id="selectTipologia">
                              <option value="Qualsiasi" <?php if (isset($_POST['tipologia']) && $_POST['tipologia'] == "Qualsiasi") {
                                                          echo "selected";
                                                        }  ?>>Qualsiasi</option>
                              <option value="Albergo" <?php if (isset($_POST['tipologia']) && $_POST['tipologia'] == "Albergo") {
                                                        echo "selected";
                                                      } ?>>Albergo</option>
                              <option value="Bed & Breakfast" <?php if (isset($_POST['tipologia']) && $_POST['tipologia'] == "Bed & Breakfast") {
                                                                echo "selected";
                                                              } ?>>Bed & Breakfast</option>
                              <option value="Camping" <?php if (isset($_POST['tipologia']) && $_POST['tipologia'] == "Camping") {
                                                        echo "selected";
                                                      } ?>>Camping</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="contain">Regione</label>
                            <input class="form-control" name="regione" type="text" />
                          </div>
                          <div class="form-group">
                            <label for="contain">Citt&#224;</label>
                            <input class="form-control" name="citta" type="text" />
                          </div>
                          <div class="form-group">
                            <label for="contain">Nome gerente della struttura</label>
                            <input class="form-control" name="nome_gerente" type="text" />
                          </div>
                          <button type="button" class="btn btn-primary applica-filtro float-right">Applica</button>
                        </form>
                      </div>
                    </div>
                    <button type="button" class="btn btn-primary cerca" onclick="this.form.submit()"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div><br><br>

    <?php

    //Prendo il valore del filtro della tipologia.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //Imposto la tipologia selezionata in una variabile se la tipologia non è "Qualsiasi".
      if ($_POST["tipologia"] != "Qualsiasi") {
        $tipologia = $_POST["tipologia"];
      }
      if (isset($_POST["regione"])) {
        $regione = $_POST["regione"];
      }
      if (isset($_POST["citta"])) {
        $citta = $_POST["citta"];
      }
      if (isset($_POST["nome_gerente"])) {
        $nome_gerente = $_POST["nome_gerente"];
      }
    }

    ob_start();
    //Includo il file che esegue la connessione al database.
    include('server.php');
    ob_end_clean();
    //Preparo la query per prendere l'id più grande così da sapere il numero di alloggi da stampare.
    $get_max_id = "SELECT id FROM alloggio ORDER BY id DESC LIMIT 1";
    $stmt = $db->prepare($get_max_id);
    $stmt->execute();
    $max_id = implode($stmt->fetch(PDO::FETCH_ASSOC));
    //Ciclo che viene eseguito in base al numero di alloggi presenti e che stampa gli alloggi. 
    for ($i = 1; $i < $max_id + 1; $i++) {
      //Se viene utiilizzato un filtro per la tipologia utilizzo una certa query.
      if (isset($tipologia)) {
        if (isset($regione)) {
          if (isset($citta)) {
            if (isset($nome_gerente)) {

            }
            else{
              continue;
            }
          }
          else{
            continue;
          }
        }
        else{
          continue;
        }
        $accomodation_query = "SELECT id FROM alloggio WHERE id = $i AND nome_tipologia = '$tipologia' LIMIT 1";
        $stmt = $db->prepare($accomodation_query);
        $stmt->execute();
        //Se eseguendo la query viene trovata una riga, prepare una nuova query.
        if ($stmt->rowCount() > 0) {
          $id = implode($stmt->fetch(PDO::FETCH_ASSOC));
          $accomodation_query = "SELECT * FROM alloggio WHERE id = $id LIMIT 1";
        }
        //Altrimenti interrompo la corrente iterazione e passo alla prossima.
        else {
          continue;
        }
      }
      //Altrimenti uso la query di "default".
      else {
        $accomodation_query = "SELECT * FROM alloggio WHERE id = $i LIMIT 1";
      }
      $stmt = $db->prepare($accomodation_query);
      //Eseguo la query.
      $stmt->execute();
      $row = $stmt->fetch();
      //Salvo alcune variabili utili.
      $nome = $row["nome"];
      $indirizzo = $row["indirizzo"];
      $link_immagine = $row["link_immagine"];
      $regione = $row["regione"];
      $citta = $row["citta"];
      $email_gerente = $row["email_gerente"];
      $nome_tipologia = $row["nome_tipologia"];
      //Stampo un alloggio.
      echo '<div class="row wow fadeIn">
                <div class="col-lg-5 col-xl-4 mb-4">
                  <div class="view overlay rounded z-depth-1">
                    <img src="' . $link_immagine . '" class="img-fluid" alt="">
                    <a href="#" target="_blank">
                      <div class="mask rgba-white-slight"></div>
                    </a>
                  </div>
                </div>
                
                <div class="col-lg-7 col-xl-7 ml-xl-4 mb-4">
                  <h3 class="mb-3 font-weight-bold dark-grey-text">
                    <strong>' . $nome . '</strong>
                  </h3>
                  <p>
                    <strong>' . $indirizzo . '</strong>
                  </p>
                    <p class="grey-text">' . $citta . ', ' . $regione . '</p>
                  <a href="#" target="_blank" class="btn btn-primary btn-md">Mostra dettagli
                    <i class="fas fa-play ml-2"></i>
                  </a>
                </div>
              </div>
              <hr class="mb-5">';
    }

    ?>


    <!--Pagination-->
    <nav class="d-flex justify-content-center wow fadeIn">
      <ul class="pagination pg-blue">

        <!--Arrow left-->
        <li class="page-item disabled">
          <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>

        <li class="page-item active">
          <a class="page-link" href="#">1
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">2</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">3</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">4</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">5</a>
        </li>

        <li class="page-item">
          <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      </ul>
    </nav>
    <!--Pagination-->

    </section>
    <!--Section: Cards-->

    </div>
  </main>
  <!--Main layout-->

  <!--Footer-->
  <footer class="page-footer text-center font-small mdb-color darken-2 mt-4 wow fadeIn">

    <hr class="my-4">

    <!-- Social icons -->
    <div class="pb-4">
      <a href="https://www.facebook.com/mattia.lazzaroni.92" target="_blank">
        <i class="fab fa-facebook-f mr-3"></i>
      </a>

      <a href="https://github.com/mattialazzaroni" target="_blank">
        <i class="fab fa-github mr-3"></i>
      </a>

      <a href="http://instagram.com/mattia.lazza" target="_blank">
        <i class="fab fa-instagram mr-3"></i>
      </a>
    </div>
    <!-- Social icons -->

    <!--Copyright-->
    <div class="footer-copyright py-3">
      © 2019 Copyright:
      <a class="copyright" href="https://samtinfo.ch/i16lazmat/web" target="_blank"> Mattia Lazzaroni </a>
    </div>
    <!--/.Copyright-->

  </footer>
  <!--/.Footer-->

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