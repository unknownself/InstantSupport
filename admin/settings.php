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
					<h4><i class="icon-reorder"></i> Settings</h4>
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
                            <div class="span12">
						<div class="box">
							<div class="box-head">
								<i class="icon-table"></i>
								<span>Settings</span>
							</div>
							<div class="box-body box-body-nopadding"><form action="settings.php" METHOD="post">
								<table class="table table-nomargin">
									<thead>
										<tr>
											<th>Setting Name</th>
											<th>Value</th>
										</tr>
									</thead>
									<tbody>
								<?php 
									$query = $db->query('SELECT * FROM site_settings');
									foreach($query as $row) {
										$setting_name = $row['setting_name'];
										$setting_value = $row['setting_value'];
										if($_POST['submit']) {
											$key = mysql_real_escape_string($_POST['license_key']);
											if(empty($key)) {
												echo 'Error updating license key.';
												exit;	
											}
											$query = $db->query('UPDATE `site_settings` SET `setting_value`="'.$key.'" WHERE `setting_name`="license_key"');
											echo 'Updated license key.';
										} else {
											?>
                                            
                                            
										<tr>
											<td><?php echo $row['setting_name']; ?></td>
											<td><input type='text' name='<?php echo $row['setting_name']; ?>' value='<?php echo $row['setting_value']; ?>'> </td>
										</tr>
									
                        
                        <?php	
										}
									}
								?>
                                	<tr>
                                    	<td>&nbsp;</td>
                                        <td><input class='btn' type="submit" name="submit" value="Update setting"></td>
                                    </tr>
                                </tbody>
								</table></form>
								</div>
							</div>
						</div>
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

