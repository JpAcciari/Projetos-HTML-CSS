<?php
session_start();

$conexao = pg_connect("host=kesavan.db.elephantsql.com dbname=aekljadg user=aekljadg password=kKEMZKgkqDLwN98jK2HX8-H9aIgW2JVs port=5432");
if (!$conexao) {
    die("Falha na conexão: " . pg_last_error());
}

$query = "
SELECT 
  a.id_anuncio AS id_anuncio,
  a.nome AS nome,
  a.descricao AS descricao,
  a.imagem AS imagem,
  o.nome AS ong_nome,
  o.cnpj AS ong_cnpj
FROM anuncios a, ongs o
WHERE a.ong_cnpj = o.cnpj";
$result = pg_query($conexao, $query);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doação</title>
    <link rel="stylesheet" type="text/css" href="css/doacao.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<style>
    .card-destaque button {
    background-color: #8B0000;
    width: 100px;
    height: 30px;
    border: none;
    border-radius: 6px;
    font-family: 'Sarala', sans-serif;
    font-weight: 400;
    font-size: 16px;
    color: #FFFAFA;
    cursor: pointer;
    margin-top: 24px;
    margin-left: 74px;
    margin-bottom: -100px;
    }

    .card-destaque button:hover {
        background-color: #B22222;
    }

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

<body>

    <header class="cabecalho"> 
        <img class="cabecalho-imagem" src="imgs/thenext.png" alt="Logo Site">
        <nav class="cabecalho-menu">
            <a href="index.html" class="cabecalho-menu-item">Menu</a>
            <a href="profile.php"cabecalho-menu-item">Perfil</a>
        </nav>
        <div id="login-button-container">
        </div>
    </header>

<main class="conteudo-doacao">
    <section class="carrossel-campanhas-apenas-titulo">
        <h2 class="carrossel-campanhas-titulo">Campanhas</h2>
    </section>
    
    <section class="carrossel-campanhas">
        <div class="carrossel">
            <div class="slide-campanha-1">
                <h3>Rio Grande do Sul</h3>
                <p>Faça parte dessa corrente do bem! O Rio Grande do Sul está unido em solidariedade e prontidão para ajudar aqueles que mais precisam. Se você tem algo para doar, junte-se a nós e faça a diferença na vida de quem precisa.</p>
                <button>Saber mais...</button>
                <img src="imgs/sosriograndedosul.jpg" alt="Rio Grande do Sul">
            </div>
            <div class="slide-campanha-2">
                <h3>Campanha do Agasalho 2024</h3>
                <p>Doar também é um gesto de amor e salva vidas, nesse inverno vamos contribuir com o próximo.</p>
                <button>Saber mais...</button>
                <img src="imgs/campanha-agasalho.png" alt="Imagem campanha agasalho">
            </div>
            <div class="slide-campanha-3">
                <h3>Rifa Benefiente</h3>
                <p>Estamos realizando uma rifa beneficiente em prol da ONG Vida Lata, com o intuito de arrecadar dinheiro para ração e mendicamentos de uso veterinário, venha e contribua com essa ação.</p>
                <button>Saber mais...</button>
                <img src="imgs/campanha-cachorro.png" alt="Imagem campanha cachorro">
            </div>
        </div>
    </section>
    
    <section class="conteudo-secundario"> 
        <h3 class="conteudo-secundario-titulo">Categorias</h3>
    </section>

    <section class="container">
        <div class="card">
            <img src="imgs/alimentos.png" alt="Imagem Alimentos">
            <h4>Alimentos</h4>
        </div>
        <div class="card">
            <img src="imgs/animais.png" alt="Imagem Animais">
            <h4>Animais / Pets</h4>
        </div>
        <div class="card">
            <img src="imgs/festas.png" alt="Imagem Eventos">
            <h4>Eventos</h4>
        </div>    
    </section>
    <section class="container">
        <div class="card">
            <img src="imgs/vestuario.png" alt="Imagem Vestuario">
            <h4>Vestuário</h4>
        </div>
        <div class="card">
            <img src="imgs/saude.png" alt="Imagem Saude">
            <h4>Saúde / Tratamento</h4>
        </div>
        <div class="card">
            <img src="imgs/projeto-social.png" alt="Imagem Projeto Social">
            <h4>Projetos Sociais</h4>
        </div>
    </section>

    <section class="carrossel-ong-apenas-titulo">
        <h2 class="carrossel-ong-titulo">ONG's</h2>
    </section>
    <section class="carrossel-ong">
        <div class="carrossel">
            <div class="slide-1">
                <h3>IMENE</h3>
                <p>Na Imene, acreditamos que a educação é a chave para a transformação social. Nosso compromisso é capacitar indivíduos e fortalecer comunidades, oferecendo oportunidades de aprendizado que criam pontes para um futuro mais promissor. Com cada aula ministrada e cada pessoa formada, reforçamos a crença de que juntos podemos construir um mundo melhor.</p>
                <button>Saber mais...</button>
                <img src="imgs/imene.png" alt="Imagem IMENE">
            </div>
            <div class="slide-2">
                <h3>Instituto Vaga Lume</h3>
                <p>o Instituto Vaga Lume, tem como objetivo empoderar crianças das comunidades rurais da Amazônia a partir da leitura e da gestão de bibliotecas comunitárias.</p>
                <button>Saber mais...</button>
                <img src="imgs/vaga-lume.png" alt="Imagem vaga-lume">
            </div>
            <div class="slide-3">
                <h3>Amor De Bicho</h3>
                <p>A ONG Amor de Bicho, tem o foco no regaste, tratamento e encontrar um novo lar para os animais.</p>
                <button>Saber mais...</button>
                <img src="imgs/amor-de-bicho.png" alt="Imagem amor de bicho">
            </div>
            <div class="slide-4">
                <h3>Instituto Amor e Vida</h3>
                <p>O Instituto Amor e Vida foi fundado em 05/03/2007 e reconhecido como Utilidade Pública Municipal em 05 de Junho de 2009, com o objetivo de apoiar pessoas portadoras de câncer e seus familiares, empreendendo apoio humano, emocional, econômico e material. Contamos com sua ajuda para mantermos o nosso trabalho.</p>
                <button>Saber mais...</button>
                <img src="imgs/amor-e-vida.png" alt="Imagem amor e vida">
            </div>
        </div>
    </section>

    <section class="conteudo-secundario"> 
        <h3 class="conteudo-secundario-titulo">Destaques</h3>
    </section>

    <section class="container-2">
        <?php while ($anuncio = pg_fetch_assoc($result)): ?>
            <div class="card-destaque">
                <img src="<?php echo htmlspecialchars($anuncio['imagem'], ENT_QUOTES, 'UTF-8'); ?>" alt="Imagem <?php echo htmlspecialchars($anuncio['nome'], ENT_QUOTES, 'UTF-8'); ?>">
                <h4><?php echo htmlspecialchars($anuncio['nome'], ENT_QUOTES, 'UTF-8'); ?></h4>
                <p><?php echo htmlspecialchars($anuncio['descricao'], ENT_QUOTES, 'UTF-8'); ?></p>
                <a href="paginaOng.php?cnpj=<?php echo htmlspecialchars($anuncio['ong_cnpj'], ENT_QUOTES, 'UTF-8'); ?>" class="card-descricao"><?php echo htmlspecialchars($anuncio['ong_nome'], ENT_QUOTES, 'UTF-8'); ?></a>
                <button onclick="location.href='paginaAnuncio.php?id_anuncio=<?php echo htmlspecialchars($anuncio['id_anuncio'], ENT_QUOTES, 'UTF-8'); ?>'">Detalhes...</button>
            </div>
        <?php endwhile; ?>
    </section>

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
                <li><a href="doacao.html">Doação</a></li>
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
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
    $(document).ready(function() {
    $('.carrossel').slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        adaptiveHeight: true
    });

    // Verifica o status de login
    $.ajax({
        url: 'check_login.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            var loginButtonContainer = $('#login-button-container');

            if (response.logged_in) {
                let buttons = '<a href="logout.php"><button class="cabecalho-menu-login">Sair</button></a>';
                
                if (response.is_ong) {
                    // Adiciona o botão de criar anúncio se for ONG
                    buttons += '<a href="criarAnuncio.html"><button class="cabecalho-menu-anuncio"><i class="fas fa-plus"></i></button></a>';
                }
                
                loginButtonContainer.html(`<div class="botao-login-anuncio">${buttons}</div>`);
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
</body>
</html>
