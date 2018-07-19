<?php
$username = $_POST['user'];
$password = $_POST['password'];

 // connect and select database login in this case 
$con=mysqli_connect("localhost","root","","login");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
//mysqli_select_db($con,"login");// in case of changing database 
  
// preventing injuction
$username = stripcslashes($username);
$password = stripcslashes($password);
$username = mysqli_real_escape_string($con, $username);
$password = mysqli_real_escape_string($con,$password);
 


// queries
$result = $con->query("select * from users where username='$username' and password  = '$password' ")
        or die("filled to connect ".mysqli_errno($link));
     
$row = mysqli_fetch_array($result);
//$row = mysql_fetch_arry($result,MYSQLI_BOTH);
if($row['UserName'] == $username && $row['Password'] == $password){ // element in database itself 
    echo 'login success welcome my process:  '.$row['UserName'];  // colom name in db    
}
else
    echo "failed to login wrong pass or username ";



?>