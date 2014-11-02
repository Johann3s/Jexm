<!DOCTYPE html>
<html lang="sv">
	<head>
		<meta charset="UTF-8">
		<title>Jexm || JSON</title>
		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script>
		$(document).ready(function(){
		
			function sendAjax(reqMethod,url,dataObj,responseFunc){
				$.ajax({
					type: reqMethod,
					url: url,
					data: dataObj,
					success: function(data){
						return responseFunc(data);
					},
					dataType: "json"
				});   
			}
			
			sendAjax("GET","/json",{test:'test'},function(response){
				console.log(response);
			});
		});
		</script>
	</head>
	<body>
		<h1>Json</h1>
		<div>

		</div>
	</body>
</html>