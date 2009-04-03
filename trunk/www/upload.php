<?php
	//include("db.php");
	include_once("func2.php");
	
	include_once("handle_files.php");
	
	if (!isset($errorMsg))
	{
		echo($name.";".$tmp_name);
	}
	else
	{
		//header("Location: /");
		echo "Error;".$errorMsg;
        exit(0);
	}
?>
