<?php
// Defina suas credenciais de banco de dados
$host = '127.0.0.1';  // Geralmente 'localhost' se você estiver usando o MySQL localmente
$dbname = 'doacao';  // Substitua pelo nome do seu banco de dados
$username = 'root';  // Substitua pelo seu nome de usuário do MySQL
$password = '';  // Substitua pela sua senha do MySQL

try {
    // Cria uma conexão PDO com o banco de dados
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Define o modo de erro do PDO para exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Caso tudo dê certo, a conexão está estabelecida
    // echo "Conexão bem-sucedida!";
} catch (PDOException $e) {
    // Caso haja erro, exibe uma mensagem de erro
    die("Erro de conexão: " . $e->getMessage());
}
?>
