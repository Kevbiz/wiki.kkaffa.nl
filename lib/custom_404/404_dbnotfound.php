<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Error</title>
	<style>

		body {
			font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
			font-size: 14px;
			line-height: 1.42857143;
			color: #333;
			background-color: #fff;
		}

		#error {
			width:90%;
			margin:auto;
			text-align:center;
			margin-top:10em;
		}

		#error img {
			max-width:90%;
		}

		#error h1 small {
			font-weight:normal;
		}

		/* Let browser defaults do the rest */
	</style>
</head>
<body>
<div id="error">

	<center><img src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/assets/img/gear.png" width=100 alt="Compass"/></center>

	<h1>Oops! Database not found!<br>
		<small>Please wait, someone will fix it <soon></soon></small></h1>

</div>
</body>
</html>

