<?php
	// At the top of the page we check to see whether the user is logged in or not 
	if(empty($_SESSION['user'])) { 
		// If they are not, we redirect them to the login page. 
		header("Location: /"); 
		 
		// Remember that this die statement is absolutely critical.Without it, 
		// people can view your members-only content without logging in. 
		die("Redirecting to login.php"); 
	}elseif(($_SESSION['user']['gaEnabled']) && (!$_SESSION['user']['gaAuthed'])) {
		if($_SERVER['PHP_SELF'] !== "/users/tfa.php") {
			header("Location: /users/tfa.php");
		}
	}
