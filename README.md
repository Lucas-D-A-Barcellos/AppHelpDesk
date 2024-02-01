# AppHelpDesk

## Descrição

Este é um sistema de Help Desk desenvolvido em PHP e utilizando um banco de dados MySQL para a criação e consulta de chamados de suporte. O sistema é voltado para gerenciar solicitações de suporte técnico.


## Recursos Principais

- **Criação de Chamados:** Os usuários podem criar novos chamados, registrando informações detalhadas sobre o problema ou solicitação de suporte.

- **Consulta de Chamados:** Os usuários podem visualizar e acompanhar os chamados previamente criados.

- **Autenticação Segura:** O sistema implementa autenticação segura para garantir que apenas usuários autenticados possam acessar as funcionalidades. A senha dos usuários é criptografada usando o algoritmo de hash MD5 para garantir segurança adicional.

- **Restrição de Visualização:** Os usuários não têm permissão para visualizar os chamados criados por outros usuários. Isso é alcançado através da comparação de uma chave estrangeira (`foreign key`) associada à tabela de chamados com a chave primária (`primary key`) da tabela de usuários.



## Instalação

1. **Requisitos:**
   - Servidor web
   - PHP
   - MySQL

2. **Configuração do Banco de Dados:**
   - Utilize o script SQL a seguir para criar as tabelas no banco de dados MySQL:
```sql
    CREATE DATABASE helpdesk;
    USE helpdesk; 

    CREATE TABLE usuario (
        ID_USER INT AUTO_INCREMENT PRIMARY KEY,
        NOME_USER VARCHAR(255) NOT NULL,
        SOBRENOME_USER VARCHAR(255) NOT NULL,
        EMAIL VARCHAR(255) NOT NULL,
        SENHA VARCHAR(255) NOT NULL
    );

    CREATE TABLE chamados (
        ID_CHAMADO INT AUTO_INCREMENT PRIMARY KEY,
        TITULO VARCHAR(255) NOT NULL,
        CATEGORIA VARCHAR(50),
        DESCRICAO TEXT,
        ID_USER INT,
        FOREIGN KEY (USER_ID) REFERENCES usuario(ID_USER)
    );
```

3. **Configuração do PHP:**
   - Certifique-se de que o PHP esteja configurado corretamente além das informações de conexão do banco de dados no arquivo `config.json`.
 ```json
   {
      "hostname": "localhost",
      "bancodedados": "helpdesk",
      "usuario": "root",
      "senha": ""
   }
```     

4. **Inicie o Servidor Web:**
   - Inicie o servidor web e acesse o sistema através do navegador.

## Como Usar

1. **Login:**
   - Faça o login utilizando suas credenciais. Caso não tenha uma conta, registre-se como novo usuário no botão "cadastre-se".

2. **Painel Principal:**
   - Após o login, você será direcionado para o painel principal.
   - No painel, você pode criar novos chamados ou consultar os chamados existentes.

3. **Criação de Chamados:**
   - Clique na opção "Abrir Chamado" para criar um novo chamado.
   - Preencha os detalhes necessários e envie o formulário.

4. **Consulta de Chamados:**
   - Clique na opção "Consultar Chamados" para visualizar os chamados previamente criados.
   - Você só poderá visualizar seus próprios chamados.

5. **Segurança:**
   - O sistema implementa medidas de segurança, como a criptografia de senhas usando o hash MD5.

## Autenticação Segura e Restrição de Visualização

### Restrição de Visualização
Recupera o usuario logado e insere na variavel de sessão "$SESSION" no momento da validação de login, localizada no arquivo valida_login.php:


```php
    session_start();

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    //criptografando a senha usando hash MD5
    $senhaCriptografada = md5($senha);

    (...)

    if ($senhaCriptografada == $row['SENHA']) {
    
        // Senha correta   
        $_SESSION['autenticado'] = 'SIM';
        $_SESSION['user'] = $email;      
        header("Location: home.php");
        
    }

```
<br>

Compara o usuario logado da variavel "$SESSION" com indice ID_USER no banco de dados, para mostrar apenas os chamados referentes ao usuario logado:
<br>
<br>
*consultar.php
```php
    $chamados = array();
    $user = $_SESSION['user'];
    
    require_once("conexao.php");
    
    $verify = "SELECT ID_USER FROM usuario WHERE EMAIL = '$user'"; 
    $result = $mysqli->query($verify);
    
    if ($result) {
        $row = $result->fetch_assoc(); // Obtém a linha de resultado como um array associativo

        // Obtém o valor específico da coluna "ID_USER" do array $row
        $user_id = $row['ID_USER'];
    }
```


### Hash da Senha (MD5)
*cadastrar.php:


```php
    //setando os dados enviados pela requisição post em variáveis
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Criptografar a senha usando hash MD5
    $senhaCriptografada = md5($senha);
```

## Atualizações Futuras

As seguintes funcionalidades serão implementadas em futuras atualizações:

1. **Exclusão de Chamados:**
   - Adição da funcionalidade de excluir chamados já criados. Isso permitirá que os usuários removam registros de chamados que não são mais relevantes.

2. **Edição de Chamados:**
   - Implementação da funcionalidade de edição de chamados. Os usuários poderão realizar alterações em detalhes específicos de um chamado existente.

3. **Acompanhamento de Status de Chamados:**
   - Adição de recursos para acompanhar e atualizar o status dos chamados. Isso proporcionará uma visão mais dinâmica e em tempo real do progresso de cada chamado.

<hr>

Se desejar contribuir para este projeto, sinta-se à vontade para implementar melhorias e enviar um pull request.
