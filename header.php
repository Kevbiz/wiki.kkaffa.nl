<?php
require_once $_SERVER['DOCUMENT_ROOT']. '/load.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Wikie</title>

	<!-- Bootstrap -->
	<link href="<?php $_SERVER['DOCUMENT_ROOT']  ?>/assets/flatly/css/bootstrap.css" rel="stylesheet">
    <link href="<?php $_SERVER['DOCUMENT_ROOT']  ?>/assets/custom/css/custom.css?time=<?php echo time();?>" rel="stylesheet">

    <!-- Summernote -->
    <link href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/assets/custom/css/summernote.css?time=<?php echo time();?>" rel="stylesheet">

    <!-- Bootstrap alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

</head>
<body>

<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Wiki</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-left">
				<li><a href="/">Home</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
                <?php if(!isset($_SESSION['user_session'])){?>
                <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a></li>
                <?php } else { ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $user_details->user_name ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header">Wiki Instellingen</li>
                        <li><a href="#" data-toggle="modal" data-target="#new-cat-modal">New Categorie</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#new-sub-cat-modal">New Subcategorie</a></li>
                        <li><a href="/new_article">New Artikel</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">User Instellingen</li>
                        <li><a href="/logout">Logout</a></li>
                    </ul>
                </li>
                <?php } ?>
			</ul>
			<form class="navbar-form navbar-right" id="searchform">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search..." id="searchfield" name="search" autocomplete="off">
                    </div>
                </div>
			</form>
		</div>
	</div>
</nav>

