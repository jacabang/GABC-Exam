<?php

class Employee {

	public static function fetchEmployee(){
		global $db;

		
		$query = "CALL fetch_employee";

		$statement = $db->prepare($query);
		$statement->execute();
		$employee = $statement->fetchAll();
		$statement->closeCursor();
		// echo json_encode($employee);
		return $employee;
	}

	public static function create($data){
		global $db;

		$query = "CALL insert_employee(:first_name, :middle_name, :last_name, :image_path, :hired_at)";
		// $query = "INSERT INTO employee (`first_name`,`middle_name`,`last_name`,`hired_at`) VALUES (:first_name, :middle_name, :last_name, :hired_at)";

		$statement = $db->prepare($query);
		$statement->bindValue(':first_name', $data['first_name']);
		$statement->bindValue(':middle_name', $data['middle_name']);
		$statement->bindValue(':last_name', $data['last_name']);
		$statement->bindValue(':hired_at', $data['hired_at']);
		$statement->bindValue(':image_path', $data['image_path']);
		$statement->execute();
		$statement->closeCursor();

	}

	public static function update($data, $employee_id){
		global $db;

		$query = "CALL update_employee(:first_name, :middle_name, :last_name, :image_path, :hired_at, :employee_id)";

		$statement = $db->prepare($query);
		$statement->bindValue(':employee_id', $employee_id);
		$statement->bindValue(':first_name', $data['first_name']);
		$statement->bindValue(':middle_name', $data['middle_name']);
		$statement->bindValue(':last_name', $data['last_name']);
		$statement->bindValue(':hired_at', $data['hired_at']);
		$statement->bindValue(':image_path', $data['image_path']);
		$statement->execute();
		$statement->closeCursor();

	}

	public static function delete($id){
		global $db;

		$query = "CALL delete_employee(:id)";

		$statement = $db->prepare($query);
		$statement->bindValue(':id', $id);
		$statement->execute();
		$statement->closeCursor();

	}

	public static function fetchEmployeeViaId($id){
		global $db;

		
		$query = "CALL fetch_employee_by_id(:id)";

		$statement = $db->prepare($query);
		$statement->bindValue(':id', $id);
		$statement->execute();
		$employee = $statement->fetch();
		$statement->closeCursor();
		// echo json_encode($employee);
		return $employee;
	}

	public static function fetchEmployeeSourceViaSearch($q){
		global $db;

        $query = "CALL search_employee(:q)";

        $statement = $db->prepare($query);
		$statement->bindValue(':q', $q);
		$statement->execute();
		$data1 = $statement->fetchAll();
		$statement->closeCursor();

        return $data1;
    }

}

?>