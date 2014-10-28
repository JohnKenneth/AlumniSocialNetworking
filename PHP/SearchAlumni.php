
<div class="post">
	<h1 class="title">Alumni</h1>
	<?php
		include("includes/connect.php");
		$whereClause = "";
		$studId = '';
		$studName = '';
		$course = '';
		$batch = '';
		if(isset($_POST['searchAll']))
		{
			$searchAll = $_POST['searchAll'];
			$whereClause = "(alumni.student_id like '%$searchAll%' OR ".
						"(first_name like '%$searchAll%' OR middle_name like '%$searchAll%' OR last_name like '%$searchAll%') OR ".
						"course like '%$searchAll%' OR ".
						"batch like '%$searchAll%')";
		}
		else
		{
			$studId = isset($_POST['searchStudId']) ? $_POST['searchStudId']:'';
			$studName = isset($_POST['searchStudName']) ? $_POST['searchStudName']:'';
			$course = isset($_POST['searchCourse']) ? $_POST['searchCourse']:'';
			$batch = isset($_POST['searchBatch']) ? $_POST['searchBatch']:'';
			$whereClause = "(alumni.student_id like '%$studId%' AND ".
						"(first_name like '%$studName%' OR middle_name like '%$studName%' OR last_name like '%$studName%') AND ".
						"course like '%$course%' AND ".
						"batch like '%$batch%')";
		}				
		$alumniList = mysql_query("SELECT * FROM alumni WHERE $whereClause");
		
		?>
		<script type="text/javascript">
		$(function(){
			$("table tr:odd").addClass("evenrowcolor");
			$("tr:even").addClass("oddrowcolor");
		});
		</script>
		<h3 class="title">Search Criteria</h3>
		<p class="byline"></p>
		<form method='POST' style="text-align:center" name="SearchAlumni">
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
			<a class="btn" style="float:right;margin:10px 10px 0 0" onclick="javascript:document.SearchAlumni.reset()">Reset</a>
		</form>
		<h2 class="title">List of Alumni</h2>
		<p class="byline"></p>
		<?php
		if(mysql_num_rows($alumniList) > 0)
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
					while($alumni=mysql_fetch_array($alumniList))
					{
						$alumniId = $alumni["student_id"];
						echo "<tr><td><a href='/Alumni?profileId=$alumniId'>$alumniId</td>";
						echo "<td>".$alumni["first_name"].' '.$alumni["middle_name"].' '.$alumni["last_name"]."</td>";
						echo "<td>".$alumni["course"]."</td>";
						echo "<td>".$alumni["batch"]."</td>";
					}
				?>
			</table>
		<?php
		}
		else if(!isset($_POST['alumniId']))
		{
		?>
			<div class="notif"><font>No Search Results Found</font></div>
		<?php
		}
		
		mysql_close($con);
	?>
</div>