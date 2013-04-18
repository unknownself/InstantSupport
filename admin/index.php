<?php 
session_start();
require_once('../inc/config.php');
eval(base64_decode('JGxxdWVyeSA9ICRkYi0+cXVlcnkoJ1NFTEVDVCAqIEZST00gYHNpdGVfc2V0dGluZ3NgIFdIRVJFIGBzZXR0aW5nX25hbWVgPSJsaWNlbnNlX2tleSInKTsNCmZvcmVhY2goJGxxdWVyeSBhcyAkbHJvdykgew0KCSRsaWNlbnNlID0gYmFzZTY0X2VuY29kZSgkbHJvd1snc2V0dGluZ192YWx1ZSddKTsNCgkvLyBERUJVRzogZWNobyAkbGljZW5zZTsNCn0NCiRzciA9IGJhc2U2NF9kZWNvZGUoJ2FIUjBjRG92TDJOb1pXRjBZbkp2TG5neE1DNXRlQzl1YjJNdlkyaGxZMnN1Y0dod1AyeHBZejA9JykuJycuYmFzZTY0X2RlY29kZSgkbGljZW5zZSk7DQokY29udHMgPSBmaWxlX2dldF9jb250ZW50cygkc3IpOw0KaWYoJGNvbnRzPT0naW52YWxpZCcgfHwgJGNvbnRzID09ICdzdXNwZW5kZWQnIHx8ICRjb250cyA9PSAnZXhwaXJlZCcgfHwgJGNvbnRzID09ICd1bmtub3duJykgew0KCSRlcnJvcnNbXSA9ICdMaWNlbnNlIGlzIGludmFsaWQvc3VzcGVuZGVkL2V4cGlyZWQuJzsNCn0NCmRlZmluZSgnbGljX3J1bicsICd5ZXMnKTs='));
error_reporting(0);
if($_SESSION['logged_in']&&$_SESSION['admin']) {
	header('Location: dashboard.php');	
}
if($_SESSION['logged_in']&&!$_SESSION['admin']) {
	header('Location: ../index.php');	
}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>Admin Login</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
	<!-- Theme CSS -->
	<!--[if !IE]> -->
	<link rel="stylesheet" href="css/style.css">
	<!-- <![endif]-->
	<!--[if IE]>
	<link rel="stylesheet" href="css/style_ie.css">
	<![endif]-->

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>

	<!-- Just for demonstration -->
	<script src="js/demonstration.min.js"></script>
	<!-- Theme scripts -->
	<script src="js/application.min.js"></script>

</head>
<body class='login-body'>
	<div class="login-wrap">
		<h2>Admin Login</h2>
		<div class="login">
			<?php  if(!defined('lic_run')) { $errors[] = 'NULLED COPY.'; }
				if($_POST['submit']) {
					$user = mysql_real_escape_string($_POST['user']);
					$pass = md5($_POST['password']);
					if(empty($pass) || empty($user)) {
						echo 'Error: Username or password is empty.';
						exit;	
					}
					$query = $db->query('SELECT * FROM admin WHERE `username`="'.$user.'"');
					if($query->rowCount() == 0) {
						echo 'Username not found.';
						exit;	
					}
					foreach($query as $row) {
						if($row['username']==$user&&$row['password']==$pass) {
							$_SESSION['logged_in']='yes';
							$_SESSION['user']=$user;
							$_SESSION['admin']='yes';
							echo '<b>Logged in. <a href="dashboard.php">Dashboard</a></b>';	
						} else {
							header('Location: index.php');
						}
					}
				} else {
					if(is_array($errors)) {
						foreach($errors as $err => $msg) {
							session_destroy();
							exit('<h1>ERROR!</h1> ' .$msg);
						}
					}
					?><form action="index.php" method="POST">
				<a href="#" class='button button-basic-blue button-less-round'>Connect with <span>Facebook</span> (disabled)</a>
				<a href="#" class='button button-basic-blue button-less-round button-twitter'>Connect with <span>Twitter</span> (disabled)</a>
				<div class="sep">or</div>
				<div class="email"><input type="text" name="user" placeholder="username" class='input-block-level'></div>
				<div class="pw">
					<input type="password" name="password" placeholder="Password" class='input-block-level'>
				</div>
				<input type="submit" name="submit" value="Sign In" class='button button-basic-darkblue btn-block'>
			</form><?php	
				}
			?>
		</div>
		<a href="#" class='pw-link'>Forgot your <span>password</span>? <i class="icon-arrow-right"></i></a>
	</div>
</body>

</html>