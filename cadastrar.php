<?php

    //setando os dados enviados pela requisição post em variáveis
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Criptografar a senha usando MD5
    $senhaCriptografada = md5($senha);

    //requisição da conexão com o banco
    require_once("conexao.php");

    $verify = "SELECT EMAIL FROM usuario WHERE EMAIL = '$email'";
    $resultado = $mysqli->query($verify);

    if ($resultado->num_rows > 0) {
        
        header("Location: index.php?login=erro3");

    }else {

        //sql utilizando para inserir dados no banco, seguidos das variaveis inseridas
        $sql = "INSERT INTO usuario (NOME_USER, SOBRENOME_USER, EMAIL, SENHA) VALUES  ('$nome', '$sobrenome', '$email', '$senhaCriptografada')";
        $result = $mysqli->query($sql);

        // Dados inseridos com sucesso, exibe um alerta
        echo '<script>alert("Usuário cadastrado com sucesso!");</script>';

        // Redireciona para index.php após exibir o alerta
        header("Location: index.php");

        // Encerra o script para evitar que o código continue executando após o redirecionamento
        exit;
    }

    
?>