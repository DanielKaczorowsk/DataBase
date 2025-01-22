<?php
	namespace DataBase\Model;
	use pdo;
	require_once "interface_connect.php";

	class MyBasePDO implements interface_connect
	{
		Private $connection, $stmt, $query, $result;
		public function Connect():	void
		{
			$user='root';
			$pass='';
		try {
		$this->connection = new PDO("mysql:host=localhost;dbname=database",$user,$pass,
		array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
		$this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
		 echo $e->getMessage();
		}
		}
		public function getConnect(){
			return $this->connection;
		}
		public function reset():	void
		{
			$this->query = new \stdClass();
		}
		public function Select(array $select)
		{
			$this->reset();
			$this->query->base = 'SELECT '. implode(',',$select);
			$this->query->type = 'select';
			return $this;
		}
		public function From(string $from)
		{
			$this->query->From = ' FROM '.$from;
			return $this;
		}
		public function Where(array $where)
		{
			$this->query->Where = ' WHERE '. implode(' AND ',$where);
			return $this;
		}
		public function OrWhere(array $where){
			if(isset($this->query->Where)){
				$this->query->OrWhere = 'WHERE '.implode('OR ',$where);
			}else {
				$this->query->OrWhere = 'OR WHERE'.implode('Or',$where);
			}
		}
		public function ON(array $on)
		{
			$this->query->On = ' ON '.implode(' AND ',$on);
			return $this;
		}
		public function INNERJOIN(array $innerjoin,array $on)
		{
			foreach($innerjoin as $key=>$val){
				$inneron[]=" INNER JOIN ".$innerjoin[$key]." ON ".$on[$key];
			}
			$this->query->INNERJOIN = implode(' ',$inneron);
			return $this;
		}
		public function getSql()
		{
			$query = $this->query;
			$sql = $query->base;
			if(isset($this->query->From)){
				$sql .= $this->query->From;
			}else{
				$sql .= $this->query->From = ' From role';
			}
				if (isset($this->query->INNERJOIN)){
				$sql .= $this->query->INNERJOIN;
			}
			if(isset($this->query->On))
			{
				$sql .= $this->query->On;
			}
				if(isset($this->query->Where)){
				$sql .= $this->query->Where;
			}
			$sql .=';';
			$this->stmt = $this->connection->prepare($sql);
			$this->stmt->execute();
			$this->stmt = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
			return $this->stmt;
		}
		public function update(string $from,array $names,array $value)
		{
			$sql = "UPDATE posts SET";
			foreach($names as $index => $name )
			{
				if ($index !== array_key_last($names)) 
				{
					 $sql.="$name=:$name,";
				}
				else
				{
					 $sql.="$name=:$name";
				}
			}
			return $sql;
		}
		public function add(string $from,array $names,array $values)
		{
			$sql = "INSERT INTO ".$from."(";
			foreach($names as $index => $name )
			{
				if ($index !== array_key_last($names)) 
				{
					 $sql.="$name,";
				}
				else
				{
					 $sql.="$name";
				}
			}
			$sql .=")VALUES(";
			foreach($names as $index => $name )
			{
				if ($index !== array_key_last($names)) 
				{
				 $sql.=":$name,";
				}
				else
				{
					 $sql.=":$name";
				}
			}
			$sql.=")";
			$this->stmt = $this->connection->prepare($sql);

			foreach ($values as $index => $value) {
				$this->stmt->bindValue(":$names[$index]", $value);
			}
			$this->stmt->execute();
		}
	};
?>