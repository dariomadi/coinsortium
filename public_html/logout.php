<?php
	require("../lib/autoload.php");
	unset($_SESSION['user']); 
	header("Location: /");
	die;
