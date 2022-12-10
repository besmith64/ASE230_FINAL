<?php

function signup($connection, $GID, $email, $password, $fname, $lname)
{
	$query = $connection->prepare('SELECT * FROM t_user WHERE email=?'); // ? denotes parameter to be passed
	$query->execute([$email]); // check if user exists
	if ($query->rowCount() > 0) return false;
	$query = $connection->prepare('INSERT INTO t_user(GID,email,password,firstname,lastname) VALUES(?,?,?,?,?)');
	$query->execute([$GID, $email, password_hash($password, PASSWORD_DEFAULT), $fname, $lname]); // pass parameters when executing the script
	return true;
}

function signin($connection, $email, $password)
{
	$query = $connection->prepare('SELECT * FROM t_user WHERE email=?'); // ? denotes parameter to be passed
	$query->execute([$email]); // check if user exists
	if ($query->rowCount() == 0) return false;

	$result = $query->fetch();
	if ($result['is_deleted'] == 1) return false; // check if user is deleted

	if (!password_verify($password, $result['password'])) return false; // check for password match

	$_SESSION['ID'] = $result['UID'];
	$_SESSION['GID'] = $result['GID'];
	$_SESSION['firstname'] = $result['firstname'];
	$_SESSION['lastname'] = $result['lastname'];
	setcookie('user', $_SESSION['ID'], time() + (86400 * 30), "/"); // Logged in for a month
	return true;
}

function signout()
{
	$_SESSION = ['']; // Clear session information
	session_destroy();
}

// Check for logged in users
function is_logged()
{
	// check if the user is logged
	//return true|false
	if (count($_SESSION) > 0 && is_numeric($_SESSION['ID'])) {
		return true;
	} else {
		return false;
	}
}