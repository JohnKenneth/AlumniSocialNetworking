
<div class="post">
	<h1 class="title">Friends</h1>
	<?php
		include("includes/CheckSession.php");
		include("includes/connect.php");
		
		$alumniId = $_SESSION['studInfo']['student_id'];
		
		$studId = isset($_POST['searchStudId']) ? $_POST['searchStudId']:'';
		$studName = isset($_POST['searchStudName']) ? $_POST['searchStudName']:'';
		$course = isset($_POST['searchCourse']) ? $_POST['searchCourse']:'';
		$batch = isset($_POST['searchBatch']) ? $_POST['searchBatch']:'';
		
		$whereClause = "AND (alumni.student_id like '%$studId%' AND ".
						"(first_name like '%$studName%' OR middle_name like '%$studName%' OR last_name like '%$studName%') AND ".
						"course like '%$course%' AND ".
						"batch like '%$batch%')";
						
		$friendsList = mysql_query("SELECT * FROM friends INNER JOIN alumni ON friends.student_friend_id = alumni.student_id where friends.student_id='$alumniId' $whereClause");
		
		?>
		<script type="text/javascript">
		$(function(){
			$("table tr:odd").addClass("evenrowcolor");
			$("tr:even").addClass("oddrowcolor");
		});
		</script>
		<h3 class="title">Search Criteria</h3>
		<p class="byline"></p>
		<form method='POST' style="text-align:center" name="SearchFriends">
			<table align="center" border="0" class="tblSearch">
				<tr>
					<th>
						ID:
					</th>
					<td>
						<input name='searchStudId' type='text' style="width:80%" value="<?php echo $studId;?>"/>
					</td>
					<th>
						Name:
					</th>
					<td>
						<input name='searchStudName' type='text' style="width:80%" value="<?php echo $studName;?>"/>
					</td>
				</tr>
				<tr>
					<th>
						Course:
					</th>
					<td>
						<input name='searchCourse' type='text' style="width:80%" value="<?php echo $course;?>"/>
					</td>
					<th>
						Year Graduated:
					</th>
					<td>
						<input name='searchBatch' type='text' style="width:80%" value="<?php echo $batch;?>"/>
					</td>
				</tr>
			</table>
			<input type= "submit" class="btn" value="Search" style="float:right;margin:10px 45px 0 0"/>
			<a class="btn" style="float:right;margin:10px 10px 0 0" onclick="javascript:document.SearchFriends.reset()">Reset</a>
		</form>
		<h2 class="title">Friends List</h2>
		<p class="byline"></p>
		<?php
		if(mysql_num_rows($friendsList) > 0)
		{
			?>
			
			<table class="tblDisplay" align="center" border="1" >
			<tr class="tableColumnHeader">
				<th>Student Number
				</th>
				<th>Student Name
				</th>
				<th>Course
				</th>
				<th>Year Graduated
				</th>
				<?php
					while($friend=mysql_fetch_array($friendsList))
					{
						$friendId = $friend["student_id"];
						echo "<tr><td><a href='/Alumni?profileId=$friendId'>$friendId</td>";
						echo "<td>".$friend["first_name"].' '.$friend["middle_name"].' '.$friend["last_name"]."</td>";
						echo "<td>".$friend["course"]."</td>";
						echo "<td>".$friend["batch"]."</td>";
					}
				?>
			</table>
		<?php
		}
		else if(!isset($_POST['alumniId']))
		{
		?>
			<div class="notif"><font>You Have No Friends.. :(</font></div>
		<?php
		}
		
		mysql_close($con);
	?>
</div>