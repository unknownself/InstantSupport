<?php
session_start();
require_once('../inc/config.php');
eval(base64_decode('JGxxdWVyeSA9ICRkYi0+cXVlcnkoJ1NFTEVDVCAqIEZST00gYHNpdGVfc2V0dGluZ3NgIFdIRVJFIGBzZXR0aW5nX25hbWVgPSJsaWNlbnNlX2tleSInKTsNCmZvcmVhY2goJGxxdWVyeSBhcyAkbHJvdykgew0KCSRsaWNlbnNlID0gYmFzZTY0X2VuY29kZSgkbHJvd1snc2V0dGluZ192YWx1ZSddKTsNCgkvLyBERUJVRzogZWNobyAkbGljZW5zZTsNCn0NCiRzciA9IGJhc2U2NF9kZWNvZGUoJ2FIUjBjRG92TDJ4dlkyRnNhRzl6ZEM5c2FXTmxibk5sTDJOb1pXTnJMbkJvY0Q5c2FXTTknKS4nJy5iYXNlNjRfZGVjb2RlKCRsaWNlbnNlKTsNCiRjb250cyA9IGZpbGVfZ2V0X2NvbnRlbnRzKCRzcik7DQppZigkY29udHM9PSdpbnZhbGlkJyB8fCAkY29udHMgPT0gJ3N1c3BlbmRlZCcgfHwgJGNvbnRzID09ICdleHBpcmVkJyB8fCAkY29udHMgPT0gJ3Vua25vd24nKSB7DQoJJGVycm9yc1tdID0gJ0xpY2Vuc2UgaXMgaW52YWxpZC9zdXNwZW5kZWQvZXhwaXJlZC4nOw0KfQ0KZGVmaW5lKCdsaWNfcnVuJywgJ3llcycpOw=='));
error_reporting(0);
if($_SESSION['logged_in']&&!$_SESSION['admin']) {
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
	<?php require_once('tpl/top.php'); ?>

	<div id="main">
		<?php require_once('tpl/nav_left.php'); ?>
		<div id="content">
			<div class="page-header">
				<div class="pull-left">
					<h4><i class="icon-reorder"></i> Chats</h4>
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
								<span>Current chats/requests in progress</span>
							</div>
							<div class="box-body">
								<?php if(!defined('lic_run')) { $errors[] = 'NULLED COPY.'; }
									if(is_array($errors)) {
										foreach($errors as $err => $msg) {
											session_destroy();
											exit('<h1>ERROR!</h1> ' .$msg);
										}
									}
									
										if($_GET['a']=='add') {
											if($_POST['submit']) {
												$name = $_POST['name'];
												$message = $_POST['message'];
											} else {
												?> <h4>Add Canned Reply</h4>
                                                	<form action="?a=add" method="post">
                                                    	Name: <input type='text' name='name' value=''><br>
                                                        Message<br><textarea style="margin-left: 0px; margin-right: 0px; width: 243px;" name="message"></textarea><br>
                                                        <input class="btn btn-info" type="submit" name="submit" value="Add">
                                                    </form>
                                                <?php
											}
										} elseif($_GET['a']=='remove') {
											$id = $_GET['id'];
											if(!isset($id) || empty($id)) {
												echo 'Error. ID not set/empty.';
												exit;
											}
											$db->query('DELETE FROM `canned` WHERE `id`="'.$id.'"');
											echo 'Removed canned reply #'.$id.' successfully.';
										} elseif($_GET['a']=='edit') {
											if($_POST['submit']) {
												$name = htmlspecialchars($_POST['name'], ENT_QUOTES);
												$message = htmlspecialchars($_POST['message'], ENT_QUOTES);
												if(empty($name) || empty($message)) {
													exit('Name/message was left empty.');	
												}
												$id = $_GET['id'];
												$db->query('UPDATE `canned` SET `name`="'.$name.'",`message`="'.$message.'" WHERE `id`="'.$id.'"');
											} else {
												$id = $_GET['id'];
												$query = $db->query('SELECT * FROM `canned` WHERE `id`="'.$id.'"');
												foreach($query as $row) {
													$c = array();
													$c['name'] = $row['name'];
													$c['message'] = $row['message'];
												}
												?> <h4>Edit Canned Reply</h4>
                                                	<form action="?a=edit&id=<?php echo $id; ?>" method="post">
                                                    	Name: <input type='text' name='name' value='<?php echo $c['name']; ?>'><br>
                                                        Message<br><textarea style="margin-left: 0px; margin-right: 0px; width: 243px;" name="message"><?php echo $c['message']; ?></textarea><br>
                                                        <input class="btn btn-info" type="submit" name="submit" value="Add">
                                                    </form>
                                                <?php
											}
										} else {
											echo '<a class="btn" href="?a=add">Add</a><br>';
											$query = $db->query('SELECT * FROM `canned`');
											foreach($query as $row) {
												$id = $row['id'];
												$name = $row['name'];
												echo '<a href="?a=edit&id='.$id.'">'.$name.'</a> <a href="?a=edit&id='.$id.'" class="btn">Edit</a> <a href="?a=remove&id='.$id.'" class="btn">Remove</a><br>';
											}
										}
									?>
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
</body>

</html>

