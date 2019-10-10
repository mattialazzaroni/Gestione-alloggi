<?php
session_start();

$errors = array();

//Mi connetto al database
$db = mysqli_connect('localhost', 'root', '', 'gestione_alloggi');

if (isset($_POST['reg_user'])) {
    //Ricevo tutti gli input dal form
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $surname = mysqli_real_escape_string($db, $_POST['surname']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $prefix = $_POST['prefix'];
    $number = mysqli_real_escape_string($db, $_POST['number']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
    $user_type = $_POST['user_type'];

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
    if ($password_1 != $password_2) {
        array_push($errors, "Le due password non coincidono");
    }
    if (empty($user_type)) {
        array_push($errors, "Il tipo di utente è richiesto");
    }

    //Si controlla il database per assicurarsi che
    //un utente non esiste gà con quella email
    $user_check_query = "SELECT * FROM utente WHERE email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['email'] === $email) {
            array_push($errors, "La seguente email è già in uso");
        }
    }

    // Finalmente, si registra l'utente se non ci sono errori nel form
    if (count($errors) == 0) {
        $password = md5($password_1); //encrypt the password before saving in the database

        $query = "INSERT INTO utente (email, nome, cognome, password_utente, n_telefono) 
              VALUES('$email', '$name', '$surname', '$password', '$full_number')";
        mysqli_query($db, $query);
        $_SESSION['nome'] = $nome;
        $_SESSION['success'] = "Hai effettuato la registrazione correttamente";
        header('location: index.php');
    }
}


if (isset($_POST['login_user'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

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
