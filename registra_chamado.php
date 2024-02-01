<?php

session_start();

$titulo = $_POST['titulo'];
$categoria = $_POST['categoria'];
$desc = $_POST['desc']; 
$user = $_SESSION['user'];

require_once("conexao.php");

$sql = "SELECT ID_USER FROM usuario WHERE EMAIL = '$user'"; 

$result = $mysqli->query($sql);

    // Verifica se a consulta foi bem-sucedida
    if ($result) {
        $row = $result->fetch_assoc(); // Obtém a linha de resultado como um array associativo

        // Obtém o valor específico da coluna "ID_USER" do array $row
        $user_id = $row['ID_USER'];

        $update = "INSERT INTO chamados (TITULO, CATEGORIA, DESCRICAO, ID_USER) VALUES  ('$titulo', '$categoria', '$desc', '$user_id')";

        $result = $mysqli->query($update);

    } else {
        echo "Erro na consulta: " . $mysqli->error;
    }

// Fecha a conexão
$mysqli->close();

echo '<script>alert("Chamado criado com Sucesso!");</script>';

Header('Location: abrir_chamado.php');

exit(); // Termina o script após o redirecionamento

?>
