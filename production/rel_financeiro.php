<?php 
ini_set('display_errors', 0);
include 'php/session.php';
include 'php/connection.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Aldeia Crystal | Recife Sites</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

    <script type="text/javascript">
      function showRota() {
        var idEntregador;
        idEntregador = $("#entregador").val();
        //alert(idEntregador);
        window.location.href = "rel_rota.php?id_entregador="+idEntregador;
      }

      function printRota() {
        var idEntregador;
        //alert(idEntregador);
        window.open("print_rota.php?id_entregador="+<?php echo $_GET["id_entregador"]; ?>, '_blank');
      }

    </script>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><i class="fa fa-laptop"></i> <span>Aldeia Crystal</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <?php
              include 'php/inc/menu_profile.php';
            ?>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <?php
              include 'php/inc/side.php';
            ?>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <?php
          include 'php/inc/top.php';
        ?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Relatórios -> Relatório Financeiro</h3>
              </div>

              
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Período: </h2><br />   
                        <select class="form-control" name="mes" id="entregador">
                          <option value="">-- Selecione o Mês --</option>
                          <option value="01">Janeiro</option>
                          <option value="02">Fevereiro</option>
                          <option value="03">Março</option>
                          <option value="04">Abril</option>
                          <option value="05">Maio</option>
                          <option value="06">Junho</option>
                          <option value="07">Julho</option>
                          <option value="08">Agosto</option>
                          <option value="09">Setembro</option>
                          <option value="10">Outubro</option>
                          <option value="11">Novembro</option>
                          <option value="12">Dezembro</option>
                            
                        </select>
                        <br />
                        <select class="form-control" name="entregador" id="entregador">
                          <option value="">-- Selecione o Ano --</option>
                          <option value="2017">2017</option>
                          <option value="2018">2018</option>
                          <option value="2019">2019</option>
                          <option value="2020">2020</option>
                          <option value="2021">2021</option>
                          <option value="2022">2022</option>
                          <option value="2023">2023</option>
                          <option value="2024">2024</option>
                          <option value="2025">2025</option>
                          <option value="2026">2026</option>
                          <option value="2027">2027</option>
                          <option value="2028">2028</option>
                          <option value="2029">2029</option>
                          <option value="2030">2030</option>
                        </select>
                        <br />
                        <button type="button" class="btn btn-primary" onclick="showRota();">Exibir Rota</button>
                          <button id="send" type="button" class="btn btn-success" onclick="printRota();">Imprimir Rota</button>
                    <div class="clearfix"></div>
                  </div>
                  
          </div>

          <!--table-->
            <div class="row">
              <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Relatório Financeiro</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
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
                        </thead>

                        <tbody>
                        <?php
                          $sqlRota = "SELECT pedido.id_pedido, usuario_app.nome,condominio.nome as nome_condominio, usuario_app.apt, DATE_FORMAT(pedido.data_hora, '%d/%m/%Y') as data_hora, 
                                    pedido.qtd_5l, (pedido.qtd_5l * 5) AS vlr_5L, pedido.qtd_10l, (pedido.qtd_10l * 10) as vlr_10l 
                                    FROM pedido, usuario_app, condominio
                                    WHERE usuario_app.id_usuario_app = pedido.id_usuario_app
                                    AND condominio.id_condominio = usuario_app.condominio_id
                                    AND pedido.status = 'E'
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
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--/table-->

        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php 
          include 'php/inc/footer.php';
        ?>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- validator -->
    <script src="../vendors/validator/validator.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
  
  </body>
</html>