<!DOCTYPE html>
<html lang="sv">
	<head>
		<meta charset="UTF-8">
		<title>Jexm || Home</title>
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
		<h1>JEXM</h1>
		<p><?php echo(Link::create(URL_ROOT,'Back')); ?></p>
		<p><?php echo Link::breadcrumbs(); ?></p>
	</body>
</html>