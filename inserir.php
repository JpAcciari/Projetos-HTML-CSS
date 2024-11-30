<?php 

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conexao = mysqli_connect('127.0.0.1', 'root', '', 'doacao', 3306);
    if (!$conexao) 
        die("Falha na conexão: " . mysqli_connect_error());
    
    
    if (isset($_POST['option'])) {
        $opcaoSelecionada = $_POST['option'];
        $nome = mysqli_real_escape_string($conexao, $_POST['txtnome']);
        $doc = mysqli_real_escape_string($conexao, $_POST['txtdoc']);
        $email = mysqli_real_escape_string($conexao, $_POST['txtemail']);
        $senha = mysqli_real_escape_string($conexao, $_POST['txtsenha']);

        
        if ($opcaoSelecionada == 1)
            $insere = "INSERT INTO doadores (nome, cpf, email, senha) VALUES ('$nome', '$doc', '$email', '$senha')";
        else 
            $insere = "INSERT INTO ongs (nome, cnpj, email, senha) VALUES ('$nome', '$doc', '$email', '$senha')";
        
        
        mysqli_query($conexao, $insere); 
    }
    
    mysqli_close($conexao);
}

require("login.html");


?>