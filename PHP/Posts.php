<div class="post">
	<h1 class="title">Posts</h1>
	<div class='byline'>
	<?php
		include("includes/connect.php");
		
		$postId='';
		
		// Saving Post
		if(isset($_POST['post_title']))
		{
			$alumniInfo = $_SESSION['studInfo'];
			$alumniId = $alumniInfo['student_id'];
			$postTitle = $_POST['post_title'];
			$postDesc = $_POST['post_description'];
			$date = date('Y-m-d H:i:s');
			$sql="INSERT INTO posts  
			VALUES(null,'$alumniId', '$postTitle', '$postDesc','$date',null)";
		 
			if (!mysql_query($sql,$con))
			{
				die('Error: ' . mysql_error());
			}
			else
				echo '<div class="notif"><font>Post Successful</font></div>';
		}
		$addToWhere = '';
		if(!isset($_GET['postId']))
		{
		include("includes/CheckSession.php");
		?>
			<form method="POST">
				<h3>Post Title:</h3> <input type="text" name="post_title" style="width:100%" required/>
				<h3>Post Description:</h3><textarea name="post_description" style="width:100%" required></textarea>
				<input type="submit" class="btn" value="POST"/>
			</form>
			</div>
			<h2 class='title'>Friends Post</h3>
			<p class="byline"/>
		<?php
			$studId = $_SESSION['studInfo']['student_id'];
			$addToWhere = "AND posts.post_owner IN ((SELECT student_friend_id FROM friends WHERE friends.student_id ='$studId'),'$studId')";
		}
		else
		{
			$postId = $_GET['postId'];
			echo "</div>";
		}
		$posts = mysql_query("SELECT * FROM posts INNER JOIN alumni ON posts.post_owner = alumni.student_id where post_id like '%$postId%' $addToWhere order by post_date desc");
		// echo "SELECT * FROM posts INNER JOIN alumni ON posts.post_owner = alumni.student_id where post_id like '%$postId%' $addToWhere order by post_date desc";
		if(mysql_num_rows($posts) > 0)
		{
			
			while($post=mysql_fetch_array($posts))
			{
				echo '<div class = "entry"><h4 class="title"><a href="/Alumni?postId='.trim($post['post_id']).'">'.$post['post_title'].'</a></h4>';
				echo '<p class="byline"><small>Posted on '.$post['post_date'].
						' by <a href="/Alumni?profileId='.$post['student_id'].'">'.
							$post['first_name'].' '.
							$post['last_name'].
						'</a></small></p>';
				echo '<div class="entry">';
				echo '<span>'.$post['post_description'].'</span>';
				if($postId == '')
					echo '<p class="links">
							<a href="/Alumni?postId='.trim($post['post_id']).'" class="more">
								&laquo;&laquo;&nbsp;&nbsp;Read More&nbsp;&nbsp;&raquo;&raquo;
							</a>
						  </p>';
				echo '</div></div>';
			}
		}
		else
			echo '<div class="notif"><font>No Friends Post</font></div>';
	?>
</div>