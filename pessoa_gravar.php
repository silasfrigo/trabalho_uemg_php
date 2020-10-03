<?php
    session_start();
    require_once('variaveis.php');
    require_once('conexao.php');
    

    $id_pessoa = $_POST["inputIdPessoa"];

    $nome = strtoupper($_POST["inputNome"]);
    $numero = $_POST["inputNumero"];
    $datanasc  = $_POST["inputDataNasc"];
    $cep = $_POST["inputCep"];
    $telefone  = $_POST["inputTelefone"];
    $email = $_POST["inputEmail"];
    
    
    if($id_pessoa){
      //atualizar
      $sql = "UPDATE pessoas SET
               nome='$nome',
               email='$email',
               numero='$numero',
               datanascimento= '$datanasc',
               cep = '$cep',
               telefone = '$telefone'
             WHERE idPessoa = $id_pessoa";
   }else{
      //insert
      $sql = "INSERT INTO pessoas( nome, email, numero, datanascimento, cep, telefone)
              VALUES('$nome', '$email','$numero','$datanasc','$cep','$telefone' )";
   }

   mysqli_query($conexao_bd, $sql);
   mysqli_close($conexao_bd);
   header("location:pessoas_list.php");
   echo $sql;


    
    ?>