<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title><?=$page_title." | ".WEBSITE_TITLE?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?= ASSETS . THEME?>admin/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="<?= ASSETS . THEME?>admin/font-awesome/css/font-awesome.css" rel="stylesheet" />
   
   
    
   
        
    <!-- Custom styles for this template -->
    <link href="<?= ASSETS . THEME?>admin/css/style.css" rel="stylesheet">
    <link href="<?= ASSETS . THEME?>admin/css/style-responsive.css" rel="stylesheet">
    <link href="<?= ASSETS . THEME?>admin/css/my_css.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
        <div class="header_top"><!--header_top-->
            <div class="header_top_left">
        
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
                </div>
                <!--logo start-->
                <a href="<?=ROOT?>admin" class="logo"><b>ESHOP ADMIN</b></a>
                <!--logo end-->
            </div>

            <div class="header_top_midle"><!--header_top_midle-->
                <div class="pagination-area">
                    <?php Page::show_links(4)?>
                </div>

                        <form action="">
                            <div class="search_box pull-right">
                                <input name="description" type="text" placeholder="Search"/>
                            </div>
                        </form>
             </div>

                <div class="header_top_right">
                    <div class="top-menu">
                        <ul class="nav pull-right top-menu">
                            <li><a class="logout" href="<?=ROOT?>logout">Logout</a></li>
                            <li><a class="logout" href="<?=ROOT?>" target="_blank">Website</a></li>
                        </ul>
                    </div>
                    <!-- header_top_right end -->
                </div>
                <!-- header_top end -->
            </div>

        
       
        </header>
      <!--header end-->
