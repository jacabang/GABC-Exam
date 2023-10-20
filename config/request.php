<?php

$request_method = strtoupper($_SERVER['REQUEST_METHOD']);

if($request_method === 'POST'):

	$request = $_POST;

	$token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);

	if (!$token || $token !== $_SESSION['token']):
	    // return 405 http status code
	    header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
	    exit;
	endif;

else:

	$request = $_GET;

endif;

$method = filter_input(INPUT_GET, 'method', FILTER_SANITIZE_STRING);
$branch_id = filter_input(INPUT_GET, 'branch_id', FILTER_VALIDATE_INT);

if(!$branch_id):

	$branch_id = filter_input(INPUT_POST, 'branch_id', FILTER_VALIDATE_INT);

endif;

$employee_id = filter_input(INPUT_GET, 'employee_id', FILTER_VALIDATE_INT);

if(!$employee_id):

	$employee_id = filter_input(INPUT_POST, 'employee_id', FILTER_VALIDATE_INT);

endif;