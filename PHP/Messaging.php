<div class="post">
	<h1 class="title">Conversation</h1>
	<div class='byline'>
	<?php
		include("includes/CheckSession.php");
		include("includes/connect.php");
		
		$friendsId=$_GET['msg'];
		$alumniInfo = $_SESSION['studInfo'];
		$alumniId = $alumniInfo['student_id'];
		
		// Saving Post
		if(isset($_POST['message']))
		{
			$receiver = $friendsId;
			$message = $_POST['message'];
			$date = date('Y-m-d H:i:s');
			$sql="INSERT INTO messages  
			VALUES(null,'$alumniId', '$receiver','$message','$date')";
		 
			if (!mysql_query($sql,$con))
			{
				die('Error: ' . mysql_error());
			}
			else
				echo '<div class="notif"><font>Message Sent</font></div>';
		}
		?>
			<form method="POST">
				<h3>Message:<textarea name="message" style="width:100%" required></textarea>
				<input type="submit" class="btn" value="SEND"/></h3>
			</form>
			</div>
			<h2 class='title'>Messages</h3>
			<p class="byline"/>
		<?php
		
		$messages = mysql_query("SELECT * FROM messages INNER JOIN alumni ON messages.sender_id = alumni.student_id where (sender_id = '$friendsId' AND receiver_id = '$alumniId') OR (sender_id = '$alumniId' AND receiver_id = '$friendsId') order by message_date desc");
		
		if(mysql_num_rows($posts) > 0)
		{
			
			while($message=mysql_fetch_array($messages))
			{
			?>
				<div class="messageDiv">
					<div>
						<h3 class="msgHeader byline">
							<a href="/Alumni?profileId=<?php echo $message['student_id']; ?>">
								<?php echo $message['first_name'].' '.$message['middle_name'].' '.$message['last_name']; ?>
							</a>
						</h3>
						<p class="byline"></p>
						<div class="byline">
							<?php echo $message['message']; ?>
						</div>
					</div>
				</div>
			<?php
			}
		}
		else
			echo '<div class="notif"><font>No Friends Post</font></div>';
	?>
</div>