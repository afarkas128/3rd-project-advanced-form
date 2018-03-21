<?php
require_once('config.php');

	try {
		$host = "localhost"; // If you don't know what your host is, it's safe to leave it localhost
		$dbName = "first-php-project"; // Database name
		$dbUser = "root"; // Username
		$dbPass = ""; // Password
	    $dbh = new PDO('mysql:host=localhost;dbname=first-php-project', $dbUser, $dbPass);

	    // set the PDO error mode to exception
	    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	} catch (PDOException $e) {

	    print "Error!: " . $e->getMessage() . "<br/>";
	    die();
	}
?>
