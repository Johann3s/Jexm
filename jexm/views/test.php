<!DOCTYPE html>
<html lang="sv">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title>Welcome || Jexm</title>
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
			img{
				display:block;
				margin:0 auto;
				border-radius:10px;
			}
			h2{
				text-align:center;
				color:#FFFFFF;
			}
		</style>
	</head>
	<body>
		<div class="overlay">
			<div class="text-wrap">
				<img src="<?php echo Path::asset('images/logo-jexm.png'); ?>" alt="jexmlogo">
				<h2>You are up and running!!</h2>
			</div>	
		</div>	
	</body>
</html>