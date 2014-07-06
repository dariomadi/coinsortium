<?php

function newGAKey(){
	global $g;
	$secret = $g->generateSecret();
	$url = $g->getURL($_SESSION['user']['id'], 'coinsortium.co', $secret);
	$return = $url;
	$return .= $secret;
	return $return;
}
