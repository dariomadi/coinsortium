<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/">Coinsortium</a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li<?php if($_SERVER['PHP_SELF'] == "/securities.php") { echo " class=\"active\"";} ?>><a href="/securities.php">Securities</a></li>
				<li<?php if($_SERVER['PHP_SELF'] == "/contact.php") { echo " class=\"active\"";} ?>><a href="/contact.php">Contact</a></li>
<?php if(!$_SESSION['user']) {  ?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="#">Action</a></li>
						<li><a href="#">Another action</a></li>
						<li><a href="#">Something else here</a></li>
						<li class="divider"></li>
						<li class="dropdown-header">Nav header</li>
						<li><a href="#">Separated link</a></li>
						<li><a href="#">One more separated link</a></li>
					</ul>
				</li>
			</ul>
			<form class="navbar-form navbar-right" role="form" action="/" method="post">
				<div class="form-group">
					<input type="text" placeholder="Username" class="form-control" name="username" value="<?php echo $submitted_username; ?>">
				</div>
				<div class="form-group">
					<input type="password" placeholder="Password" class="form-control" name="password" value="">
				</div>
				<button type="submit" class="btn btn-success" name="login" value="login">Sign in</button>
				<button type="submit" class="btn btn-info" name="register" value="register">Register</button>
			</form>
<?php 
	}else{
?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="/users/settings.php">Settings</a></li>
						<li class="divider"></li>
						<li class="dropdown-header">Nav header</li>
						<li><a href="#">Separated link</a></li>
						<li><a href="#">One more separated link</a></li>
					</ul>
				</li>
			</ul>
			<form class="navbar-form navbar-right" role="form" action="/logout.php" method="post">
				<button type="submit" class="btn btn-info" name="logout">Logout</button>
			</form>
<?php
	}
?>
		</div><!--/.navbar-collapse -->
	</div>
</div>
