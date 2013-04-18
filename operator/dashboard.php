<?php
session_start();
require_once('../inc/config.php');
eval(base64_decode('JGxxdWVyeSA9ICRkYi0+cXVlcnkoJ1NFTEVDVCAqIEZST00gYHNpdGVfc2V0dGluZ3NgIFdIRVJFIGBzZXR0aW5nX25hbWVgPSJsaWNlbnNlX2tleSInKTsNCmZvcmVhY2goJGxxdWVyeSBhcyAkbHJvdykgew0KCSRsaWNlbnNlID0gYmFzZTY0X2VuY29kZSgkbHJvd1snc2V0dGluZ192YWx1ZSddKTsNCgkvLyBERUJVRzogZWNobyAkbGljZW5zZTsNCn0NCiRzciA9IGJhc2U2NF9kZWNvZGUoJ2FIUjBjRG92TDJOb1pXRjBZbkp2TG5neE1DNXRlQzl1YjJNdlkyaGxZMnN1Y0dod1AyeHBZejA9JykuJycuYmFzZTY0X2RlY29kZSgkbGljZW5zZSk7DQokY29udHMgPSBmaWxlX2dldF9jb250ZW50cygkc3IpOw0KaWYoJGNvbnRzPT0naW52YWxpZCcgfHwgJGNvbnRzID09ICdzdXNwZW5kZWQnIHx8ICRjb250cyA9PSAnZXhwaXJlZCcgfHwgJGNvbnRzID09ICd1bmtub3duJykgew0KCSRlcnJvcnNbXSA9ICdMaWNlbnNlIGlzIGludmFsaWQvc3VzcGVuZGVkL2V4cGlyZWQuJzsNCn0NCmRlZmluZSgnbGljX3J1bicsICd5ZXMnKTs='));
error_reporting(0);
if($_SESSION['logged_in']&&!$_SESSION['operator']) {
	header('Location: ../index.php');	
}
if(!$_SESSION['logged_in']) {
	header('Location: ../index.php');	
}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no,maximum-scale=1">
	
    <title>Dashboard</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
	<!-- CSS for Growl like notifications -->
	<link rel="stylesheet" href="css/jquery.gritter.css">
	<!-- Theme CSS -->
	<!--[if !IE]> -->
	<link rel="stylesheet" href="css/style.css">
	<!-- <![endif]-->
	<!--[if IE]>
	<link rel="stylesheet" href="css/style_ie.css">
	<![endif]-->

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- smoother animations -->
	<script src="js/jquery.easing.min.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Scrollable navigation -->
	<script src="js/jquery.nicescroll.min.js"></script>
	<!-- Growl Like notifications -->
	<script src="js/jquery.gritter.min.js"></script>

	<!-- Just for demonstration -->
	<script src="js/demonstration.min.js"></script>
	<!-- Theme framework -->
	<script src="js/eakroko.min.js"></script>
	<!-- Theme scripts -->
	<script src="js/application.min.js"></script>
    
</head>

<body data-layout="fixed">
	<?php $can_use_presets = true; require_once('tpl/top.php'); ?>

	<div id="main">
		<?php require_once('tpl/nav_left.php'); ?>
		<div id="content">
			<div class="page-header">
				<div class="pull-left">
					<h4><i class="icon-reorder"></i> Dashboard</h4>
				</div>
				<div class="pull-right">
					<ul class="bread">
						<li class='active'><a href="dashboard.php">Home</a></li>
					</ul>
				</div>
			</div>
			
			<div class="container-fluid" id="content-area">
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-head">
								<i class="icon-reorder"></i>
								<span>Welcome</span>
							</div>
							<div class="box-body">
								<?php  if(!defined('lic_run')) { $errors[] = 'NULLED COPY.'; }
									echo 'Welcome, '.$_SESSION['user'].' to the operator dashboard.<br>';
									if(is_array($errors)) {
										foreach($errors as $err => $msg) {
											exit('<h1>ERROR!</h1> '.$msg);
										}
									}
								?>
                                <div id="support-panel"></div>
                                <div id="support-panel-refnum"></div>
                                <div id="support-panel-chat-window">
                                
                                </div>
                                <div id="support-panel-chat-msgs">
                                
                                </div>
                                <div id="support-panel-reply-box"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="navi-functions">
		<div class="btn-group btn-group-custom">
			<a href="#" class="button button-square layout-not-fixed notify" rel="tooltip" title="Toggle fixed-nav" data-notify-message="Fixed nav is now {{state}}" data-notify-title="Toggled fixed nav">
				<i class="icon-unlock"></i>
			</a>
			<a href="#" class="button button-square layout-not-fluid notify button-active" rel="tooltip" title="Toggle fixed-layout" data-notify-message="Fixed layout is now {{state}}" data-notify-title="Toggled fixed layout">
				<i class="icon-exchange"></i>
			</a>
			<a href="#" class="button button-square toggle-active notify" rel="tooltip" title="Toggle Automatic data refresh" data-notify-message="Automatic data-refresh is now {{state}}" data-notify-title="Toggled automatic data refresh">
				<i class="icon-refresh"></i>
			</a>
			<a href="#" class="button button-square button-active force-last notify-toggle toggle-active notify" rel="tooltip" title="Toggle notification"  data-notify-message="Notifications turned {{state}}" data-notify-title="Toggled notifications">
				<i class="icon-bullhorn"></i>
			</a>
		</div>
	</div>
    <script type="text/javascript">
		function checkrequests() {
				var tryit = 'yes';
				$.ajax({
					type: "POST",
					url: "../inc/ajax_opfunc_checkrequests.php",
					data: { 'tryit': tryit },
					success: function(data)
					{
						$("#support-panel").html('<ul class="nav nav-tabs">' +data+ '</ul>');
					}
				});
			}
			var myName = '<?php echo $_SESSION['user']; ?>';
			
		function popupchat(chatId) {
			var tryit = 'yes';
				$.ajax({
					type: "POST",
					url: "../inc/ajax_opfunc_enter.php",
					data: { 'handling': myName, 'chatId': chatId },
					success: function(data)
					{
						$("#support-panel-chat-window").html('<div id="tab' + chatId + '">'+data+'</div>');
						var thatid = chatId;
						var thatidstorage = '<div id="tid">'+thatid+'</div>';
						$('#support-panel-chat-num').append(thatidstorage);
						setInterval(function(){checkformsgs(chatId)},100);
						$("#support-panel-reply-box").html('<textarea name="msg" id="msg"></textarea><br><button onclick="sendmsg()" class="btn-success">Send</button> <button onclick="closechat()" class="btn-danger">Close</button>');
						$("#support-panel-refnum").html('<div style="display:none;" id="support-panel-chat-num">' + chatId + '</div>');
						var chatid = $('#support-panel-chat-num').html();
						setInterval(function(){keepactive()},1);
					}
				});
		}
		function keepactive() {
				var chatid = $('#support-panel-chat-num').html();
				var tabs = $('#act'+chatid+'').html();
				var thatid = $('#tid').html();
				var othertabs = $('#tab'+thatid).html();
					$('#act'+chatid).addClass('active');
					
		}
		var chatid = $('#support-panel-chat-num').html();
		function assignChatId() {
			var chatid = $('#support-panel-chat-num').html();	
		}
		function checkformsgs() {
			var tryit = 'yes';
				var chatid = $('#support-panel-chat-num').html();
				$.ajax({
					type: "POST",
					url: "../inc/ajax_opfunc_checkmsgs.php",
					data: { 'chatId': chatid },
					success: function(data)
					{
						$("#support-panel-chat-msgs").html('<div id="tab' + chatid + '">' + data + '</div>');
					}
				});
		}
		function sendCustomMessage(messg) {
			var chatid = $('#support-panel-chat-num').html();
			$.ajax({
				type: "POST",
				url: "../inc/ajax_opfunc_post.php",
				data: { 'name': '<?php echo $_SESSION['user']; ?>', 'message': messg, 'chatid': chatid, 'type': 'staff'},
				success: function(msg) {
					//$("#msg").val('');
				}
			});
		}
		function closechat() {
			var chatid = $('#support-panel-chat-num').html();
			$.ajax({
				type: "POST",
				url: "../inc/ajax_opfunc_close.php",
				data: { 'chatId': chatid },
				success: function(msg) {
					$("#support-panel-chat-window").html('');
					$("#support-panel-reply-box").html('');
				}
			});
		}
		setInterval(function(){checkrequests()},500);
		function sendmsg() {
			var chatid = $('#support-panel-chat-num').html();
			$.ajax({
				type: "POST",
				url: "../inc/ajax_opfunc_post.php",
				data: { 'name': '<?php echo $_SESSION['user']; ?>', 'message': $("#msg").val(), 'chatid': chatid, 'type': 'staff'},
				success: function(msg) {
					$("#msg").val('');
				}
			});
		}
	</script>
</body>

</html>

