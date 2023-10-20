<?php

require_once('repository/gabc_repository.php');

class BranchController {

	public static function index(){

		$employees = GABC::fetchEmployee();

		include('view/branch/list.php');

	}

	public static function create(){

		$query = "";
		$branch_id = "";
		$branch_code = "";
		$branch_name = "";
		$open_at = "";
		$address = "";
		$barangay = "";
		$city = "";
		$permit_no = "";
		$branch_manager_id = "";
		$is_active = 1;

		$label = "Add";
		$label1 = "Create";
		$employee = "";

		include('view/branch/create.php');

	}

	public static function store($request){

		$check = GABC::checkBranchCode($request['branch_code']);

		if($check == ""):

			$query = GABC::addBranch($request);

			header("Location: .?action=branch");

		else:

			header("Location: .?action=branch_form&error={$request['branch_code']}");

		endif;
	}

	public static function edit($branch_id){

		$query = GABC::fetchBranchViaId($branch_id);

		if($query == ""):

			header("Location: .?action=branch");

		endif;

		$branch_code = $query['branch_code'];
		$branch_name = $query['branch_name'];
		$open_at = $query['open_at'];
		$address = $query['address'];
		$barangay = $query['barangay'];
		$city = $query['city'];
		$permit_no = $query['permit_no'];
		$branch_manager_id = $query['branch_manager_id'];
		$is_active = $query['is_active'];
		$employee = GABC::fetchEmployeeViaId($query['branch_manager_id']);

		$label = "Edit";
		$label1 = "Update";

		include('view/branch/create.php');

	}

	public static function update($request, $id){

		$check = GABC::checkBranchCode($request['branch_code']);

		if($check != ""):

			if($check['branch_id'] == $id):

				$query = GABC::updateBranch($request, $id);

				header("Location: .?action=branch");

			else:

				header("Location: .?action=branch_form&branch_id={$id}&error={$request['branch_code']}");

			endif;

		else:

			$query = GABC::updateBranch($request, $id);

			header("Location: .?action=branch");

		endif;
	}

	public static function destroy($id){

		$query = GABC::fetchBranchViaId($id);

		if($query != ""):
			return GABC::deleteBranch($id);
		endif;
	}

	public static function checkBranchCode($request){

		$data = array("status"=> false);

		if(isset($request['branch_code'])):
			$check = GABC::checkBranchCode($request['branch_code']);

			if($check != ""):

				if($check['branch_id'] == $request['branch_id']):
					
					$data = array("status"=> false);

				else:
					$data = array("status"=> true);
				endif;
			else:

				$data = array("status"=> false);

			endif;
		endif;

		return json_encode($data);

	}

	public static function fetchBranch(){
		 $query = GABC::fetchBranch();

		 $data = [];

		foreach($query as $result):

            $action1 = "<a style='margin-bottom: .5em; margin-left: .5em;' class='btn btn-info btn-flat btn-pri icon-upate' href='./?action=branch&branch_id={$result['branch_id']}&method=edit'><i class='fa fa-pencil-square-o'></i> Edit</a>";

			$action1 .="<a style='margin-bottom: .5em; margin-left: .5em;' data-id='".$result['branch_id']."' class='btn btn-danger btn-flat btn-pri icon-delete'>
                        <i class='fa fa-trash'></i> Delete
                    </a>";

            $branch_manager = "";

            if($result['last_name'] != "" || $result['last_name'] != "" || $result['middle_name'] != ""):
            	$branch_manager = $result['last_name'].", ".$result['first_name']." ".$result['middle_name'];
            endif;

			$data[] = array(
                $result['branch_code'],
                $result['branch_name'],
                $branch_manager,
                $result['open_at'] != "" ? date("m/d/Y", strtotime($result['open_at'])) : "",
                $action1
                );

		endforeach;

		$res = array('data'=>$data);
    	return  json_encode($res);
	}

}