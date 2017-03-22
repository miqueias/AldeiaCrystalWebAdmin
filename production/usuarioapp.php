<?php 
ini_set('display_errors', 0);
include 'php/session.php';
include 'php/connection.php';

$mode = "add_usuarioapp";

if ($_GET['id'] != "") {
  $sql = "SELECT id_usuario_app, nome, telefone_fixo, 
                  telefone_celular, apt, codigo_acesso, 
                  status, condominio_id 
        FROM usuario_app
        WHERE id_usuario_app = ".$_GET['id'];

  $result = mysqli_query($mysqli, $sql);
  
  while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
    
    $id = $row["id_usuario_app"];
    $nome = utf8_encode(utf8_decode($row["nome"]));
    $telefone_fixo = utf8_encode(utf8_decode($row["telefone_fixo"]));
    $telefone_celular = utf8_encode(utf8_decode($row["telefone_celular"]));
    $apt = utf8_encode(utf8_decode($row["apt"]));
    $codigo_acesso = utf8_encode(utf8_decode($row["codigo_acesso"]));
    $status = $row["status"];
    $condominio_id = $row["condominio_id"];
    $mode = "edit_usuarioapp";
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
                <h3>Cadastros -> Usuários</h3>
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
                      <span class="section">Usuário</span>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nome <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="nome" class="form-control col-md-7 col-xs-12" name="nome" required="required" type="text" value="<?php echo $nome; ?>">
                          <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Tel. Fixo <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="telefone_fixo" name="telefone_fixo" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $telefone_fixo; ?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Tel. Celular <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="telefone_celular" name="telefone_celular" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $telefone_celular; ?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Condomínio <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="condominio_id">
                            <?php 
                              $sql = "SELECT id_condominio, nome FROM condominio ORDER BY nome ASC";

                              $result = mysqli_query($mysqli, $sql);

                              while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                                if ($row['id_condominio'] == $condominio_id) {
                                  echo "<option value=\"".$row['id_condominio']."\" selected>".($row['id_condominio'] * 1000). " - ".$row['nome']."</option>";
                                } else {
                                  echo "<option value=\"".$row['id_condominio']."\">".($row['id_condominio'] * 1000). " - " .$row['nome']."</option>";
                                }
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Apartamento <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="apt" name="apt" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $apt; ?>">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="button" class="btn btn-primary" onclick="window.location.href='usuarioapp.php'">Novo</button>
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
                            <th class="column-title">Nome </th>
                            <th class="column-title">Condomínio </th>
                            <th class="column-title">Apt </th>
                            <th class="column-title">Celular </th>
                            <th class="column-title">Status </th>
                            <th class="column-title no-link last"><span class="nobr"></span>
                            </th>
                            <th class="column-title no-link last"><span class="nobr"></span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                            
                          </tr>
                        </thead>

                        <tbody>
                        <?php
                          $sql = "SELECT u.id_usuario_app, u.nome, u.telefone_fixo, 
                                          u.telefone_celular, u.apt, u.codigo_acesso, 
                                          u.status, u.condominio_id, u.status,
                                          c.nome as nome_condominio, c.id_condominio 
                                  FROM usuario_app u, condominio c 
                                  WHERE c.id_condominio = u.condominio_id";

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
                            } else {
                              $status = "Inativo";
                            }

                            echo '<tr class="'.$class.'">
                                    <td class=" ">'.$row["id_usuario_app"].'</td>
                                    <td class=" ">'.utf8_encode(utf8_decode($row["nome"])).'</td>
                                    <td class=" ">'.utf8_encode(utf8_decode($row["nome_condominio"])).'</td>
                                    <td class=" ">'.$row["apt"].'</td>
                                    <td class=" ">'.$row["telefone_celular"].'</td>
                                    <td class=" ">'.$status.'</td>
                                    <td class=" last"><a href="usuarioapp.php?id='.$row["id_usuario_app"].'">Editar</a></td>
                                    <td class=" last"><a href="#">Suspender</a></td>
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