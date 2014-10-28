<?php include('PHP/header.php');?>
<div id="wrapper">
	<!-- start page -->
	<div id="page">
		<!-- start sidebars -->
		<?php include("PHP/leftSidebar.php"); ?>
		<!-- end sidebars -->
		<!-- start content -->
		<div id="content">
			<?php
				$page = "PHP/Home.php";
				if(isset($_GET["page"]))
					$page = "PHP/".$_GET["page"].".php";
					
				if(isset($_GET["frame"]))
					echo "<iframe src='$page' width='100%' height='1000px' frameBorder='0'></iframe>";
				else if(isset($_GET['error']))
				{
					include("PHP/ErrorPage.php");
				}
				else if(isset($_GET['postId']))
				{
					include("PHP/Posts.php");
				}
				else if(isset($_GET['annId']))
				{
					include("PHP/Announcements.php");
				}
				else if(isset($_GET['profileId']))
				{
					include("PHP/Profile.php");
				}
				else if(isset($_GET['addFriend']))
				{
					include("PHP/AddFriend.php");
				}
				else if(isset($_GET['msg']))
				{
					include("PHP/Messaging.php");
				}
				else if(isset($_GET['album']))
				{
					include("PHP/Album.php");
				}
				else if(isset($_GET['pic']))
				{
					include("PHP/Photo.php");
				}
				else
					include($page);
			?>
		</div>
		<!-- end content -->
		<!-- start sidebars -->
		<?php include("PHP/rightSidebar.php"); ?>
		<!-- end sidebars -->
		<div style="clear: both;">&nbsp;</div>
	</div>
	<!-- end page -->
</div>
<div id="footer">
	<p class="copyright">&copy;&nbsp;&nbsp;2014 All Rights Reserved &nbsp;&bull;&nbsp; Programmed by <a href="#">JKNL</a>.</p>
	<!--<p class="link"><a href="#">Privacy Policy</a>&nbsp;&#8226;&nbsp;<a href="#">Terms of Use</a></p>-->
</div>
<div align=center>Programmed by <a href="#">JNKL</a></div></body>
</html>
