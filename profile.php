<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/perfil.css">
    <title>Perfil</title>
</head>
<body>
<header class="cabecalho">
    <img class="cabecalho-imagem" src="imgs/thenext.png" alt="Logo Site">
    <nav class="cabecalho-menu">
        <a href="index.html" class="cabecalho-menu-item">Menu</a>
        <a href="doacao.php" class="cabecalho-menu-item">Doação</a>
    </nav>
    <?php
    session_start();
    if (isset($_SESSION['user_email'])) {
        echo '<a href="logout.php"><button class="cabecalho-menu-login">Sair</button></a>';
    } else {
        echo '<a href="login.html"><button class="cabecalho-menu-login">Login</button></a>';
    }
    ?>
</header>

<main class="line-top">
    <div class="container">
        <h1>Dados do Usuário</h1>
        <div class="profile" id="conteudo">
            <!-- O conteúdo carregado via AJAX será inserido aqui -->
        </div>
    </div>
    
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $.ajax({
        url: 'perfil.php',
        type: 'GET',
        success: function(response) {
            $('#conteudo').html(response);
        },
        error: function(xhr, status, error) {
            console.error('Erro ao carregar o conteúdo:', error);
        }
    });
});
</script>
  

</body>
</html>
