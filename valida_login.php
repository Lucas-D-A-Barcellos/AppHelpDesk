<?php

session_start();

$email = $_POST['email'];
$senha = $_POST['senha'];

//criptografando a senha usando MD5
$senhaCriptografada = md5($senha);

// Requisição da conexão com o banco
require_once("conexao.php");

// SQL para buscar dados no banco, usando o email fornecido
$sql = "SELECT EMAIL, SENHA FROM usuario WHERE EMAIL = '$email'";
$result = $mysqli->query($sql);

if ($result) {
    // Verificar se há resultados
    if ($result->num_rows > 0) {
        // Obter a linha do resultado
        $row = $result->fetch_assoc();
        
        // Comparar a senha fornecida com a senha armazenada no banco
        if ($senhaCriptografada == $row['SENHA']) {

            // Senha correta   
            $_SESSION['autenticado'] = 'SIM';
            $_SESSION['user'] = $email;      
            header("Location: home.php");
            
        } else {
            // Senha incorreta
            // Redireciona de volta para a página de login
            $_SESSION['autenticado'] = 'NÃO';
            header("Location: index.php?login=erro");
            
        }
    } else {

        // Email incorreto
        $_SESSION['autenticado'] = 'NÃO';
        header("Location: index.php?login=erro");
         
    }

} else {
    // Erro na conexão
    echo '<script>alert("Erro de conexão com o banco de dados!");</script>';
    
    
}

?>
