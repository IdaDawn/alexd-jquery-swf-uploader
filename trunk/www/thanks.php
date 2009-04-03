<?php

// Check for a degraded file upload, this means SWFUpload did not load and the user used the standard HTML upload
$used_degraded = false;
$name = "";
$tmp_name = "";

include("func2.php");

include ("handle_files.php");


if(!isset($errorMsg))
{
	echo "File $tmp_name uploaded and stored as $name";	
}
else
{
	echo $errorMsg;
}

?>

