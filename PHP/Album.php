<div class="post">
	<h1 class="title">Album</h1>
	<div class='byline'>
	<style>
		div.img {
			margin: 5px;
			padding: 5px;
			height: auto;
			width: auto;
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
			margin: 5px;
		}
		</style>
	<?php
		include("includes/connect.php");
		
		$albumOwner='';
		
		// Saving PHOTO
		if(isset($_FILES['userfile']))
		{
			echo "<div class='notif'>";
			include("PHP/Upload.php");
			echo "</div>";
		}	
		if(!isset($_GET['album']))
		{
		include("includes/CheckSession.php");
		?>
		<form method="POST" enctype="multipart/form-data" class="byline">
			<h3> Upload Picture:</h3>
			<input type="file" style="height:25px" name="userfile" id="file"></input>
			<h3>Description:</h3><textarea name="description" style="width:100%"></textarea>
			<center>
				<input type="submit" class="btn" value="Upload" />
			</center>
		</form>
		</div>
		<h2 class='title'>Uploaded Pictures</h3>
		<p class="byline"/>
		<?php
		$albumOwner = $_SESSION['studInfo']['student_id'];
		}
		else
		{
			$albumOwner = $_GET['album'];
			if(isset($_SESSION['studInfo']) && $albumOwner == $_SESSION['studInfo']['student_id'])
				echo "<a href='/Alumni?page=Album'>Upload Photo</a>";
				
			echo "</div>";
		}
		$album = mysql_query("SELECT * FROM album 
								INNER JOIN alumni ON album.album_owner = alumni.student_id 
								INNER JOIN uploads ON uploads.upload_id = album.upload_id
								where album_owner like '%$albumOwner%' order by upload_date desc");
								
		if(mysql_num_rows($album) > 0)
		{
			
			while($picture=mysql_fetch_array($album))
			{
			?>
			<div class="img">
			  <a href="?pic=<?php echo $picture['upload_id']; ?>">
				<img src="<?php echo $picture['upload_url']; ?>" alt="<?php echo $picture['description']; ?>" width="110" height="90">
			  </a>
			  <div class="desc"><?php echo $picture['description']; ?></div>
			</div>
			<?php
			}
		}
		else
			echo '<div class="notif"><font>No Photo Uploaded</font></div>';
	?>
</div>