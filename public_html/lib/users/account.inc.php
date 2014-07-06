<?php
	if(!$_SESSION['user']['gaEnabled']) {
		$g = new \Google\Authenticator\GoogleAuthenticator();
		$secret = $g->generateSecret();
		$url = $g->getURL($_SESSION['user']['id'], 'coinsortium.co', $secret);

		$gaCodes = "<small>Your OTP secret is: <strong>$secret</strong>. Alternatively you can scan the below QR code:</p><a href=\"$url\"><img src=\"$url\"\></a></small><input name=\"gaSecret\" value=\"$secret\" hidden \>";
	}
