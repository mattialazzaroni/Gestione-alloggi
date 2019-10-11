<?php
session_start();

$errors = array();

$servername = "localhost";
$username = "root";
$password = "";
$database = "gestione_alloggi";

try {
    //Mi connetto al database
    $db = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "Connessione fallita: " . $e->getMessage();
}

if (isset($_POST['reg_user'])) {
    //Ricevo tutti gli input dal form
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $prefix = $_POST['prefix'];
    $number = $_POST['number'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];
    $user_type = $_POST['user_type'];

    //Si controlla il database per assicurarsi che
    //un utente non esiste gà con quella email
    $user_check_query = "SELECT * FROM utente WHERE email='$email' LIMIT 1";
    if($stmt = $db->prepare($user_check_query)){
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $param_email = trim($_POST["username"]);

        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                array_push($errors, "La seguente email è già in uso");
            } else{
                $email = trim($_POST["email"]);
            }
        } else{
            echo "Ops! Qualcosa è andato storto. Riprova più tardi.";
        }
    }
    unset($stmt);

    if (empty($name)) {
        array_push($errors, "Il nome è richiesto");
    }
    if (empty($surname)) {
        array_push($errors, "Il cognome è richiesto");
    }
    if (empty($email)) {
        array_push($errors, "L'email è richiesta");
    }
    if (empty($number)) {
        array_push($errors, "Il numero di telefono è richiesto");
    } else {
        if (!is_numeric($number)) {
            array_push($errors, "Il formato per il numero di telefono non è valido");
        }
        $full_number = '+' . $prefix . $number;
    }
    if (empty($password_1)) {
        array_push($errors, "La password è richiesta");
    }
    if(strlen(trim($password_1)) < 6){
        array_push($errors, "Il tipo di utente è richiesto");
    } else{
        $password_1 = trim($password_1);
    }
    if ($password_1 != $password_2) {
        array_push($errors, "Le due password non coincidono");
    }
    if (empty($user_type)) {
        array_push($errors, "Il tipo di utente è richiesto");
    }


    // Finalmente, si registra l'utente se non ci sono errori nel form
    if (count($errors) == 0) {

        $query = "INSERT INTO utente (email, nome, cognome, password_utente, n_telefono) 
              VALUES('$email', '$name', '$surname', '$password', '$full_number')";

        if($stmt = $db->prepare($query)){
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $param_password = password_hash($password_1, PASSWORD_DEFAULT);
        }

        mysqli_query($db, $query);
        $_SESSION['nome'] = $nome;
        $_SESSION['success'] = "Hai effettuato la registrazione correttamente";
        header('location: index.php');
    }
}


if (isset($_POST['login_user'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($email)) {
        array_push($errors, "L'email è richiesta");
    }
    if (empty($password)) {
        array_push($errors, "La password è richiesta");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM utenti WHERE email='$email' AND password='$password'";
        #echo $query;
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['nome'] = $nome;
            $_SESSION['success'] = "Hai effettuato il login correttamente";
            header('location: index.php');
        } else {
            array_push($errors, "Combinazione email/password errata");
        }
    }
}
