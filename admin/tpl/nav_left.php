<div id="navigation">
			<div class="search">
				<i class="icon-search icon-white"></i>
				<form action="dashboard.php" method="get">
					<input type="text" placeholder="Search here" />
				</form>
				<div class="dropdown">
					<a href="#" class='search-settings dropdown-toggle' data-toggle="dropdown"><i class="icon-cog icon-white"></i></a>
					<ul class="dropdown-menu">
						<li class='sort-by'>
							Sort by <span class='filter'>Categories</span> <span class="order">A-Z</span>
						</li>
						<li class="heading">
							Filter categories
						</li>
						<li class='filter active'>
							Categories
						</li>
						<li class="filter">
							Countries
						</li>
						<li class="filter">
							Likes
						</li>
						<li class="heading">
							Sorting order
						</li>
						<li class='order active'>
							Ascending
						</li>
						<li class="order">
							Descending
						</li>
					</ul>
				</div>
			</div>

			<ul class="mainNav" data-open-subnavs="multi">
				<li>
					<a href="dashboard.php"><i class="icon-home icon-white"></i><span>Dashboard</span></a>
				</li>
				<li>
					<a href="#"><i class="icon-edit icon-white"></i><span>Settings</span><span class="label">4</span></a>
					<ul class="subnav">
						<li>
							<a href="settings.php">Site Settings</a>
						</li>
						<li>
							<a href="account.php">My Account</a>
						</li>
						<li>
							<a href="operators.php">Operators</a>
						</li>
                        <li>
                        	<a href="canned.php">Canned replys</a>
                        </li>
					</ul>
				</li>
				<li>
					<a href="#"><i class="icon-th-large icon-white"></i><span>Chats</span><span class="label">2</span></a>
					<ul class="subnav">
						<li>
							<a href="chats.php">Current Chats</a>
						</li>
						<li>
							<a href="logs.php">Operator logs</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="tickets.php"><i class="icon-th-list icon-white"></i><span>Tickets</span></a>
				</li>
			</ul>
			
			
		</div>