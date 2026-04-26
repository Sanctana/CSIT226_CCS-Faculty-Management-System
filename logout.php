<?php
    // lab act
	session_start();
	session_destroy();
	header('Location: index.php');
	exit;
?>
