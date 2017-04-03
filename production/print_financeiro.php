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
                            
                            
                            <tr class="headings">
                            <th class="column-title">Código </th>
                            <th class="column-title">Cliente </th>
                            <th class="column-title">Condomínio </th>
                            <th class="column-title">Apt </th>
                            <th class="column-title">Data </th>
                            <th class="column-title"># 5L </th>
                            <th class="column-title">$ 5L </th>
                            <th class="column-title"># 10L </th>
                            <th class="column-title">$ 10L </th>
                          </tr>
                          </tr>
                        </thead>

                        <tbody >
                        <?php
                          $sqlRota = "SELECT pedido.id_pedido, usuario_app.nome,condominio.nome as nome_condominio, usuario_app.apt, DATE_FORMAT(pedido.data_hora, '%d/%m/%Y') as data_hora, 
                                    pedido.qtd_5l, (pedido.qtd_5l * 5) AS vlr_5L, pedido.qtd_10l, (pedido.qtd_10l * 10) as vlr_10l 
                                    FROM pedido, usuario_app, condominio
                                    WHERE usuario_app.id_usuario_app = pedido.id_usuario_app
                                    AND condominio.id_condominio = usuario_app.condominio_id
                                    AND pedido.status = 'E'
                                    AND DATE_FORMAT(pedido.data_hora, '%m') = ".$_GET["mes"]."
                                    AND DATE_FORMAT(pedido.data_hora, '%Y') = ".$_GET["ano"]."
                                    ORDER BY pedido.data_hora ASC, usuario_app.id_usuario_app ASC";

                          $result = mysqli_query($mysqli, $sqlRota);
                          $i = 0;

                          $totalCont5 = 0;
                          $totalSum5 = 0;
                          $totalCont10 = 0;
                          $totalSum10 = 0;

                          while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {

                            if ($i % 2 == 0) {
                              $class = "even pointe";
                            } else {
                              $class = "odd pointe";
                            }

                            echo '<tr class="'.$class.'">
                                <td class=" ">'.$row["id_pedido"].'</td>
                                <td class=" ">'.utf8_encode(utf8_decode($row["nome"])).'</td>
                                <td class=" ">'.utf8_encode(utf8_decode($row["nome_condominio"])).'</td>
                                <td class=" ">'.utf8_encode(utf8_decode($row["apt"])).'</td>
                                <td class=" ">'.utf8_encode(utf8_decode($row["data_hora"])).'</td>
                                <td class=" ">'.$row["qtd_5l"].'</td>
                                <td class=" ">R$ '.number_format($row["vlr_5L"], 2, ',', '.').'</td>
                                <td class=" ">'.$row["qtd_10l"].'</td>
                                <td class=" ">R$ '.number_format($row["vlr_10l"], 2, ',', '.').'</td>
                              </tr>';

                              $totalCont5 = $totalCont5 + $row["qtd_5l"];
                              $totalSum5 = $totalSum5 + $row["vlr_5L"];
                              $totalCont10 = $totalCont10 + $row["qtd_10l"];
                              $totalSum10 = $totalSum10 + $row["vlr_10l"];
                            
                            $i++;
                          }
                        ?>
                        </tbody>
                        <thead>
                          <tr class="headings">
                            
                            <th class="column-title"></th>
                            <th class="column-title"></th>
                            <th class="column-title"></th>
                            <th class="column-title"></th>
                            <th class="column-title"></th>
                            <th class="column-title"><?php echo $totalCont5; ?></th>
                            <th class="column-title">R$ <?php echo number_format($totalSum5, 2, ',', '.'); ?></th>
                            <th class="column-title"><?php echo $totalCont10; ?></th>
                            <th class="column-title">R$  <?php echo number_format($totalSum10, 2, ',', '.'); ?></th>
                          </tr>
                        </thead>
                      </table>

</body>
</html>