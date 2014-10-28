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
$batch=$_POST['batch'];
$course=$_POST['course'];
$com=$_POST['company'];
$comAdd=$_POST['company_address'];

 $result=mysql_query("SELECT status FROM alumni WHERE student_id='$studId'");
 if(mysql_num_rows($result)>0)
 {
	if(mysql_fetch_array($posts)[0]['status']=='For Confirmation')
		echo "This student Number is already for Confirmation";
	else
		echo "Student Already Exist";
 }
 else
 {
	$sql="INSERT INTO alumni  
	VALUES ('$studId','$fName', '$mName', '$lName','For Confirmation','$email','$password',
			'$pNum','$addr','$batch','$course','$com','$comAdd',null)";
 
	if (!mysql_query($sql,$con))
	{
		echo mysql_error();
	}
    
	mysql_close($con);
	echo "Sign Up Successful! Your account is now Pending for confirmation";
 }
 ?>
 
 
 <!--Done--!>