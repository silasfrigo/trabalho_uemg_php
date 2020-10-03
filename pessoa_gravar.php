<?php
    session_start();
    require_once('variaveis.php');
    require_once('conexao.php');
    
    
    $id_pessoa = $_POST["inputIdPessoa"];
    
    $email = $_POST["inputEmail"];
    $nome = strtoupper($_POST["inputNome"]);
    $datanasc  = $_POST["inputDataNasc"];
    $cep = $_POST["inputCep"];
    $telefone  = $_POST["inputTelefone"];
    $celular = $_POST["inputCelular"];
    $estado = $_POST["inputEstado"];
    $cidade = $_POST["inputCidade"];
    $endereco = $_POST["inputEndereco"];
    $numero = $_POST["inputNumero"];
    $complemento = $_POST["inputComplemento"];
    
    if($id_pessoa){
      //atualizar
      $sql = "UPDATE pessoas SET 
          nome='$nome', 
          email='$email', 
          numero='$numero',
          datanascimento= '$datanasc',
          cep = '$cep',
          telefone = '$telefone',
          complemento = '$complemento',
          cidade = '$cidade',
          estado = '$estado',
          celular = '$celular'
   WHERE idPessoa = $id_pessoa";
    }else{
      //insert
      $sql = "INSERT INTO pessoas( nome, email, numero, datanascimento, cep, telefone, celular, endereco, estado, complemento, cidade)
              VALUES('$nome', '$email','$numero','$datanasc','$cep','$telefone','$celular','$endereco','$estado','$complemento','$cidade' )";
    }

    mysqli_query($conexao_bd, $sql);
    mysqli_close($conexao_bd);
    header("location:pessoas_list.php");
    echo $sql;
    
    
    
  ?>