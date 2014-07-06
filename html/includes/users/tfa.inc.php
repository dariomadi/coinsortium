<?php
	if($_POST) {
		$g = new \Google\Authenticator\GoogleAuthenticator();
		if ($g->checkCode($_SESSION['user']['gaSecret'], $_POST['otp'])) {
			$_SESSION['user']['gaAuthed'] = True;
			header("Location: /");
		} else {
			$error = "Incorrect OTP!";
		}
	}
