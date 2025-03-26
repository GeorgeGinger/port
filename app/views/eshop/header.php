<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $data["page_title"]?> | E-Shopper</title>
    <link href="<?= ASSETS . THEME?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= ASSETS . THEME?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= ASSETS . THEME?>css/prettyPhoto.css" rel="stylesheet">
    <link href="<?= ASSETS . THEME?>css/price-range.css" rel="stylesheet">
    <link href="<?= ASSETS . THEME?>css/animate.css" rel="stylesheet">
	<link href="<?= ASSETS . THEME?>css/main.css" rel="stylesheet">
	<link href="<?= ASSETS . THEME?>css/responsive.css" rel="stylesheet">
	<link href="<?= ASSETS . THEME?>css/my-css.css" rel="stylesheet">
	<link href="<?= ASSETS . THEME?>node_modules/flag-icons/css/flag-icons.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="<?= ASSETS . THEME?>/js/html5shiv.js"></script>
    <script src="<?= ASSETS . THEME?>/js/respond.min.js"></scr=
    <link rel="shortcut icon" href="<?= ASSETS . THEME?>/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= ASSETS . THEME?>/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= ASSETS . THEME?>/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= ASSETS . THEME?>/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?= ASSETS . THEME?>/images/ico/apple-touch-icon-57-precomposed.png">
	-->

</head><!--/head-->
<a href="tel:+"></a>
<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="tel:<?=$phone;?>"><i class="fa fa-phone"></i> <?=$phone;?></a></li>
								<li><a  href="mailto:<?=$email;?>"><i class="fa fa-envelope"></i> <?=$email;?></a></li>
								<?php if(isset($data["user_data"])): ?>
								<li><a href="<?=ROOT?>profile"><i class="fa fa-user"></i> <?=$data["user_data"]->name ?></a></li>
								<?php endif; ?>
								<?php if(isset($data["styles"])): ?>
								<?php foreach($styles as $value): ?>
								<li><a href="<?=ROOT?>home?style=<?=$value->id?>"><?=$value->flag?> <?=$value->style?></a></li>
								<?php endforeach; ?>
								<?php endif; ?>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="<?=$facebook_link;?>" target="blank"><i class="fa fa-facebook"></i></a></li>
								<li><a href="<?=$twiter_link;?>" target="blank"><i class="fa fa-twitter"></i></a></li>
								<li><a href="<?=$linkedin_link;?>" target="blank"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="<?=$google_plus_link;?>" target="blank"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="<?=ROOT?>"><img src="<?= ASSETS . THEME?>/images/home/logo2.png" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								
								<?php if(is_array($data["shop_menu"])):?>
								<?php foreach($data["shop_menu"] as $value):?>

									<?php if(isset($data["user_data"])):?>
										<?php if($value->type == "user_login"):?>
											<li><a href="<?=ROOT.$value->url?>"><i class="<?=$value->class?>"></i> <?= $value->shelf ?></a></li>
										<?php endif; ?>
									<?php else: ?>
										<?php if($value->type == "user_logout"):?>
											<li><a href="<?=ROOT.$value->url?>"><i class="<?=$value->class?>"></i> <?= $value->shelf ?></a></li>
										<?php endif; ?>
									<?php endif; ?>


									<?php if($value->type == "0"): ?> 
									<li><a href="<?=ROOT.$value->url?>"><i class="<?=$value->class?>"></i> <?= $value->shelf ?></a></li>
									<?php endif; ?>

								<?php endforeach; ?>
								<?php endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">

								<?php if(is_array($data["main_menu"])):?>
									<?php foreach($data["main_menu"] as $value):?>
										<li><a href="<?=ROOT.$value->url?>" class="<?= $page_title == ucfirst($value->url) ? "active" : ""; ?>"><?= $value->shelf ?></a></li>
									<?php endforeach; ?>
								<?php endif; ?>

							</ul>
						</div>
					</div>
					<?php if(isset($show_search) && $show_search == true): ?>
					<div class="col-sm-3">
						<form action="">
							<div class="search_box pull-right">
								<input name="find" type="text" placeholder="Search"/>
							</div>
						</form>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

