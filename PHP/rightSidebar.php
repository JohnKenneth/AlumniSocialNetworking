<div id="sidebar2" class="sidebar">
			<ul>
				<li>
					<?php
						if(isset($_SESSION['studInfo']) || isset($_SESSION['adminInfo']))
							include('LoggedInSidebar.php');
						else
							include('login.php');
					?>
				</li>
				<li>
					<h2>Announcements</h2>
					<ul>
				<?php
					include("includes/connect.php");
					$announcements = mysql_query("SELECT * FROM announcements 
							LEFT OUTER JOIN alumni ON announcements.announcer_id = alumni.student_id 
							LEFT OUTER JOIN admin ON announcements.announcer_id = admin.admin_id 
							order by announcement_date desc LIMIT 10");
						
					if(mysql_num_rows($announcements) > 0)
					{
						while($announcement=mysql_fetch_array($announcements))
						{
							echo '<li>
									<a href="/Alumni?annId='.trim($announcement['announcement_id']).'" class="more">
										'.trim($announcement['announcement_title']).'
									</a>
								  </li>';
						}
					}
					else
						echo '<div class="notif"><font>No Announcements</font></div>';
				?>
					</ul>
				</li>
			</ul>
		</div>