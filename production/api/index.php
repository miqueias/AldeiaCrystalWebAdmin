<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../../vendor/autoload.php';

$app = new \Slim\App(array('templates.path' => 'templates'));

$app->get('/listarpedidos', function() {
	getAllPedidos();
});

$app->get('/pedidos/{id}', function(Request $request, Response $response, $args){
	$idPedido = (int)$args['id'];
	getPedidos($idPedido);
});

$app->get('/pedidos/usuario/{id}', function(Request $request, Response $response, $args){
	$idUsuario = (int)$args['id'];
	getPedidosByUsuario($idUsuario);
});

$app->get('/usuario/{apt}/{id_condominio}', function(Request $request, Response $response, $args){
	$apt = $args['apt'];
	$idCondominio = (int)$args['id_condominio'];
	login($apt, $idCondominio);
});

$app->get('/noticias', function() {
	getNoticias();
});

$app->post('/pedidos/novo', function(Request $request, Response $response, $args) {
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
}

function getAllPedidos() {
	$sql = "SELECT pedido.id_pedido, pedido.id_usuario_app, pedido.qtd_5l, pedido.qtd_10l, pedido.troco, DATE_FORMAT(pedido.data_hora, '%d/%m/%Y') as data_hora, pedido.status, condominio.id_condominio, condominio.nome as nome_condominio, usuario_app.nome as nome_cliente, usuario_app.apt, 
		condominio.rua, condominio.numero, condominio.bairro, condominio.cep, condominio.cidade, condominio.uf,
		condominio.referencia, condominio.nome_sindico, condominio.telefone, entregador.nome as nome_entregador
      FROM pedido, condominio, usuario_app, entregador
      WHERE usuario_app.condominio_id = condominio.id_condominio
      AND usuario_app.id_usuario_app = pedido.id_usuario_app
      AND condominio.id_entregador = entregador.id_entregador";

	$stmt = getConn()->query($sql);
	$categorias = $stmt->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($categorias);
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
	$categorias = $stmt->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($categorias);
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
	$categorias = $stmt->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($categorias, JSON_HEX_APOS);
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
    echo json_encode($usuario);
}

function getNoticias() {
	$sql = "SELECT id_noticia, titulo, descricao, status 
          	FROM noticia 
          	ORDER BY id_noticia DESC 
          	LIMIT 20";
  	$stmt = getConn()->query($sql);
	$noticia = $stmt->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($noticia);
}


$app->run();