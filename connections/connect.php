<?php 
	$connection = new mysqli('localhost', 'root','','css_faculty_system_db');
	
	if (!$connection){
		die (mysqli_error($mysqli));
	}
		
?>