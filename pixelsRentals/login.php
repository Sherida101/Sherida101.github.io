<?php
// Server host name 
$HostName = "localhost";
 
// MySQL Database name
$DatabaseName = "rentalsDB";
 
// Database User Name 
$HostUser = "sherida";
 
// Database password 
$HostPass = "crybaby";
 
 // Create MySQL Connection
 $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 
 // Store the received JSON into $json variable.
 $json = file_get_contents('php://input');
 
 // Decode the received JSON and store into $obj variable
 $obj = json_decode($json,true);
 
 // Get username from JSON $obj array and store into $username
 $username = $obj['username'];
 
 // Getting Password from JSON $obj array and store into $password.
 $password = $obj['password'];
 
 //Apply login query with username and password.
 $loginQuery = "select * from User where username = '$username' and password = '$password' ";
 
 // Executing SQL Query.
 $check = mysqli_fetch_array(mysqli_query($con,$loginQuery));
 
	if(isset($check)){
		
		 // Successful login message
		 $onLoginSuccess = 'Login successful';
		 
		 // Convert the message into JSON format
		 $SuccessMSG = json_encode($onLoginSuccess);
		 
		 // Echo the message.
		 echo $SuccessMSG ; 
	 
	 }
	 
	 else{
	 
		 // If username and password do not match
		$InvalidMSG = 'Invalid username or password. Please Try Again' ;
		 
		// Convert the message into JSON format
		$InvalidMSGJSon = json_encode($InvalidMSG);
		 
		// Echo the message.
		 echo $InvalidMSGJSon ;
	 
	 }
 
 mysqli_close($con);
?>