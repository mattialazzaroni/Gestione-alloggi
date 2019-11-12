<?php
//Includo il file che esegue la connessione al database.
include('server.php');

//Creo le variabili per l'email e la password.
$email = '';
$password = '';

//Se il form di login viene confermato dall'utente.
if (isset($_POST['login_user'])) {
	//Imposto le variabili con i dati dell'utente.
	$email = $_POST['email'];
	$password = $_POST['password'];

	//Preparo dei messaggi di errori se l'utente lascia dei campi vuoti.
	if (empty($email)) {
		array_push($errors, "L'email è richiesta");
	}
	if (empty($password)) {
		array_push($errors, "La password è richiesta");
	}

	//Se non ci sono errori.
	if (count($errors) == 0) {
		//Preparo la query.
		$query = "SELECT * FROM utente WHERE email=:email";
		if ($stmt = $db->prepare($query)) {
			$stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
			$param_email = trim($email);
			if ($stmt->execute()) {
				//Se la query ritorna un risultato.
				if ($stmt->rowCount() == 1) {
					if ($row = $stmt->fetch()) {
						$email = $row["email"];
						$hashed_password = $row["password_utente"];
						//Se la password inserita dall'utente coincide con la password hashata presente nel db e legata a quell'email.
						if (password_verify($password, $hashed_password)) {
							//Imposto delle variabili session e sposto l'utente alla homepage.
							$_SESSION["name"] = $row["nome"];
							$_SESSION["loggedin"] = true;
							header('location: index.php');
						}
						//Altrimenti indico all'utente che la password inserita è errata.
						else {
							array_push($errors, "La password che ha inserito non è corretta");
						}
					} else {
						array_push($errors, "Ops! Qualcosa è andato storto");
					}
				//Altrimenti stampo un errore.
				} else {
					array_push($errors, "Nessun utente trovato con questa email");
				}
			}
			unset($stmt);
		}
		unset($db);
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Login</title>
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

	<!-- Contenuto visivo della pagina con form di login -->
	<article class="card-body mx-auto" style="max-width: 450px;">
		<h4 class="card-title mt-3 text-center">Accedi al tuo account</h4>
		<form method="post" action="login.php">
			<div class="form-group input-group">
				<div class="input-group-prepend">
					<span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
				</div>
				<input name="email" class="form-control" placeholder="Inserisci la tua email" type="email" value="<?php echo $email; ?>">
			</div> <!-- form-group// -->
			<div class="form-group input-group">
				<div class="input-group-prepend">
					<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
				</div>
				<input name="password" class="form-control" placeholder="Inserisci la tua password" type="password" value="<?php echo $password; ?>">
			</div> <!-- form-group// -->

			<!-- Stampa degli errori -->
			<?php if (count($errors) > 0) : ?>
				<div class="error">
					<?php foreach ($errors as $error) : ?>
						<p style="color:red"><?php echo $error ?></p>
					<?php endforeach ?>
				</div>
			<?php endif ?>

			<div class="form-group">
				<button type="submit" name="login_user" class="btn btn-primary btn-block"> Accedi </button>
			</div> <!-- form-group// -->
			<p class="text-center">Non hai ancora un account? <a href="signup.php">Registrati</a> </p>
			<p class="text-center">Oppure <a href="index.php">torna alla home </a> </p>
		</form>
	</article>
</body>

</html>