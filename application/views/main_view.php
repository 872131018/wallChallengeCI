<?php /*
*Need to load the url helper to use base_url
*/ ?>
<?php $this->load->helper('url'); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>The Wall</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="http://www.bootstrap-switch.org/dist/css/bootstrap3/bootstrap-switch.css">
	</head>

	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<h1>Bricks in the Wall!</h1>
				</div>
  				<div class="col-sm-3"></div>
			</div>
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<div id='wallContainer'></div>
				</div>
				<div class="col-sm-2"></div>
			</div>
			<div id='feedback'></div>
			<div id='wallControl'>
				<input type='text' value='' placeholder='Put Name Here!' id='name' class='required'>
				<input type='text' value='' placeholder='Put Email Here!' id='email'>
				<input type='text' value='' placeholder='Put Website Here!' id='website'>
				<input type='textarea' value='' placeholder='Put Comment Here!' id='comment' class='required'>
				<input type='button' id='postButton' value='Add Brick!'>
				<input type="checkbox" id='sortOrder' class="switch" data-label-text="Sort" data-on-text="ASC" data-off-text="DESC" checked/>
			</div>
		</div>
		<?php /*
		*Load the external scripts first!
		*/ ?>
		<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type='text/javascript' src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js'></script>
		<script type='text/javascript' src='http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js'></script>
		<script type='text/javascript' src="http://www.bootstrap-switch.org/dist/js/bootstrap-switch.js"></script>
		<?php /*
		*Load the internal scripts next!
		*/ ?>
		<script type='text/javascript' src='<?php echo base_url();?>js/wallScripts.js'></script>
		<?php /*
		*Load the driver last
		*/ ?>
		<script type='text/javascript' src='<?php echo base_url();?>js/wallDriver.js'></script>
	</body>
</html>
