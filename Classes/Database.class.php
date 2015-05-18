<?php 
/**
 *	Database Class that creates the connection for the database.
 *	
 *
 */

class Database {
	private $host, $user, $password, $name, $conn;
	
	function __construct() {
		$this->host = "localhost";
		$this->user = "devtstis_ista";
		$this->password = "ista*123";
		$this->name = "devtstis_ista";
		$this->mysqli = "";
	}

	public function getConn() {
		//$this->conn = new mysqli($this->host, $this->user, $this->password, $this->name);

		$conn = new mysqli("localhost", "devtstis_ista", "ista*123", "devtstis_ista");
		
		/* check connection */
		if ($conn->connect_error) {
			echo("Connect failed: " . mysqli_connect_error());
			exit();
		}
		
		
		return $conn;	
	}
	
}

?>