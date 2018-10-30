<?php

	$conn = new mysqli("localhost", "root", "Cesitar95.", "agroSmart");
	if (mysqli_connect_errno()) {
    	printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}

	function is_valid_email($str){
		return (false !== filter_var($str, FILTER_VALIDATE_EMAIL));
	}

 ?>