<?php
	
	session_start();

	if(isset($_SESSION[$user_id])){
		header('Location: /php-login');
	}

	require 'datebase.php';

	if(!empty($_POST['email']) && !empty($_POST['password'])){
		$records= $conn->prepare('SELECT id, email, password FROM users WHERE email=:email');
		$records->bindParam(':email', $_POST['email']);
		$records->execute();
		$results= $records->fetch(PDO::FETCH_ASSOC);

		$mssage= '';

		if (count($results) > 0 && password_verify($_POST['password'], $results['password'])){
			$_SESSION['user_id']= $results['id'];
			header('Location: /php-login');
		}else{
			$message= 'No coinciden los datos';
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Ingresar</title>
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

	<?php require 'partials/header.php' ?>

	<h1>Ingresar</h1>
	<span>O <a href="signup.php">Registrar</a></span>

	<?php if(!empty($message)) : ?>
		<p><?= $message ?></p>
	<?php endif; ?>

	<form action="login.php" method="post">
		<input type="text" name="email" placeholder="Ingrese su correo">
		<input type="password" name="password" placeholder="Ingrese su contraseña">
		<input type="submit" value="Entrar">
	</form>


</body>
</html>