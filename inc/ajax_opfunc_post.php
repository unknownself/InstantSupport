<?php
require_once('config.php');
$name = $_POST['name'];
$msg = $_POST['message'];
$chatid = $_POST['chatid'];
$type = $_POST['type'];
if(empty($name) || empty($msg) || empty($chatid) || empty($type)) {
	echo 'Unable to send shout.';	
}
$db->query('INSERT INTO `messages`(`id`, `chatid`, `name`, `message`, `reply_type`) VALUES (NULL,"'.$chatid.'","'.$name.'","'.$msg.'","'.$type.'")');