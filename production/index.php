<?php
ini_set('display_errors', 0);
include 'php/session.php';
include 'php/connection.php';

function mesPorExtenso(){
  switch (date("m")) {
        case "01":    $mes = Janeiro;     break;
        case "02":    $mes = Fevereiro;   break;
        case "03":    $mes = Março;       break;
        case "04":    $mes = Abril;       break;
        case "05":    $mes = Maio;        break;
        case "06":    $mes = Junho;       break;
        case "07":    $mes = Julho;       break;
        case "08":    $mes = Agosto;      break;
        case "09":    $mes = Setembro;    break;
        case "10":    $mes = Outubro;     break;
        case "11":    $mes = Novembro;    break;
        case "12":    $mes = Dezembro;    break; 
 }

 echo $mes;
}

$sql = "SELECT * FROM usuario_app";
$result = mysqli_query($mysqli, $sql);
$contUsuarioApp = mysqli_num_rows($result);

$sql = "SELECT * FROM pedido WHERE MONTH(data_hora) = MONTH(NOW()) AND status = 'A'";
$result = mysqli_query($mysqli, $sql);
$pedidosAberto = mysqli_num_rows($result);

$sql = "SELECT * FROM pedido WHERE MONTH(data_hora) = MONTH(NOW()) AND status = 'E'";
$result = mysqli_query($mysqli, $sql);
$pedidosEntrege = mysqli_num_rows($result);

$sql = "SELECT * FROM condominio";
$result = mysqli_query($mysqli, $sql);
$contCondominio = mysqli_num_rows($result);

$sql = "SELECT * FROM pedido WHERE MONTH(data_hora) = MONTH(NOW()) AND status = 'E' and qtd_5l > 0";
$result = mysqli_query($mysqli, $sql);
$pedidosCinco = mysqli_num_rows($result);

$sql = "SELECT * FROM pedido WHERE MONTH(data_hora) = MONTH(NOW()) AND status = 'E' and qtd_10l > 0";
$result = mysqli_query($mysqli, $sql);
$pedidosDez = mysqli_num_rows($result);

$sql = "SELECT COUNT(condominio.id_condominio) as count, condominio.id_condominio, condominio.nome FROM pedido, condominio, usuario_app
        WHERE pedido.id_usuario_app = usuario_app.id_usuario_app
        AND usuario_app.condominio_id = condominio.id_condominio
        AND MONTH(pedido.data_hora) = MONTH(NOW()) 
        AND pedido.status = 'E'
        GROUP BY condominio.id_condominio 
        LIMIT 5";
$rsEntregasCondominio = mysqli_query($mysqli, $sql);

$sql = "SELECT COUNT(pedido.id_pedido) as qtd, DAY(pedido.data_hora) AS dia 
        FROM pedido 
        WHERE pedido.status = 'E'
        AND MONTH(pedido.data_hora) = MONTH(NOW()) 
        GROUP BY pedido.data_hora 
        ORDER BY pedido.data_hora ASC";
$rsEntregasDiaDia = mysqli_query($mysqli, $sql);

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
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Condomínio');
        data.addColumn('number', 'Entregas');
        data.addRows([
        <?php 
          $i = 0;
          $total = mysqli_num_rows($rsEntregasCondominio);
          while ($row = mysqli_fetch_array($rsEntregasCondominio, MYSQLI_BOTH)) {

            $item = "['".$row['nome']."', ".$row['count']."]";

            $i++;

            if ($i < $total) {
              $itemAux = $item . ",";
            } else {
              $itemAux = $itemAux . $item;
            }

          }

          echo $itemAux;

          ?>
          //['Mushrooms', 3],
          //['Onions', 1],
          //['Olives', 1],
          //['Zucchini', 1],
          //['Pepperoni', 2]
        ]);

        // Set chart options
        var options = { 'title':'Entregas por Condomínio',
                        'width':300,
                        'height':300,
                        is3D: true, legend:{position:'none'}};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Dia', 'Entregas'],
          <?php 
            $_0 = 0;
            $_1 = 0;
            $_2 = 0;
            $_3 = 0;
            $_4 = 0;
            $_5 = 0;
            $_6 = 0;
            $_7 = 0;
            $_8 = 0;
            $_9 = 0;
            $_10 = 0;
            $_11 = 0;
            $_12 = 0;
            $_13 = 0;
            $_14 = 0;
            $_15 = 0;
            $_16 = 0;
            $_17 = 0;
            $_18 = 0;
            $_19 = 0;
            $_20 = 0;
            $_21 = 0;
            $_22 = 0;
            $_23 = 0;
            $_24 = 0;
            $_25 = 0;
            $_26 = 0;
            $_27 = 0;
            $_28 = 0;
            $_29 = 0;
            $_30 = 0;
            $_31 = 0;
            while ($row = mysqli_fetch_array($rsEntregasDiaDia, MYSQLI_BOTH)) {

              if ($row["dia"] == 1) {
                $_1 = $row["qtd"];
              } elseif ($row["dia"] == 2) {
                $_2 = $row["qtd"];
              } elseif ($row["dia"] == 3) {
                $_3 = $row["qtd"];
              } elseif ($row["dia"] == 4) {
                $_4 = $row["qtd"];
              } elseif ($row["dia"] == 5) {
                $_5 = $row["qtd"];
              } elseif ($row["dia"] == 6) {
                $_6 = $row["qtd"];
              } elseif ($row["dia"] == 7) {
                $_7 = $row["qtd"];
              } elseif ($row["dia"] == 8) {
                $_8 = $row["qtd"];
              } elseif ($row["dia"] == 9) {
                $_9 = $row["qtd"];
              } elseif ($row["dia"] == 10) {
                $_10 = $row["qtd"];
              } elseif ($row["dia"] == 11) {
                $_11 = $row["qtd"];
              } elseif ($row["dia"] == 12) {
                $_12 = $row["qtd"];
              } elseif ($row["dia"] == 13) {
                $_13 = $row["qtd"];
              } elseif ($row["dia"] == 14) {
                $_14 = $row["qtd"];
              } elseif ($row["dia"] == 15) {
                $_15 = $row["qtd"];
              } elseif ($row["dia"] == 16) {
                $_16 = $row["qtd"];
              } elseif ($row["dia"] == 17) {
                $_17 = $row["qtd"];
              } elseif ($row["dia"] == 18) {
                $_18 = $row["qtd"];
              } elseif ($row["dia"] == 19) {
                $_19 = $row["qtd"];
              } elseif ($row["dia"] == 20) {
                $_20 = $row["qtd"];
              } elseif ($row["dia"] == 21) {
                $_21 = $row["qtd"];
              } elseif ($row["dia"] == 22) {
                $_22 = $row["qtd"];
              } elseif ($row["dia"] == 23) {
                $_23 = $row["qtd"];
              } elseif ($row["dia"] == 24) {
                $_24 = $row["qtd"];
              } elseif ($row["dia"] == 25) {
                $_25 = $row["qtd"];
              } elseif ($row["dia"] == 26) {
                $_26 = $row["qtd"];
              } elseif ($row["dia"] == 27) {
                $_27 = $row["qtd"];
              } elseif ($row["dia"] == 28) {
                $_28 = $row["qtd"];
              } elseif ($row["dia"] == 29) {
                $_29 = $row["qtd"];
              } elseif ($row["dia"] == 30) {
                $_30 = $row["qtd"];
              } elseif ($row["dia"] == 31) {
                $_31 = $row["qtd"];
              }
            }

            echo "['01',  $_1],
            ['02',  $_2],
            ['03',  $_3],
            ['04',  $_4],
            ['05',  $_5],
            ['06',  $_6],
            ['07',  $_7],
            ['08',  $_8],
            ['09',  $_9],
            ['10',  $_10],
            ['11',  $_11],
            ['12',  $_12],
            ['13',  $_13],
            ['14',  $_14],
            ['15',  $_15],
            ['16',  $_16],
            ['17',  $_17],
            ['18',  $_18],
            ['19',  $_19],
            ['20',  $_20],
            ['21',  $_21],
            ['22',  $_22],
            ['23',  $_23],
            ['24',  $_24],
            ['25',  $_25],
            ['26',  $_26],
            ['27',  $_27],
            ['28',  $_28],
            ['29',  $_29],
            ['30',  $_30],
            ['31',  $_31]";
          ?>
        ]);

        var options = {
          
          hAxis: {title: 'dia do mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div_line'));
        chart.draw(data, options);
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
              include_once 'php/inc/menu_profile.php';
            ?>
            <!-- /menu profile quick info -->
            <br />
            <!-- sidebar menu -->
            <?php 
              include_once 'php/inc/side.php';
            ?>
            <!-- /sidebar menu -->
          </div>
        </div>

        <?php
          include_once 'php/inc/top.php';
        ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total de Usuários</span>
              <div class="count green"><?php echo $contUsuarioApp; ?></div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total de Pedidos Em Aberto</span>
              <div class="count"><?php echo $pedidosAberto;?></div>
              <span class="count_bottom">Mês de <?php mesPorExtenso(); ?></span>
            </div>
            <!--<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Average Time</span>
              <div class="count">123.50</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
            </div>-->
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total de Entregas</span>
              <div class="count green"><?php echo $pedidosEntrege;?></div>
              <span class="count_bottom">Mês de <?php mesPorExtenso(); ?></span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total de Condomínios</span>
              <div class="count"><?php echo $contCondominio; ?></div>
              <!--<span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>-->
            </div>
            <!--<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total de Entregadores</span>
              <div class="count">0</div>
            </div>-->
          </div>
          <!-- /top tiles -->

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Entregas por Dia <small>Mês de <?php echo mesPorExtenso(); ?></small></h3>
                  </div>
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                  <!--<div id="chart_plot_01" class="demo-placeholder"></div>-->
                  <div id="chart_div_line" style="width: 900px;" ></div>
                </div>
                
                <div class="clearfix"></div>
              </div>
            </div>

          </div>
          <br />

          <div class="row">


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Entregas em <?php echo mesPorExtenso(); ?></h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <h4>Entregas por Tipo de Garrafão</h4>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>5 Litros</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="<?php echo "width:".$pedidosCinco."%;"; ?>">
                          <span class="sr-only"><?php echo $pedidosCinco; ?></span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span><?php echo $pedidosCinco; ?></span>
                    </div>
                    <div class="clearfix"></div>
                  </div>

                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>10 Litros</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="<?php echo "width:".$pedidosDez."%;"; ?>">
                          <span class="sr-only"><?php echo $pedidosDez; ?> </span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span><?php echo $pedidosDez; ?></span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                  <h2>Entregas em <?php echo mesPorExtenso(); ?></h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div id="chart_div" wid></div>  
                </div>
              </div>
            </div>


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Menu Rápido</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">
                    <ul class="quick-list">
                      <li><i class="fa fa-shopping-cart"></i><a href="pedidos.php">Pedidos</a>
                      </li>
                      <li><i class="fa fa-building"></i><a href="condominio.php">Condomínios</a>
                      </li>
                      <li><i class="fa fa-users"></i><a href="usuarioapp.php">Usuários</a> </li>
                      <li><i class="fa fa-line-chart"></i><a href="#">Relatórios</a>
                      </li>
                      <li><i class="fa fa-bar-chart"></i><a href="noticias.php">Notícias</a> </li>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

          </div>


          <div class="row">
          
            </div>


            <div class="col-md-8 col-sm-8 col-xs-12">



              <div class="row">

              <div class="row">


                <!-- end of weather widget -->
              </div>
            </div>
          </div>
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
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	
  </body>
</html>
