<?php
   session_start();
   require_once('variaveis.php');
   require_once('conexao.php');

   //$id_usuario = $_GET["id_usuario"];
   
   //recuperando dados da sessao
   $id_usuario   = $_SESSION["id_usuario"];   
   $nome_usuario = "";

   //validar se codigo do usuario esta na sesao
   if(strlen($id_usuario) == 0){
      header("location: index.php");
   }

   $sql = "SELECT nome FROM usuarios WHERE id = " . $id_usuario;
   $resp = mysqli_query($conexao_bd, $sql);
   if($rows=mysqli_fetch_row($resp)){
      $nome_usuario = $rows[0];
   }   
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>SysPacientes - ADM</title>
    <link rel="icon" href="img/favicon/favicon2.ico">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/navbar.css" rel="stylesheet">
   <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
        <a class="navbar-brand" href="#">SysPacientes</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample09">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
              <a class="nav-link" href="admin.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cadastros</a>
              <div class="dropdown-menu" aria-labelledby="dropdown09">
                <a class="dropdown-item" href="#">Cadastro de pessoas</a>
                <a class="dropdown-item" href="usuario_list.php">Cadastro de usuários</a>                
                <a class="dropdown-item" href="#">Cadastro de pacientes</a>
              </div>
            </li>
          </ul>  
          <ul class="navbar-nav navbar-right">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown10" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php echo($nome_usuario); ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdown10">
                <a class="dropdown-item" href="minhaconta.php">Minha conta</a>
                <a class="dropdown-item" href="logout.php">Sair</a>                 
              </div>
            </li>
          </ul>
        </div>
      </nav>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Listagem de usuários:</h1>
        <table class="table">
        <p>
         <thead>
            <tr>
               <th scope="col">#</th>
               <th scope="col">Nome</th>
               <th scope="col">E-mail</th>
               <th scope="col">...</th>
            </tr>
         </thead>
         <tbody>
            <?php
               $sql = "SELECT id, nome, email FROM usuarios ORDER BY Nome";
               $resp = mysqli_query($conexao_bd, $sql);
               while($rows=mysqli_fetch_row($resp)){
                  $idUsuario   = $rows[0];
                  $nomeUsuario = $rows[1];
                  $email       = $rows[2];
                  echo("<tr>");
                  echo("<th scope='row'>$idUsuario</td>");
                  echo("<td>$nomeUsuario</td>");
                  echo("<td>$email</td>");
                  echo("<td>");
                  echo("<a class='btn btn-lg btn-success' href='usuario.php?idUsuario=$idUsuario' role='button'>Editar</a>&nbsp;");
                  echo("<a class='btn btn-lg btn-danger' href='usuario_excluir.php?idUsuario=$idUsuario' role='button'>Excluir</a>");
                  echo("</td>");
                  echo("</tr>");
               }                
            ?>
         </tbody>
        </table>
        </p>        
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="https://code.jquery.com/jquery-1.12.4.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <?php
    mysqli_close($conexao_bd);
    ?>
</body>
</html>