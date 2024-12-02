<?php
$host = 'kesavan.db.elephantsql.com';
$dbname = 'aekljadg';
$username = 'aekljadg';
$password = 'kKEMZKgkqDLwN98jK2HX8-H9aIgW2JVs';
$port = 5432;

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}
?>
