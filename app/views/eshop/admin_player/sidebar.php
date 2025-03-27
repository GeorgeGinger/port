      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="profile.html"><img src="<?= ASSETS . THEME?>admin_player/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
              	  <h5 class="centered"><?=$data["user_data"]->name?></h5>
              	  <h6 class="centered"><?=isset($data["user_data"]->email) ? $data["user_data"]->email : ""?></h6>

                  <li class="sub-menu">
                      <a href="<?=ROOT?>admin_player/players" class="<?php if(isset($type_active) && $type_active == "players"){echo 'active';}?>">
                        <i class="fa fa-user fa-fw"></i>
                        <span>Players</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="<?=ROOT?>admin_player/players/player" class="<?php if(isset($page_title) && $page_title == "Admin - player"){echo 'active';}?>">Players</a></li>
                          <li><a  href="<?=ROOT?>admin_player/players/admin" class="<?php if(isset($page_title) && $page_title == "Admin - admin"){echo 'active';}?>">Admin</a></li>
                      </ul>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
    
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> <?= ucwords($data['page_title']) ?></h3>
        <div class="row mt">
            <div class="col-lg-12">