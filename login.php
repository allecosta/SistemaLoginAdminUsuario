<?php include('connection.php') ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Sistema de Login</title>
		<link rel="stylesheet" type="text/css" href="assets/style.css">
	</head>
	<body>
		<div class="header">
			<h2>Login</h2>
		</div>

		<form method="POST" action="login.php">

			<?php echo displayError(); ?>

			<div class="input-group">
				<label>Usuário</label>
				<input type="text" name="usuario">
			</div>
			<div class="input-group">
				<label>Senha</label>
				<input type="password" name="senha">
			</div>
			<div class="input-group">
				<button type="submit" class="btn" name="login-btn">Login</button>
			</div>
			<p>Ainda não é membro ? <a href="register.php">Inscreva-se</a></p>
		</form>
	</body>
</html>