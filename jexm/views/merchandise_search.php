<!DOCTYPE html>
<html lang="sv">
	<head>
		<meta charset="UTF-8">
		<title>Jexm || Merch-search</title>
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
		<h1>Search Merchandise</h1>
		<p><?php echo(Link::breadcrumbs()); ?></p>
		<p><?php echo Link::create('merch','Back'); ?></p>
	</body>
</html>