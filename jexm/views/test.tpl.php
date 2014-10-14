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
			<p>Imma a link  {{ link.create('test@doRockAndRoll','cool link with controller') | raw }}</p>
			<p>Im also a link {{link.create('/test',"regular link") | raw}}</p>

			<h2>{{first}}</h2>
			<h2>{{second}}</h2>
			<h2>{{third}}</h2>
		</div>
	</body>
</html>