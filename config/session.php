<?php

session_start();

function __construct(){

	if(!isset($_SESSION['token'])):

		$_SESSION['token'] = md5(uniqid(mt_rand(), true));

	endif;

}

function csrf_token(){
	return $_SESSION['token'];
}

function csrf(){
	return "<input type='hidden' value='{$_SESSION['token']}' name='token' />";
}