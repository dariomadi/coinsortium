<?php
	$root = "/usr/local/coinsortium/public_html2/";
	$html_root = $root."html/";

	require($root.'etc/settings.php');
	require($root.'vendor/autoload.php');
	require($root.'lib/classes/pdo/Db.class.php');

	$db = new Db();
?>
