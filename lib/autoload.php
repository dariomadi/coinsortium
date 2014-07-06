<?php
	$root = "/usr/local/coinsortium/public_html2/";
	$html_root = $root."html/";

	require($root.'etc/settings.php');
	require($root.'vendor/autoload.php');
	require($root.'lib/classes/pdo/Db.class.php');

	$db = new Db();

	// This tells the web browser that your content is encoded using UTF-8 
	// and that it should submit content back to you using UTF-8 
	header('Content-Type: text/html; charset=utf-8'); 

	// This initializes a session.  Sessions are used to store information about 
	// a visitor from one web page visit to the next.  Unlike a cookie, the information is 
	// stored on the server-side and cannot be modified by the visitor.  However, 
	// note that in most cases sessions do still use cookies and require the visitor 
	// to have cookies enabled.  For more information about sessions: 
	// http://us.php.net/manual/en/book.session.php 
	session_start(); 

	// Note that it is a good practice to NOT end your PHP files with a closing PHP tag. 
	// This prevents trailing newlines on the file from being included in your output, 
	// which can cause problems with redirecting users.
