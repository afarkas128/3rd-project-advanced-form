<?php 
// include_once("../header.php");

// // require_once('database.php');
// // require_once('config.php');


// // echo '<pre>';
// // print_r($_POST);
// // echo '<hr>';
// // print_r($_POST['first_name']);
// // echo "\n";
// // print_r($_POST['last_name']);
// // echo "\n";
// // print_r($_POST['birthdate']);
// // echo "\n";
// // print_r($_POST['age']);
// // echo "\n";
// // print_r($_POST['country']);
// // echo "\n";
// // print_r($_POST['friend_name']);
// // echo '</pre>';


// // insert_data();
// // insert_friend();



// /******************************************************** CHECKS ********************************************************/


// // if (isset($_POST['farki-form'])) {

// // 	$data = json_decode($_POST['farki-form'], true);

// // 	if ($data[0]['first-name'] == 'Anyam' || $data[0]['first-name'] == 'anyam') {
// // 		echo json_encode(array('status' => 'error', 'message' => 'Please do not use your mother in a form! Thank you. :))', 'form_data' => NULL));
// // 	} else {
// // 		echo json_encode(array('status' => 'success', 'message' => 'Thank you for submitting. Your information has been successfully saved.', 'form_data' => $_POST['farki-form']));
// // 	}
	
// // } else {
// // 	echo json_encode(array('status' => 'error', 'message' => 'There was an error saving your information. Please try resubmitting the form.', 'form_data' => NULL));
// // }


// /******************************************************** FUNCTIONS ********************************************************/

// function insert_data() {

// 	$formData = $_POST;

// 	// global $dbh;

// 	$host = "localhost"; // If you don't know what your host is, it's safe to leave it localhost
// 	$dbName = "first-php-project"; // Database name
// 	$dbUser = "root"; // Username
// 	$dbPass = ""; // Password




// 	try {

// 	    $dbh = new PDO('mysql:host=localhost;dbname=first-php-project', $dbUser, $dbPass);

// 	    // set the PDO error mode to exception
// 	    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// 	    $query = "INSERT INTO `form_data` (`first_name`, `last_name`, `birthday`, `age`, `country`, `number_of_friends`) VALUES ('" . $formData['first_name'] . "', '" . $formData['last_name'] . "', '" . $formData['birthdate'] . "', '" . $formData['age'] . "', '" . $formData['country'] . "', '" .  count($_POST['friend_name']) . "')";
// 	    // use exec() because no results are returned
// 	    $dbh->exec($query);
// 	    echo "New record created successfully";

//     } catch (PDOException $e) {

// 		$error = $e->getMessage();
// 		$fp = file_put_contents( '/log/php-database-errors.log', print_r( $error, true ) );

// 		//return false for error/fail 
// 		return false;
// 	}
// }


// function insert_friend() {
// 	try {
// 		$insert_friend = "INSERT INTO `friends` (`friend_name`) VALUES ('" .  count($_POST['friend_name']) . "')"; 
// 	} catch (PDOException $e) {

// 		$error = $e->getMessage();
// 		$fp = file_put_contents( '/log/php-database-errors.log', print_r( $error, true ) );

// 		//return false for error/fail 
// 		return false;
// 	}
// }




// include_once("data.php");
?>