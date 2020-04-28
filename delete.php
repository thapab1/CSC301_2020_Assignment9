<?php
require_once('includes/functions.php');
require_once('includes/database.php');
require_once('includes/db_connection.php');

$apartments = jsonToArray('data/data.json');

displayPageHeader('Delete Room');

if(!isset($_GET['id'])){
	echo 'Please visit our <a href="index.php">Home Page</a>.';
	die();
}
if($_GET['id']<0){
	echo 'Something went wrong! Please come back to our <a href="index.php">Home Page</a>.';
	die();
}
    
$id = $_GET['id'];
$database->deleteRoom($id);
echo 'Delete room successfully. Click <a href="index.php">here</a> to go back to home page.';

displayPageFooter(); ?>