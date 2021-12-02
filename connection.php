<?php
session_start();

// conexao com o database
$conn = mysqli_connect("localhost", "", "", "db_user_admin"); 

// declaração de variaveis
$username = "";
$email = "";
$errors = array();


	// chama a função registro se register-btn for clicado
	if (isset($_POST['register-btn'])) {
		register();
	}

// login do usuario
function login() 
{
	global $conn, $username, $errors;

	$username = e($_POST['usuario']);
	$password = e($_POST['senha']);

	// verifica se o formulario está preenchido corretamente
	if (empty($username)) {
		array_push($errors, "É necessario informar o nome de usuário");
	}

	if (empty($password)) {
		array_push($errors, "É necessario informar a senha");
	}

	// realiza o login se não houver erros
	if (count($errors) == 0) {
		$password = md5($password);
		$query = "SELECT * FROM users WHERE usuario='$username' AND senha='$password' LIMIT 1";
		$result = mysqli_query($conn, $query);

		// usuario identificado
		if (mysqli_num_rows($result) == 1) {

			// verifica se é usuário ou admin
			$loggedUser = mysqli_fetch_assoc($result);

			if ($loggedUser['user_type'] == 'admin') {
				$_SESSION['user'] = loggedUser;
				$_SESSION['success'] = "Você está logado!";

				header("location: admin/home.php");

			} else {
				$_SESSION['user'] = $loggedUser;
				$_SESSION['success'] = "Você está logado!";

				header("location: index.php");
			}

		} else {
			array_push($errors, "Houve um erro usuario/senha");
		}
	}
} 

// registro de usuario
function register() 
{
	// chama essas variáveis com as palavras-chave globais para torná-las disponíveis na função
	global $conn, $errors, $username, $email;

	// recebe todos os valores de entrada do formulário, chama a função e() 
	$username = e($_POST['usuario']);
	$email = e($_POST['email']);
	$password1 = e($_POST['senha1']);
	$password2 = e($_POST['senha2']);

	// validando o formulario, garantindo que esteja preenchido corretamente
	if (empty($username)) {
		array_push($errors, "É necessario informar o nome de usuário");
	}

	if (empty($email)) {
		array_push($errors, "É necessario informar o email");
	}

	if (empty($password1)) {
		array_push($errors, "É necessario informar a senha");
	}

	if ($password1 != $password2) {
		array_push($errors, "A senhas informadas não são iguais ");
	}

	// registra o usuário se não houver erros
	if (count($errors) == 0) {
		// encriptando a senha antes de salvar no database
		$password = md5($password1);

		if (isset($_POST['user_type'])) {
			$userType = e($_post['user_type']);
			$query = "INSERT INTO users (usuario, email, senha, user_type) VALUES ('$username', '$email', '$password', '$userType')";
			mysqli_query($conn, $query);

			header("location: home.php");

		} else {
			$query = "INSERT INTO users (usuario, email, senha, user_type) VALUES ('$username', '$email', '$password', '$userType')";
			mysqli_query($conn, $query);

			// obtendo a identificação do usuario cadastrado
			$loggedUser = mysqli_insert_id($conn);

			$_SESSION['user'] = getUserById($loggedUser);
			$_SESSION['success'] = "Você está logado!";

			header("location: index.php");
		}
	}
}

function getUserById($id) 
{
	global $conn;

	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($conn, $query);
	$user = mysqli_fetch_assoc($result);

	return $user;
}

function e($val) 
{
	global $conn;

	return mysqli_real_escape_string($conn, trim($val));
}

function displayError() 
{
	global $errors;

	if (count($errors) > 0) {
		echo "<div class='error'>";
			foreach ($errors as $error) {
				echo $error . "<br>";
			}

		echo "</div>";
	}
}

function isLoggedIn() 
{
	if (isset($_SESSION['user'])) {
		return true;

	} else {
		return false;
	}
}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);

		header("location: login.php");
	}

function isAdmin() 
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin') {
		return true;

	} else {
		return false;
	}
}

	