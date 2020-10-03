<?php
    session_start();
    require_once('variaveis.php');
    require_once('conexao.php');
    
    


    $idPessoa = $_GET['idPessoa'];
    //recuperando dados da sessao
     $id_usuario   = $_SESSION["id_usuario"];
     $tipoAcesso   = $_SESSION["tipo_acesso"];    
     $nome_usuario = "";
     
     $sql = "SELECT nome FROM usuarios WHERE id = ".$id_usuario;
     $resp = mysqli_query($conexao_bd, $sql);
     if($rows=mysqli_fetch_row($resp)){
         $nome_usuario = $rows[0];
     }
    
    
    
    $nomePessoa  = "";
    $numeroPessoa = "";
    $datanascPessoa = "";
    $cepPessoa  = "";
    $telefonePessoa   = "";
    $emailPessoa   = "";
    
    
    $sql = "SELECT nome, numero, datanascimento, cep, telefone, email FROM pessoas where idPessoa = ".$idPessoa;
            
    $resp = mysqli_query($conexao_bd, $sql);
    if($rows=mysqli_fetch_row($resp)){
       $nomePessoa = $rows[0];      
       $numeroPessoa = $rows[1];
       $datanascPessoa = $rows[2];
       $cepPessoa  = $rows[3];
       $telefonePessoa   = $rows[4];
       $emailPessoa   = $rows[5];
    }

    function Mask($mask,$str){

        $str = str_replace(" ","",$str);
    
        for($i=0;$i<strlen($str);$i++){
            $mask[strpos($mask,"#")] = $str[$i];
        }
    
        return $mask;
    
    }

    ?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SysPacientes - Cadastrar/Editar pessoa</title>
        <link rel="icon" href="img/favicon/favicon2.ico">
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
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
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <?php 
                            if($tipoAcesso != 3) {
                            ?>
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cadastros</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown09">
                                <a class="dropdown-item" href="#">Cadastro de pessoas</a>
                                <a class="dropdown-item" href="usuario_list2.php">Cadastro de usuários</a>                
                                <a class="dropdown-item" href="#">Cadastro de pacientes</a>
                            </div>
                        </li>
                        <?php
                            }
                            ?>
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
            <div class="jumbotron">

                <form
                    method="post"
                    action="pessoa_gravar.php">
                    <div class="form-group">
                        <label for="inputNome">Nome da pessoa:</label>
                        <input type="text" class="form-control" id="inputNome" 
                            name="inputNome" placeholder="Nome da pessoa" maxlength="100"
                            value="<?php echo($nomePessoa); ?>"
                            >
                            
                    </div>
                    <div class="form-group">
                        <label for="inputNumero">Numero do endereço:</label>
                        <input type="text" class="form-control" id="inputNumero" 
                            name="inputNumero" placeholder="Numero do endereço" onkeypress="return isNumberKey(event)"
                            value="<?php echo($numeroPessoa); ?>"
                            >
                    </div>
                    <div class="form-group">
                        <label for="inputDataNasc">Data de Nascimento:</label>
                        <input type="text" class="form-control date" id="inputDataNasc" 
                            name="inputDataNasc" placeholder="Data de Nascimento"
                            value="<?php echo($datanascPessoa); ?>"
                            >
                    </div>
                    <div class="form-group">
                        <label for="inputCep">CEP:</label>
                        <input type="text" class="form-control cep" id="inputCep" 
                            name="inputCep" placeholder="CEP"
                            value="<?php echo($cepPessoa); ?>"
                            
                            >
                    </div>

                    <div class="form-group">
                        <label for="inputTelefone">Telefone:</label>
                        <input type="text" class="form-control phone_with_ddd" id="inputTelefone" 
                            name="inputTelefone" placeholder="Telefone"
                            value="<?php echo($telefonePessoa); ?>"
                            >
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">E-mail:</label>
                        <input type="email" class="form-control" id="inputEmail" 
                            name="inputEmail" placeholder="E-mail"
                            value="<?php echo($emailPessoa); ?>"
                            >
                    </div>
                    
                    <input type="hidden" id="inputIdPessoa" name="inputIdPessoa" value="<?php echo($idPessoa) ?>">
                    <button type="submit" class="btn btn-success">Gravar</button>&nbsp;
                    <a href="pessoas_list.php" class="btn btn-warning" role="button">Retornar</a>
                </form>
            </div>
        </div>

        <script src="./js/jquery-3.5.1.min.js" type="text/javascript"></script>
        <script src="./js/jquery.mask.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(document).ready(function(){
            $('.date').mask('00/00/0000');
            $('.cep').mask('00.000-000');
            $('.phone_with_ddd').mask('(00) 00000-0000');
        });
        </script>

    </body>
    <?php
        //encerrando a conexao com mysql
        mysqli_close($conexao_bd);
        ?>
    <script>
       function isNumberKey(evt)
			{
				var charCode = (evt.which) ? evt.which : evt.keyCode;
				if (charCode != 46 && charCode > 31 
				&& (charCode < 48 || charCode > 57))
				return false;
				return true;
			}  
    </script>
</html>