<!DOCTYPE html>
<html lang="sv">
	<head>
		<meta charset="UTF-8">
		<title>Jexm || QB TEST</title>
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
		<h1>Query builder</h1>
		<div>
			<p><?php if(isset($links)){ echo $links; }?></p>
			<?php var_dump($response); ?>

		</div>
	</body>
</html>