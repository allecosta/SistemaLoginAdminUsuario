<?php 

include('../connection.php');

	if (!isAdmin()) {
		$_SESSION['msg'] = "Você deve realizar primeiro o login";

		header("location: ../login.php");
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);

		header("location: ../login.php");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Home</title>
		<link rel="stylesheet" type="text/css" href="../assets/style.css">
		<style>
			.header {
				background: #003366;
			}

			button[name='register-btn'] {
				background: #003366;
			}
		</style>
	</head>
	<body>
		<div class="content">
			<!-- mensagem de notificação -->
			<?php if (isset($_SESSION['success'])) : ?>

				<div class="error success">
					<h3>
						<?php
							echo $_SESSION['success'];
							unset($_SESSION['success']);
						?>
					</h3>
				</div>
			<?php endif ?>

			<!-- informação do usuario logado -->
			<div class="profile-info">
				<img src="../assets/image/icon-admin.jpg">

				<div>
					<?php if (isset($_SESSION['user'])) : ?>
						<strong><?php echo $_SESSION['user']['usuario']; ?></strong>

						<small>
							<i style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i>
							<br>
							<a href="home.php?logout='1'" style="color: red;">Logout</a>
							&nbsp; <a href="CreateUser.php"> + Adicionar Usuario</a>
						</small>
					<?php endif ?>
				</div>
			</div>
		</div>
	</body>
</html>