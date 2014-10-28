<?php
include("includes/CheckSession.php");
include("includes/connect.php");

$friendStudId=$_GET['addFriend'];
$studId=$_SESSION['studInfo']['student_id'];

$sql="INSERT INTO friends  
VALUES (null,'$studId','$friendStudId')";

if (!mysql_query($sql,$con))
{
	die('Error: ' . mysql_error());
}

mysql_close($con);

if(isset($_GET['addFriend']))
	header("Location: /Alumni?profileId=$friendStudId&notif=success");
?>