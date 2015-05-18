<?php 
/**
 *	Users Class for interacting with users.
 *	
 *
 */
 require_once "Database.class.php";

class Users {

	private $username, $password, $email, $type;
	
	function __construct($username,$password,$email,$type) {
		$this->username = $username;
		$this->password = $password;
		$this->email = $email;
		$this->type = $type;
	}

	//Methods

	/*Insert
	* Insert a new user by passing an array with the properties of the username
	* Ex: 
	*	$properties=array("username","email","password","user_type");
	*	add($properties)
	*/
	public function register(){
		$db = new Database();
		$conn= $db->getConn();
		$status = false;
		
		$stmt = $conn->prepare("insert into login (username,email,password,user_type) VALUES (?, ?, ?, ?)");
		$v_password=sha1($this->password);
		$stmt->bind_param("sssd", $this->username,$this->email,$v_password,$this->type);			
		 if($stmt->execute()){
		 $status = true;
		 }
		//release resources
		$stmt->free_result();
		$conn->close();
		
		return $status;	
	}
	
	/*Delete
	* Delete the specified username by passing the name of the username to delete
	* Ex: 
	*	delete("username")
	*/
	
	public function delete($id){
		$db = new Database();
		$conn= $db->getConn();
		$status = false;
		$stmt = $conn->prepare("DELETE from login where id=?");
		$stmt->bind_param("i", $id);			
		 if($stmt->execute()){
		 $status = true;
		 }
		//release resources
		$stmt->free_result();
		$conn->close();
		
		return $status;
	}
	
	/*Update*/
	public function update($username,$password,$email,$id){
		$db = new Database();
		$conn= $db->getConn();
		$status = false;
		if($password == ""){
			$stmt = $conn->prepare("Update login set username = ?, email =? where id=?");
			$stmt->bind_param("ssi", $username,$email,$id);			
		}
		else{
			$stmt = $conn->prepare("Update login set username = ?, password = ?, email =? where id=?");
			$stmt->bind_param("sssi", $username,sha1($password),$email,$id);			
		} 
		 if($stmt->execute()){
		 $status = true;
		 }
		//release resources
		$stmt->free_result();
		$conn->close();
		
		return $status;
	}
	
	/*Get Users All
	*retrieves all the users
	*Returns an array of associative arrays with the information of each user
	*	Ex: $users = getAllUsers();
	* 		echo $user[0]['username'];
	*/
	public function getAllUsers(){
	
		$db = new Database();
		$conn= $db->getConn();
		$rs = $conn->query("select * from login");
		$num_of_row = $rs->num_rows;
		if($num_of_row >0){
			while($row = $rs->fetch_assoc()){
				$users[]=array('username'=>$row['username'],'password'=>sha1($row['password']),'email'=>$row['email'],'user_type'=>$row['user_type']);
			}
		}
		
		return $users;
	}
	
	
	//returns the user id by passing the email
	public function getUserID($email){
	
		$db = new Database();
		$conn= $db->getConn();
		$stmt = $conn->prepare("select id from login where Email=?");
		$stmt->bind_param("s", $email);			
		$stmt->execute();
		$stmt->bind_result($v_id);
		
		if($stmt->execute()){
			while($stmt->fetch()){
				$id=$v_id;
			}
		}

		$stmt->free_result();
		$stmt->close();
		
		return $id;
	
	}
	
	//return the user info
	public function getUserByID($id){
	
		$db = new Database();
		$conn= $db->getConn();
		$stmt = $conn->prepare("select * from login where id=?");
		$stmt->bind_param("i", $id);			
		$stmt->execute();
		$stmt->bind_result($v_id,$v_username,$v_password,$v_email,$v_user_type);
		
		if($stmt->execute()){
			while($stmt->fetch()){
			$user=array('id'=>$v_id,'username'=>$v_username,'password'=>sha1($v_password),'email'=>$v_email,'user_type'=>$v_user_type);
				
			}
		}

		$stmt->free_result();
		$stmt->close();
		
		return $user;
	
	}

}

?>