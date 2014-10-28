<div class="post" >
	<h1 class="title">Messages</h1>
	<div class='byline'>
	<?php
		include("includes/CheckSession.php");
		include("includes/connect.php");
		$alumniId = $_SESSION['studInfo']['student_id'];
		
		// Saving Message
		if(isset($_POST['receiver']))
		{
			$alumniInfo = $_SESSION['studInfo'];
			$alumniId = $alumniInfo['student_id'];
			$receiver = $_POST['receiver'];
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
		<h3>To:</h3> 
		<select name="receiver" style="width:60%" required>
			<option value=""></option>
			<?php
			
			$friends = mysql_query("SELECT * 
										FROM friends
										INNER JOIN alumni ON friends.student_friend_id = alumni.student_id where friends.student_id='$alumniId'");
			if(mysql_num_rows($friends) > 0)
			{
				while($friend=mysql_fetch_array($friends))
				{
					$friendId = $friend['student_friend_id'];
					$friendName = $friend['first_name'].' '.$friend['middle_name'].' '.$friend['last_name'];
					echo "<option value='$friendId'>$friendName</option>";
				}
			}
			?>
		</select>				
		<h3>Message:</h3><textarea name="message" style="width:100%" required></textarea>
		<input type="submit" class="btn" value="Send Message"/>
	</form>
	</div>
	<h2 class='title'>Friends Messages</h3>
	<p class="byline"/>
	<?php
		$messages = mysql_query("SELECT * FROM (Select * from messages order by message_date desc) as messages
									LEFT OUTER JOIN friends ON messages.sender_id = friends.student_id
									INNER JOIN alumni ON friends.student_id = alumni.student_id
									where receiver_id = '$alumniId'
									group by receiver_id
									order by message_date desc");
		if(mysql_num_rows($messages) > 0)
		{
			while($message=mysql_fetch_array($messages))
			{
			?>
				<div class="messageDiv">
					<div>
						<h3 class="msgHeader byline">
							<a href="/Alumni?msg=<?php echo $message['student_id']; ?>">
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
			echo '<div class="notif"><font>No Message Found</font></div>';
	?>
</div>