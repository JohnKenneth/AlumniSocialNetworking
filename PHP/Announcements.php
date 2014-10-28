<div class="post">
	<h1 class="title">Announcements</h1>
	<div class='byline'>
	<?php
		include("includes/connect.php");
		
		$annId='';
		
		// Saving Post
		if(isset($_POST['announcement_title']))
		{
			$id = '';
			if(isset($_SESSION['adminInfo']))
				$id = $_SESSION['adminInfo']['admin_id'];
			else
				$id = $_SESSION['studInfo']['student_id'];
				
			$announcementTitle = $_POST['announcement_title'];
			$announcementDesc = $_POST['announcement_description'];
			$date = date('Y-m-d H:i:s');
			$sql="INSERT INTO announcements
			VALUES(null,'$id', '$announcementTitle', '$announcementDesc','$date')";
		 
			if (!mysql_query($sql,$con))
			{
				die('Error: ' . mysql_error());
			}
			else
				echo '<div class="notif"><font>Announcement Successful</font></div>';
		}
		$addToWhere = '';
		if(!isset($_GET['annId']) && (isset($_SESSION['studInfo']) || isset($_SESSION['adminInfo'])))
		{
			?>
				<form method="POST">
					<h3>Announcement Title:</h3> <input type="text" name="announcement_title" style="width:100%" required/>
					<h3>Announcement Description:</h3><textarea name="announcement_description" style="width:100%" required></textarea>
					<input type="submit" class="btn" value="Announce"/>
				</form>
				</div>
				<h2 class='title'>Announcements</h3>
				<p class="byline"/>
			<?php
		}
		else if(isset($_GET['annId']))
		{
			$annId = $_GET['annId'];
			echo "</div>";
		}
		else
			echo "</div>";
		$announcements = 
			mysql_query("SELECT * FROM announcements 
							LEFT OUTER JOIN alumni ON announcements.announcer_id = alumni.student_id 
							LEFT OUTER JOIN admin ON announcements.announcer_id = admin.admin_id 
						where announcement_id like '%$annId%' order by announcement_date desc");
		
		if(mysql_num_rows($announcements) > 0)
		{
			
			while($announcement=mysql_fetch_array($announcements))
			{
				echo '<div class = "entry"><h3 class="title"><a href="/Alumni?annId='.trim($announcement['announcement_id']).'">'.$announcement['announcement_title'].'</a></h3>';
				echo '<p class="byline"><small>Posted on '.$announcement['announcement_date'];
				if(isset($announcement['student_id']))
					echo ' by <a href="/Alumni?profileId='.$announcement['student_id'].'">'.
							$announcement['first_name'].' '.
							$announcement['last_name'].
						'</a></small></p>';
				else
					echo ' by <font color="red">'.$announcement['admin_name'].'</font></small></p>';
				echo '<div class="entry">';
				echo '<span>'.$announcement['announcement_description'].'</span>';
				if($annId == '')
					echo '<p class="links">
							<a href="/Alumni?annId='.trim($announcement['announcement_id']).'" class="more">
								&laquo;&laquo;&nbsp;&nbsp;Read More&nbsp;&nbsp;&raquo;&raquo;
							</a>
						  </p>';
				echo '</div></div>';
			}
		}
		else
			echo '<div class="notif"><font>No Announcements</font></div>';
	?>
</div>