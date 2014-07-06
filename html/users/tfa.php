<?php
	require("../../lib/autoload.php");
	require($html_root."includes/users/secure.inc.php");
	require($html_root."includes/users/tfa.inc.php");
	require($html_root."includes/head.inc.php");
?>
<body>
	<?php require($html_root."includes/nav.inc.php");?>

<!-- Main jumbotron for a primary marketing message or call to action -->
	<div class="jumbotron">
		<div class="container">
			<?php require($html_root."includes/errors.inc.php");?>
			<h1>Two Factor Authentication</h1>
			<form class="form-horizontal" action="/users/tfa.php" method="post">
				<fieldset>

					<!-- Form Name -->
					<legend>Please provide your OTP</legend>

					<!-- Text input-->
					<div class="control-group">
						<label class="control-label" for="otp"></label>
						<div class="controls">
							<input id="otp" name="otp" type="text" placeholder="One Time Passcode" class="input-xlarge" required="">

						</div>
					</div>

					<!-- Button -->
					<div class="control-group">
						<label class="control-label" for="submit"></label>
						<div class="controls">
							<button id="submit" name="submit" class="btn btn-primary">Go!</button>
						</div>
					</div>

				</fieldset>
			</form>
		</div>
	</div>

	<div class="container">

	<?php require($html_root."includes/footer.inc.php");?>
	</div> <!-- /container -->


	<?php require($html_root."includes/js.inc.php");?>
</body>
</html>
