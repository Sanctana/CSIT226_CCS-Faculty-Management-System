<?php 
	$connection = new mysqli('localhost', 'root','','dbccsfacultysystem');
	
	if (!$connection){
		die (mysqli_error($mysqli));
	}
		
?>