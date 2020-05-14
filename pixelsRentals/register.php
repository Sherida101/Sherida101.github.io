<?php
 
// Server host name 
$HostName = "localhost";
 
// MySQL Database name
$DatabaseName = "rentalsDB";
 
// Database User Name 
$HostUser = "sherida";
 
// Database password 
$HostPass = "crybaby"; 
 
// Create MySQL database onnection
$con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 
// Store the received JSON into a $json variable.
$json = file_get_contents('php://input');
 
// Decode the received JSON and store into a $obj variable.
$obj = json_decode($json,true);
 
// Retrieve first name from $obj object.
$firstname = $obj['firstname'];
 
// Retrieve last name from $obj object.
$lastname = $obj['lastname'];
 
// Retrieve email from $obj object.
$email = $obj['email'];
 
// Retrieve username from $obj object.
$username = $obj['username'];

// Retrieve password from $obj object.
$password = $obj['password'];
 
// Determine whether email already exists in MySQL Table
$CheckSQL = "SELECT * FROM User WHERE email='$email'";
 
// Execute email address check MySQL query.
$check = mysqli_fetch_array(mysqli_query($con,$CheckSQL));
 
 
if(isset($check)){
 
	 $emailExist = 'Email already exist. Please try again with new email address..!';
	 
	 // Convert the message into JSON format
	$existEmailJSON = json_encode($emailExist);
	 
	// Echo the message on screen
	 echo $existEmailJSON ; 
 
  }
 else{
 
	 // Create SQL query and insert the record into MySQL database table
	 $Sql_Query = "insert into User (firstname,lastname, email, username, password) values ('$firstname', '$lastname', '$email','$password')";
	 
	 
	 if(mysqli_query($con,$Sql_Query)){
	 
		 // If the record has been inserted successfully, show the message
		$MSG = 'User registered successfully' ;
		 
		// Converting the message into JSON format.
		$json = json_encode($MSG);
		 
		// Echo the message.
		 echo $json ;
	 
	 }
	 else{
	 
		echo 'Try Again';
	 
	 }
 }
 mysqli_close($con);
?>