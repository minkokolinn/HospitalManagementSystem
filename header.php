<?php
session_start();
include('connect.php');

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="description" content="Orbitor,business,company,agency,modern,bootstrap4,tech,software">
	<meta name="author" content="themefisher.com">

	<title>Novena- Health & Care Medical template</title>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />

	<!-- bootstrap.min css -->
	<link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
	<!-- Icon Font Css -->
	<link rel="stylesheet" href="plugins/icofont/icofont.min.css">
	<!-- Slick Slider  CSS -->
	<link rel="stylesheet" href="plugins/slick-carousel/slick/slick.css">
	<link rel="stylesheet" href="plugins/slick-carousel/slick/slick-theme.css">

	<!-- Main Stylesheet -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="fixingnavbar.css">

	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
</head>

<body id="top">

	<header id="site-header" class="bg-white">
		<div class="header-top-bar" style="height: 40px;">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-6">
						<ul class="top-bar-info list-inline-item pl-0 mb-0">
							<li class="list-inline-item"><a href="mailto:ml3914j@gre.ac.uk"><i class="icofont-support-faq mr-2"></i>ml3914j@gre.ac.uk</a></li>
							<li class="list-inline-item"><i class="icofont-location-pin mr-2"></i>Address No.(201), Pyay Road, Dagon </li>
						</ul>
					</div>
					<div class="col-lg-6">
						<div class="text-lg-right top-right-bar mt-2 mt-lg-0">
							<a href="tel:+23-345-67890">
								<span>Call Now : </span>
								<span class="h4">(+95) 837837328</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<nav class="navbar navbar-expand-lg navigation" id="navbar">
			<div class="container">
				<a class="navbar-brand" href="index.html">
					<div class="row d-flex align-items-center">
						<img src="images/sitelogo.png" alt="" width="10%" style="margin-top: -15px;" class="mx-2">
						<h3 style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">Royal Moke Ta Ma</h3>
					</div>
				</a>

				<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
					<span class="icofont-navigation-menu"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarmain">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item active">
							<a class="nav-link" href="index.php">Home</a>
						</li>
						<li class="nav-item"><a class="nav-link" href="service.php">Services</a></li>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="department.html" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Room <i class="icofont-thin-down"></i></a>
							<ul class="dropdown-menu" aria-labelledby="dropdown02">
								<li><a class="dropdown-item" href="roomtype.php">Room Type(Rate)</a></li>
								<li><a class="dropdown-item" href="bookroom.php">Book Room</a></li>
							</ul>
						</li>

						<li class="nav-item"><a class="nav-link" href="medicine.php">Medicine</a></li>
						<li class="nav-item"><a class="nav-link" href="article.php">Article</a></li>

						<?php
						if (isset($_SESSION['uid'])) {
							$userIdLoginned = $_SESSION['uid'];
							$selectname = "SELECT userName from user where userId=$userIdLoginned";
							$runselectname = $connection->query($selectname);
							$userNameLoginned = "";
							if ($runselectname->num_rows == 1) {
								$dataofuser = $runselectname->fetch_array(MYSQLI_BOTH);
								$userNameLoginned = $dataofuser['userName'];
							}
							if (isset($_SESSION['cart'])) {
								$countofcart = sizeof($_SESSION['cart']);
								echo "<li class='nav-item mr-4'><div style='position:relative;'><a class='nav-link' href='cart.php'><i class='icofont-shopping-cart' style='font-size:26px; color:#223A66;'></i><span class='badge badge-pill badge-success' style='position:absolute; top:1px; right:3px;'>$countofcart</span></a></div></li>";
							} else {
								echo "<li class='nav-item mr-4'><div style='position:relative;'><a class='nav-link' href='cart.php'><i class='icofont-shopping-cart' style='font-size:26px; color:#223A66;'></i></a></div></li>";
							}
							echo "
								<li class='nav-item dropdown'>
								<a class='nav-link dropdown-toggle btn-main btn-round-full text-white' href='blog-sidebar.html' id='setting' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>$userNameLoginned <i class='icofont-thin-down'></i></a>
								<ul class='dropdown-menu' aria-labelledby='setting'>
									<li><a class='dropdown-item' href='profile.php'>Profile</a></li>
									<li><a class='dropdown-item' href='testimonial.php'>Testimonial</a></li>
									<li><a class='dropdown-item' href='logout.php'>Logout</a></li>
								</ul>
								</li>
								";
						} else {
							echo "<li class='nav-item'><a class='nav-link' href='login.php'>Login</a></li>";
						}
						?>
						<li class='nav-item mr-4'><a class='nav-link' href='finddoctor.php'><i class='icofont-doctor' style='font-size:26px; color:#223A66;'></i></a></li>
					</ul>
				</div>
			</div>
		</nav>
	</header>