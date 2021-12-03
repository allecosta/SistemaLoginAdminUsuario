<?php include('../connection.php') ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Sistema de Usuario</title>
		<link rel="stylesheet" type="text/css" href="../assets/style.css">

		<style>
			.header {
				background: #003366;
			}

			button[name=register-btn] {
				background: #003366;
			}
		</style>
	</head>
	<body>
		<div class="header-admin">
			<h2>Administrador</h2>
		</div>

		<form method="POST" action="CreateUser.php">

			<?php echo displayError(); ?>

			<div class="input-group">
				<label>Usuário</label>
				<input type="text" name="usuario" value="<?php echo $username; ?>">
			</div>
			<div class="input-group">
				<label>Email</label>
				<input type="email" name="email" value="<?php echo $email; ?>">
			</div>
			<div class="input-group">
				<label>Tipo de Usuário</label>
				<select name="user_type" id="user-type">
					<option value=""></option>
					<option value="admin">Administrador</option>
					<option value="user">Usuario</option>
				</select>
			</div>
			<div class="input-group">
				<label>Senha</label>
				<input type="password" name="password1">
			</div>
			<div class="input-group">
				<label>Confirme a senha</label>
				<input type="password" name="password2">
			</div>
			<div class="input-group">
				<button type="submit" class="btn" name="register-btn"> + Criar Usuario</button>
			</div>
		</form>
	</body>
</html>