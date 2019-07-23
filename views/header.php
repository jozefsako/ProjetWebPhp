<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8" >
	<title>Projet Web</title>

	<link rel="stylesheet" type="text/css" href="<?php echo PATH_VIEWS ?>css/bootstrap.css">

	<!-- Website CSS style -->
	<link rel="stylesheet" type="text/css" href="<?php echo PATH_VIEWS ?>css/main.css">

	<!-- Website Font style -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

</head>
<body>
	<header>

		<!-- Navigation -->
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
			<div class="container">
				<a class="navbar-brand" href="index.php">Gestion de Coureurs</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarResponsive">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item active">
							<a class="nav-link" href="index.php">Accueil
								<span class="sr-only">(current)</span>
							</a>
						</li>
						<?php if(empty($_SESSION['authenticated'])){ ?>
							<li class="nav-item">
								<a class="nav-link" href="index.php?action=login">Se Connecter</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="index.php?action=login&page=signin">S'inscrire</a>
							</li>
						<?php }else{ ?>
							<li class="nav-item">
								<a class="nav-link" href="index.php?action=login"><?php echo $label ?></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="index.php?action=logout">Déconnexion</a>
							</li>
						<?php }?>
					</ul>
				</div>
			</div>
		</nav>
	</header>
	<br/>
