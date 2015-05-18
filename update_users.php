<?php
require_once "Classes/Database.class.php";

function convertColInt( $i )
{
       if ( $i == 1 ) return "username";
       else if ( $i == 2 ) return "email";
		else if ( $i == 3 ) return "user_type";
	}
 
		$id=$_POST['id'];
		$value = convertColInt($_POST['columnId']);
		if($value == "user_type"){
			if($_POST['value']=="administrator"){
			$_POST['value']=1;
			}
			else if($_POST['value']=="manager"){
			$_POST['value']=2;
			}
			
		}
		$updateSQL='UPDATE login SET '.$value.'=? WHERE id=?';
				
		$db = new Database();
		$conn= $db->getConn();
		$stmt = $conn->prepare($updateSQL);

		$stmt->bind_param("sd",$_POST['value'],$id);			
		if($stmt->execute()){
			echo "ok";
		}
		else {
		echo "error";
		}
		//release resources
		$stmt->free_result();
		$conn->close();

		
	?>
