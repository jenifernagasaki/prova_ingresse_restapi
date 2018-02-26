<?php
namespace controllers
{
    class Users
    {
        // Objeto de conexão do banco
		private $PDO;

		function __construct($app){
            $container = $app->getContainer();
            $settings = $container->get('settings');
            $this->PDO = new \PDO($settings['db']['connectionString'], $settings['db']['user'], $settings['db']['password']); // Instancia um objeto de conexão do banco com a string de conexão
			//$this->PDO = new \PDO('mysql:host=localhost;dbname=provaingresse', 'root', 'lu101192'); // Instancia um objeto de conexão do banco com a string de conexão
			$this->PDO->setAttribute( \PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION ); // habilita erros do PDO
		}

        // Metodo para listar todos os usuários da tabela
		public function list($request, $response, $args) {
			global $app;
			$query = $this->PDO->prepare("SELECT * FROM usuarios");
			$query->execute();
			$resultado = $query->fetchAll(\PDO::FETCH_ASSOC);
            return $response->withJson(["response"=>$resultado],200); // Retorna todos os usuários da tabela
		}

        // Metodo para pegar apenas o usuario com o ID especificado na URL
		public function get($request, $response, $args){
			global $app;
			$query = $this->PDO->prepare("SELECT * FROM usuarios WHERE id_usuario = :id");
			$query->bindValue(':id',$args['id']);
			$query->execute();
			$resultado = $query->fetch(\PDO::FETCH_ASSOC);
			return $response->withJson(["response"=>$resultado],200); // Retorna o objeto do usuário buscado na tabela, 'false' caso não exista
		}

		// Inserir usuario no banco
		public function insert($request, $response, $args){
			global $app;
            $dados = json_decode($request->getBody(), true);            
			$dados = (sizeof($dados)==0) ? $_POST : $dados;

            $query = $this->PDO->prepare("INSERT INTO usuarios (login, senha, nome, data_nascimento, sexo, telefone, cpf) VALUES (:login, :senha, :nome, :data_nasc, :sexo, :telefone, :cpf)");
            $query->bindValue(':login', $dados['login']);
            $query->bindValue(':senha', md5($dados['senha']));
            $query->bindValue(':nome', $dados['nome']);
            $query->bindValue(':data_nasc', $dados['data_nascimento']);
            $query->bindValue(':sexo', $dados['sexo']);
            $query->bindValue(':telefone', $dados['telefone']);
            $query->bindValue(':cpf', $dados['cpf']);
            $query->execute();
            
			return $response->withJson(["response"=>['id_usuario'=>$this->PDO->lastInsertId()]],200); // Retorna o ID do usuário inserido
		}

		// Editar usuário
		public function update($request, $response, $args){
			global $app;
			$dados = json_decode($request->getBody(), true);
            $dados = (sizeof($dados)==0)? $_POST : $dados;
            if($args['id'] == 1) return $response->withJson(["response"=>"Nao e permitido alterar o usuario com ID 1"], 200);

            $query = $this->PDO->prepare("UPDATE usuarios SET senha=:senha, nome=:nome, data_nascimento=:data_nasc, sexo=:sexo, telefone=:telefone, cpf=:cpf WHERE id_usuario=:id");
            $query->bindValue(':senha', md5($dados['senha']));
            $query->bindValue(':nome', $dados['nome']);
            $query->bindValue(':data_nasc', $dados['data_nascimento']);
            $query->bindValue(':sexo', $dados['sexo']);
            $query->bindValue(':telefone', $dados['telefone']);
            $query->bindValue(':cpf', $dados['cpf']);
            $query->bindValue(':id',$args["id"]);
            $query->execute();

            $resultado = $query->rowCount()>0;
			return $response->withJson(["response"=>$resultado],200); // Retorna 'true' caso atualizou um usuário, ou 'false' caso não tenha atualizado nada
		}

		// Excluir um usuário
		public function delete($request, $response, $args){
            global $app;
            if($args['id'] == 1) return $response->withJson(["response"=>"Nao e permitido remover o usuario com ID 1"], 200);

			$query = $this->PDO->prepare("DELETE FROM usuarios WHERE id_usuario=:id");
            $query ->bindValue(':id',$args['id']);
            $query->execute();
            
            $resultado = $query->rowCount()>0;
			return $response->withJson(["response"=>$resultado],200); // Retorna 'true' caso removeu um usuário, ou 'false' caso não tenha removido nada
		}
	}
}