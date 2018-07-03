<?php
$connection = $database->connect;

class CustomFunction {

	public function inputvalid( $string ) {
		global $connection;
		return mysqli_real_escape_string($connection, $string);		
}
public function numRows($query) {
		global $connection;		
		$numRows = mysqli_num_rows($query);
		return $numRows;
	}
	public function isLoginAdmin () {
		if( !isset($_SESSION['logged_user_admin']) && !isset($_COOKIE['logged_user_admin'])  ) {
			self::redirect('login.php');
		}
	}
	public function isLoginUser () {
		if( !isset($_SESSION['logged_user_normal']) && $_SESSION['logged_user_normal'] == '' ) {
			self::redirect('login.php');
		}
	}


	public function userAdmin(){
		if ( (!isset($_SESSION['logged_user_admin'])) && (!isset($_COOKIE['logged_user_admin']))  &&  (!isset($_SESSION['logged_user_normal'])) && (!isset($_COOKIE['logged_user_normal']))) {

			self::redirect('login.php');
		}
	}


	public function isLoginGeneralDriver () {
		if( (!isset($_SESSION['logged_user_driver_general'])) &&  (!isset($_COOKIE['logged_user_driver'])) ) {
			self::redirect('login.php');
		}
	}

	public function isLoginShuttleDriver () {
		if( (!isset($_SESSION['logged_user_driver_shuttle'])) &&  (!isset($_COOKIE['logged_user_driver_shuttle'])) ) {
			self::redirect('login.php');
		}
	}


public function redirect ( $location, $refresh = null) {

		if( empty($refresh) ) {
			header("Location: {$location}");
		} else {
			header("Refresh:{$refresh}; url={$location}");
		}		
	}
	
	public function updateData ($table, $column_name, $column_values, $id, $id_value) {
		global $connection;		

		$data = array();
		foreach ($column_name as $key => $value) {
			$data[] = $value . '=' . "'".$column_values[$key]."'";
		}
		$data = implode(', ', $data);		

		$query = " UPDATE $table SET ";
		$query .= $data;
		$query .= " WHERE $id = $id_value ";
		$query = mysqli_query($connection, $query);
		return $query;		
	} 

	public function deleteData ($table, $id, $id_value) {
		global $connection;
		$query = mysqli_query($connection, "DELETE FROM $table WHERE $id =  $id_value ");
		return $query;
	}
}