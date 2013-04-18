<?php
session_start();
require_once('../inc/config.php');
error_reporting(0);
?>
<!doctype html>
<html>
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no,maximum-scale=1">
	
    <title>Installation</title>

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
					<h4><i class="icon-reorder"></i> Install</h4>
				</div>
				<div class="pull-right">
					<ul class="bread">
						<li class='active'><a href="index.php">Home</a></li>
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
								<?php 
									if(isset($_GET['step'])) {
										$step = $_GET['step'];
										if($step=='1') {
											// Run SQL queries to start db
											$file = file_get_contents('sql.sql');
											$db->query($file);
											$step = 1;
											if(file_exists('installer.lock')) {
												exit('System already installed.');
											}
											$db->query('INSERT INTO `site_settings`(`setting_name`, `setting_value`) VALUES ("license_key","'.$_POST['key'].'")');
											header('Location: index.php?step=2');
											
										}
										if($step=='2') {
											$step = 2;
											if($_POST['submit']) {
											
											if(file_exists('installer.lock')) {
												exit('System has already been installed.');
											}
											$db->query('INSERT INTO `admin`(`id`, `username`, `password`, `full_name`) VALUES (NULL, "'.$_POST['user'].'", "'.md5($_POST['pass']).'", "Administrator")');
											echo 'System installed successfully. <a href="../admin/index.php">View your dashboard</a>';
											$ourFileName = "installer.lock";
											$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
											fclose($ourFileHandle);
										} else {
												?>
                                                <form action="?step=2" method="post">
                                            	Setup Default Administrator Account<br>
                                                Username: <input type='text' name='user' value='admin'><br>
                                                Password: <input type='password' name='pass' value='password'><br>
                                                <input type='submit' class='btn btn-success' name='submit' value='Continue &gt;'>
                                            </form>
                                            <?php
											}
										}
									} else {
										?>
                                        	<form action="?step=1" method="post">
                                            	License key: <input type='text' name='key' value=''><br>
                                                <input class='btn btn-success' name='submit' type='submit' value='Next step &gt;'>
                                            </form>
                                        <?php
										$step = 0;
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

