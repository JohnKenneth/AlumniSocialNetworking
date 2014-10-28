<?php
include("includes/connect.php");

// username and password sent from form 
$studId=$_POST['studId']; 
$password=$_POST['password'];
// To protect MySQL injection (more detail about MySQL injection)

$studId = stripslashes($studId);
$password = stripslashes($password);
$studId = mysql_real_escape_string($studId);
$password = mysql_real_escape_string($password);



$sql1="SELECT * FROM alumni WHERE student_id='$studId' and password='$password'";
$result1=mysql_query($sql1);
$count1=mysql_num_rows($result1);
$alumniInfo=mysql_fetch_array($result1);


$sql2="SELECT * FROM admin WHERE admin_id='$studId' and password='$password'";
$result2=mysql_query($sql2);
$count2=mysql_num_rows($result2);
$adminInfo=mysql_fetch_array($result2);


if($count1==1){
	if($alumniInfo['status']=="For Confirmation")
	{
		header("location:?notif=confirm");
	}
	else
	{
		$_SESSION["studInfo"]=$alumniInfo;
		header("location: /Alumni?profileId=$studId");
	}
}
elseif($count2==1){
	$_SESSION["adminInfo"]=$adminInfo;
	header("location: /Alumni?page=ConfirmAlumni");
}
else {
	header("location:?notif=invalid");
}
?>
