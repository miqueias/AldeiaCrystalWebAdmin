<?php
ini_set('display_errors', 0);
include 'connection.php';

$action = $_GET["a"];

switch ($action) {
	case 'login':
		
		$sql = "SELECT id_usuario, nome, usuario, status, id_tipo_usuario  
		FROM usuario 
		WHERE usuario = '".trim($_POST["login"])."' 
		AND senha = '".trim($_POST["password"])."' ";

		$result = mysqli_query($mysqli, $sql);

		$i = mysqli_num_rows($result);

		if ($i == 1) {
			$row = mysqli_fetch_array($result, MYSQLI_BOTH);

			session_start();
			$_SESSION['id_usuario'] = $row['id_usuario'];
			$_SESSION['nome'] = $row['nome'];
			$_SESSION['usuario'] = $row['usuario'];
			$_SESSION['status'] = $row['status'];
			$_SESSION['id_tipo_usuario'] = $row['id_tipo_usuario'];

			header("Location: ../index.php");

		} else {
			header("Location: ../login.php?error=true");
		}


		break;
	
	default:
		# code...
		break;
}

?>