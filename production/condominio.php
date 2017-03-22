<?php 
ini_set('display_errors', 0);
include 'php/session.php';
include 'php/connection.php';

$mode = "add_condominio";

if ($_GET['id'] != "") {
  $sql = "SELECT id_condominio, nome, rua, numero, bairro, cidade, uf, cep, referencia, nome_sindico, telefone, status, id_entregador
        FROM condominio c
        WHERE id_condominio = ".$_GET['id'];

  $result = mysqli_query($mysqli, $sql);
  
  while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
    
    $id = $row["id_condominio"];
    $nome = utf8_encode(utf8_decode($row["nome"]));
    $rua = utf8_encode(utf8_decode($row["rua"]));
    $numero = utf8_encode(utf8_decode($row["numero"]));
    $bairro = utf8_encode(utf8_decode($row["bairro"]));
    $cidade = utf8_encode(utf8_decode($row["cidade"]));
    $uf = $row["uf"];
    $cep = $row["cep"];
    $referencia = utf8_encode(utf8_decode($row["referencia"]));
    $sindico = utf8_encode(utf8_decode($row["nome_sindico"]));
    $telefone = $row["telefone"];
    $status = $row["status"];
    $id_entregador = $row["id_entregador"];
    $mode = "edit_condominio";
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
                <h3>Cadastros -> Condomínios</h3>
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
                      <span class="section">Condomínio</span>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nome <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="nome" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="nome" required="required" type="text" value="<?php echo $nome;?>">
                          <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Rua <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="rua" name="rua" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $rua;?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Número <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="numero" name="numero" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $numero;?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Bairro <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="bairro" name="bairro" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $bairro;?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Cidade <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="cidade" name="cidade" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $cidade;?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">UF <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="uf" type="text" name="uf" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $uf;?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="password" class="control-label col-md-3">CEP <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="cep" type="text" name="cep" class="form-control col-md-7 col-xs-12" required="required" value="<?php echo $cep;?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Síndico <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="sindico" type="text" name="sindico" class="form-control col-md-7 col-xs-12" required="required" value="<?php echo $sindico;?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Telefone <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="telefone" name="telefone" required="required" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12" value="<?php echo $telefone;?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Observações 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="observacoes" name="observacoes" class="form-control col-md-7 col-xs-12"><?php echo $referencia;?></textarea>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Entregador <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="entregador">
                            <?php 

                              $sql = "SELECT id_entregador, nome, cpf FROM entregador ORDER BY nome ASC";

                              $result = mysqli_query($mysqli, $sql);
                              $i = 0;

                              while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                                if ($row['id_entregador'] == $id_entregador) {
                                  echo "<option value=\"".$row['id_entregador']."\" selected>".$row['nome']."</option>";
                                } else {
                                  echo "<option value=\"".$row['id_entregador']."\">".$row['nome']."</option>";
                                }
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="button" class="btn btn-primary" onclick="window.location.href='condominio.php'">Novo</button>
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
                    <h2>Condomínios Cadastrados</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            
                            <th class="column-title">Código </th>
                            <th class="column-title">Nome </th>
                            <th class="column-title">Rua </th>
                            <th class="column-title">Bairro </th>
                            <th class="column-title">Cidade </th>
                            <th class="column-title">Síndico </th>
                            <th class="column-title">Telefone </th>
                            <th class="column-title">Entregador </th>
                            <th class="column-title no-link last"><span class="nobr"></span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        <?php
                          $sql = "SELECT c.id_condominio, c.nome, c.rua, c.numero, c.bairro, c.cidade, c.uf, c.cep, c.referencia, c.nome_sindico, c.telefone, c.status, c.id_entregador, e.nome as nome_entregador
                                FROM condominio c, entregador e
                                WHERE c.id_entregador = e.id_entregador 
                                ORDER BY c.id_condominio ASC";

                          $result = mysqli_query($mysqli, $sql);
                          $i = 0;

                          while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {

                            if ($i % 2 == 0) {
                              $class = "even pointe";
                            } else {
                              $class = "odd pointe";
                            }

                            echo '<tr class="'.$class.'">
                                <td class=" ">'.($row["id_condominio"] * 1000).'</td>
                                <td class=" ">'.utf8_encode(utf8_decode($row["nome"])).'</td>
                                <td class=" ">'.utf8_encode(utf8_decode($row["rua"])).'</td>
                                <td class=" ">'.utf8_encode(utf8_decode($row["bairro"])).'</td>
                                <td class=" ">'.utf8_encode(utf8_decode($row["cidade"])).'</td>
                                <td class=" ">'.utf8_encode(utf8_decode($row["nome_sindico"])).'</td>
                                <td class=" ">'.utf8_encode(utf8_decode($row["telefone"])).'</td>
                                <td class=" ">'.utf8_encode(utf8_decode($row["nome_entregador"])).'</td>
                                <td class=" last"><a href="condominio.php?id='.$row["id_condominio"].'">Editar</a>
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