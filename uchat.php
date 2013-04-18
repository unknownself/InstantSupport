<?php
require_once('inc/config.php');
$chatid = $_POST['chatid'];
$query = $db->query("SELECT * FROM messages WHERE `chatid`='".$chatid."'");
foreach($query as $row)
{
	$message = $row['message'];
	if(empty($message)) { echo "<b><font color='black'>".$row['name']."</b> entered a blank message.</font><br>"; }
	/*else if(strpos(":)", $message) !== false)
	{
		$message = str_replace(array(':)'), array('<img src="smiles/smile.gif" border="0">'), $message);
		echo "<b><font color='black'>".$row['name']."</b> says: <br> <font color='black'>".$message."</font><br>";
	} else if(strpos(":(", $message) !== false)
	{
		$message = str_replace(array(':(', '):'), array('<img src="smiles/sad.png" border="0">', '<img src="smiles/sad.png" border="0">'), $message);
		echo "<b><font color='black'>".$row['name']."</b> says: <br> <font color='black'>".$message."</font><br>";
	} else if(strpos("):", $message) !== false)
	{
		$message = str_replace(array('):'), array('<img src="smiles/sad.png" border="0">'), $message);
		echo "<b><font color='black'>".$row['name']."</b> says: <br> <font color='black'>".$message."<br></font>";
	}*/
	else
	{   if($row['reply_type']=='regular') {
        $whatfont = 'black';
		$staff = false;
    } else {
        $whatfont = 'black';
		$staff = true;
    }
		echo "<b><font color='".$whatfont."'>";
			if($staff==true) {
				echo 'Operator ';
			}
		echo "".$row['name']."</b> says: </font><br><font color='black'>".$row['message']."<br></font>";
	}
}
?>