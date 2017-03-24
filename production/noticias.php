<?php 
ini_set('display_errors', 0);
include 'php/session.php';
include 'php/connection.php';

$mode = "add_noticia";

if ($_GET['id'] != "") {
  $sql = "SELECT id_noticia, titulo, descricao, status 
          FROM noticia    
          WHERE id_noticia = ".$_GET['id'];

  $result = mysqli_query($mysqli, $sql);
  
  while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
    $id_noticia = $row["id_noticia"];
    $titulo = utf8_encode(utf8_decode($row["titulo"]));
    $descricao = utf8_encode(utf8_decode($row["descricao"]));
    $status =  $row["status"];
    $mode = "edit_noticia";
  }
}

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
                <h3>Cadastros -> Notícias</h3>
              </div>

              
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <!--<h2>Form validation <small>sub title</small></h2>-->
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" novalidate name="form" method="post" action="php/facade.php?a=<?php echo $mode; ?>">

                      <!--<p>For alternative validation library <code>parsleyJS</code> check out in the <a href="form.html">form page</a>-->
                      </p>
                      <span class="section">Notícia</span>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Título <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="titulo" class="form-control col-md-7 col-xs-12" name="titulo" required="required" type="text" value="<?php echo $titulo; ?>">
                          <input type="hidden" name="id" id="id" value="<?php echo $id_noticia; ?>" />
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Descrição <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea required="required" id="descricao" name="descricao" rows="10" cols="5" class="form-control col-md-7 col-xs-12"><?php echo $descricao; ?></textarea>
                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="button" class="btn btn-primary" onclick="window.location.href='noticias.php'">Novo</button>
                          <button id="send" type="submit" class="btn btn-success">Salvar</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--table-->
            <div class="row">
              <div class="clearfix"></div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Usuários Cadastrados</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            
                            <th class="column-title">Código </th>
                            <th class="column-title">Título </th>
                            <th class="column-title">Descrição </th>
                            <th class="column-title">Status </th>
                            <th class="column-title no-link last"><span class="nobr"></span>
                            <th class="column-title no-link last"><span class="nobr"></span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        <?php
                          $sql = "SELECT id_noticia, titulo, descricao, status FROM noticia";

                          $result = mysqli_query($mysqli, $sql);
                          $i = 0;

                          while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {

                            if ($i % 2 == 0) {
                              $class = "even pointe";
                            } else {
                              $class = "odd pointe";
                            }
                            
                            if ($row["status"] == "A") {
                              $status = "Ativo";
                              $tr = '<td class=" last"><a href="php/facade.php?a=del_noticia&id='.$row["id_noticia"].'">Suspender</a></td>';
                            } else {
                              $status = "Inativo";
                              $tr = '<td class=" last"><a href="php/facade.php?a=active_noticia&id='.$row["id_noticia"].'">Ativar</a></td>';
                            }

                            echo '<tr class="'.$class.'">
                                    <td class=" ">'.$row["id_noticia"].'</td>
                                    <td class=" ">'.utf8_encode(utf8_decode($row["titulo"])).'</td>
                                    <td class=" ">'.utf8_encode(utf8_decode($row["descricao"])).'</td>
                                    <td class=" ">'.$status.'</td>
                                    '.$tr.'
                                    <td class=" last"><a href="noticias.php?id='.$row["id_noticia"].'">Editar</a></td>
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