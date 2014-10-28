<?php
include("includes/connect.php");

$studId=$_POST['student_id'];
$email=$_POST['email'];
$password=$_POST['password'];
$fName=$_POST['first_name'];
$mName=$_POST['middle_name'];
$lName=$_POST['last_name'];
$pNum=$_POST['phone_number'];
$addr=$_POST['address'];
$com=$_POST['company'];
$comAdd=$_POST['company_address'];

$sql="UPDATE alumni SET 
			email = '$email', 
			password = '$password', 
			first_name = '$fName', 
			middle_name = '$mName', 
			last_name = '$lName', 
			phone_number = '$pNum', 
			address = '$addr', 
			company = '$com', 
			company_address = '$comAdd'
		WHERE student_id = '$studId'";
if (!mysql_query($sql,$con))
{
	echo mysql_error();
}

mysql_close($con);
$alumniInfo = $_POST;
$_SESSION['studInfo'] = $_POST;
?>
Update Successful
 
 
 <!--Done--!>