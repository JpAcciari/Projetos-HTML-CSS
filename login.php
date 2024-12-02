<?php 
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conexao = pg_connect("host=kesavan.db.elephantsql.com dbname=aekljadg user=aekljadg password=kKEMZKgkqDLwN98jK2HX8-H9aIgW2JVs port=5432");
    if (!$conexao) {
        die("Falha na conexão: " . pg_last_error());
    }

    $email = pg_escape_string($conexao, $_POST['txtemail']);
    $senha = pg_escape_string($conexao, $_POST['txtsenha']);
        
    $query = "SELECT * FROM doadores WHERE email = $1 AND senha = $2";
    $result = pg_query_params($conexao, $query, [$email, $senha]);

    if (pg_num_rows($result) == 0) {
        $query = "SELECT * FROM ongs WHERE email = $1 AND senha = $2";
        $result = pg_query_params($conexao, $query, [$email, $senha]);
    } 

    if (pg_num_rows($result) > 0) {
        $user = pg_fetch_assoc($result);

        $_SESSION['user_nome'] = $user['nome'];
        if (isset($user['cpf'])) {
            $_SESSION['user_cpf'] = $user['cpf'];
        } else {
            $_SESSION['user_cnpj'] = $user['cnpj'];
            $_SESSION['user_nome_responsavel'] = $user['nome_responsavel'];
            $_SESSION['user_cpf_responsavel'] = $user['cpf_responsavel'];
        }
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_senha'] = $user['senha'];
        $_SESSION['user_cep'] = $user['cep'];
        $_SESSION['user_endereco'] = $user['endereco'];

        header('Location: index.html');
        exit;
    } else {
        echo '<script>alert("Login incorreto");</script>';
    }

    pg_free_result($result);
    pg_close($conexao);
}

require("login.html");
?>
