<h2>Log In</h2>
<div class="notif">
	<font>
	<?php
		if(isset($_GET["notif"]))
		{
			$notif = $_GET["notif"];
			if($notif=="logout")
				echo "Log Out Successful";
			if($notif=="invalid")
				echo "Invalid Student ID/ Password";
			if($notif=="confirm")
				echo "Student ID is Still For Confirmation";
			if($notif=="kenneth")
				echo "Hello Kenneth";
		}
	?>
	</font>
</div>
<form id="LogInForm" method="post">
	<table>
		<tr>
			<td>
				<h3>Student Id<h3>
			</td>
			<td>
				<h3>:<h3>
			</td>
			<td>
				<input type="text" name="studId" style="width:90%" required/>
			</td>
		<tr>
			<td>
				<h3>Password:<h3>
			</td>
			<td>
				<h3>:<h3>
			</td>
			<td>
				<input type="password" name="password" style="width:90%" required/>
			</td>
		</tr>
		<tr>
			<td colspan="3" style="padding-top:10px;text-align:center;">
				<input type="submit" class="btn" value="Log In"/>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<a class="btn" href="?page=SignUp">
					Sign Up
				<a>
			</td>
		</tr>
	</table>
</form>