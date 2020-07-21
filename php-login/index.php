<?php 
	
	session_start();

	require 'datebase.php';

	if (isset($_SESSION['user_id'])) {
		$records= $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
		$records->bindParam(':id', $_SESSION['user_id']);
		$records->execute();
		$results= $records->fetch(PDO::FETCH_ASSOC);

		$user = null;

		if (count($results) > 0) {
			$user= $results;
		}
	}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Bienvenido</title>
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

	<?php require 'partials/header.php' ?>

	<?php if(!empty($user)): ?>
		<br>Bienvenido. <?= $user['email'] ?>
		<a href="logout.php">Salir</a>
	<?php else: ?>
		<h1>Ingrese o Registrese</h1>

		<a href="login.php">Ingresar</a> or
		<a href="signup.php">Registrarse</a>
	<?php endif; ?>

</body>
</html>