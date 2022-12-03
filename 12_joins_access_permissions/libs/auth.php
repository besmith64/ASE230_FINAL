<?php

//create.php
require_once('../settings.php');
session_start();

if (!signin($connection, 'admin@nku.edu', '123123')) echo 'Signin failed';
// if (!signup($connection, 'admin@nku.edu', '123123')) echo 'Signup failed';

function signup($connection, $email, $password)
{
	$query = $connection->prepare('SELECT * FROM users WHERE email=?'); // ? denotes parameter to be passed
	$query->execute([$email]);
	if ($query->rowCount() > 0) return false;
	$query = $connection->prepare('INSERT INTO users(email,password) VALUES(?,?)');
	$query->execute([$email, password_hash($password, PASSWORD_DEFAULT)]); // pass parameters when executing the script
	return true;
}

function signin($connection, $email, $password)
{
	$query = $connection->prepare('SELECT * FROM users WHERE email=? and status=1'); // ? denotes parameter to be passed
	$query->execute([$email]);
	if ($query->rowCount() == 0) return false;
	// die('here');
	$result = $query->fetch();
	// if ($result['status'] == -1) return false;
	// die('here');
	if (!password_verify($password, $result['password'])) return false;
	// die('here');
	$_SESSION['ID'] = $result['ID'];
	$_SESSION['role'] = $result['role'];
	$_SESSION['firstname'] = $result['firstname'];
	$_SESSION['lastname'] = $result['lastname'];
	return true;
}

function signout()
{
	$_SESSION = [''];
	session_destroy();
}