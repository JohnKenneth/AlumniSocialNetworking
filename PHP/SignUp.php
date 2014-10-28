<div class="post">
	<style type="text/css">
		.window{
			padding-top:10px;
		}
		textarea{
			max-width: 210px; 
		}
		#error{
			text-align:center;
		}
	</style>
	<script type="text/javascript">
function echeck(str) {
		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		
		if (str.indexOf(at)==-1){
			wrong();
		   return false
		}

		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
			wrong();
		   return false
		}

		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
			wrong();
		    return false
		}

		 if (str.indexOf(at,(lat+1))!=-1){
			wrong();
		    return false
		 }

		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
			wrong();
		    return false
		 }

		 if (str.indexOf(dot,(lat+2))==-1){
			wrong();
			return false
		 }
		
		 if (str.indexOf(" ")!=-1){
			wrong();
		    return false
		 }
 		 return true					
	}
	
	function wrong()
	{
		document.getElementById("errorText").innerHTML ="Invalid Email Address";
	}
	
	function pcheck(value)
	{
		var pass1=document.getElementById("password").value;
		var pass2=document.getElementById("cpassword").value;
		if ((pass1 != pass2)&&(pass2 != "")) 
		{
			document.getElementById("errorText").innerHTML ="Password do not Match";
			document.getElementById("cpassword").focus();
			return false;
		}
		else if(value.length<5)
		{
			document.getElementById("errorText").innerHTML ="Password should be more than 5 characters";
			document.getElementById("password").focus();
			return false;
		}
		return true;
		
	}
	function checkform(form)
	{
		var check=echeck(document.getElementById("email").value);
		if (!check)
		{
			document.getElementById("email").focus();
			return false;
		}
		else if (!pcheck(document.getElementById("password").value))
		{
			return false;
		}
		document.getElementById("errorText").innerHTML ="";
		return confirm("Do you really want to Register?");
	}
</script>
<style type="css">
td,th
{
	vertical-align:text-top;
}
</style>
<h1 class="title">Sign Up</h1>
	<form name="AlumniSignUp" method="POST" onsubmit="return checkform(this)">
		<table class="window" name="tbSignUp" align="center" width="80%" border="0" cellpadding="5" cellspacing="1" bgcolor=>
				
				<tr>
					<td colspan="3">					
						
					</td>
				</tr>
				<tr>
					<td colspan='3' id="error">
						<font color='red' id="errorText">
						<?php 
							if(isset($_POST['student_id']))
								include('PHP/InsertAlumni.php');
						?>
						</font>
					</td>
				</tr>
				<tr>
					<td width="1%">Student Number</td>
					<td width="1px">:</td>
					<td width="10%">
						<input name="student_id" id="studId" type="text" required>
						<font color="red">*</font>
					</td>
				</tr>
				<tr>
					<td width="15%">E-Mail</td>
					<td width="1%">:</td>
					<td width="%">
						<input name="email" id="email" type="email" required>
						<font color="red">*</font>
					</td>
				</tr>
				
				<tr>
					<td>Password</td>
					<td>:</td>
					<td>
						<input name="password" id="password" type="password" required>
						<font color="red">*</font>
					</td>
				</tr>
				<tr>
					<td>Confirm Password</td>
					<td>:</td>
					<td>
						<input name="cpassword" id="cpassword" type="password" required>
					</td>
				</tr>
				
				<tr>
					<td>First Name</td>
					<td>:</td>
					<td>
						<input name="first_name" type="text" required>
						<font color="red">*</font>
					</td>
				</tr>
				
				<tr>
					<td>Middle Name</td>
					<td>:</td>
					<td>
						<input 	name="middle_name" type="text"/>
					</td>
				</tr>
				
				<tr>
					<td>Last Name</td>
					<td>:</td>
					<td>
						<input name="last_name" type="text" required/>
						<font color="red">*</font>
					</td>
				</tr>
				
				<tr>
					<td>Contact Number</td>
					<td>:</td>
					<td>
						<input name="phone_number" pattern="09[0-9]{9}" type="text" />
						<font color="red">*</font>
					</td>
				</tr>
				
				<tr>
					<td>Address</td>
					<td>:</td>
					<td><textarea name="address"></textarea></td>
				</tr>
				
				<tr>
					<td>Course</td>
					<td>:</td>
					<td>
						<input 	name="course" type="text" required/>
						<font color="red">*</font>
					</td>
				</tr>		
				
				<tr>
					<td>Year Graduated</td>
					<td>:</td>
					<td>
						<input 	name="batch" pattern="[0-9]{4}" type="text" required/>
						<font color="red">*</font>
					</td>
				</tr>	
				
				<tr>
					<td>Company</td>
					<td>:</td>
					<td><input 	name="company" type="text"/></td>
				</tr>
				
				<tr>
					<td>Company Address</td>
					<td>:</td>
					<td><textarea name="company_address"></textarea></td>
				</tr>
		</table>
		
		<div class="window">
			<div class="winbody">
				<table class="window" align="center" width="60%" border="0" cellpadding="3" cellspacing="1" bgcolor=>
					<tr>
						<td width="25%"></td>
						<td width="25%"><input type="submit" class="btn" value="Register"/></td>
						<td width="50%"><a class="btn" href="/Alumni" target="_parent">Cancel</a></button></td>
					</tr>
				</table>
			</div>	
		</div>
	</form>
</div>



<!--80% done designing--!>
