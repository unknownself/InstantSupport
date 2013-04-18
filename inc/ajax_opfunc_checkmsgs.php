<?php
require_once('config.php');
$query2 = $db->query('SELECT * FROM messages WHERE `chatId`="'.$_POST['chatId'].'"');
foreach($query2 as $row2) {
		echo '<b>';
			if($row2['reply_type']=='staff') {
				echo 'OPERATOR '.$row2['name'];	
			} else {
				echo $row2['name'];	
			}
		echo '</b> says: '.htmlspecialchars($row2['message'], ENT_QUOTES).'<br>';	
	}
	echo '<br>';