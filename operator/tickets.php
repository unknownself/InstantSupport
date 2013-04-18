<?php
session_start();
require_once('../inc/config.php');
error_reporting(0);
if(!$_SESSION['logged_in'] || !$_SESSION['operator']) {
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
					<h4><i class="icon-reorder"></i> Tickets</h4>
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
								<span>All Tickets</span>
							</div>
							<div class="box-body">
								<?php
								$act = $_GET['act'];
								if(isset($act)) {
									if($act=='view') {
										$id = mysql_real_escape_string($_GET['id']);
										if(empty($id) || !isset($id)) {
											echo 'Unknown Ticket ID #.';
											exit;
										}
										$query = $db->query('SELECT * FROM `tickets` WHERE `id`="'.$id.'"');
										if($query->rowCount() != 1) {
											echo 'Ticket does not exist.';
											exit;
										}
										foreach($query as $row) {
											echo '<b><a class="btn">'.$row['subject'].'</a></b><br>'.htmlspecialchars($row['message'], ENT_QUOTES).'<br>';
										}
										$query = $db->query('SELECT * FROM `ticket_messages` WHERE `ticket_id`="'.$id.'"');
										foreach($query as $row) {
											echo '<b><a class="btn">'.$row['name'].'</a></b><br>'.htmlspecialchars($row['message'], ENT_QUOTES).'<br>';
										}
										// Add messages
										?>
                                        <hr><form action="?act=add&id=<?php echo $id; ?>" method="post">
                                        	Message<br><textarea style="margin: 0px 0px 10px; height: 102px; width: 229px;" name="msg"></textarea><br>
                                            <input style="width:229px;" type="submit" name="submit" value="Reply" class="btn-success">
                                        </form>
                                        <?php
									} elseif($act=='add') {
										$id = mysql_real_escape_string($_GET['id']);
										$msg = htmlspecialchars($_POST['msg'], ENT_QUOTES);
										$db->query('INSERT INTO `ticket_messages`(`id`, `ticket_id`, `name`, `message`) VALUES (NULL, "'.$id.'", "'.$_SESSION['user'].'", "'.$msg.'")');
										header('Location: tickets.php?act=view&id='.$id);
									} elseif($act=='close') {
										
									} else {
										header('Location: tickets.php');	
									}
								} else {
									$query = $db->query('SELECT * FROM `tickets` WHERE `status`="Open"');
									echo $query->rowCount().' total tickets.<br>';
									foreach($query as $row) {
										echo '<a href="?act=view&id='.$row['id'].'" class="btn">'.$row['subject'].' - status: '.$row['status'].'</a><br>';	
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

