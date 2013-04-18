<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'support';
	try {
    $db = new PDO('mysql:host='.$db_host.';dbname='.$db_name, $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}
?>