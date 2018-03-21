<?php
require_once('database.php');
ini_set('display_errors', '1');

/******************************************************** CHECKS ********************************************************/

// check if this file is used by form.php
if(isset($_POST['farki-form']) && $_POST['farki-form'] != "") {
	insert_data();
}

// this if checks what the ajax wants to do in the database (this case will delete a row)
if(isset($_POST['farki-table']) && $_POST['farki-table'] != "") {
	if(isset($_POST['farki-table']['action']) && $_POST['farki-table']['action'] == "delete") {
		delete_form_data($_POST['farki-table']['id']);
	}
}

if(isset($_POST['edit-farki-form']) && $_POST['edit-farki-form'] != "") {
	$formData = json_decode($_POST['edit-farki-form'], true);
	update_form_data($formData);
}

/******************************************************** FUNCTIONS ********************************************************/

//inserting user submitted data into the database
function insert_data() {

	global $dbh;

	$formData = json_decode($_POST['farki-form'], true);

	try {

	    $query = "INSERT INTO `form_data` (`first_name`, `last_name`, `birthday`, `age`, `country`, `number_of_friends`) VALUES ('" . $formData['first_name'] . "', '" . $formData['last_name'] . "', '" . $formData['birthdate'] . "', '" . $formData['age'] . "', '" . $formData['country'] . "', '" .  count($formData['friends']) . "')";
	    // use exec() because no results are returned
	    $dbh->exec($query);

	    insert_friends($formData['friends']);

	    $ajax_response = array(
	    		'message' => 'Thank you for submitting. Your information has been successfully saved.',
	    		'status' => 'success'
	    	);

	    echo json_encode($ajax_response);

    } catch (PDOException $e) {

		$error = $e->getMessage();
		$fp = file_put_contents( 'log/php-database-errors.log', print_r( $error, true ) );

		$ajax_response = array(
	    		'message' => $error,
	    		'status' => 'error'
	    	);

	    echo json_encode($ajax_response);

		//return false for error/fail 
		return false;
	}
}


function insert_friends($friends_array) {

	global $dbh;

	$form_id = get_last_inserted_form_data_id();

	//insert all the friends belonging to the current data into friends table
	try {

		$stmt = $dbh->prepare('INSERT INTO `friends`(`form_id`, `name`) VALUES(:form_id, :name)');

		$dbh->beginTransaction();

		foreach ($friends_array as $index => $friend_name){
		    $stmt->bindValue(':form_id', $form_id);
		    $stmt->bindValue(':name', $friend_name);
		    $stmt->execute();
		}
		

		$dbh->commit();

	} catch (PDOException $e) {

		$error = $e->getMessage();
		$fp = file_put_contents( 'log/php-database-errors.log', print_r( $error, true ) );

		//return false for error/fail 
		return false;
	}
}


function get_last_inserted_form_data_id() {

	global $dbh;

	//get the id of the last submitted bunch of data
	try {

	    $stmt = $dbh->prepare("SELECT `id` FROM `form_data` ORDER BY `id` DESC LIMIT 1");
	    // use exec() because no results are returned
	    $stmt->execute();
		$theIdWeNeed = $stmt->fetch(PDO::FETCH_ASSOC)['id'];

		return $theIdWeNeed;

	} catch (PDOException $e) {

		$error = $e->getMessage();
		$fp = file_put_contents( 'log/php-database-errors.log', print_r( $error, true ) );

		//return false for error/fail 
		return false;
	}
}

//get form_data from database
function get_form_data($rowID = false) {

	global $dbh;

	try {
		
		if ($rowID) {
			$stmt = $dbh->prepare("SELECT * FROM `form_data` WHERE `id`=" . $rowID);
		} else {
			$stmt = $dbh->prepare("SELECT * FROM `form_data`");
		}
		
	    // use exec() because no results are returned
	    $stmt->execute();
		$all_form_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $all_form_data;

	} catch (PDOException $e) {

		$error = $e->getMessage();
		$fp = file_put_contents( 'log/php-database-errors.log', print_r( $error, true ) );

		//return false for error/fail 
		return false;
	}
}


//Deleting row from database
function delete_form_data($rowID) {

    global $dbh;

    try {

    	$stmt = "DELETE FROM `form_data` WHERE `id`=" . $rowID;
	    // use exec() because no results are returned
	    $dbh->exec($stmt);
	    echo 'deleted';
    	return true;

    } catch (PDOException $e) {

		$error = $e->getMessage();
		$fp = file_put_contents( 'log/php-database-errors.log', print_r( $error, true ) );
		//return false for error/fail
		return false;
	}
}

//updateing user submitted form data into the databa
function update_form_data($formData) {

	global $dbh;

	$params = array(
		':first_name' => $formData['first_name'],
		':last_name' => $formData['last_name'],
		':birthdate' => $formData['birthdate'],
		':age' => $formData['age'],
		':country' => $formData['country'],
		':number_of_friends' => count($formData['friends']),
		':formID' => $formData['id']
	);

	try {

		$stmt = $dbh->prepare("UPDATE form_data SET `first_name` = :first_name, `last_name` = :last_name , `birthday` = :birthdate, `age` = :age, `country` = :country, `number_of_friends` = :number_of_friends WHERE `id` = :formID");
		$stmt->execute($params);

	    $ajax_response = array(
	    		'message' => 'Thank you for updating your information. Your information has been successfully saved.',
	    		'status' => 'success'
	    	);

	    echo json_encode($ajax_response);

    } catch (PDOException $e) {

		$error = $e->getMessage();
		$fp = file_put_contents( '../log/php-database-errors.log', print_r( $error, true ) );

		$ajax_response = array(
	    		'message' => $error,
	    		'status' => 'error'
	    	);

	    echo json_encode($ajax_response);

		//return false for error/fail 
		return false;
	}
}

?>