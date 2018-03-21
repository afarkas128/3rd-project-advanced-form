<?php 
//Insert case switch here which will decide what page to show

// $page = 'form';

if (isset($_GET['p'])) {
	$page = $_GET['p'];
} else {
	$page = '404';
}

include_once('header.php');

switch ($page) {
	case 'form':
		include('page/form.php');
		break;

	case 'table':
		include('page/table.php');
		break;

	case '404':
		include('page/404.php');
		break;

	case 'about':
		include('page/about.php');
		break;

	case 'contact':
		include('page/contact.php');
		break;

	case 'sign-in';
		include('page/sign-in.php');
		break;

	case 'edit-table';
		$rowToEdit = $_GET['rowid'];
		echo '<div class="hidden" style="display: none;" rowToEdit='. $rowToEdit .'></div>';
		include('page/edit-table.php');
		break;
}

include_once('footer.php');
?>