<?php
session_start();
$conexao = pg_connect("host=kesavan.db.elephantsql.com dbname=aekljadg user=aekljadg password=kKEMZKgkqDLwN98jK2HX8-H9aIgW2JVs port=5432");

if (!$conexao) {
    die("Erro ao conectar com o banco de dados.");
}

if (isset($_GET['id_anuncio'])) {
    $id_anuncio = intval($_GET['id_anuncio']);
} else {
    die("ID do anúncio não fornecido.");
}

$query = "
SELECT 
  o.cnpj AS cnpj_ong,
  o.nome AS nome_ong,
  o.email AS email_ong,
  o.telefone AS telefone_ong,
  o.endereco AS endereco_ong,
  a.nome AS nome_anuncio,
  a.descricao AS descricao_anuncio,
  a.imagem
FROM anuncios a
INNER JOIN ongs o ON a.ong_cnpj = o.cnpj
WHERE a.id_anuncio = $1
";
$result = pg_query_params($conexao, $query, array($id_anuncio));

if (pg_num_rows($result) > 0) {
    $anuncio = pg_fetch_assoc($result);
    $cnpj_ong = $anuncio['cnpj_ong'];
} else {
    die("Anúncio não encontrado.");
}

$query_outros = "
SELECT 
  id_anuncio,
  nome AS nome_anuncio,
  imagem
FROM anuncios
WHERE ong_cnpj = $1 AND id_anuncio != $2
";
$result_outros = pg_query_params($conexao, $query_outros, array($cnpj_ong, $id_anuncio));

$outros_anuncios_disponiveis = pg_num_rows($result_outros) > 0;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/anuncio.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Anúncio Doação</title>
    <style>
        .anuncio-titulo {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .anuncio-destaque {
            display: flex;
            justify-content: center;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 40px;
        }

        .anuncio-destaque-inicio {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .anuncio-detalhes {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            gap: 20px;
        }

        .anuncio-destaque-imagem {
            width: 480px;
            height: 380px;
            margin-left: -6px;
            margin-top: -6px;
            border-radius: 5px;
            margin: 10px 10px 10px 10px;
        }

        .anuncio-destaque-info {
            display: flex;
            flex-direction: column;
        }

        .anuncio-titulo {
            font-size: 2em;
            margin-bottom: 10px;
            font-family: 'Roboto', sans-serif;
        }

        .anuncio-descricao {
            font-family: 'Roboto', sans-serif;
        }

        .anuncio-destaque-lateral {
            display: flex;
            flex-direction: column;
            align-content: center;
            justify-content: end;
            gap: 20px;
        }

        .anuncio-botao {
            background-color: #8B0000;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 6px;
            font-size: 18px;
            cursor: pointer;
            font-family: 'Sarala', sans-serif;
        }

        .anuncio-botao:hover {
            background-color: #B22222;
        }

        .outros-anuncios {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 10px;
        }

        .outros-anuncios h2 {
            font-size: 30px;
            margin-bottom: 20px;
            font-family: 'Sarala', sans-serif;
        }

        .anuncios-galeria p {
            font-family: 'Sarala', sans-serif;
            font-size: 14px;
            margin-top: 10px;
            margin-left: 6px;
            text-align: center;
        }

        .anuncios-galeria {
            background-image: radial-gradient(circle at 45.08% 45.08%, #fbf0d0 0, #f7e7c3 25%, #f2deb5 50%, #eed5a8 75%, #eacb9b 100%);
            width: 258px;
            height: 390px;
            margin: 20px;
            border-radius: 6px;
            display: flex;
            flex-direction: column;
            outline: auto;
            outline-style: solid;
            outline-color: #5a4d36;
            padding: 5px;
            box-shadow: 20px 20px 20px -22px;
        }

        .anuncio-miniatura {
            width: 260px;
            height: 200px;
            margin-left: -6px;
            margin-top: -6px;
            border-radius: 5px;
            border: solid 2px;
            border-top: 0px;
            border-left: 0px;
            border-right: 0px;
            border-color: #5a4d36;
        }

        .anuncio-titulo-pequeno {
            padding: 10px;
            margin-top: 4px;
            font-family: 'Roboto', sans-serif;
            font-size: 1rem;
            display: flex;
            justify-content: center;
        }

        .anuncio-botao-pequeno {
            background-color: #8B0000;
            width: 100px;
            height: 26px;
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

        .anuncio-botao-pequeno:hover {
            background-color: #B22222;
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

        <div id="login-button-container"></div>
    </header>

    <main class="conteudo">
        <h1 class="anuncio-titulo"><?php echo htmlspecialchars($anuncio['nome_anuncio'], ENT_QUOTES, 'UTF-8'); ?></h1>
        <section class="anuncio-destaque">
            <div class="anuncio-detalhes">
                <div class="anuncio-destaque-inicio">
                    <img class="anuncio-destaque-imagem" src="<?php echo htmlspecialchars($anuncio['imagem'], ENT_QUOTES, 'UTF-8'); ?>" alt="Imagem do anúncio">
                </div>
                <div class="anuncio-destaque-lateral">
                    <p class="anuncio-descricao">
                        <?php echo htmlspecialchars($anuncio['descricao_anuncio'], ENT_QUOTES, 'UTF-8'); ?>
                    </p>
                    <p class="anuncio-ong">
                        <strong>ONG:</strong> <?php echo htmlspecialchars($anuncio['nome_ong'], ENT_QUOTES, 'UTF-8'); ?>
                    </p>
                    <p class="anuncio-contato">
                        <strong>Contato:</strong> <?php echo htmlspecialchars($anuncio['telefone_ong'], ENT_QUOTES, 'UTF-8'); ?> | 
                        <?php echo htmlspecialchars($anuncio['email_ong'], ENT_QUOTES, 'UTF-8'); ?>
                    </p>
                    <button class="anuncio-botao">Realizar Doação</button>
                </div>
            </div>
        </section>

        <?php if ($outros_anuncios_disponiveis): ?>
        <section class="outros-anuncios">
            <h2>Outras Doações Disponíveis</h2>
            <div class="anuncios-galeria">
                <?php while ($outro_anuncio = pg_fetch_assoc($result_outros)): ?>
                    <img class="anuncio-miniatura" src="<?php echo $outro_anuncio['imagem']; ?>" alt="Imagem do Item">
                    <h3 class="anuncio-titulo-pequeno"><?php echo $outro_anuncio['nome_anuncio']; ?></h3>
                    <button class="anuncio-botao-pequeno" onclick="location.href='paginaAnuncio.php?id_anuncio=<?php echo $outro_anuncio['id_anuncio']; ?>'">Ver Detalhes</button>
                <?php endwhile; ?>
            </div>
        </section>
        <?php endif; ?>
    </main>

    <footer class="rodape">
        <p>&copy; 2024 ONG Doações - Todos os direitos reservados.</p>
    </footer>
</body>
</html>
