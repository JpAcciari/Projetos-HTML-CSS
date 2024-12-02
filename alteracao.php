<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header('Location: erroPerfil.html');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conexao = pg_connect("host=kesavan.db.elephantsql.com dbname=aekljadg user=aekljadg password=kKEMZKgkqDLwN98jK2HX8-H9aIgW2JVs port=5432");
    if (!$conexao) 
        die("Falha na conexão: " . pg_last_error());

    $nome = pg_escape_string($conexao, $_POST['txtnome']);
    $doc = pg_escape_string($conexao, $_POST['txtdoc']);
    $email = pg_escape_string($conexao, $_POST['txtemail']);
    $cep = pg_escape_string($conexao, $_POST['txtcep']);
    $endereco = pg_escape_string($conexao, $_POST['txtendereco']);
    $user_nome_responsavel = pg_escape_string($conexao, $_POST['txtnomeresponsavel']);
    $user_cpf_responsavel = pg_escape_string($conexao, $_POST['txtcpfresponsavel']);
    $user_telefone = pg_escape_string($conexao, $_POST['txttelefone']);  // Telefone
    $user_descricao = pg_escape_string($conexao, $_POST['txtdescricao']);  // Descrição

    if (isset($_SESSION['user_cpf'])) {
        $query = "UPDATE doadores SET nome = $1, cpf = $2, email = $3, cep = $4, endereco = $5 WHERE email = $6";
        $params = [$nome, $doc, $email, $cep, $endereco, $_SESSION['user_email']];
    } else {
        $query = "UPDATE ongs SET nome = $1, cnpj = $2, email = $3, cep = $4, endereco = $5, nome_responsavel = $6, cpf_responsavel = $7, telefone = $8, descricao = $9 WHERE email = $10";
        $params = [$nome, $doc, $email, $cep, $endereco, $user_nome_responsavel, $user_cpf_responsavel, $user_telefone, $user_descricao, $_SESSION['user_email']];
    }

    $result = pg_query_params($conexao, $query, $params);

    if ($result) {
        $_SESSION['user_nome'] = $nome;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_cep'] = $cep;
        $_SESSION['user_endereco'] = $endereco;
        if (isset($_SESSION['user_cpf'])) {
            $_SESSION['user_cpf'] = $doc;
        } else {
            $_SESSION['user_cnpj'] = $doc;
            $_SESSION['user_nome_responsavel'] = $user_nome_responsavel;
            $_SESSION['user_cpf_responsavel'] = $user_cpf_responsavel;
            $_SESSION['user_telefone'] = $user_telefone;  // Atualiza telefone
            $_SESSION['user_descricao'] = $user_descricao;  // Atualiza descrição
        }

        echo "Informações atualizadas com sucesso!";
    } else {
        echo "Erro ao atualizar informações: " . pg_last_error($conexao);
    }

    pg_close($conexao);
    header('Location: profile.php');
    exit;
}
?>