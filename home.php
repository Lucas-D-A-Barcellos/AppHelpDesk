<?php

session_start();

  if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'SIM') {

  header('Location: index.php?login=erro2');
  
  }

?>

<html>
  <head>
    <meta charset="utf-8" />
    <title>App Help Desk</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
      .card-home {
        padding: 30px 0 0 0;
        width: 100%;
        margin: 0 auto;
      }

      .link:hover {
        transform: scale(1.1);
      }

      .titulo h3{
        text-decoration: none;
        color: #383838;
      }

      .titulo h3:hover {
        text-decoration: none;  /* Remova a decoração ao passar o mouse, se desejado */
      }

    </style>
  </head>

  <body>

    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
        <img src="logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        App Help Desk
      </a>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="logoff.php">SAIR</a>
        </li>
      </ul>
    </nav>

    <div class="container">    
      <div class="row">

        <div class="card-home">
          <div class="card">
            <div class="card-header">
              Menu
            </div>
            <div class="card-body">
              <div class="row">               
                <div class="col-6 d-flex justify-content-center">
                    <h3 class="titulo">Abrir Chamado</h2>
                </div>
                <div class="col-6 d-flex justify-content-center">          
                    <h3 class="titulo">Consultar Chamados</h2>                 
                </div>
              </div>
              <div class="row">
                
                <div class="col-6 d-flex justify-content-center">
                  <a href="abrir_chamado.php">
                    <img class="link" src="formulario_abrir_chamado.png" width="70" height="70">
                  </a>
                </div>
                <div class="col-6 d-flex justify-content-center">
                  <a href="consultar_chamado.php">
                    <img class="link"  src="formulario_consultar_chamado.png" width="70" height="70">
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </body>
</html>