<?php

// add parameters
function signup()
{
	if(count($_POST)>0)
	{
		// check if the fields are empty
		if(!isset($_POST['email']))
			die('please enter your email');
		if(!isset($_POST['password'])) 
			die('please enter your password');

		// check if the email is valid
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
			die('Your email is invalid');

		// check if password length is between 8 and 16 characters
		if(strlen($_POST['password']) < 8) 
			die('Please enter a password >=8 characters');

		// check if the password contains at least 2 special characters
		if (!preg_match('/[\'^£$%&*!()}{@#~?><>,|=_+¬-]/', $_POST['password']))
			die('Please enter atleast 2 special characters in your password');

		// encrypt password
		$passwordHash = hash("sha256", $_POST['password']);

		registerUser($_POST['first'], $_POST['last'], $_POST['email'], $passwordHash);

		// show them a success message and redirect them to the sign in page
		header('Location: ../auth/signin.php');
	}		
}

// add parameters
function signin()
{
	if(count($_POST)>0)
	{
		// 1. check if email and password have been submitted
		if(!isset($_POST['email']))
			die('please enter your email');
		if(!isset($_POST['password'])) 
			die('please enter your password');

		// 2. check if the email is well formatted
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
			die('Your email is invalid');

		// 3. check if the password is well formatted
		// check if password length is between 8 and 16 characters
		if(strlen($_POST['password']) < 8) 
			die('Please enter a password >=8 characters');

		// check if the password contains at least 2 special characters
		if (!preg_match('/[\'^£$%&*!()}{@#~?><>,|=_+¬-]/', $_POST['password']))
			die('Please enter atleast 2 special characters in your password');

		// Check if registered and not banned
		$registered = isUser($_POST['email'], hash("sha256", $_POST['password']));

		if (!$registered)
			die('The Email/Password is incorrect or already registed.');

		// Store session information
		$_SESSION['logged'] = true;

		if (isAdmin($_POST['email']))
			$_SESSION['admin'] = true;

		// Redirect the user to the members_page.php page
		header('Location: ../index.php');	
	}	
}

function signout()
{
	// add the body of the function based on the guidelines of signout.php
	$_SESSION['logged'] = false;
	$_SESSION['admin'] = false;
	session_destroy();
	header('Location: ../index.php');	
}

function is_logged()
{
	if (!isset($_SESSION['logged']))
		$_SESSION['logged'] = false;

	return $_SESSION['logged'];
}

function is_admin()
{
	if (!isset($_SESSION['admin']))
		$_SESSION['admin'] = false;

	return $_SESSION['admin'];
}