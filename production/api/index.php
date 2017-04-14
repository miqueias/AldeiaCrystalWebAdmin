<?php
date_default_timezone_set('America/Sao_Paulo');
require '../../vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Firebase\JWT\JWT;

define('SECRET_KEY','aldeia_crystal');
define('ALGORITHM','HS256');

$app = new \Slim\App(array('templates.path' => 'templates', 'settings' => ['displayErrorDetails' => true]));
//$app = new \Slim\App(array('templates.path' => 'templates'));

$app->get('/', function(Request $request, Response $response, $args) {
	echo "Api Manager Aldeia Crystal";
});

$app->post('/login', function(Request $request, Response $response, $args) {
	$data = $request->getParsedBody();
	return login($data[apt],$data[cod_condominio]);
});

$app->get('/pedidos', function(Request $request, Response $response, $args) {
	auth($request);
	getAllPedidos();
});

$app->get('/pedidos/{id}', function(Request $request, Response $response, $args){
	auth($request);
	$idPedido = (int)$args['id'];
	getPedidos($idPedido);
});

$app->get('/pedidos/usuario/{id}', function(Request $request, Response $response, $args){
	auth($request);
	$idUsuario = (int)$args['id'];
	getPedidosByUsuario($idUsuario);
});

$app->get('/usuario/{apt}/{id_condominio}', function(Request $request, Response $response, $args){
	//auth($request);
	$apt = $args['apt'];
	$idCondominio = (int)$args['id_condominio'];
	login($apt, $idCondominio);
	//validateJWT($request, $response);
});

$app->get('/noticias', function(Request $request, Response $response, $args) {
	auth($request);
	getNoticias();
});

$app->post('/pedidos/novo', function(Request $request, Response $response, $args) {
	auth($request);
	$data = $request->getParsedBody();
	
	$stmt = getConn()->prepare("INSERT INTO pedido (id_usuario_app, qtd_5l, qtd_10l, troco, data_hora, status) 							VALUES (:id_usuario_app, :qtd_5l, :qtd_10l, :troco, NOW(), 'A')");
	$stmt->bindParam(':id_usuario_app', $id_usuario_app);
	$stmt->bindParam(':qtd_5l', $qtd_5l);
	$stmt->bindParam(':qtd_10l', $qtd_10l);
	$stmt->bindParam(':troco', $troco);

	// insert one row
	$id_usuario_app = filter_var($data['id_usuario_app'], FILTER_SANITIZE_STRING);
	$qtd_5l = filter_var($data['qtd_5l'], FILTER_SANITIZE_STRING);
	$qtd_10l = filter_var($data['qtd_10l'], FILTER_SANITIZE_STRING);
	$troco = filter_var($data['troco'], FILTER_SANITIZE_STRING);

	$stmt->execute();
	$status = array("status"=>"sucesso");
	echo json_encode($status);

});

function getConn() {
	
	return new PDO('mysql:host=localhost;dbname=aldeia_crystal', 'root', 'root',
			array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	//return new PDO('mysql:host=localhost;dbname=aldeiacr_dev', 'aldeiacr_dev', 'voanubo2016',
	//		array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

function getAllPedidos() {
	$sql = "SELECT pedido.id_pedido, pedido.id_usuario_app, pedido.qtd_5l, pedido.qtd_10l, pedido.troco, DATE_FORMAT(pedido.data_hora, '%d/%m/%Y') as data_hora, pedido.status, condominio.id_condominio, condominio.nome as nome_condominio, usuario_app.codigo_acesso as token, usuario_app.nome as nome_cliente, usuario_app.apt, 
		condominio.rua, condominio.numero, condominio.bairro, condominio.cep, condominio.cidade, condominio.uf,
		condominio.referencia, condominio.nome_sindico, condominio.telefone, entregador.nome as nome_entregador
      FROM pedido, condominio, usuario_app, entregador
      WHERE usuario_app.condominio_id = condominio.id_condominio
      AND usuario_app.id_usuario_app = pedido.id_usuario_app
      AND condominio.id_entregador = entregador.id_entregador";

	$stmt = getConn()->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($result);
}

function getPedidos($id) {
	$sql = "SELECT pedido.id_pedido, pedido.id_usuario_app, pedido.qtd_5l, pedido.qtd_10l, pedido.troco, DATE_FORMAT(pedido.data_hora, '%d/%m/%Y') as data_hora, pedido.status, condominio.id_condominio, condominio.nome as nome_condominio, usuario_app.nome as nome_cliente, usuario_app.apt, 
		condominio.rua, condominio.numero, condominio.bairro, condominio.cep, condominio.cidade, condominio.uf,
		condominio.referencia, condominio.nome_sindico, condominio.telefone, entregador.nome as nome_entregador
      FROM pedido, condominio, usuario_app, entregador
      WHERE usuario_app.condominio_id = condominio.id_condominio
      AND usuario_app.id_usuario_app = pedido.id_usuario_app
      AND condominio.id_entregador = entregador.id_entregador 
      AND pedido.id_pedido = ".$id;

	$stmt = getConn()->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($result);
}

function getPedidosByUsuario($id) {
	$sql = "SELECT pedido.id_pedido, pedido.id_usuario_app, pedido.qtd_5l, pedido.qtd_10l, pedido.troco, DATE_FORMAT(pedido.data_hora, '%d/%m/%Y') as data_hora, pedido.status, condominio.id_condominio, condominio.nome as nome_condominio, usuario_app.nome as nome_cliente, usuario_app.apt, 
		condominio.rua, condominio.numero, condominio.bairro, condominio.cep, condominio.cidade, condominio.uf,
		condominio.referencia, condominio.nome_sindico, condominio.telefone, entregador.nome as nome_entregador
      FROM pedido, condominio, usuario_app, entregador
      WHERE usuario_app.condominio_id = condominio.id_condominio
      AND usuario_app.id_usuario_app = pedido.id_usuario_app
      AND condominio.id_entregador = entregador.id_entregador 
      AND pedido.id_usuario_app = ". $id . " 
      ORDER BY pedido.id_pedido DESC 
      LIMIT 50";

	$stmt = getConn()->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($result);
}

function login($apt, $id_condominio) {
	$sql = "SELECT usuario_app.id_usuario_app, usuario_app.nome, usuario_app.telefone_fixo, usuario_app.telefone_celular, usuario_app.apt, condominio.id_condominio, condominio.rua, condominio.numero, condominio.bairro, condominio.cep, condominio.cidade, condominio.uf,
condominio.referencia, condominio.nome_sindico, condominio.telefone, condominio.nome as  nome_condominio, entregador.id_entregador, entregador.nome as nome_entregador, entregador.cpf, entregador.foto
			FROM condominio, usuario_app, entregador
			WHERE usuario_app.condominio_id = condominio.id_condominio
			AND condominio.id_entregador = entregador.id_entregador 
			AND condominio.id_condominio = ".$id_condominio." 
			AND usuario_app.apt = '".$apt."'";

	$stmt = getConn()->query($sql);
	$usuario = $stmt->fetchAll(PDO::FETCH_OBJ);
	//echo count($usuario);die;
	if (count($usuario) > 0) {
		
		$tokenId    = base64_encode(mcrypt_create_iv(32));
        $issuedAt   = time();
        $notBefore  = $issuedAt + 10;  //Adding 10 seconds
        $expire     = $notBefore + 7200; // Adding 60 seconds
        $serverName = 'http://aldeiacrystal.com.br/'; /// set your domain name 

			
        /*
         * Create the token as an array
         */
        $data = [
            'iat'  => $issuedAt,         // Issued at: time when the token was generated
            'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
            'iss'  => $serverName,       // Issuer
            'nbf'  => $notBefore,        // Not before
            'exp'  => $expire,           // Expire
            'data' => [                  // Data related to the logged user you can set your required data
	    		'apt'   => $apt, // id from the users table
	     		'condominio' => $id_condominio, //  name
                      ]
        ];
      $secretKey = SECRET_KEY;
      /// Here we will transform this array into JWT:
      $jwt = JWT::encode(
                $data, //Data to be encoded in the JWT
                $secretKey,
                ALGORITHM 
                ); 
     $unencodedArray = ['jwt' => $jwt];
     $arr = array('status' => 'success', 'token' => $unencodedArray, 'usuario' => $usuario);
     echo json_encode($arr);
	} else {
		$arr = array('status' => 'error', 'msg' => 'Usuário não cadastrado!');
		echo json_encode($arr);
	} 
    
}

function getNoticias() {
	$sql = "SELECT id_noticia, titulo, descricao, status 
          	FROM noticia 
          	WHERE status = 'A' 
          	ORDER BY id_noticia DESC 
          	LIMIT 20";
  	$stmt = getConn()->query($sql);
	$noticia = $stmt->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($noticia);
}

function auth($request) {
	$authorization = $request->getHeaderLine("Authorization");
	
	if (trim($authorization) == "") {
		$arr = array('status' => 'error', 'msg' => 'Acesso negado!', 'detail' => 'Token não informado');
		echo json_encode($arr);
		die;
	} else {
		try {
			JWT::decode($authorization, SECRET_KEY, array('HS256'));
		} catch (Exception $e) {
			$arr = array('status' => 'error', 'msg' => 'Acesso negado!', 'detail' => 'Acesso não autorizado');
			echo json_encode($arr);
			die;
		}
	}
}

$app->run();