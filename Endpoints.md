# Endpoints -> REST API | Ingresse Dev Test

Abaixo uma lista com todos os endpoints disponíveis nesta API

## [GET] /users/

* Lista todos os usuários cadastrados no banco de dados, sem filtros
* **Este método não necessita de parâmetros**

### Uso:
```http://localhost:8080/users/```

### Retorno esperado:
```
{
    "response": [
        {
            "id_usuario": "1",
            "login": "UsuarioInicial",
            "senha": "4e2e29b37f45f043d6ec8a48f161cbae",
            "nivelacesso": "10",
            "nome": "Usuario Inicial",
            "data_nascimento": "2018-02-24 00:00:00",
            "sexo": "M",
            "telefone": "9999888877",
            "cpf": "99988877766",
            "data_adicionado": "2018-02-24 00:00:00"
        }
    ]
}
```

## [GET] /user/{id}

* Busca no banco de dados pelo usuário solicitado. Retorna "false" caso não encontre nenhum usuário cadastrado.
* **Este método necessita apenas do parâmetro {id}, sendo um número inteiro**

### Uso:
```http://localhost:8080/user/{id}```

### Retorno esperado:
```
{
    "response": {
        "id_usuario": "1",
        "login": "UsuarioInicial",
        "senha": "4e2e29b37f45f043d6ec8a48f161cbae",
        "nivelacesso": "10",
        "nome": "Usuario Inicial",
        "data_nascimento": "2018-02-24 00:00:00",
        "sexo": "M",
        "telefone": "9999888877",
        "cpf": "99988877766",
        "data_adicionado": "2018-02-24 00:00:00"
    }
}
```

## [POST] /user/

* Cadastra no banco de dados o usuário informado. Retorna "true" caso o usuário seja cadastrado, ou "false" caso não inclua.
* **Este método necessita que envie um objeto em JSON no corpo da requisição**

### Uso:
```http://localhost:8080/user/```

### Corpo da requisição:
```
{
	"login": "usuarioX",
	"senha": "testeSenha1234",
	"nome": "Usuario X",
	"data_nascimento": "1994-05-07",
	"sexo": "F",
	"telefone": 11987654321,
	"cpf": 12345678900
}
```

### Retorno esperado:
```
{
    "response": {
        "id_usuario": "1"
    }
}
```

## [PUT] /user/{id}

* Atualiza no banco de dados o registro do usuário informado. Retorna "true" caso o usuário seja alterado, ou "false" caso não encontre ou não seja alterado.
* **Este método necessita apenas do parâmetro {id}, sendo um número inteiro**
* **Este método necessita também que envie um objeto em JSON no corpo da requisição**

### Uso:
```http://localhost:8080/user/{id}```

### Corpo da requisição:
```
{
	"senha": "NovaSenhaTeste1234",
	"nome": "Usuário XYZ",
	"data_nascimento": "1998-09-22",
	"sexo": "M",
	"telefone": 1123456789,
	"cpf": 98765432100
}
```

### Retorno esperado:
```
{
    "response": true
}
```

## [DELETE] /user/{id}

* Remove do banco de dados o registro do usuário informado. Retorna "true" caso o usuário seja removido, ou "false" caso não encontre ou não remova o mesmo.
* **Este método necessita apenas do parâmetro {id}, sendo um número inteiro**

### Uso:
```http://localhost:8080/user/{id}```

### Retorno esperado:
```
{
    "response": true
}
```