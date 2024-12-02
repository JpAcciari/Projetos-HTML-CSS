<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    echo '<script>alert("Só será possível visualizar seus dados ao realizar o login.");</script>';
    exit;
}

$user_nome = $_SESSION['user_nome'];
$user_email = $_SESSION['user_email'];
$user_senha = $_SESSION['user_senha'];
$user_cep = $_SESSION['user_cep'];
$user_endereco = $_SESSION['user_endereco'];

if (isset($_SESSION['user_cpf'])) {
    $user_doc = $_SESSION['user_cpf'];
    $user_is_ong = false;
} else {
    $user_is_ong = true;
    $user_doc = $_SESSION['user_cnpj'];
    $user_nome_responsavel = $_SESSION['user_nome_responsavel'];
    $user_cpf_responsavel = $_SESSION['user_cpf_responsavel'];
    $user_telefone = $_SESSION['user_telefone']; // Atribuindo telefone da ONG
    $user_descricao = $_SESSION['user_descricao']; // Atribuindo descrição da ONG
}

if (isset($_SESSION['user_cpf'])) {
    echo '
<style>
    .profile-form {
        width: 80%;
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        border: 2px solid #ccc;
        border-radius: 5px;
    }
    
    .form-label {
        font-weight: bold;
    }
    
    .form-input {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 2px solid #ccc;
        border-radius: 4px;
    }
    
    .form-button {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    
    .form-button:hover {
        background-color: #45a049;
    }
    
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f0f0f0;
    }
    
    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
    h1 {
        text-align: center;
        margin-bottom: 20px;
    }
    
    .profile-info {
        margin-bottom: 20px;
    }
    
    label {
        font-weight: bold;
    }
    
    p {
        margin-bottom: 10px;
    }
    
    .profile-info p {
        margin-bottom: 15px;
    }
    
    .profile-info p:last-child {
        margin-bottom: 0;
    }

    </style>
    <div class="profile-form">

    <form name="frmProfile" method="post" action="alteracao.php" class="form">
        <label for="txtnome" class="form-label">Nome Completo:</label><br>
        <input type="text" name="txtnome" value="' . $user_nome . '" class="form-input"><br><br>

        <label for="txtdoc" class="form-label">CPF:</label><br>
        <input type="text" name="txtdoc" value="' . $user_doc . '" class="form-input"><br><br>

        <label for="txtemail" class="form-label">Email:</label><br>
        <input type="text" name="txtemail" value="' . $user_email . '" class="form-input"><br><br>

        <label for="txtcep" class="form-label">CEP:</label><br>
        <input type="text" name="txtcep" value="' . $user_cep . '" class="form-input"><br><br>

        <label for="txtendereco" class="form-label">Endereço:</label><br>
        <input type="text" name="txtendereco" value="' . $user_endereco . '" class="form-input"><br><br>

        <input type="submit" value="Atualizar" class="form-button">
    </form>
    </div>
    ';
} else {
    echo '
    <style>
        
    .formulario-ong-profile {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        margin-top: 20px;
    }

    .form {
        width: 100%;
        padding: 20px;
    }
    
    .form-label {
        font-weight: bold;
    }
    
    .form-input {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    
    .form-button {
        height: 45px;
        width: 120px;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    
    .form-button:hover {
        background-color: #45a049;
    }    

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f0f0f0;
    }
    
    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 30px;
    }
    
    .profile-info {
        margin-bottom: 20px;
    }
    
    label {
        font-weight: bold;
    }
    
    p {
        margin-bottom: 10px;
    }
    
    .profile-info p {
        margin-bottom: 15px;
    }
    
    .profile-info p:last-child {
        margin-bottom: 0;
    }

    </style>
    <div class="formulario-ong-profile">
        <form name="frmProfile" method="post" action="alteracao.php" class="form">
            <label for="txtnome" class="form-label">Nome ONG:</label><br>
            <input type="text" name="txtnome" value="' . $user_nome . '" class="form-input"><br><br>

            <label for="txtdoc" class="form-label">CNPJ:</label><br>
            <input type="text" name="txtdoc" value="' . $user_doc . '" class="form-input"><br><br>

            <label for="txtemail" class="form-label">Email:</label><br>
            <input type="text" name="txtemail" value="' . $user_email . '" class="form-input"><br><br>

            <label for="txtnomeresponsavel" class="form-label">Nome Responsável:</label><br>
            <input type="text" name="txtnomeresponsavel" value="' . $user_nome_responsavel . '" class="form-input"><br><br>

            <label for="txtcpfresponsavel" class="form-label">CPF Responsável:</label><br>
            <input type="text" name="txtcpfresponsavel" value="' . $user_cpf_responsavel . '" class="form-input"><br><br>

            <label for="txttelefone" class="form-label">Telefone:</label><br>
            <input type="text" name="txttelefone" value="' . $user_telefone . '" class="form-input"><br><br>

            <label for="txtcep" class="form-label">CEP:</label><br>
            <input type="text" name="txtcep" value="' . $user_cep . '" class="form-input"><br><br>

            <label for="txtendereco" class="form-label">Endereço:</label><br>
            <input type="text" name="txtendereco" value="' . $user_endereco . '" class="form-input"><br><br>

            <label for="txtdescricao" class="form-label">Descrição:</label><br>
            <input type="text" name="txtdescricao" value="' . $user_descricao . '" class="form-input"><br><br>

            <input type="submit" value="Atualizar" class="form-button">
        </form>
    </div>
    
    ';
}
?>
