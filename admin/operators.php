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
					<h4><i class="icon-reorder"></i> Operators</h4>
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
								<span>Operators</span>
							</div>
							<div class="box-body">
								<?php
									$action = $_GET['action'];
									if(isset($action)) {
										if($action=='add') {
											if($_POST['submit']) {
												$user = mysql_real_escape_string($_POST['username']);
												$pass = md5($_POST['password']);
												$fn = mysql_real_escape_string($_POST['fn']);
												$rank = $_POST['rank'];
												if($rank=='Level 1(operator)') { $rank = '1'; } elseif($rank=='Level 2(manager)') { $rank = '2'; } else { $rank = '1'; }
												// Is any fields empty?
												if(empty($user) || empty($pass) || empty($fn) || empty($rank)) {
													echo 'One or more field(s) were left blank.';
													exit;	
												}
												// assumes its all there, lets add it
												$db->query('INSERT INTO `operators`(`id`, `username`, `password`, `full_name`, `level`, `status`) VALUES (NULL,"'.$user.'","'.$pass.'","'.$fn.'","'.$rank.'","offline")');
												echo 'Added operator successfully.';
											} else {
												echo '<form action="?action=add" method="post">';	
													?>
                                                    	Username: <input type='text' name='username' value=''><br>
                                                        Password: <input type='password' name='password' value=''><br>
                                                        Full Name: <input type='text' name='fn' value=''><br>
                                                        Rank/Level: <select name='rank'><option>Level 1(operator)</option><option>Level 2(manager)</option></select><br>
                                                        <input class='btn' type='submit' name='submit' value='Save changes'>
                                                    <?php
													echo '</form>';
											}
										} elseif($action=='remove') {
											$who = mysql_real_escape_string($_GET['who']);
											echo 'Removed operator successfully.';
											$db->query('DELETE FROM `operators` WHERE `username`="'.$who.'"');
										} elseif($action=='edit') {
											$who = mysql_real_escape_string($_GET['who']);
											$query = $db->query('SELECT * FROM `operators` WHERE `username`="'.$who.'"');
											if($_POST['submit']) {
												$user = mysql_real_escape_string($_POST['username']);
												$pass = md5($_POST['password']);
												$full = mysql_real_escape_string($_POST['fn']);
												if(empty($user) || empty($full)) {
													echo 'Username/full name is empty.';
													exit;	
												}
												if(!empty($pass)) {
													$rank = $_POST['rank'];
													if($rank=='Level 1(operator)') { $rank = '1'; } elseif($rank=='Level 2(manager)') { $rank = '2'; } else { $rank = '1'; }
													$db->query('UPDATE `operators` SET `username`="'.$user.'",`password`="'.$pass.'",`full_name`="'.$full.'",`level`="'.$rank.'" WHERE `username`="'.$who.'"');
													echo 'Updated operator successfully.';
												} else {
													$rank = $_POST['rank'];
													if($rank=='Level 1(operator)') { $rank = '1'; } elseif($rank=='Level 2(manager)') { $rank = '2'; } else { $rank = '1'; }
													$db->query('UPDATE `operators` SET `username`="'.$user.'",`full_name`="'.$full.'",`level`="'.$rank.'" WHERE `username`="'.$who.'"');
													echo 'Updated operator successfully.';
												}
											} else {
												foreach($query as $row) {
													echo '<form action="?action=edit&who='.$who.'" method="post">';	
													?>
                                                    	Username: <input type='text' name='username' value='<?php echo $row['username']; ?>'><br>
                                                        Password: <input type='password' name='password' value=''><br>
                                                        Full Name: <input type='text' name='fn' value='<?php echo $row['full_name']; ?>'><br>
                                                        Rank/Level: <select name='rank'><option>Level 1(operator)</option><option>Level 2(manager)</option></select><br>
                                                        <input class='btn' type='submit' name='submit' value='Save changes'>
                                                    <?php
													echo '</form>';
												}
											}
											
										} else {
											header('Location: operators.php');	
										}
									} else {
										?>
                                        	<div class="span12">
						<div class="box">
							<div class="box-head">
								<i class="icon-table"></i>
								<span>Operator List</span>
							</div>
							<div class="box-body box-body-nopadding">
								<table class="table table-nomargin">
									<thead>
										<tr>
											<th>Operator Name</th>
											<th>&nbsp;</th>
										</tr>
									</thead>
									<tbody>
                                    	<tr>
                                        	<td>&nbsp;</td>
                                            <td><a href='?action=add' class='btn'>Add Operator</a></td>
                                        </tr>
										<?php
											$query = $db->query('SELECT * FROM `operators`');
											foreach($query as $row) {
												?>
                                                <tr>
											<td><?php echo $row['username']; ?></td>
											<td><a href='?action=edit&who=<?php echo $row['username']; ?>' class='btn'>Edit</a> <a href='?action=remove&who=<?php echo $row['username']; ?>' class='btn'>Remove</a></td>
											</tr>
                                                <?php	
											}
										?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
                                        <?php	
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

