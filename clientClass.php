<?php 
	Class Customer {

		private $pdo;

		// Construtor
		public function __construct($dbname, $host, $user, $password)
		{
			try 
			{
				$this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host, $user, $password);
			} catch (PDOException $e) 
			{
				echo "Erro com o banco de dados: ".$e->getMessage();
				exit();
			} catch (Exception $e) 
			{
				echo "Erro genérico: ".$e->getMessage();
			}
		}

		// Select
		public function fetchData()
		{
			$result = array(); // Caso o banco esteja vazio evita erro e retorna um array vazio
			$cmd = $this->pdo->query("SELECT * FROM cliente ORDER BY id DESC");
			$result = $cmd->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}

		// Insert
		public function registerCustomer($nome, $celular, $email) 
		{
			// Validar se email já existe no banco
			$cmd = $this->pdo->prepare("SELECT id FROM cliente WHERE email = :email");
			$cmd->bindValue(":email", $email);
			$cmd->execute();

			if ($cmd->rowCount() > 0) // Email já existe no BD
			{ 
				return false;
			} else 
			{
				$cmd = $this->pdo->prepare("INSERT INTO cliente(nome, celular, email) VALUES(:nome, :celular, :email)");
				$cmd->bindValue(":nome", $nome);
				$cmd->bindValue(":celular", $celular);
				$cmd->bindValue(":email", $email);
				$cmd->execute();
				return true;
			}
		}

		// Delete
		public function deleteCustomer($id)
		{
			$cmd = $this->pdo->prepare("DELETE FROM cliente WHERE id = :id");
			$cmd->bindValue("id", $id);
			$cmd->execute();
		}

		public function fetchDataCustomer($id) 
		{
			$response = array();
			$cmd = $this->pdo->prepare("SELECT * FROM cliente WHERE id = :id");
			$cmd->bindValue(":id", $id);
			$cmd->execute();
			$response = $cmd->fetch(PDO::FETCH_ASSOC);
			return $response;
		}

		// Update
		public function updateData($id, $nome, $celular, $email) 
		{
			$cmd = $this->pdo->prepare("UPDATE cliente SET nome = :n, celular = :c, email = :e WHERE id = :id");
			$cmd->bindValue(":n", $nome);
			$cmd->bindValue(":c", $celular);
			$cmd->bindValue(":e", $email);
			$cmd->bindValue(":id", $id);
			$cmd->execute();
		}
	}
?>