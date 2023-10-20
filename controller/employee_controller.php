<?php

require_once('repository/gabc_repository.php');

class EmployeeController {


	public static function index(){

		$image_file = './assets/images/No-Image-Available.png';

		// $course_name = GABC::fetchCourseNameViaId($course_id);
		$employees = GABC::fetchEmployee();

		include('view/employee/list.php');

	}

	public static function store($request){

		if(isset($_FILES['banner'])):
			$image = $_FILES['banner'];

			$ext = explode(".",$image['name']);
			$ext = end($ext);
			$name = time().'.'.$ext;
			$destinationPath = './uploads/';
			move_uploaded_file($image['tmp_name'],$image_path);
			$image_path = $destinationPath.$name;
		else:
			$image_path = NULL;
		endif;

		GABC::addEmployee($request, $image_path);

		header("Location: .?action=employee");
	}

	public static function update($request, $id){

		$check = GABC::fetchEmployeeViaId($id);

		if($check != ""):

			if(isset($_FILES['banner'])):
				if(file_exists($check['image_path'])):
					unlink($check['image_path']);
				endif;
				$image = $_FILES['banner'];
				$ext = explode(".",$image['name']);
				$ext = end($ext);
				$name = time().'.'.$ext;
				$destinationPath = './uploads/';
				$image_path = $destinationPath.$name;
				move_uploaded_file($image['tmp_name'],$image_path);
			else:
				$image_path = $check['image_path'];
			endif;

		endif;

		GABC::updateEmployee($request, $image_path, $id);

		header("Location: .?action=employee");
	}

	public static function destroy($id){

		$employee = GABC::fetchEmployeeViaId($id);

		if($employee != ""):
			if(file_exists($employee['image_path'])):
					unlink($employee['image_path']);
				endif;
			return GABC::deleteEmployee($id);
		endif;

	}

	public static function fetchEmployee(){
		 $query = GABC::fetchEmployee();

		 $data = [];

		foreach($query as $result):

			$action1 ="<a style='margin-bottom: .5em; margin-left: .5em;' data-id='".$result['id']."' data-first_name='".$result['first_name']."' data-middle_name='".$result['middle_name']."' data-last_name='".$result['last_name']."' data-hired_at='".$result['hired_at']."' data-image_path='".$result['image_path']."' class='btn btn-info btn-flat btn-pri icon-update'>
                        <i class='fa fa-pencil-square-o'></i> Edit
                    </a>";

			$action1 .="<a style='margin-bottom: .5em; margin-left: .5em;' data-id='".$result['id']."' class='btn btn-danger btn-flat btn-pri icon-delete'>
                        <i class='fa fa-trash'></i> Delete
                    </a>";

			$data[] = array(
                $result['first_name'],
                $result['middle_name'],
                $result['last_name'],
                $result['hired_at'],
                $action1
                );

		endforeach;

		$res = array('data'=>$data);
    	return  json_encode($res);
	}

	public static function fetchEmployeeSourceViaSearch($request){
        $array[] = array("id" => "", "name" => "MARKED EMPTY");

	        if(isset($request['q'])):
				if($request['q'] != ""):
					$query = GABC::fetchEmployeeSourceViaSearch($request['q']);
				else:
					$query = GABC::fetchEmployee();
				endif;
			else:
				$query = GABC::fetchEmployee();
			endif;

		foreach($query as $result):
	            $array[] = array("id" => $result['id'], "name" => $result['first_name'].', '.$result['last_name'].' '.$result['middle_name']);
	        endforeach;

	        $data = array(
	                "incomplete_results" => true, 
	                "items" => $array, 
	                "total_count" => COUNT($array)
	            );

        	return json_encode($data);
	}

}