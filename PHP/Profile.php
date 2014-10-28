<div class="post">
	<h1 class="title">Profile</h1>
	<div class='byline'>
	<?php
		include("includes/connect.php");
		
		$alumniInfo = null;
		if(isset($_SESSION['studInfo']))
			$alumniInfo = $_SESSION['studInfo'];
		if(isset($_GET['profileId']))
		{
			$alumnus = mysql_query("SELECT *,(SELECT COUNT(*) FROM friends where friends.student_id = '".$alumniInfo['student_id']."' AND student_friend_id=alumni.student_id) as isFriend FROM alumni where student_id = '".$_GET['profileId']."'");
				
			if(mysql_num_rows($alumnus) > 0)
			{
				$alumniInfo=mysql_fetch_array($alumnus);
			}
			if(isset($_GET['notif']))
			{
				if($_GET['notif']=="editSuccess")
					echo '<div class="notif"><font>Edit Successful</font></div>';
				else
					echo '<div class="notif"><font>Adding Friends Successful</font></div>';
			}
		}
		if(isset($_GET['profileId']) && isset($_GET['confirm']))
		{
			if(!isset($_SESSION['adminInfo']))
				header("location:/alumni?error=AccesDenied");
			$alumni = $_GET['profileId'];
			$sql="UPDATE alumni SET status='Confirmed'
									WHERE student_id ='$alumni'";
			if (!mysql_query($sql,$con))
			{
				die('Error: ' . mysql_error());
			}
			else
				echo '<div class="notif"><font>Confirmation Successful</font></div>';
		}
			
		$alumniId = $alumniInfo['student_id'];
		?>
			<h2 class='title byline'>
				<?php echo ucfirst($alumniInfo['first_name']).' '.
						   ucfirst($alumniInfo['middle_name']).' '.
						   ucfirst($alumniInfo['last_name']); 
				?>
			</h2>
			
			<h3>
				Student Number: <small><?php echo $alumniId; ?></small>&nbsp;&nbsp;
				Course: <small><?php echo $alumniInfo['course']; ?></small>&nbsp;&nbsp;
				Year Graduated: <small><?php echo $alumniInfo['batch']; ?></small>
			</h3>
			<h3>
				Email: <small><?php echo $alumniInfo['email']; ?></small>&nbsp;&nbsp;
				Contact Number: <small><?php echo $alumniInfo['phone_number']; ?></small>
			</h3>
			<h3>Address: <small><?php echo $alumniInfo['address']; ?></small></h3>
			<h3>Company: <small><?php echo $alumniInfo['company']; ?></small></h3>
			<h3>Company Address: <small><?php echo $alumniInfo['company_address']; ?></small></h3>
			<center>
				<?php
					if(isset($_SESSION['studInfo']) && $alumniId == $_SESSION['studInfo']['student_id'])
						echo '<a class="btn" href="/Alumni?page=EditProfile">Edit</a>';
					else if(isset($_SESSION['studInfo']) && $alumniInfo['isFriend']!='1')
						echo '<a class="btn" href="/Alumni?addFriend='.$alumniId.'">Add Friend</a>';
					else if(isset($_SESSION['adminInfo']) && $alumniInfo['status']=='For Confirmation' && !isset($_GET['confirm']))
						echo '<a class="btn" href="/Alumni?profileId='.$alumniId.'&confirm">Confirm</a>';
					else if(!isset($_SESSION['studInfo']) && !isset($_SESSION['adminInfo']))
						echo '<div class="notif"><font>Please Log In first To Add Friends</font></div>';
				if(!isset($_SESSION['adminInfo']))
				{
					echo "&nbsp;&nbsp;&nbsp";
					echo "<a class='btn' href='/Alumni?album=$alumniId'>Album<a>";
				}
				?>
			</center>
		</div>
		<h2 class="title">Posts</h2>
		<p class="byline"><br/></p>
		<?php
		
		$posts = mysql_query("SELECT * FROM posts INNER JOIN alumni ON posts.post_owner = alumni.student_id where post_owner = '$alumniId' order by post_date desc");
		if(mysql_num_rows($posts) > 0)
		{
			while($post=mysql_fetch_array($posts))
			{
				echo '<div class = "entry"><h4 class="title"><a href="#">'.$post['post_title'].'</a></h4>';
				echo '<p class="byline"><small>Posted on '.$post['post_date'].
						' by <a href="#">'.
							$post['first_name'].' '.
							$post['last_name'].
						'</a></small></p>';
				echo '<div class="entry">';
				echo '<span>'.$post['post_description'].'</span>';
				echo '<p class="links">
						<a href="/Alumni?postId='.trim($post['post_id']).'" class="more">
							&laquo;&laquo;&nbsp;&nbsp;Read More&nbsp;&nbsp;&raquo;&raquo;
						</a>
					  </p>';
				echo '</div></div>';
			}
		}
		else
			echo '<div class="notif"><font>No Posts</font></div>';
		
		$announcements = mysql_query("SELECT * FROM announcements INNER JOIN alumni ON announcements.announcer_id = alumni.student_id where announcer_id = '$alumniId' order by announcement_date desc");
		echo '<h2 class="title">Announcements</h2>';
		if(mysql_num_rows($announcements) > 0)
		{
			while($announcement=mysql_fetch_array($announcements))
			{
				echo '<h4 class="title"><a href="/Alumni?annId='.trim($announcement['announcement_id']).'">'.$announcement['announcement_title'].'</a></h4>';
				echo '<p class="byline"><small>Posted on '.$announcement['announcement_date'].
						' by <a href="#">'.
							$announcement['first_name'].' '.
							$announcement['last_name'].
						'</a></small></p>';
				echo '<div class="entry">';
				echo '<span>'.$announcement['announcement_description'].'</span>';
				echo '<p class="links">
						<a href="/Alumni?annId='.trim($announcement['announcement_id']).'" class="more">
							&laquo;&laquo;&nbsp;&nbsp;Read More&nbsp;&nbsp;&raquo;&raquo;
						</a>
					  </p>';
				echo '</div>';
			}
		}
		else
			echo '<div class="notif"><font>No Announcements</font></div>';
	?>
</div>