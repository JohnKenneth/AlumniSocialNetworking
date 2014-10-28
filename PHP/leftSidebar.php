<div id="sidebar1" class="sidebar">
	<ul>
		<li>
			<h2>Recent Posts</h2>
			<ul>
				<?php
					include("includes/connect.php");
					$posts = mysql_query("SELECT * FROM posts INNER JOIN alumni ON posts.post_owner = alumni.student_id order by post_date desc LIMIT 10");
						
					if(mysql_num_rows($posts) > 0)
					{
						while($post=mysql_fetch_array($posts))
						{
							echo '<li>
									<a href="/Alumni?postId='.trim($post['post_id']).'" class="more">
										'.trim($post['post_title']).'
									</a>
								  </li>';
						}
					}
					else
						echo '<div class="notif"><font>No Post</font></div>';
				?>
			</ul>
		</li>
		<li>
			<h2>Alumni Members</h2>
			<ul>
				<?php
					include("includes/connect.php");
					$alumni = mysql_query("SELECT * FROM alumni where status='Confirmed'");
						
					if(mysql_num_rows($posts) > 0)
					{
						while($alumnus=mysql_fetch_array($alumni))
						{
							echo '<li>
									<a href="/Alumni?profileId='.trim($alumnus['student_id']).'" class="more">
										'.ucfirst($alumnus['first_name']).' '.
										  ucfirst($alumnus['middle_name']).' '.
										  ucfirst($alumnus['last_name']).'
									</a>
								  </li>';
						}
					}
					else
						echo '<div class="notif"><font>No Post</font></div>';
				?>
			</ul>
		</li>
	</ul>
</div>