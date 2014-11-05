<!DOCTYPE html>
<html lang="sv">
	<head>
		<meta charset="UTF-8">
		<title>Jexm || Paginationtest</title>
		<link rel="stylesheet" type="text/css" href="<?php echo Path::asset('css/style.css'); ?>">
	</head>
	<body>
		<h1>Post data</h1>
		<div>
			<form action="<?php echo Path::create('test@cleanStuff'); ?>" method="post">
				<input type="hidden" value="tjoho" name="val" />
				<input type="submit" value="send" />
			</form>
			<p><?php if(isset($links)){ echo $links; }?></p>
			<p>Imma a linkb <?php echo Link::create('test@doRockAndRoll',"cool link with controllerz",["testval" => "someval"]); ?></p>
			<p>Im also a link <?php echo Link::create('/test',"regular link"); ?></p>
			<p>Im a getlink <?php echo Link::create('/test/get',"get link",["testval" => "someval"]); ?></p>
			<h2><?php echo $first; ?></h2>
			<h2><?php echo $second; ?></h2>
			<h2><?php echo $third; ?></h2>
			<img src="<?php echo Path::asset('images/arrow.jpg'); ?>" alt="alt">
		</div>
	</body>
</html>