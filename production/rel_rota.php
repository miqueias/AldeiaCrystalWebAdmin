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
        <?php
         if($_GET["id_entregador"] == "") {
          $idEntregadorJs = 0;
         } else {
          $idEntregadorJs = $_GET["id_entregador"];
         }

         ?>
        window.open("print_rota.php?id_entregador="+<?php echo $idEntregadorJs; ?>, '_blank');
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
                <h3>Relatórios -> Rota de Entrega</h3>
              </div>

              
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Entregador: </h2><br />   
                        <select class="form-control" name="entregador" id="entregador">
                          <option value="">-- Selecione o entregador --</option>
                          <?php 

                            $sql = "SELECT id_entregador, nome, cpf FROM entregador ORDER BY nome ASC";

                            $result = mysqli_query($mysqli, $sql);
                            $i = 0;

                            while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                              echo "<option value=\"".$row['id_entregador']."\">".$row['nome']."</option>";
                            }
                          ?>
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
                    <h2>Rota de Entrega</h2>
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
                            <th class="column-title">Entregador </th>
                          </tr>
                        </thead>

                        <tbody>
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
                                <td class=" ">'.$row["id_pedido"].'</td>
                                <td class=" ">'.utf8_encode(utf8_decode($row["nome_cliente"])).'</td>
                                <td class=" ">'.utf8_encode(utf8_decode($row["nome_condominio"])).'</td>
                                <td class=" ">'.utf8_encode(utf8_decode($row["apt"])).'</td>
                                <td class=" ">'.utf8_encode(utf8_decode($row["data_hora"])).'</td>
                                <td class=" ">'.utf8_encode(utf8_decode($row["nome_entregador"])).'</td>
                              </tr>';
                            
                            $i++;
                          }
                        ?>
                        </tbody>
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