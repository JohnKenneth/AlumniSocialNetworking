<?php
if(!(isset($_SESSION["studInfo"]) || isset($_SESSION["adminInfo"])))
{
	header("location:/alumni?error=AccesDenied");
}
?>