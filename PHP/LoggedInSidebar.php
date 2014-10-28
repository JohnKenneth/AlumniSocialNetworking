<h2>Activities</h2>
<ul>
	<?php
		if(isset($_SESSION["adminInfo"]))
		{
		?>
			<li><a href="/Alumni?page=ConfirmAlumni">Confirm Alumni</a></li>
			<li><a href="/Alumni?page=SearchAlumni">Search Alumni</a></li>
			<li><a href="/Alumni?page=Announcements">Announcements</a></li>
			<li><a href="/Alumni?page=Logout">Log Out</a></li>
			
		<?php
		}
		else
		{
		?>
			<li><a href="/Alumni?page=Posts">Posts</a></li>
			<li><a href="/Alumni?page=Profile">Profile</a></li>
			<li><a href="/Alumni?page=Friends">Friends</a></li>
			<li><a href="/Alumni?page=SearchAlumni">Search Alumni</a></li>
			<li><a href="/Alumni?page=Messages">Messages</a></li>
			<li><a href="/Alumni?page=Album">Album</a></li>
			<li><a href="/Alumni?page=Announcements">Announcements</a></li>
			<li><a href="/Alumni?page=Logout">Log Out</a></li>
		<?php
		}
		?>
</ul>