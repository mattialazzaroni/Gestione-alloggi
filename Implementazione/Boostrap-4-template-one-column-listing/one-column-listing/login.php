<?php
include('server.php');

$email = '';
$password = '';


if(isset($_POST['login_user'])){
	$email = $_POST['email'];
	$password = $_POST['password'];
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
		</form>
	</article>
</body>
</html>