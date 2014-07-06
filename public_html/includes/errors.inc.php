<?php
if(isset($error)) { ?>
	<div class="alert alert-danger" role="alert">
		<strong>Oh snap!</strong> <?php echo $error; ?> 
	</div>
<?php }elseif(isset($warning)) { ?>
	<div class="alert alert-warning" role="alert">
		<strong>Warning!</strong> <?php echo $warning; ?> 
	</div>
<?php }elseif(isset($info)) { ?>
	<div class="alert alert-info" role="alert">
		<strong>Heads Up!</strong> <?php echo $info; ?> 
	</div>
<?php }
