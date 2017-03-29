<?php
ini_set('display_errors', 0);
include 'connection.php';

$action = $_GET["a"];

switch ($action) {
	case 'login':
		
		$sql = "SELECT id_usuario, nome, usuario, status, id_tipo_usuario, email, senha  
		FROM usuario 
		WHERE usuario = '".trim($_POST["login"])."' 
		AND senha = '".trim($_POST["password"])."' 
		AND status = 'A'";

		$result = mysqli_query($mysqli, $sql);

		$i = mysqli_num_rows($result);

		if ($i == 1) {
			$row = mysqli_fetch_array($result, MYSQLI_BOTH);

			session_start();
			$_SESSION['id_usuario'] = $row['id_usuario'];
			$_SESSION['nome'] = $row['nome'];
			$_SESSION['usuario'] = $row['usuario'];
			$_SESSION['status'] = $row['status'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['senha'] = $row['senha'];
			$_SESSION['id_tipo_usuario'] = $row['id_tipo_usuario'];

			header("Location: ../index.php");

		} else {
			header("Location: ../login.php?error=true");
		}


		break;

	case 'add_entregador':

		$_UP['pasta'] = '../uploads/';
		// Tamanho máximo do arquivo (em Bytes)
		$_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb
		// Array com as extensões permitidas
		$_UP['extensoes'] = array('jpg', 'png', 'gif', 'jpeg');
		// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
		$_UP['renomeia'] = true;
		// Array com os tipos de erros de upload do PHP
		$_UP['erros'][0] = 'Não houve erro';
		$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite de 2Mb';
		$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
		$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
		$_UP['erros'][4] = 'Não foi feito o upload do arquivo';

		$nome_final = "";
		
		if ($_FILES['arquivo']['name'] != "") {
			if ($_FILES['arquivo']['error'] != 0) {
				$msg = "Não foi possível fazer o upload, erro:" . $_UP['erros'][$_FILES['arquivo']['error']];
				echo "<script>alert('".$msg."');window.location.href='../entregadores.php';</script>";
			}
			
			$extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
			if (array_search($extensao, $_UP['extensoes']) === false) {
		  		$msg = "Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif";
		  		echo "<script>alert('".$msg."');window.location.href='../entregadores.php';</script>";
			}
			
			if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
			  	$msg = "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
				echo "<script>alert('".$msg."');window.location.href='../entregadores.php';</script>";
			}
			
			if ($extensao != "") {
				if ($_UP['renomeia'] == true) {
				  // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
				  $nome_final = md5(time()).'.jpg';
				} else {
				  // Mantém o nome original do arquivo
				  $nome_final = $_FILES['arquivo']['name'];
				}
			}

			if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)) {
			  // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
			  //echo "Upload efetuado com sucesso!";
			  //echo '<a href="' . $_UP['pasta'] . $nome_final . '">Clique aqui para acessar o arquivo</a>';
			} else {
			  // Não foi possível fazer o upload, provavelmente a pasta está incorreta
			  	$msg = "Não foi possível enviar o arquivo, tente novamente";
		  		echo "<script>alert('".$msg."');window.location.href='../entregadores.php';</script>";
			}	
		}

		$sql = "INSERT INTO entregador (nome, cpf, foto) 
				VALUES ('".$_POST['nome']."', '".$_POST['cpf']."', '".$nome_final."')";

		$result = mysqli_query($mysqli, $sql);
		echo "<script>alert('Cadastro realizado com sucesso!');window.location.href='../entregadores.php';</script>";

		break;

	case 'edit_entregador':

		$sql = "UPDATE entregador 
				SET nome = '".$_POST['nome']."', 
					cpf = '".$_POST['cpf']."'
					WHERE id_entregador = ".$_POST['id'];

		$result = mysqli_query($mysqli, $sql);
		echo "<script>alert('Dados alterados com sucesso!');window.location.href='../entregadores.php';</script>";

		break;

	case 'add_condominio':
		
		$sql = "INSERT INTO condominio (nome, rua, numero, bairro, cidade, uf, cep, referencia, nome_sindico, telefone, status, id_entregador) 
				VALUES ('".$_POST['nome']."', '".$_POST['rua']."', '".$_POST['numero']."', '".$_POST['bairro']."', '".$_POST['cidade']."', '".$_POST['uf']."', '".$_POST['cep']."', '".$_POST['referencia']."', '".$_POST['sindico']."', '".$_POST['telefone']."', 'A', ".$_POST['entregador'].")";
		$result = mysqli_query($mysqli, $sql);
		echo "<script>alert('Cadastro realizado com sucesso!');window.location.href='../condominio.php';</script>";

		break;

	case 'edit_condominio':
		
		$sql = "UPDATE condominio 
				SET nome = '".$_POST['nome']."', 
					rua = '".$_POST['rua']."', 
					numero = '".$_POST['numero']."', 
					bairro = '".$_POST['bairro']."', 
					cidade = '".$_POST['cidade']."', 
					uf = '".$_POST['uf']."', 
					cep = '".$_POST['cep']."', 
					referencia = '".$_POST['referencia']."', 
					nome_sindico = '".$_POST['sindico']."', 
					telefone = '".$_POST['telefone']."', 
					id_entregador = ".$_POST['entregador']." 
					WHERE id_condominio = ".$_POST["id"];

		$result = mysqli_query($mysqli, $sql);
		echo "<script>alert('Dados alterados com sucesso!');window.location.href='../condominio.php';</script>";

		break;

		case 'add_usuarioapp':
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    $charactersLength = strlen($characters);
		    $randomString = '';
		    for ($i = 0; $i < 10; $i++) {
		        $randomString .= $characters[rand(0, $charactersLength - 1)];
		    }
			$sql = "INSERT INTO usuario_app (nome, telefone_fixo, telefone_celular, apt, codigo_acesso, status, condominio_id) 
					VALUES ('".$_POST["nome"]."', '".$_POST["telefone_fixo"]."', '".$_POST["telefone_celular"]."', '".$_POST["apt"]."', '".$randomString."', 'A', ".$_POST["condominio_id"].")";

			$result = mysqli_query($mysqli, $sql);
			echo "<script>alert('Cadastro realizado com sucesso!');window.location.href='../usuarioapp.php';</script>";
			break;

		case 'edit_usuarioapp':
			
			$sql = "UPDATE usuario_app 
					SET nome = '".$_POST["nome"]."', 
					telefone_fixo = '".$_POST["telefone_fixo"]."', 
					telefone_celular = '".$_POST["telefone_celular"]."', 
					apt = '".$_POST["apt"]."', 
					condominio_id = ".$_POST["condominio_id"]."
					WHERE id_usuario_app = ".$_POST["id"];

			$result = mysqli_query($mysqli, $sql);
			echo "<script>alert('Dados alterados com sucesso!');window.location.href='../usuarioapp.php';</script>";

			break;

		case 'del_usuarioapp':
			$sql = "UPDATE usuario_app 
					SET status = 'I' 
					WHERE id_usuario_app = ". $_GET["id"];
			$result = mysqli_query($mysqli, $sql);
			echo "<script>alert('Dados alterados com sucesso!');window.location.href='../usuarioapp.php';</script>";
			break;

		case 'active_usuarioapp':
			$sql = "UPDATE usuario_app 
					SET status = 'A' 
					WHERE id_usuario_app = ". $_GET["id"];
			$result = mysqli_query($mysqli, $sql);
			echo "<script>alert('Dados alterados com sucesso!');window.location.href='../usuarioapp.php';</script>";
			break;

		case 'add_noticia':
			$sql = "INSERT INTO noticia (titulo, descricao, status) 
					VALUES ('".$_POST["titulo"]."', '".$_POST["descricao"]."', 'A')";
			$result = mysqli_query($mysqli, $sql);
			echo "<script>alert('Cadastro realizado com sucesso!');window.location.href='../noticias.php';</script>";
			break;

		case 'edit_noticia':
			$sql = "UPDATE noticia 
					SET titulo = '".$_POST["titulo"]."', 
					descricao = '".$_POST["descricao"]."' 
					WHERE id_noticia = ". $_POST["id"];
			$result = mysqli_query($mysqli, $sql);
			echo "<script>alert('Dados alterados com sucesso!');window.location.href='../noticias.php';</script>";
			break;

		case 'del_noticia':
			$sql = "UPDATE noticia 
					SET status = 'I' 
					WHERE id_noticia = ". $_GET["id"];
			$result = mysqli_query($mysqli, $sql);
			echo "<script>alert('Dados alterados com sucesso!');window.location.href='../noticias.php';</script>";
			break;

		case 'active_noticia':
			$sql = "UPDATE noticia 
					SET status = 'A' 
					WHERE id_noticia = ". $_GET["id"];
			$result = mysqli_query($mysqli, $sql);
			echo "<script>alert('Dados alterados com sucesso!');window.location.href='../noticias.php';</script>";
			break;

		case 'add_usuario':

			$sql = "SELECT * FROM usuario WHERE TRIM(usuario) = '".trim($_POST["usuario"])."'";
			$result = mysqli_query($mysqli, $sql);
			$i = mysqli_num_rows($result);

			if ($i > 0) {
				echo "<script>alert('Nome de usuario ja esta em uso!');window.location.href='../configuracoes.php';</script>";
			} else {
				$sql = "INSERT INTO usuario (nome, usuario, senha, email, status, id_tipo_usuario) 
					VALUES ('".$_POST["nome"]."', '".$_POST["usuario"]."', '".$_POST["senha"]."', '".$_POST["email"]."', 'A', '1')";
				$result = mysqli_query($mysqli, $sql);
				echo "<script>alert('Cadastro realizado com sucesso!');window.location.href='../configuracoes.php';</script>";
			}
			break;

		case 'edit_usuario':
			$sql = "UPDATE usuario SET 
				nome = '".$_POST["nome"]."', 
				senha = '".$_POST["senha"]."', 
				email = '".$_POST["email"]."' 
				WHERE id_usuario = ".$_POST["id"];
			$result = mysqli_query($mysqli, $sql);
			echo "<script>alert('Dados alterados com sucesso!');window.location.href='../configuracoes.php';</script>";	
			break;

		case 'del_usuario':
			$sql = "UPDATE usuario
					SET status = 'I' 
					WHERE id_usuario = ". $_GET["id"];
			$result = mysqli_query($mysqli, $sql);
			echo "<script>alert('Dados alterados com sucesso!');window.location.href='../configuracoes.php';</script>";
			break;

		case 'active_usuario':
			$sql = "UPDATE usuario 
					SET status = 'A' 
					WHERE id_usuario = ". $_GET["id"];
			$result = mysqli_query($mysqli, $sql);
			echo "<script>alert('Dados alterados com sucesso!');window.location.href='../configuracoes.php';</script>";
			break;

		case 'pedido_entregue':
			$sql = "UPDATE pedido 
					SET status = 'E' 
					WHERE id_pedido = ". $_GET["id"];
					$result = mysqli_query($mysqli, $sql);
			echo "<script>alert('Status do pedido alterado com sucesso!');window.location.href='../pedidos.php';</script>";
			break;
	default:
		# code...
		break;
}
?>