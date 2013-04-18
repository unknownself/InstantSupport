<div id="navigation">
			<div class="search">
				<i class="icon-search icon-white"></i>
				<form action="#" method="get">
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
					<a href="index.php"><i class="icon-home icon-white"></i><span>Install</span></a>
				</li>
				<?php 
					if($step=='1') {
						echo '<li><a href="#"><i class="icon-home icon-white"></i><span>Step 1 - Complete</span></a>';
					}
				?>
			</ul>
			
			
		</div>