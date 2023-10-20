<?php

require_once('controller/branch_controller.php');
require_once('controller/employee_controller.php');

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

	// route

if(!$action):

	$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

	if(!$action):
		$action = 'branch';
	endif;

endif;

switch($action):
	case "branch":
		if(!$branch_id && !$method && $request_method == 'GET'):

			echo BranchController::index();

		elseif($branch_id && !$method && $request_method == 'GET'):

			//show will be put here

		elseif(!$branch_id && strtolower($method) == 'create' && $request_method == 'GET'):

			echo BranchController::create();

		elseif($branch_id && strtolower($method) == 'edit' && $request_method == 'GET'):

			echo BranchController::edit($branch_id);

		elseif($branch_id && $request_method == 'POST' && isset($request['method'])):
			if($request['method'] == 'PUT'):

				echo BranchController::update($request, $branch_id);

			elseif($request['method'] == 'DELETE'):

				echo BranchController::destroy($branch_id);

			endif;
		elseif(!$branch_id && $request_method == 'POST' && !isset($request['method'])):

			echo BranchController::store($request);

		else:
			$error = "Page not found.";
			include('view/error.php');
			exit();
		endif;

		break;
	case "check_branch_code":
		if($request_method == 'POST'):
			echo BranchController::checkBranchCode($request);
		else:
			$error = "Page not found.";
			include('view/error.php');
			exit();
		endif;
		break;
	case "fetchBranch":
		if($request_method == 'POST'):
			echo BranchController::fetchBranch();
		else:
			$error = "Page not found.";
			include('view/error.php');
			exit();
		endif;
		break;
	case "employee":
		if(!$employee_id && !$method && $request_method == 'GET'):

			echo EmployeeController::index();

		elseif($employee_id && !$method && $request_method == 'GET'):

			//show will be put here

		elseif(!$employee_id && strtolower($method) == 'create' && $request_method == 'GET'):

			echo EmployeeController::create();

		elseif($employee_id && strtolower($method) == 'edit' && $request_method == 'GET'):

			echo EmployeeController::edit($employee_id);

		elseif($employee_id && $request_method == 'POST' && isset($request['method'])):
			if($request['method'] == 'PUT'):

				echo EmployeeController::update($request, $employee_id);

			elseif($request['method'] == 'DELETE'):

				echo EmployeeController::destroy($employee_id);

			endif;
		elseif(!$employee_id && $request_method == 'POST' && !isset($request['method'])):

			echo EmployeeController::store($request);

		else:
			$error = "Page not found.";
			include('view/error.php');
			exit();
		endif;

		break;
	case "fetchEmployee":
		if($request_method == 'POST'):
			echo EmployeeController::fetchEmployee();
		else:
			$error = "Page not found.";
			include('view/error.php');
			exit();
		endif;
		break;
	case "fetchEmployeeSourceViaSearch":
		if($request_method == 'POST'):
			echo EmployeeController::fetchEmployeeSourceViaSearch($request);
		else:
			$error = "Page not found.";
			include('view/error.php');
			exit();
		endif;
		break;
	default:

		$error = "Page not found.";
		include('view/error.php');
		exit();

	break;

endswitch;