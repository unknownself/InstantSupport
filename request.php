<?php
session_start();
require_once('inc/config.php');
				$name = htmlentities(strip_tags($_POST['name'])); // name
				$email = htmlentities(strip_tags($_POST['email'])); // email
				$subject = htmlentities(strip_tags($_POST['subject'])); // subject
				$message = htmlspecialchars($_POST['message']); // message
				$securehash = md5($name . $subject);
				if(empty($name) || empty($subject) || empty($message))
				{
					exit('One or more fields are empty');
				}
				$db->query('INSERT INTO `requests`(`id`, `name`, `email`, `subject`, `message`, `ip`, `operator_handling`) VALUES (NULL, "'.$name.'", "'.$email.'", "'.$subject.'", "'.$message.'", "'.$_SERVER['REMOTE_ADDR'].'", "")');
				$query = $db->query('SELECT * FROM requests WHERE `name`="'.$name.'" AND `email`="'.$email.'" AND `subject`="'.$subject.'" AND `message`="'.$message.'"');
				foreach($query as $row) {
					$chatid = $row['id'];
				}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Live Support</title>
<link rel="stylesheet" type="text/css" href="main.css" />
<?php
	
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js?ver=1.3.2" type="text/javascript"></script>
<script type="text/javascript">
var chatid = <?php echo $chatid; ?>;
function sendMessage()
{
	$.ajax({
		type: "POST",
		url: "upost.php",
		data: { 'name': '<?php echo $name; ?>', 'message': $("#sendie").val(), 'chatid': chatid, 'type': 'regular'},
		success: function(msg) {
			refreshChat();
			$("#sendie").val('');
			$("#status").html("<b>Message sent.</b>");
		}
	});
}
function refreshChat()
{
	$.ajax({
		type: "POST",
		url: "uchat.php",
		data: { 'chatid': chatid },
		success: function(msg) {
			$("#status").html("<b>Checking...</b>");
			$("#chat-area").html(msg);
		}
	});
}
function checkifclosed()
{
	//$("#closed").html("<b>No messages? That means its been closed.</b>");
}
			function leavechat()
			{
				$.ajax({
					type: "POST",
					url: "funcs.php",
					data: { 'function': 'leave', 'chatid': chatid },
					success: function(msg) {
						//sendCustomMessage('Operator left the chat room...');
						//window.location.replace("index.php");
						window.location.replace("operator.php");
					}
				});
			}
window.onbeforeunload = function () {
	leavechat();
}
function checksystemissues()
{
	$.ajax({
		type: "POST",
		url: "systemissues.php",
		data: { 'function': 'checkforissues' },
		success: function(msg) {
			$("#systemissues").html(msg);
		}
	});
}
window.setInterval("refreshChat()", 1000);
window.setInterval("checksystemissues()", 1000);
//window.setInterval("checkifclosed()", 1000);
</script>
</head>
<body>
    <div id="page-wrap"> 
    
    	<div id="header">
        	<h1><a href="#header">Logo</a></h1>
			<div id="you">Talking as <b><?php echo $name; ?></b></div>
        </div>
        
    	<div id="section">
        	<h2><?php echo $name; ?></h2>
                     
            <div id="chat-wrap">
                <div id="chat-area"></div>
            </div>
                	<div id="userlist"> Rate the operator: 
					<select name="rating">
						<option name="exellent" onchange="$('#userlist').html('<b>Thank you</b>');" value="Exellent">Exellent</option>
						<option name="very_good" onchange="$('#userlist').html('<b>Thank you</b>');" value="very_good">Very Good</option>
						<option name="bad" onchange="$('#userlist').html('<b>Thank you</b>');" value="bad">Bad</option>
						<option name="very_bad" onchange="$('#userlist').html('<b>Thank you</b>');" value="very_bad">Very Bad</option>
					</select>
				</div>
                <form id="send-message-area" action="">
                    <textarea id="sendie" maxlength='200'></textarea> <br /><input type="button" value="Send" onclick="sendMessage()" />
                </form>
        	<div id="closed"></div>
			<div id="status">
				
			</div>
		</div>
        
    </div>
</body>
</html>