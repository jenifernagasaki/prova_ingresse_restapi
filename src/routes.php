<?php

use Slim\Http\Request;
use Slim\Http\Response;

/* 
	CONFIGURAÇÃO DE ROTAS DO PROJETO 
*/
$app->get('/phpinfo', function (Request $request, Response $response, array $args) {
	return $this->renderer->render($response, 'phpinfo.php', $args);
});

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    return $this->renderer->render($response, 'index.phtml', $args);
});





// Lista todos os usuários
$app->get('/users/', function(Request $request, Response $response, array $args) use ($app){
	return (new \controllers\Users($app))->list($request, $response, $args);
});

// Retorna o usuário solicitado, caso exista
$app->get('/user/[{id}]', function(Request $request, Response $response, array $args) use ($app){
	return (new controllers\Users($app))->get($request, $response, $args);
});

// Cadastra um novo usuário
$app->post('/user/', function(Request $request, Response $response, array $args) use ($app){
	return (new controllers\Users($app))->insert($request, $response, $args);
});

// Altera o usuário solicitado, caso exista
$app->put('/user/[{id}]', function(Request $request, Response $response, array $args) use ($app){
	return (new controllers\Users($app))->update($request, $response, $args);
});

// Apaga o usuário solicitado, caso exista
$app->delete('/user/[{id}]', function(Request $request, Response $response, array $args) use ($app){
	return (new controllers\Users($app))->delete($request, $response, $args);
});