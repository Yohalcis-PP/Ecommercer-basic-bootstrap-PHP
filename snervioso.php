<?php session_start();
error_reporting(0);
$varsession = $_SESSION['usuario'];
include_once 'conexion.php';
?>

<!DOCTYPE html>

<html lang="en">

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

 		<!-- Bootstrap -->
 		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

 		<!-- Slick -->
 		<link type="text/css" rel="stylesheet" href="css/slick.css"/>
 		<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

 		<!-- nouislider -->
 		<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

 		<!-- Font Awesome Icon -->
 		<link rel="stylesheet" href="css/font-awesome.min.css">

 		<!-- Custom stlylesheet -->
 		<link type="text/css" rel="stylesheet" href="css/style.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> TurbaquitoFarma@gmail.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> Frente al Hospital, Arjona, Bolívar</a></li>
					</ul>
					<ul class="header-links pull-right">
					<?php
						if($varsession == 'admin'){echo '<li><a href="insert.php"><i class="fa fa-user-o"></i> Agregar Productos</a></li>';}
						if($varsession == 'mensajeria'){echo '<li><a href="mensajeria.php"><i class="fa fa-user-o"></i> Mensajeria</a></li>';}
						
					?>
						<li><a href="index2.php"><i class="fa fa-user-o"></i> <?php if($varsession == null || $varsession == ''){echo 'Mi cuenta';}else{echo $varsession;}?></a></li>

					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="#" class="logo">
									<img src="./img/logo3.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form>
									<input class="input" placeholder="Buscar aqui">
									<button class="search-btn">>>></button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="index.php">Home</a></li>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->

		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li><a href="index.php">Home</a></li>
							<li><a href="#">Sistema Nervioso</a></li>
							
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->
		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- STORE -->
					<div id="store" class="col-md-9">
						<!-- store top filter -->

						<!-- /store top filter -->

						<!-- store products -->
						<div class="row">

						<?php
								$conectar = $con -> query("SELECT * FROM PRODUCTO WHERE categoria = 'Sistema Nervioso'");
								foreach ($conectar as $variable) {
							
							?>
							
							<!-- product -->
							<div class="col-md-4 col-xs-6">
								<div class="product">
									<div class="product-img">
										<img src="<?php echo"./img/".$variable[1].".jpeg";?>" alt="">
									</div>
									<div class="product-body">
										<p class="product-category"><?php echo $variable[3]; ?></p>
										<h3 class="product-name"><a href="#"><?php echo $variable[0]; ?></a></h3>
										<h4 class="product-price"><?php echo $variable[2]; ?></h4>
										<h4 class="product-price"><?php echo "$".$variable[4]; ?><del></h4>

										<div class="product-btns">
											<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">descripción</span></button>
										</div>
									</div>
									<div class="add-to-cart">
										<button onclick="enviar('<?php echo $variable[1]; ?>')" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Comprar</button>
									</div>
								</div>
							</div>
							<!-- /product -->

							<div class="clearfix visible-sm visible-xs"></div>


							<?php

								}
							?>
						</div>

						
						<!-- /store products -->

						<!-- store bottom filter -->
						<div class="store-filter clearfix">
							<span class="store-qty"></span>
							<ul class="store-pagination">
								<li class="active">1</li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
							</ul>
						</div>
						<!-- /store bottom filter -->
					</div>
					<!-- /STORE -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		
		<!-- FOOTER -->
		<footer id="footer">
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Todos los derechos Reservados.</h3>
				
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->
			<script>

				function enviar(cod){

					location.href="comprar.php?cod="+cod;

				}
			</script>


		<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>

	</body>
</html>
