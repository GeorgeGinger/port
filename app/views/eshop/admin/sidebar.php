      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="profile.html"><img src="<?= ASSETS . THEME?>admin/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
              	  <h5 class="centered"><?=$data["user_data"]->name?></h5>
              	  <h6 class="centered"><?=isset($data["user_data"]->email) ? $data["user_data"]->email : ""?></h6>

                  <li class="sub-menu">
                      <a href="<?=ROOT?>admin/dashboard" >
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="<?=ROOT?>admin/messages" class="<?php if(isset($type_active) && $type_active == "messages"){echo 'active';}?>">
                        <i class="fa fa-reorder fa-fw"></i>
                        <span>Messages</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="<?=ROOT?>admin/blogs" class="<?php if(isset($type_active) && $type_active == "blogs"){echo 'active';}?>">
                        <i class="fa fa-reorder fa-fw"></i>
                        <span>Blogs</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="<?=ROOT?>admin/settings" class="<?php if(isset($type_active) && $type_active == "settings"){echo 'active';}?>">
                        <i class="fa fa-cogs fa-fw"></i>
                        <span>Settings</span>
                      </a>

                        <ul class="sub">
                            <li><a class="<?php if(isset($page_title) && $page_title == "Admin - socials"){echo 'active';}?>" href="<?=ROOT?>admin/settings/settings">Social links</a></li>
                            <li><a class="<?php if(isset($page_title) && $page_title == "Admin - Shop_menu"){echo 'active';}?>" href="<?=ROOT?>admin/shop_menu">Shop menu</a></li>
                            <li><a class="<?php if(isset($page_title) && $page_title == "Admin - main_menu"){echo 'active';}?>" href="<?=ROOT?>admin/main_menu">Main menu</a></li>
                        </ul>
                     
                  </li>

                  <li class="sub-menu">
                      <a href="<?=ROOT?>admin/users" class="<?php if(isset($type_active) && $type_active == "users"){echo 'active';}?>">
                        <i class="fa fa-user fa-fw"></i>
                        <span>Users</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="<?=ROOT?>admin/users/customer">Customers</a></li>
                          <li><a  href="<?=ROOT?>admin/users/admin">Admins</a></li>
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="<?=ROOT?>admin/players" class="<?php if(isset($type_active) && $type_active == "players"){echo 'active';}?>">
                        <i class="fa fa-user fa-fw"></i>
                        <span>Players</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="<?=ROOT?>admin/players/player" class="<?php if(isset($page_title) && $page_title == "Admin - player"){echo 'active';}?>">Players</a></li>
                          <li><a  href="<?=ROOT?>admin/players/admin"  class="<?php if(isset($page_title) && $page_title == "Admin - admin"){echo 'active';}?>">Admins</a></li>
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="<?=ROOT?>admin/backup" >
                        <i class="fa fa-hdd-o"></i>
                        <span>Website Backup</span>
                      </a>
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