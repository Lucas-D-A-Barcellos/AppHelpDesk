<?php

    // Ler as configurações do arquivo JSON
    $configFile = 'config.json';
    $config = json_decode(file_get_contents($configFile), true);

    // Extrair as informações do JSON
    $hostname = $config['hostname'];
    $bancodedados = $config['bancodedados'];
    $usuario = $config['usuario'];
    $senha = $config['senha'];

    //objeto mysqli para conexões com o banco seguidos dos parâmetros setados anteriormente
    $mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);

    //teste retornando erro de conexão
    if ($mysqli->connect_errno) {
        
        header("Location: index.php?login=erro3");

    }

?>