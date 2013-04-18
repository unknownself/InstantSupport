<?php
require_once('config.php');
if(isset($_POST['chatId']))
{
	$db->query('DELETE FROM `requests` WHERE `id`="'.$_POST['chatId'].'"');
	$db->query('DELETE FROM `messages` WHERE `chatid`="'.$_POST['chatId'].'"');
}
?>