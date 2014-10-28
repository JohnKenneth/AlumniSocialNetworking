<?php 
	session_start(); 
	if(isset($_POST["studId"]))
		include("checkLogin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : Premium Series
Description: A three-column, fixed-width blog design.
Version    : 1.0
Released   : 20090303

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>EARIST Alumni</title>
<meta name="keywords" content="earist alumni" />
<meta name="Earist Alumni" content="" />
<link href="/Alumni/style/bootstrap.css" rel="stylesheet" type="text/css" media="screen" />
<link href="/Alumni/style/style.css" rel="stylesheet" type="text/css" media="screen" />
<script src="/Alumni/script/scripts.js"></script>
</head>
<body>
<!-- start header -->
<div id="header">
	<div id="logoDiv">
		<a href='#'>
			<img id="logo" src="/Alumni/images/earistLogo.png"/>
		</a>
		<?php
			if(isset($_SESSION["studInfo"]))
				echo "<h3>Welcome ".$_SESSION["studInfo"]['first_name']."!</h3>";
		?>
	</div>
	<div id="menu">
		<ul id="main">
			<li><a href="/Alumni">Home</a></li>
			<li><a href="/Alumni?page=AboutUs">About Us</a></li>
			<li><a href="/Alumni?page=Announcements">Announcements</a></li>
			<li><a href="/Alumni?page=ContactUs">Contact Us</a></li>
			<li>
				<form method="POST" action="/Alumni/?page=SearchAlumni">
						<input type="text" name="searchAll" value="<?php if(isset($_POST['searchAll'])) echo $_POST['searchAll']; ?>"/>
						<input type="submit" class="btn" value="Search"/>
				</form>
			</li>
		</ul>
	</div>
	
</div>
<!-- end header -->