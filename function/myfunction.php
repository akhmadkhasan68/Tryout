<?php 
	function login($username, $password, $login_as, $con){
		if($login_as == "admin"){
			$select_user = mysqli_query($con, "SELECT * FROM tbl_user WHERE username = '$username' AND password = md5('$password')");
			echo mysqli_num_rows($select_user);
			if(mysqli_num_rows($select_user) < 1){
				//header("location: admin.php?login=false");
				return $login = false;
			}else{
				$row = mysqli_fetch_assoc($select_user);
				$username = $row['username'];
				$status = "admin";

				//SET VARIABLE SESSION
				$_SESSION['username'] = $username;
				$_SESSION['login_as'] = $status;
				$_SESSION['logged_in'] = TRUE;

				//header("location: admin/index.php");
				return $login = true;
			}
		}
	}

	function select_data($con, $table, $where = NULL, $operations = NULL){
		$sql_select = "SELECT * FROM $table ";
		if($where != NULL){
			$data_where = count($where);
			for ($i=0; $i < $data_where; $i++) { 
				if($i == 0){
					$sql_select .= "WHERE ".$where[$i];
				}else{
					$sql_select .= " ".$operations." ".$where[$i];
				}
			}
		}

		$data = mysqli_query($con, $sql_select);
		return $data;
	}

	function validation_data($con, $table, $data, $editable = FALSE, $id = NULL){
		$column = [];
		$value = [];

		foreach ($data as $key => $val) {
			array_push($column, $key);
			array_push($value, $val);
		}

		if($editable == TRUE){
			return process_validation($con, $table, $column, $value, $editable, $id);
		}else{
			return process_validation($con, $table, $column, $value, FALSE, NULL);
		}
	}

	function process_validation($con, $table, $column, $value, $editable, $id){
		$length = count($column);

		$sql_select = "SELECT * FROM ".$table." ";
		for($i = 0; $i < $length; $i++){
			if($i == 0){
				$sql_select .= "WHERE (".$column[$i]." = '".$value[$i]."'";
			}else{
				$sql_select .= " OR ".$column[$i]." = '".$value[$i]."')";
			}
		}

		if($editable != FALSE && $id != NULL){
			$sql_select .= " AND id != '".$id."'";
		}

		$select_data = mysqli_query($con, $sql_select);
		if(mysqli_num_rows($select_data) > 0){
			$return = FALSE;
		}else{
			$return = TRUE;
		}

		return $return;
	}

	function insert_data($con, $table, $data){
		$column = [];
		$value = [];

		foreach ($data as $key => $val) {
			array_push($column, $key);
			array_push($value, $val);
		}

		return process_insert($con, $table, $column, $value);
	}

	function process_insert($con, $table, $column, $value){
		$length = count($column);

		$sql_insert = "INSERT INTO ".$table." (";
		for($i = 0; $i < $length; $i++){
			if($i == 0){
				$sql_insert .= $column[$i];
			}else{
				$sql_insert .= ", ".$column[$i];
			}
		}
		$sql_insert .= ") VALUES (";
		for($i = 0; $i < $length; $i++){
			if($i == 0){
				$sql_insert .= "'".$value[$i]."'";
			}else{
				$sql_insert .= ", '".$value[$i]."'";
			}
		}
		$sql_insert .= ")";

		$insert_data = mysqli_query($con, $sql_insert);

		if($insert_data){
			$return = TRUE;
		}else{
			$return = FALSE;
		}

		return $return;
	}

	function update_data($con, $table, $data, $id){
		$column = [];
		$value = [];

		foreach ($data as $key => $val) {
			array_push($column, $key);
			array_push($value, $val);
		}

		return process_update($con, $table, $column, $value, $id);
	}

	function process_update($con, $table, $column, $value, $id){
		$length = count($column);

		$sql_update = "UPDATE ".$table." SET";
		for($i = 0; $i < $length; $i++){
			if($i == 0){
				$sql_update .= " ".$column[$i]." = '".$value[$i]."'";
			}else{
				$sql_update .= ", ".$column[$i]." = '".$value[$i]."'";
			}
		}
		$sql_update .= " WHERE id ='".$id."'";

		$update_data = mysqli_query($con, $sql_update);

		if($update_data){
			$return = TRUE;
		}else{
			$return = FALSE;
		}

		return $return;
	}

	function delete_data($con, $table, $id){
		$sql_delete = "DELETE FROM ".$table." WHERE id = '".$id."'";
		$delete = mysqli_query($con, $sql_delete);

		if($delete){
			$return = TRUE;
		}else{
			$return = FALSE;
		}

		return $return;
	}
?>