<?php
session_start();
require_once('../inc/config.php');
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
					<h4><i class="icon-reorder"></i> My Account</h4>
				</div>
				<div class="pull-right">
					<ul class="bread">
						<li class='active'><a href="dashboard.php">Home</a></li>
					</ul>
				</div>
			</div>
			
			<div class="container-fluid" id="content-area">
				<div class="span12">
						<div class="box">
							<div class="box-head">
								<i class="icon-user"></i>
								<span>User profile (edit)</span>
							</div>
							<div class="box-body box-body-nopadding">
								<?php
									if($_POST['submit']) {
										$fn = mysql_real_escape_string($_POST['fullname']);
										$pw = md5($_POST['pass']);
										if(empty($fn)) {
											echo 'Required file full name was left blank.';	
										}
										if(!empty($pw)) {
											$query = $db->query('UPDATE `admin` SET `password`="'.$pw.'",`full_name`="'.$fn.'" WHERE `username`="'.$_SESSION['user'].'"');
											echo 'Updated settings successfully.';	
										} else {
											$query = $db->query('UPDATE `admin` SET `full_name`="'.$fn.'" WHERE `username`="'.$_SESSION['user'].'"');
											echo 'Updated settings successfully.';	
										}
									} else {
										$query = $db->query('SELECT * FROM `admin` WHERE `username`="'.$_SESSION['user'].'"');	
										foreach($query as $row) {
											?>
                                            <form action="account.php" method="post" class="form-horizontal form-bordered">
									<div class="control-group">
										<label for="textfield" class="control-label">Username</label>
										<div class="controls">
											<span class="uneditable-input"><?php echo $_SESSION['user']; ?></span>
											<span class="help-block">*You cannot change your Username</span>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Avatar</label>
										<div class="controls">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="fileupload-new thumbnail" style="width: 80px; height: 80px;"><img src="http://www.placehold.it/80/EFEFEF/AAAAAA&amp;text=admin"></div>
												<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
												<div>
													<span class="button button-basic btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="button">(disabled)</span>
													<a href="#" class="button button-basic fileupload-exists" data-dismiss="fileupload">Remove</a>
												</div>
											</div>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Full name</label>
										<div class="controls">
											<input type="text" name="fullname" value="<?php echo $row['full_name']; ?>">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Password</label>
										<div class="controls">
											<input type='password' name='password' value='' placeholder=''>
											<span class="help-block">*For security reasons hidden</span>
										</div>
									</div>
									<div class="form-actions">
										<input type="submit"  name="submit"  value="Save changes" class="button button-basic-blue">
									</div>
								</form>
                                <?php	
										}
									}
								?>
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

