<?php
session_start();
	//if (isset($_POST['logout']))
	
		if(session_destroy()){
		header("location: login.php");
		exit;

	}
?>
		
