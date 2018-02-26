<?php

namespace Tests;

class RestApiTest extends BaseTestCase
{
    /*
     * O Teste executará a rota '/users/', enviando um GET sem parâmetros
     * No retorno, deverá conter na propriedade "login" o valor "UsuarioInicial", de qualquer um dos itens listados na resposta
     */
    public function testGetTodosUsuarios()
    {
        $response = $this->runApp('GET', '/users/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('"login":"UsuarioInicial"', (string)$response->getBody());
    }

    /*
     * O Teste executará a rota '/user/', enviando um GET request informando o ID 1
     * No retorno, deverá conter na propriedade "nome" o valor "Usuario Inicial", e na propriedade "senha" o valor "4e2e29b37f45f043d6ec8a48f161cbae"
     */
    public function testGetUsuarioId1()
    {
        $response = $this->runApp('GET', '/user/1');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('"nome":"Usuario Inicial"', (string)$response->getBody());
        $this->assertContains('"senha":"4e2e29b37f45f043d6ec8a48f161cbae"', (string)$response->getBody());
    }
}