<?php include ('connection.php') ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Sistema de Registro</title>
		<link rel="stylesheet" type="text/css" href="/assets/style.css">
	</head>
	<body>
		<div class="header">
			<h2>Registre</h2>
		</div>

		<form method="POST" action="register.php">

			<?php echo displayError(); ?>

			<div class="input-group">
				<label>Usuário</label>
				<input type="text" name="usuario" value="<?php echo $username; ?>" >
			</div>
			<div class="input-group">
				<label>Email</label>
				<input type="text" name="email" value="<?php echo $password; ?>" >
			</div>
			<div class="input-group">
				<label>Senha</label>
				<input type="password" name="senha1">
			</div>
			<div class="input-group">
				<label>Confirme a senha</label>
				<input type="password" name="senha2">			
			</div>
			<div class="input-group">
				<button type="submit" class="btn" name="register-btn">Registre-se</button>
			</div>
			<p>Já é um membro ? <a href="login.php">Entrar</a></p>
		</form>
	</body>
</html>