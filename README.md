# REST API | Ingresse Dev Test

A REST API contida neste projeto foi desenvolvida com base nas informações descritas em https://gist.github.com/vitorleal/158e4e3870337dacf9475a5a27e5c7c9

Esta API foi desenvolvida para PHP7, utilizando o Slim Framework 3. Ela contém métodos de GET, POST, PUT e DELETE para gerenciamento de usuários de uma tabela, localizada em um banco de dados MySQL.

## Requisitos para execução do projeto

É necessário ter instalado:
* PHP 7+
* MySQL/MariaDB
* Composer

## Instalando a aplicação

1) Baixe o repositório do GIT para um diretório em sua máquina. Acessar o diretório do projeto na sequência;

2) Execute o comando abaixo para baixar as dependências do Composer:
> `php composer.phar install` ou `composer install`

3) Execute o script `InicialBanco.sql`, localizado no diretório `/_Scripts`, na raiz do repositório;

4) Após baixar as dependências, acesse o diretório src/settings.php e, no item "db", modifique as propriedades "connectionString", "user" e "password" com os dados de acesso do seu banco de dados:
```
'db' => [
  'connectionString' => 'mysql:host=localhost;dbname=provaingresse',
  'user' => 'root',
  'password' => ''
]
```

5) Salve o arquivo, e utilize o comando abaixo (na raiz do projeto) para iniciar o webserver:
> `php composer.phar start` ou `composer start`

6) Acesse a URL http://localhost:8000 em seu navegador

7) Para realizar os testes unitários criados, utilize o comando abaixo: 
> `composer test`

8) Há uma lista com os requests prontos para o **Postman**. Deverá importar na ferramenta o arquivo `Rest_API_PostmanRequests.json`, localizado na raiz do repositório.

## Testes Unitários

Há dois testes unitários disponíveis. Utilize o comando `composer test` para executá-los. Os testes unitários desenvolvidos são:

1) `testGetTodosUsuarios()`
* O teste executará a rota '/users/', enviando um GET sem parâmetros
* No retorno, deverá vir com o Status Code 200 e conter na propriedade "login" o valor "UsuarioInicial", de qualquer um dos itens listados na resposta

2) `testGetUsuarioId1()`
* O teste executará a rota '/user/', enviando um GET request informando o ID 1
* No retorno, deverá vir com o Status Code 200, conter na propriedade "nome" o valor "Usuario Inicial", e na propriedade "senha" o valor "4e2e29b37f45f043d6ec8a48f161cbae"