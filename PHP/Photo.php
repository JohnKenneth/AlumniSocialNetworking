<div class="post">
	<h1 class="title">Photo</h1>
	<div class='byline'>
	<style>
		div.img {
			margin: 5px;
			padding: 5px;
			height: auto;
			width: 80%;
			float: left;
			text-align: center;
		}

		div.img img {
			display: inline;
			margin: 5px;
			border: 1px solid #ffffff;
		}

		div.img a:hover img {
			border:1px solid #c4131f;
		}

		div.desc {
			text-align: center;
			font-weight: normal;
			width: 120px;
		}
		</style>
	<?php
		include("includes/connect.php");
		
		
		
		// Saving PHOTO
		$addToWhere = '';
		if(isset($_GET['pic']))
		{
			$photoId=$_GET['pic'];
				
			echo "</div>";
			$photo = mysql_query("SELECT * FROM album 
									INNER JOIN alumni ON album.album_owner = alumni.student_id 
									INNER JOIN uploads ON uploads.upload_id = album.upload_id
									where album.upload_id like '%$photoId%' order by upload_date desc");
									
				
			if(mysql_num_rows($photo) > 0)
			{
				while($photoDetl=mysql_fetch_array($photo))
				{
				$albumOwner = $photoDetl['student_id'];
				if($albumOwner == $_SESSION['studInfo']['student_id'])
					echo "<a class='link' href='/Alumni?page=Album'>Upload Photo</a><br/>";
					
				?>
				<div class="entry">
					<h3 class="title">Posted by:<a class='link' href='/Alumni?profileId="<?php echo $photoDetl['student_id']."'>".$photoDetl['first_name']; ?></a></h3>
					<p class='byline'>
						<small>
						 Posted on <?php echo $photoDetl['upload_date']; ?>
						</small>
					</p>
					<div class="entry">
						<img src="<?php echo $photoDetl['upload_url']; ?>" alt="Klematis" width="100%" height="100%">
						<h3 class="title">Desciption</h3>
						<p class="byline"/>
						<div class="desc ">
							<?php echo $photoDetl['description']!=""?
										$photoDetl['description']:
										'<font color=red>
											No Description
										</font>'; ?></div>
					</div>
				</div>
				<?php
				}
			}
			else
				echo '<div class="notif"><font>No Photo To be Viewed</font></div>';
		
		}else
				echo '<div class="notif"><font>No Photo To be Viewed</font></div>';
	?>
</div>