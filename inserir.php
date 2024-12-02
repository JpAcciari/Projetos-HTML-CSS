<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conexao = pg_connect("host=kesavan.db.elephantsql.com dbname=aekljadg user=aekljadg password=kKEMZKgkqDLwN98jK2HX8-H9aIgW2JVs port=5432");
    if (!$conexao) {
        die("Falha na conexão: " . pg_last_error());
    }
    
    if (isset($_POST['option'])) {
        $opcaoSelecionada = $_POST['option'];
        $nome = pg_escape_string($conexao, $_POST['txtnome']);
        $doc = pg_escape_string($conexao, $_POST['txtdoc']);
        $email = pg_escape_string($conexao, $_POST['txtemail']);
        $senha = pg_escape_string($conexao, $_POST['txtsenha']);

        if ($opcaoSelecionada == 1) {
            $insere = "INSERT INTO doadores (nome, cpf, email, senha) VALUES ('$nome', '$doc', '$email', '$senha')";
        } else {
            $insere = "INSERT INTO ongs (nome, cnpj, email, senha) VALUES ('$nome', '$doc', '$email', '$senha')";
        }
    
        $result = pg_query($conexao, $insere);
        if (!$result) {
            die("Erro ao inserir os dados: " . pg_last_error());
        }
    }
    pg_close($conexao);
}

require("login.html");

?>
