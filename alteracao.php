<?php
session_start();

// Verifica o login
if (!isset($_SESSION['user_email'])) {
    header('Location: erroPerfil.html');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conexao = mysqli_connect('127.0.0.1', 'root', '', 'doacao', 3306);
    if (!$conexao) 
        die("Falha na conexão: " . mysqli_connect_error());

    $nome = mysqli_real_escape_string($conexao, $_POST['txtnome']);
    $doc = mysqli_real_escape_string($conexao, $_POST['txtdoc']);
    $email = mysqli_real_escape_string($conexao, $_POST['txtemail']);
    $cep = mysqli_real_escape_string($conexao, $_POST['txtcep']);
    $endereco = mysqli_real_escape_string($conexao, $_POST['txtendereco']);
    $user_nome_responsavel = mysqli_real_escape_string($conexao, $_POST['txtnomeresponsavel']);
    $user_cpf_responsavel = mysqli_real_escape_string($conexao, $_POST['txtcpfresponsavel']);

    if (isset($_SESSION['user_cpf'])) {
        $query = "UPDATE doadores SET nome='$nome', cpf='$doc', email='$email', cep='$cep', endereco='$endereco' WHERE email='{$_SESSION['user_email']}'";
    } else {
        $query = "UPDATE ongs SET nome='$nome', cnpj='$doc', email='$email', cep='$cep', endereco='$endereco', nome_responsavel='$user_nome_responsavel', cpf_responsavel='$user_cpf_responsavel' WHERE email='{$_SESSION['user_email']}'";
    }

    if (mysqli_query($conexao, $query)) {
        // Atualiza os dados na sessão
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
        }

        echo "Informações atualizadas com sucesso!";
    } else {
        echo "Erro ao atualizar informações: " . mysqli_error($conexao);
    }

    mysqli_close($conexao);
    header('Location: profile.php');
    exit;
}
?>


