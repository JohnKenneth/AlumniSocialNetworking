
<div class="post">
<?php
	include("includes/CheckSession.php");
	if(isset($_SESSION["adminInfo"]))
	{
		include("includes/connect.php");
		echo '<h1 class="title">Students For Confirmation</h1>';
		// Confirmation
		if(isset($_POST['alumniId']))
		{
			$alumni = '';
			foreach($_POST['alumniId'] as $selected){
				$alumni .= "'".$selected."',";
			}
			$alumni = substr($alumni,0,strlen($alumni)-1);
			$sql="UPDATE alumni SET status='Confirmed'
									WHERE student_id IN ($alumni)";
			if (!mysql_query($sql,$con))
			{
				die('Error: ' . mysql_error());
			}
			else
				echo '<div class="notif"><font>Confirmation Successful</font></div>';
		}
		
		$alumni = mysql_query("SELECT * FROM alumni where status='For Confirmation'");
			
		if(mysql_num_rows($alumni) > 0)
		{
			?>
			<script type="text/javascript">
			$(function(){
				$("table tr:odd").addClass("evenrowcolor");
				$("tr:even").addClass("oddrowcolor");
			});
			</script>
			
			
			<form method='POST' style="text-align:center" >
				<table class="tblDisplay" align="center" border="1" >
				<tr class="tableColumnHeader">
					<th></th>
					<th>Student Number
					</th>
					<th>Student Name
					</th>
					<th>Course
					</th>
					<th>Year Graduated
					</th>
					<?php
						while($alumnus=mysql_fetch_array($alumni))
						{
							$alumniId = $alumnus["student_id"];
							echo "<tr><td><input name='alumniId[]' type='checkbox' value='".$alumnus["student_id"]."'/></td>";
							echo "<td><a href='/Alumni?profileId=$alumniId'>".$alumniId."</td>";
							echo "<td>".$alumnus["first_name"].' '.$alumnus["middle_name"].' '.$alumnus["last_name"]."</td>";
							echo "<td>".$alumnus["course"]."</td>";
							echo "<td>".$alumnus["batch"]."</td>";
						}
					?>
				</table>
				<BR/><BR/>
				<input type= "submit" class="btn" value="Confirm"/>
			</form>
		<?php
		}
		else if(!isset($_POST['alumniId']))
		{
		?>
			<div class="notif"><font>No more Pending Alumni to be Confirmed</font></div>
		<?php
		}
		
		mysql_close($con);
	}
	else
		header("location:/alumni?error=AccesDenied");
?>
</div>