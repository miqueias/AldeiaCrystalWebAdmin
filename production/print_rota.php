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
    table {
      text-align: center;
      width:100%; 
    }
    tr {
      outline: thin solid black;
    }
    td {
      outline: thin solid black;
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
<br/>
<center><img src="images/marca_aldeia.png" width="236" height="177" /></center>
<br/>
<table>
                        <thead>
                          <tr class="headings">
                            
                            
                            <th class="column-title">Cliente </th>
                            <th class="column-title">Qtd 5L </th>
                            <th class="column-title">Qtd 19L </th>
                            <th class="column-title">Troco </th>
                            <th class="column-title">Condomínio </th>
                            <th class="column-title">Apt </th>
                            <th class="column-title">Rua </th>
                            <th class="column-title">Bairro </th>
                            <th class="column-title">Cidade </th>
                            <th class="column-title">Data </th>
                            <th class="column-title">Entregador </th>
                          </tr>
                        </thead>

                        <tbody >
                        <?php
                          $sqlRota = "SELECT pedido.id_pedido, pedido.id_usuario_app, pedido.qtd_5l, pedido.qtd_10l, pedido.troco, DATE_FORMAT(pedido.data_hora, '%d/%m/%Y') as data_hora, pedido.status, condominio.nome as nome_condominio, usuario_app.nome as nome_cliente, usuario_app.apt, 
                                  condominio.rua, condominio.numero, condominio.bairro, condominio.cep, condominio.cidade, condominio.uf,
                                  condominio.referencia, condominio.nome_sindico, condominio.telefone, entregador.nome as nome_entregador
                                    FROM pedido, condominio, usuario_app, entregador
                                    WHERE usuario_app.condominio_id = condominio.id_condominio
                                    AND usuario_app.id_usuario_app = pedido.id_usuario_app
                                    AND condominio.id_entregador = entregador.id_entregador
                                    AND entregador.id_entregador = ".$_GET["id_entregador"]. "
                                    AND pedido.status = 'P' 
                                    ORDER BY condominio.nome ASC, pedido.id_pedido DESC ";

                          $result = mysqli_query($mysqli, $sqlRota);
                          $i = 0;

                          while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {

                            if ($i % 2 == 0) {
                              $class = "even pointe";
                            } else {
                              $class = "odd pointe";
                            }

                            echo '<tr class="'.$class.'">
                                
                                <td class=" ">'.utf8_encode(utf8_decode($row["nome_cliente"])).'</td>
                                <td class=" ">'.utf8_encode(utf8_decode($row["qtd_5l"])).'</td>
                                <td class=" ">'.utf8_encode(utf8_decode($row["qtd_10l"])).'</td>
                                <td class=" ">'.number_format($row["troco"], 2, ',', '.').'</td>
                                <td class=" ">'.utf8_encode(utf8_decode($row["nome_condominio"])).'</td>
                                <td class=" ">'.utf8_encode(utf8_decode($row["apt"])).'</td>
                                <td class=" ">'.utf8_encode(utf8_decode($row["rua"])).'</td>
                                <td class=" ">'.utf8_encode(utf8_decode($row["bairro"])).'</td>
                                <td class=" ">'.utf8_encode(utf8_decode($row["cidade"])).'</td>
                                <td class=" ">'.utf8_encode(utf8_decode($row["data_hora"])).'</td>
                                <td class=" ">'.utf8_encode(utf8_decode($row["nome_entregador"])).'</td>
                              </tr>';
                            
                            $i++;
                          }
                        ?>
                        </tbody>
                      </table>

</body>
</html>