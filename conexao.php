<?php
   $conexao_bd = mysqli_connect(
                  "localhost",
                  "root",
                  "1234",
                  "syspacientes");
   if(!$conexao_bd){
      echo "Não foi possível conectar no banco de dados: ";
      exit;
   }
   
   //echo "conectou!";
?>