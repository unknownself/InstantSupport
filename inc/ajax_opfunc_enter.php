<?php
require_once('config.php');
if(isset($_POST['handling']) and isset($_POST['chatId']))
{
	$handledBy = $_POST['handling']; // who is handling it?
	$chatId = $_POST['chatId']; // chat ID to update.
	$db->query("UPDATE `requests` SET `operator_handling`='".$handledBy."' WHERE `id`='".$chatId."'");
	$query = $db->query('SELECT * FROM requests WHERE `id`="'.$chatId.'"');
	$query2 = $db->query('SELECT * FROM messages WHERE `chatid`="'.$chatId.'"');
	foreach($query as $row) {
		echo '<b>'.$row['name'].'</b> says: '.htmlspecialchars($row['message'], ENT_QUOTES).'<br>';
	}
	
}
?>