<?php
session_start();

$response = [
    'logged_in' => false,
    'is_ong' => false
];

if (isset($_SESSION['user_email'])) {
    $response['logged_in'] = true;

    if (isset($_SESSION['user_cnpj'])) {
        $response['is_ong'] = true;
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>
