<?php
	// At the top of the page we check to see whether the user is logged in or not 
	if(empty($_SESSION['user'])) { 
		// If they are not, we redirect them to the login page. 
		header("Location: /"); 
		 
		// Remember that this die statement is absolutely critical.Without it, 
		// people can view your members-only content without logging in. 
		die("Redirecting to login.php"); 
	}
	if($_SESSION['user']['gaEnabled']){
		if((!$_SESSION['user']['gaAuthed']) && ($_SERVER['PHP_SELF'] !== "/users/tfa.php")) {
			header("Location: /users/tfa.php");
		}
	}else{
		$warning = "We recommend enabling Two Factor Authentication!";
	}
