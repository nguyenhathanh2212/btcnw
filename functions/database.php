<?php

	class DatabaseManager
	{
		private $host = 'localhost';
		private $username = 'root';
		private $password = '';
		private $dbName = 'websitettcn';	
		private $connection = '';

		public function connect()
		{
			if (!$this->connection) {
				$this->connection = new mysqli($this->host, $this->username, $this->password, $this->dbName);

				if (mysqli_connect_errno()) {
					die ('Lỗi: ' . mysqli_connect_error());
				}
				
				$this->connection->set_charset('utf8');
			}
		}

		public function close()
		{
			if ($this->connection) {
				$this->connection->close();
			}
		}

		public function select($sql)
		{
			$this->connect();
			$result = $this->connection->query($sql);
			$data = [];

			while ($row = $result->fetch_assoc()) {
				array_push($data, $row);
			}

			return $data;
		}

		public function create($table, $data)
		{
			$this->connect();
			$fields = '';
			$values = '';
			
			foreach ($data as $key => $value) {
				$fields .= "$key,";
				$values .= "'{$value}',";
			}

			$sql = "INSERT INTO $table(" . trim($fields, ',') . ") VALUES(" . trim($values, ',') . ")";

			return $this->connection->query($sql);
		}

		public function update($table, $data, $where)
		{
			$this->connect();
			$dataUpdate = '';

			foreach ($data as $key => $value) {
				$dataUpdate .= "$key = '{$value}',";
			}

			$sql = 'UPDATE ' . $table . ' SET ' . trim($dataUpdate, ',') . ' WHERE ' . $where;

			return $this->connection->query($sql);
		}

		public function delete($table, $where)
		{
			$this->connect();
			$sql = "DELETE FROM $table WHERE $where";

			return $this->connection->query($sql);
		}
	}

	$DB = new DatabaseManager();
