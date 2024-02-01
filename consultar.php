<?php

$chamados = array();
$user = $_SESSION['user'];

require_once("conexao.php");

$verify = "SELECT ID_USER FROM usuario WHERE EMAIL = '$user'"; 
$result = $mysqli->query($verify);

    // Verifica se a consulta foi bem-sucedida
    if ($result) {
        $row = $result->fetch_assoc(); // Obtém a linha de resultado como um array associativo

        // Obtém o valor específico da coluna "ID_USER" do array $row
        $user_id = $row['ID_USER'];
    }

$sql = "SELECT * FROM chamados WHERE ID_USER = '$user_id'";
$result = $mysqli->query($sql);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $chamado = array(
                'titulo' => htmlspecialchars($row['TITULO']),
                'categoria' => htmlspecialchars($row['CATEGORIA']),
                'descricao' => htmlspecialchars($row['DESCRICAO'])
                
            );

            $chamados[] = $chamado;
        }
    } else {
        
        echo "Erro na consulta: " . $mysqli->error;
    }

$mysqli->close();
?>