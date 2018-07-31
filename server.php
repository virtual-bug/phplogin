<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'registration');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}

// ... 
// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}
if (isset($_POST['new_project'])) {
  // receive all input values from the form
    
  $proid = mysqli_real_escape_string($db, $_POST['proid']);
  $proname = mysqli_real_escape_string($db, $_POST['proname']);
  $details = mysqli_real_escape_string($db, $_POST['details']);
  $time1 = mysqli_real_escape_string($db, $_POST['time1']);
  $time2 = mysqli_real_escape_string($db, $_POST['time2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($proname)) { array_push($errors, "project name is required"); }
  if (empty($details)) { array_push($errors, "details is required"); }
//  if (empty($time1)) { array_push($errors, "start time is required"); }
//  if (empty($time2)) { array_push($errors, " end time is required"); }
//  
//  if ($time1 >= $time2) {
//	array_push($errors, "The time is not correct !");
//  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $project_check_query = "SELECT * FROM projects WHERE proname='$proname' LIMIT 1";
  $result = mysqli_query($db, $project_check_query);
  $project = mysqli_fetch_assoc($result);
  
  if ($project) { // if user exists
    if ($project['proname'] == $proname) {
      array_push($errors, "project already exists change the name");
    }

     
  }

  // Finally, add  pro if there are no errors in the form
  if (count($errors) == 0) {
  	//$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO projects (proid, proname, details,startdate,enddate) 
  			  VALUES('$proid','$proname', '$details', '$time1','$time2')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "Yourproject added ";
  	header('location: index.php');
  }
}
?>
