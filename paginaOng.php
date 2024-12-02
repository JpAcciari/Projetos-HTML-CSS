<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/profileOng.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>ONG</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .conteudo {
            padding: 20px;
        }
        .bio-section {
            background-image: radial-gradient(circle at 45.08% 45.08%, #fbf0d0 0, #f7e7c3 25%, #f2deb5 50%, #eed5a8 75%, #eacb9b 100%);
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 8px 8px 8px rgba(0, 0, 0, 0.1);
        }
        .bio-header {
            display: flex;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #8B0000;
        }
        .bio-content {
            margin-bottom: 15px;
            font-size: 16px;
            line-height: 1.6;
            color: black;
        }
        .donation-section {
            background-image: radial-gradient(circle at 45.08% 45.08%, #fbf0d0 0, #f7e7c3 25%, #f2deb5 50%, #eed5a8 75%, #eacb9b 100%);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 8px 8px 8px rgba(0, 0, 0, 0.1);
        }
        .donation-header {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #8B0000;
        }
        .donation-post {
            border: 1px solid #8B0000;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .post-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 8px;
        }
        .post-content {
            font-size: 14px;
            color: black;
        }

        .post-content a{
            font-size: 18px;
            font-weight: bold;           
            color: #8B0000;
        }
    </style>

</head>
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

        <div class="bio-section">
            <div class="bio-header">Sobre a ONG</div>
            <div class="bio-content" id="bio-content">
                <p></p>
            </div>
        </div>

        
        <div class="donation-section">
            <div class="donation-header">Anúncios de Doações</div>


            <div class="donation-post">
                <div class="post-title">Doação de Cestas Básicas</div>
                <div class="post-content">
                    Ajude famílias carentes doando cestas básicas. Sua contribuição faz a diferença! 
                    <strong>Meta:</strong> 10 cestas básicas.
                    <a href="paginaAnuncio.php">Saiba mais...</a>
                </div>
            </div>
            
            <div class="donation-post">
                <div class="post-title">Campanha de Cobertores para o Inverno</div>
                <div class="post-content">
                    Estamos arrecadando cobertores para ajudar pessoas em situação de rua a enfrentarem o frio deste inverno. 
                    <strong>Meta:</strong> 20 cobertores.
                    <a href="paginaAnuncio.php">Saiba mais...</a>
                </div>
            </div>

            
            <div class="donation-post">
                <div class="post-title">Campanha de Livros Infantis</div>
                <div class="post-content">
                    Doe livros infantis e ajude a incentivar a leitura entre crianças de comunidades carentes. 
                    <strong>Meta:</strong> 25 livros.
                    <a href="paginaAnuncio.php">Saiba mais...</a>
                </div>
            </div>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $.ajax({
        url: 'check_login.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            var loginButtonContainer = $('#login-button-container');
            if (response.logged_in) {
                loginButtonContainer.html('<div class="botao-login-anuncio"> <a href="logout.php"><button class="cabecalho-menu-login">Sair</button></a> <a href="criarAnuncio.php"><button class="cabecalho-menu-anuncio"><i class="fas fa-plus"></i></button></a> </div>');
            } else {
                loginButtonContainer.html('<a href="login.html"><button class="cabecalho-menu-login">Login</button></a>');
            }
        },
        error: function(xhr, status, error) {
            console.error('Erro ao verificar o status de login:', error);
        }
    });
});
</script>

    <style>

        .botao-login-anuncio {
            display: flex;
            flex-direction: row;
            gap: 200px;
        }

        .cabecalho-menu-anuncio {
            width: 60px;
            height: 50px;
            background: #8B0000;
            border: none;
            outline: none;
            border-radius: 100px;
            font-size: 1.2em;
            cursor: pointer;
            color: white;
            font-weight: 600;
            font-family: 'Sarala', sans-serif;
            font-size: 20px;
            box-shadow: 2px 2px 2px black;
        }

        .cabecalho-menu-anuncio:hover {
            background: #B22222;
        }
    </style>

    <script src="js/script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>