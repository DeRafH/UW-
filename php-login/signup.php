<?php
	require 'datebase.php';

	$message= '';

	if (!empty($_POST['email']) && !empty($_POST['password'])){
		$sql= "INSERT INTO users (email, password) VALUES(:email, :password)";
		$stmt= $conn->prepare($sql);
		$stmt->bindParam(':email',$_POST['email']);
		$password= password_hash($_POST['password'], PASSWORD_BCRYPT);
		$stmt->bindParam(':password', $password);

		if ($stmt->execute()) {
			$message= 'Usuario registrado exitosamente';
		}else{
			$message= 'Error al crear un usuario';
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Registrarse</title>
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

	<?php require 'partials/header.php' ?>

	<h1>Registrarse</h1>
	<span>O <a href="login.php">Entrar</a></span>

	<form action="signup.php" method="post">
		<input type="text" name="email" placeholder="Ingrese su correo">
		<input type="password" name="password" placeholder="Ingrese su contraseña">
		<input type="password" name="confirm_password" placeholder="Confirmar su contraseña">
		<input type="submit" value="Entrar">

	<?php if(!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif; ?>

	</form>
</body>
</html>