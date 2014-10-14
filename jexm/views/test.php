<!DOCTYPE html>
<html lang="sv">
	<head>
		<meta charset="UTF-8">
		<title>Jexm || Paginationtest</title>
		<style>
			a{
				display:inline-block;
				margin-right:10px;
			}
			.crumbs-current-url a{
				text-decoration:none;
			}
		</style>
	</head>
	<body>
		<h1>Post data</h1>
		<div>
			<form action="/" method="post">
				<input type="hidden" value="tjoho" name="val" />
				<input type="submit" value="send" />
			</form>
			
			<p>Imma a link <?php echo $this->link->create('test@doRockAndRoll',"cool link with controller"); ?></p>
			<p>Im also a link <?php echo $this->link->create('/test',"regular link"); ?></p>
		</div>
	</body>
</html>