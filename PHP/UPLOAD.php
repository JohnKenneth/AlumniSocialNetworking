<?php
   // Configuration - Your Options
	include("includes/connect.php");
      $allowed_filetypes = array('.jpg','.gif','.bmp','.png'); // These will be the types of file that will pass the validation.
      $max_filesize = 9524288; // Maximum filesize in BYTES (currently 5.5MB).
      $upload_path = 'PHP/uploads/'; // The place the files will be uploaded to (currently a 'uploads' directory).
 
   $filename = $_FILES['userfile']['name']; // Get the name of the file (including file extension).
   $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1); // Get the extension from the filename.
   
   // Check if the filetype is allowed, if not DIE and inform the user.
   if(!in_array($ext,$allowed_filetypes))
      echo 'The file you attempted to upload is not allowed.';
 
   // Now check the filesize, if it is too large then DIE and inform the user.
   else if(filesize($_FILES['userfile']['tmp_name']) > $max_filesize)
      echo 'The file you attempted to upload is too large.';
 
   // Check if we can upload to the specified path, if not DIE and inform the user.
   else if(!is_writable($upload_path))
      echo 'You cannot upload to the specified directory, please CHMOD it to 777.';
 
   // Upload the file to your specified path.
   else if(move_uploaded_file($_FILES['userfile']['tmp_name'],$upload_path . $filename))
   {
		mysql_query("INSERT INTO uploads VALUES (null,'".$upload_path.$filename."')");
		$uploadId=mysql_insert_id();
		$alumniId = $_SESSION['studInfo']['student_id'];
		$description = isset($_POST['description'])?$_POST['description']:'';
		$date = date('Y-m-d H:i:s');
		
		mysql_query("INSERT INTO album VALUES(null,'$alumniId','$uploadId','$description','$date')");
		echo 'Upload Succesful!';
	}
   else
       echo 'There was an error during the file upload.  Please try again.'; // It failed :(.
?>