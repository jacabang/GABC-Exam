<?php

require_once('model/branch_db.php');
require_once('model/employee_db.php');

class GABC {

	public static function addEmployee($data, $image_path){
		return Employee::create([
			'first_name' => $data['first_name'],
			'middle_name' => $data['middle_name'],
			'last_name' => $data['last_name'],
			'hired_at' => $data['date_hired'],
			'image_path' => $image_path
			]);
	}

	public static function updateEmployee($data, $image_path, $id){
		return Employee::update([
			'first_name' => $data['first_name'],
			'middle_name' => $data['middle_name'],
			'last_name' => $data['last_name'],
			'hired_at' => $data['date_hired'],
			'image_path' => $image_path
			],$id);
	}

	public static function deleteEmployee($id){
		return Employee::delete($id);
	}

	public static function addBranch($data){

		$is_active = 0;
		$branch_manager_id = NULL;

		if(isset($data['is_active'])):
			$is_active = 1;
		endif;

		if(isset($data['branch_manager_id'])):
			$branch_manager_id = $data['branch_manager_id'];
		endif;

		return Branch::create([
			'branch_code' => $data['branch_code'],
			'branch_name' => $data['branch_name'],
			'address' => $data['address'],
			'barangay' => $data['barangay'],
			'city' => $data['city'],
			'permit_no' => $data['permit_no'],
			'open_at' => $data['date_open'] == "" ? NULL : $data['date_open'],
			'is_active' => $is_active,
			'branch_manager_id' => $branch_manager_id,
			]);
	}

	public static function updateBranch($data, $branch_id){

		$is_active = 0;
		$branch_manager_id = NULL;

		if(isset($data['is_active'])):
			$is_active = 1;
		endif;

		if(isset($data['branch_manager_id'])):
			$branch_manager_id = $data['branch_manager_id'];
		endif;

		return Branch::update([
			'branch_code' => $data['branch_code'],
			'branch_name' => $data['branch_name'],
			'address' => $data['address'],
			'barangay' => $data['barangay'],
			'city' => $data['city'],
			'permit_no' => $data['permit_no'],
			'open_at' => $data['date_open'] == "" ? NULL : $data['date_open'],
			'is_active' => $is_active,
			'branch_manager_id' => $branch_manager_id,
			], $branch_id);
	}

	public static function deleteBranch($id){
		return Branch::delete($id);
	}

	public static function checkBranchCode($branch_code){
		return Branch::checkBranchCode($branch_code);
	}

	public static function fetchBranch(){
		return Branch::fetchBranch();
	}

	public static function fetchBranchViaId($id){
		return Branch::fetchBranchViaId($id);
	}

	public static function fetchEmployeeViaId($id){
		return Employee::fetchEmployeeViaId($id);
	}

	public static function fetchEmployee(){
		return Employee::fetchEmployee();
	}

	public static function fetchEmployeeSourceViaSearch($q){

		return Employee::fetchEmployeeSourceViaSearch($q);
		
	}

}