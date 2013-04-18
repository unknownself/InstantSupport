<div id="top"> 
		<div class="container-fluid">
			<div class="pull-left">
				<a href="#" id="brand"><span></span>operator</a>
				<!--<div class="collapse-me">
					<a href="messages.html" class="button">
						<i class="icon-comment icon-white"></i>
						Messages
						<span class="badge badge-important">21</span>
					</a>
					<a href="#" class="button">
						<i class="icon-question-sign icon-white"></i>
						Support tickets
						<span class="badge badge-info">3</span>
					</a>
					<a href="#" class="button">
						<i class="icon-truck icon-white"></i>
						Orders
						<span class="badge badge-default">5</span>
					</a>
				</div>-->
			</div>
			<div class="pull-right">
				<div class="btn-group">
					<a href="#" class="button dropdown-toggle" data-toggle="dropdown"><i class="icon-white icon-user"></i><?php echo $_SESSION['user']; ?><span class="caret"></span></a>
					<div class="dropdown-menu pull-right">
						<div class="right-details">
							<h6>Logged in as</h6>
							<span class="name"><?php echo $_SESSION['user']; ?></span>
							<span class="email">Operator</span>
							<a href="dashboard.php" class="highlighted-link">Need help?</a>
							<ul>
								<li>
									<a href="account.php">Account settings</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<a href="logout.php" class="button">
					<i class="icon-signout"></i>
					Logout
				</a>
			</div>
		</div>
	</div>