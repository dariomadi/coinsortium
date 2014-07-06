<?php
	require("../../lib/autoload.php");
	require($html_root."includes/users/secure.inc.php");
	require($html_root."includes/users/account.inc.php");
	require($html_root."includes/head.inc.php");
?>
<body>
	<?php require($html_root."includes/nav.inc.php");?>

<!-- Main jumbotron for a primary marketing message or call to action -->
	<div class="jumbotron">
		<div class="container">
			<?php require($html_root."includes/errors.inc.php");?>
			<h1>My Account</h1>
			<form class="form-horizontal" autocomplete="off">
				<fieldset>

					<!-- Text input-->
					<div class="control-group">
						<label class="control-label" for="userid">Username</label>
						<div class="controls">
							<input id="userid" name="userid" type="text" placeholder="<?php echo $_SESSION['user']['username']; ?>" class="input-xlarge" disabled>
						</div>
					</div>

					<!-- Text input-->
					<div class="control-group">
						<label class="control-label" for="email">Email Address</label>
						<div class="controls">
							<input id="email" name="email" type="text" placeholder="<?php echo $_SESSION['user']['email']; ?>" class="input-xlarge" value="">
							<p class="help-block">Leave blank if you do not want to change this</p>
						</div>
					</div>

					<!-- Password input-->
					<div class="control-group">
						<label class="control-label" for="password1">Password</label>
						<div class="controls">
							<input id="password1" name="password1" type="password" placeholder="Password" class="input-xlarge" value="">

						</div>
					</div>

					<!-- Password input-->
					<div class="control-group">
						<label class="control-label" for="password2">Confirm</label>
						<div class="controls">
							<input id="password2" name="password2" type="password" placeholder="Password" class="input-xlarge" value="">
							<p class="help-block">Leave blank if you do not want to change this</p>
						</div>
					</div>

					<!-- Text input-->
					<div class="control-group">
						<label class="control-label" for="btcDepositAddress">Deposit Address</label>
						<div class="controls">
							<input id="btcDepositAddress" name="btcDepositAddress" type="text" placeholder="<?php echo $_SESSION['user']['btcDepositAddress']; ?>" class="input-xlarge" value="">
						</div>
					</div>

					<!-- Text input-->
					<div class="control-group">
						<label class="control-label" for="btcWithdrawAddress">Withdraw Address</label>
						<div class="controls">
							<input id="btcWithdrawAddress" name="btcWithdrawAddress" type="text" placeholder="<?php echo $_SESSION['user']['btcWithdrawAddress']; ?>" class="input-xlarge" value="">
						</div>
					</div>

					<!-- Select Basic -->
					<div class="control-group">
						<label class="control-label" for="gaEnabled">Google Authenticator</label>
						<div class="controls">
							<select id="gaEnabled" name="gaEnabled" value="gaEnabled" class="input-xlarge">
							<?php if($_SESSION['user']['gaEnabled']){?>
								<option>Enabled</option>
								<option>Disabled</option>
							<?php }else{?>
								<option>Disabled</option>
								<option>Enabled</option>
							<?php }?>
							</select>
						</div>
					</div>

					<!-- Text input-->
					<?php if($_SESSION['user']['gaEnabled']){?>
					<div id="showGA" class="control-group">
						<small>Google Authenticator is enabled.</small>
						<label class="control-label" for="gaKey">OTP</label>
						<div class="controls">
							<input id="gaKey" name="gaKey" type="text" placeholder="" class="input-xlarge" value="">
						</div>
					<?php }else{?>
					<div id="showGA" class="control-group" style="display: none;">
						<label class="control-label" for="gaKey">Install Key\QR</label>
						<div class="controls">
							<?php echo $gaCodes; ?>
						</div>
						<label class="control-label" for="gaKey">OTP</label>
						<div class="controls">
							<input id="gaKey" name="gaKey" type="text" placeholder="" class="input-xlarge" value="">
						</div>
					<?php }?>
					</div>

					<!-- Button (Double) -->
					<div class="control-group">
						<label class="control-label" for="submit"></label>
						<div class="controls">
							<button id="submit" name="submit" class="btn btn-success">Submit</button>
							<button id="clear" name="clear" class="btn btn-warning">Clear</button>
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
	<script>
		$(function() {
			var inputToHide = $("#showGA");
			$('#gaEnabled').on('change', function() {
				var selected = $('#gaEnabled option:selected').val();
				if ( selected === "Enabled" ) {
					inputToHide.show();
				} else {
					inputToHide.hide();             
				}
			});
		});
	</script>
</body>
</html>
