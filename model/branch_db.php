<?php

class Branch {

	public static function fetchBranchViaId($id){
		global $db;

		
		$query = "CALL fetch_branch_by_id(:id)";

		$statement = $db->prepare($query);
		$statement->bindValue(':id', $id);
		$statement->execute();
		$branch = $statement->fetch();
		$statement->closeCursor();
		// echo json_encode($branch);
		return $branch;
	}

	public static function fetchBranch(){
		global $db;

		
		$query = "CALL fetch_branch";

		$statement = $db->prepare($query);
		$statement->execute();
		$branch = $statement->fetchAll();
		$statement->closeCursor();
		// echo json_encode($branch);
		return $branch;
	}

	public static function create($data){
		global $db;

		$query = "CALL insert_branch(:branch_code, :branch_name, :address, :barangay, :city, :permit_no, :open_at, :branch_manager_id, :is_active)";

		$statement = $db->prepare($query);
		$statement->bindValue(':branch_code', $data['branch_code']);
		$statement->bindValue(':branch_name', $data['branch_name']);
		$statement->bindValue(':address', $data['address']);
		$statement->bindValue(':barangay', $data['barangay']);
		$statement->bindValue(':city', $data['city']);
		$statement->bindValue(':permit_no', $data['permit_no']);
		$statement->bindValue(':open_at', $data['open_at']);
		$statement->bindValue(':branch_manager_id', $data['branch_manager_id']);
		$statement->bindValue(':is_active', $data['is_active']);
		$statement->execute();
		$statement->closeCursor();

	}

	public static function update($data, $branch_id){
		global $db;

		$query = "CALL update_branch(:branch_code, :branch_name, :address, :barangay, :city, :permit_no, :open_at, :branch_manager_id, :is_active, :branch_id)";

		$statement = $db->prepare($query);
		$statement->bindValue(':branch_id', $branch_id);
		$statement->bindValue(':branch_code', $data['branch_code']);
		$statement->bindValue(':branch_name', $data['branch_name']);
		$statement->bindValue(':address', $data['address']);
		$statement->bindValue(':barangay', $data['barangay']);
		$statement->bindValue(':city', $data['city']);
		$statement->bindValue(':permit_no', $data['permit_no']);
		$statement->bindValue(':open_at', $data['open_at']);
		$statement->bindValue(':branch_manager_id', $data['branch_manager_id']);
		$statement->bindValue(':is_active', $data['is_active']);
		$statement->execute();
		$statement->closeCursor();

	}

	public static function delete($id){
		global $db;

		$query = "CALL delete_branch(:id)";

		$statement = $db->prepare($query);
		$statement->bindValue(':id', $id);
		$statement->execute();
		$statement->closeCursor();

	}

	public static function checkBranchCode($branch_code){
		global $db;

		$query = "CALL fetch_branch_by_branch_code(:branch_code)";

		$statement = $db->prepare($query);
		$statement->bindValue(':branch_code', $branch_code);
		$statement->execute();
		$branch = $statement->fetch();
		$statement->closeCursor();
		return $branch;

	}

}

?>

