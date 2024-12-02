<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conexão com o banco de dados
    $conexao = pg_connect("host=kesavan.db.elephantsql.com dbname=aekljadg user=aekljadg password=kKEMZKgkqDLwN98jK2HX8-H9aIgW2JVs port=5432");
    if (!$conexao) {
        die("Falha na conexão: " . pg_last_error());
    }

    // Dados recebidos do formulário
    $nome_anuncio = pg_escape_string($conexao, $_POST['txtnome_anuncio']);
    $descricao = pg_escape_string($conexao, $_POST['txtdescricao']);
    $nome_ong = $_SESSION['user_nome'];  // Nome da ONG (já salvo na sessão)
    $cnpj = $_SESSION['user_cnpj'];  // CNPJ da ONG (já salvo na sessão)
    
    // Tratamento da imagem
    $imagem = ''; // Valor inicial
    if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
        // Define o diretório onde a imagem será salva
        $diretorio = 'uploads/';
        $nome_imagem = basename($_FILES['img']['name']);
        $caminho_imagem = $diretorio . $nome_imagem;

        // Verifica se a imagem foi movida para o diretório
        if (move_uploaded_file($_FILES['img']['tmp_name'], $caminho_imagem)) {
            $imagem = $caminho_imagem;  // Caminho da imagem
        } else {
            echo '<script>alert("Falha ao fazer upload da imagem.");</script>';
        }
    }

    // Verifica se todos os dados estão presentes
    if ($nome_anuncio && $descricao && $cnpj && $imagem) {
        // Query de inserção no banco de dados
        $query = "INSERT INTO anuncios (nome, descricao, ong_cnpj, imagem) 
                  VALUES ($1, $2, $3, $4)";
        
        // Executa a query
        $result = pg_query_params($conexao, $query, [$nome_anuncio, $descricao, $cnpj, $imagem]);

        if ($result) {
            echo '<script>alert("Anúncio criado com sucesso!");</script>';
        } else {
            echo '<script>alert("Erro ao criar o anúncio.");</script>';
        }
    } else {
        echo '<script>alert("Todos os campos são obrigatórios!");</script>';
    }

    // Fecha a conexão
    pg_close($conexao);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Anuncio</title>
    <link rel="stylesheet" type="text/css" href="css/criarAnuncio.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <script type="text/javascript"></script>
</head>

<style>
    .nome-ong {
        display: flex;
        justify-content: center;
    }
</style>

<body>
    <header class="cabecalho"> 
        <img class="cabecalho-imagem" src="imgs/thenext.png" alt="Logo Site">
        <nav class="cabecalho-menu">
            <a href="index.html" class="cabecalho-menu-item">Menu</a>
            <a href="doacao.php" class="cabecalho-menu-item">Doação</a>
            <a href="profile.php" class="cabecalho-menu-item">Perfil</a>
        </nav>
        
        <div id="login-button-container">
            <!-- O botão de login/logout será inserido aqui via JavaScript -->
        </div>
    </header>

    <main class="conteudo">
        <div class="container">
            <form name="frmAnuncio" method="post" action="" enctype="multipart/form-data" class="form-anuncio">
    
                <!-- Exibir o nome da ONG dinamicamente -->
                <h2 class="nome-ong">
                    <?php 
                    // Exibe o nome da ONG da sessão
                    if (isset($_SESSION['user_nome'])) {
                        echo $_SESSION['user_nome'];
                    } else {
                        echo "Nome da ONG não encontrado";
                    }
                    ?>
                </h2>
                <br>

                <!-- Campo para nome do anúncio -->
                <label for="txtnome_anuncio" class="form-label">Nome do Anúncio:</label><br>
                <input type="text" name="txtnome_anuncio" class="form-input" required><br><br>
    
                <label for="txtcontato" class="form-label">Contato:</label><br>
                <input type="text" name="txtcontato" value="<?php echo isset($_SESSION['user_telefone']) ? $_SESSION['user_telefone'] : ''; ?>" class="form-input"><br><br>
    
                <label for="txtdescricao" class="form-label">Descrição:</label><br>
                <input type="text" name="txtdescricao" value="" class="form-input" required><br><br>
    
                <label for="txtimg" class="form-label">Imagem:</label><br>
                <input type="file" name="img" class="form-input-img" required><br><br>

                <input type="submit" value="Criar Anúncio" class="form-button">
    
            </form>
        </div>
    </main>
    

    <footer class="rodape">
        <div class="rodape-container">
            <div class="rodape-coluna">
                <h4>Sobre Nós</h4>
                <p>Nós somos um grupo dedicado a transformar vidas através de doações. Acreditamos no poder da solidariedade e da generosidade.</p>
            </div>
            <div class="rodape-coluna">
                <h4>Links Úteis</h4>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="doacao.php">Doação</a></li>
                    <li><a href="profile.php">Perfil</a></li>
                    <li><a href="contato.html">Contato</a></li>
                </ul>
            </div>
            <div class="rodape-coluna">
                <h4>Contato</h4>
                <p>Email: contato@doe.com</p>
                <p>Telefone: (19) 1234-5678</p>
            </div>
            <div class="rodape-coluna">
                <h4>Redes Sociais</h4>
                <div class="rodape-icones">
                    <a href="#"><ion-icon name="logo-facebook"></ion-icon></a>
                    <a href="#"><ion-icon name="logo-instagram"></ion-icon></a>
                    <a href="#"><ion-icon name="logo-twitter"></ion-icon></a>
                    <a href="#"><ion-icon name="logo-linkedin"></ion-icon></a>
                </div>
            </div>
        </div>
    </footer>
</body>

    <script src="js/script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</html>
