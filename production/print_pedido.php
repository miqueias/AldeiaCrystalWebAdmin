<?php 
ini_set('display_errors', 0);
include 'php/session.php';
include 'php/connection.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		body {
		font: 12pt "Times New Roman", Times, serif;
		color: #000;
		}
	</style>

<script>
	function printer() {
		window.print();
	}
</script>
</head>
<body>
<button onclick="printer()">Imprimir esta página</button>

<?php

	$sql = "SELECT pedido.id_pedido, pedido.id_usuario_app, pedido.qtd_5l, pedido.qtd_10l, pedido.troco, DATE_FORMAT(pedido.data_hora, '%d/%m/%Y') as data_hora, pedido.status, condominio.nome as nome_condominio, usuario_app.nome as nome_cliente, usuario_app.apt, 
		condominio.rua, condominio.numero, condominio.bairro, condominio.cep, condominio.cidade, condominio.uf,
		condominio.referencia, condominio.nome_sindico, condominio.telefone, entregador.nome as nome_entregador
      FROM pedido, condominio, usuario_app, entregador
      WHERE usuario_app.condominio_id = condominio.id_condominio
      AND usuario_app.id_usuario_app = pedido.id_usuario_app
      AND condominio.id_entregador = entregador.id_entregador
      AND pedido.id_pedido = ".$_GET["id"];

      $result = mysqli_query($mysqli, $sql);

	while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
		echo '<p>
		<img src="images/marca_aldeia.png" width="236" height="177" />
			<h1>RECIBO DE COMPRA</h1>
            <h4>DADOS DA ENTREGA</h4>
            Nome do Cliente: '.$row["nome_cliente"].'
            <br />
            Condomínio: '.$row["nome_condominio"].' - Apartamento: '.$row["apt"].'
            <br />
            Síndico: '.$row["nome_sindico"].' - Telefone: '.$row["telefone"].'
            <br />
			Endereço: '.$row["rua"].' - '.$row["bairro"].' - '.$row["cidade"].' - '.$row["uf"].' - '.$row["cep"].'
            <br />
            Entregador: '.$row["nome_entregador"].'
			<h4>DADOS DO PEDIDO</h4> 
			Número do Pedido: '.$row["id_pedido"].'
			<br/>
			Garrafão 5L: '.$row["qtd_5l"].'
			<br />
			Garrafão 10L: '.$row["qtd_10l"].' 
			<br />
			Total:  R$ XX.XX
			<br />
			Troco: R$ '.$row["troco"].'
			<br /><br /><br /><br /><br />

			________________________________________
			<br />
			Data do pedido: '.$row["data_hora"].' - '.$row["nome_cliente"].'
			</p>';
      }
?>

</body>
</html>