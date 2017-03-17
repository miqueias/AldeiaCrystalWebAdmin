<?php 
ini_set('display_errors', 0);
include 'php/session.php';
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
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
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
                <h3>Pedidos</h3>
              </div>

              
            </div>
            <div class="clearfix"></div>

            <div class="row">
              
          </div>

          <!--table-->
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Histórico de Pedidos</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Código</th>
                          <th>Data</th>
                          <th>Condóminio</th>
                          <th>Apt</th>
                          <th>Cliente</th>
                          <th>Produto</th>
                          <th>Status</th>
                          <th>Ped. Entregue</th>
                          <th>Imprimir</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>0001</td>
                          <td>04/08/2017</td>
                          <td>Palmeiras da Silva</td>
                          <td>202</td>
                          <td>Manuel da Costa</td>
                          <td>Crystal 5L</td>
                          <td>Pendente</td>
                          <td class=" last"><a href="#"><center><img src="images/icon_ok.gif"></a></center></td>
                          <td class=" last"><a href="#"><center><img src="images/icon_print.png"></a></center></td>
                        </tr>
                        <tr>
                          <td>00012</td>
                          <td>09/10/2017</td>
                          <td>Santo e Silva</td>
                          <td>404</td>
                          <td>Marcos Julio</td>
                          <td>Crystal 5L</td>
                          <td>Pendente</td>
                          <td class=" last"><a href="#"><center><img src="images/icon_ok.gif"></a></center></td>
                          <td class=" last"><a href="#"><center><img src="images/icon_print.png"></a></center></td>
                        </tr>
                        <tr>
                          <td>0003</td>
                          <td>05/11/2017</td>
                          <td>Drummond de Andrade</td>
                          <td>345</td>
                          <td>Guilerme Costa</td>
                          <td>Crystal 10L</td>
                          <td>Pendente</td>
                          <td class=" last"><a href="#"><center><img src="images/icon_ok.gif"></a></center></td>
                          <td class=" last"><a href="#"><center><img src="images/icon_print.png"></a></center></td>
                        </tr>
                        <tr>
                          <td>0004</td>
                          <td>25/12/2017</td>
                          <td>Palmeiras da Silva</td>
                          <td>282</td>
                          <td>Maria Conceição</td>
                          <td>Crystal 5L</td>
                          <td>Pendente</td>
                          <td class=" last"><a href="#"><center><img src="images/icon_ok.gif"></a></center></td>
                          <td class=" last"><a href="#"><center><img src="images/icon_print.png"></a></center></td>
                        </tr>
                        <tr>
                          <td>0005</td>
                          <td>15/01/2017</td>
                          <td>Clarita</td>
                          <td>109</td>
                          <td>Felipe Seabra</td>
                          <td>Crystal 10L</td>
                          <td>Pendente</td>
                          <td class=" last"><a href="#"><center><img src="images/icon_ok.gif"></a></center></td>
                          <td class=" last"><a href="#"><center><img src="images/icon_print.png"></a></center></td>
                        </tr>
                        <tr>
                          <td>0006</td>
                          <td>16/10/2017</td>
                          <td>Palmeiras da Silva</td>
                          <td>765</td>
                          <td>Camila Araujo</td>
                          <td>Crystal 10L</td>
                          <td>Pendente</td>
                          <td class=" last"><a href="#"><center><img src="images/icon_ok.gif"></a></center></td>
                          <td class=" last"><a href="#"><center><img src="images/icon_print.png"></a></center></td>
                        </tr>
                        <tr>
                          <td>0007</td>
                          <td>09/11/2017</td>
                          <td>Palmeiras da Silva</td>
                          <td>876</td>
                          <td>Manuel da Costa</td>
                          <td>Crystal 5L</td>
                          <td>Pendente</td>
                          <td class=" last"><a href="#"><center><img src="images/icon_ok.gif"></a></center></td>
                          <td class=" last"><a href="#"><center><img src="images/icon_print.png"></a></center></td>
                        </tr>
                        <tr>
                          <td>0008</td>
                          <td>25/02/2017</td>
                          <td>Rio Mar Trade Center</td>
                          <td>987</td>
                          <td>Manuel da Costa</td>
                          <td>Crystal 5L</td>
                          <td>Pendente</td>
                          <td class=" last"><a href="#"><center><img src="images/icon_ok.gif"></a></center></td>
                          <td class=" last"><a href="#"><center><img src="images/icon_print.png"></a></center></td>
                        </tr>
                        <tr>
                          <td>0009</td>
                          <td>22/03/2017</td>
                          <td>Canavial</td>
                          <td>224</td>
                          <td>Manuel da Costa</td>
                          <td>Crystal 5L</td>
                          <td>Pendente</td>
                          <td class=" last"><a href="#"><center><img src="images/icon_ok.gif"></a></center></td>
                          <td class=" last"><a href="#"><center><img src="images/icon_print.png"></a></center></td>
                        </tr>
                        <tr>
                          <td>0009</td>
                          <td>05/10/2017</td>
                          <td>Palmeiras da Silva</td>
                          <td>321</td>
                          <td>Manuel da Costa</td>
                          <td>Crystal 5L</td>
                          <td>Pendente</td>
                          <td class=" last"><a href="#"><center><img src="images/icon_ok.gif"></a></center></td>
                          <td class=" last"><a href="#"><center><img src="images/icon_print.png"></a></center></td>
                        </tr>
                        <tr>
                          <td>0010</td>
                          <td>05/10/2017</td>
                          <td>Palmeiras da Silva</td>
                          <td>202</td>
                          <td>Manuel da Costa</td>
                          <td>Crystal 5L</td>
                          <td>Pendente</td>
                          <td class=" last"><a href="#"><center><img src="images/icon_ok.gif"></a></center></td>
                          <td class=" last"><a href="#"><center><img src="images/icon_print.png"></a></center></td>
                        </tr>
                        </tr>
                      </tbody>
                    </table>
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
    <!-- validator -->
    <script src="../vendors/validator/validator.js"></script>
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
  
  </body>
</html>