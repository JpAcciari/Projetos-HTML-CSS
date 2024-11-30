<?php 
session_start(); // Inicia a sessão

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conexao = mysqli_connect('127.0.0.1', 'root', '', 'doacao', 3306);
    if (!$conexao) {
        die("Falha na conexão: " . mysqli_connect_error());
    }

    $email = mysqli_real_escape_string($conexao, $_POST['txtemail']);
    $senha = mysqli_real_escape_string($conexao, $_POST['txtsenha']);
        
    $stmt = $conexao->prepare("SELECT * FROM doadores WHERE email = ? AND senha = ?");
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        $stmt = $conexao->prepare("SELECT * FROM ongs WHERE email = ? AND senha = ?");
        $stmt->bind_param("ss", $email, $senha);
        $stmt->execute();
        $result = $stmt->get_result();
    } 

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc(); // Obtém os dados do usuário

        // Guarda as informações do usuário na sessão
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

        // Redireciona para uma página protegida
        header('Location: index.html');
        exit;
    } else {
        echo '<script>alert("Login incorreto");</script>';
    }

    $stmt->close();
    mysqli_close($conexao);
}

require("login.html");
?>
