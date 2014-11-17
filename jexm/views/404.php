<!DOCTYPE html>
<html lang="sv">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title>404 || Page Not found</title>
		<style>
			*{
				font-family: Tahoma,Verdana;
			}
			html,body,.overlay{
				margin:0;
				position:relative;
				width:100%;
				height:100%;
				min-height:100%;
			}
			body{
				background-image:url('/images/background.jpg');
				background-size:cover;
				background-repeat:no-repeat;
				background-position:center;
				text-align:center;
			}
			.overlay{
				position:absolute;
				width:100%;
				min-height:100%;
				background-color:rgba(0,0,0,0.9);
			}
			.text-wrap{
				display:inline-block;
				padding:40px;
				margin-top:150px;
			}
			h1{
				text-align:center;
				color:#FFFFFF;
				text-shadow: 2px 2px 6px rgba(21, 150, 150, 0.5);
			}
			@media screen and (max-width: 500px) {
				h1{ font-size:24px;}
				.text-wrap{ padding:5px; }
			}
		</style>
	</head>
	<body>
		<div class="overlay">
			<div class="text-wrap">
				<h1>It seems we couldn't find what <br> you were looking for at <?php echo $currentRequest; ?></h1>
			</div>	
		</div>	
	</body>
</html>