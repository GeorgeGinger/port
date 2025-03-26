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
              	  <h6 class="centered"><?=$data["user_data"]->email?></h6>

                  <li class="sub-menu">
                      <a href="<?=ROOT?>admin/dashboard" >
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="<?=ROOT?>admin/products" class="<?php if(isset($type_active) && $type_active == "products"){echo 'active';}?>">
                        <i class="fa fa-barcode fa-fw"></i>
                        <span>Products</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="<?=ROOT?>admin/sklad" class="<?php if(isset($type_active) && $type_active == "sklad"){echo 'active';}?>">
                        <i class="fa fa-barcode fa-fw"></i>
                        <span>Sklad</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="<?=ROOT?>admin/product_prodej" class="<?php if(isset($type_active) && $type_active == "product_prodej"){echo 'active';}?>">
                        <i class="fa fa-barcode fa-fw"></i>
                        <span>Product_prodej</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="<?=ROOT?>admin/categories" class="<?php if(isset($type_active) && $type_active == "categories"){echo 'active';}?>">
                        <i class="fa fa-list fa-fw"></i>
                        <span>Categories</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="<?=ROOT?>admin/brands" class="<?php if(isset($type_active) && $type_active == "brands"){echo 'active';}?>">
                        <i class="fa fa-list fa-fw"></i>
                        <span>Brands</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="<?=ROOT?>admin/orders" class="<?php if(isset($type_active) && $type_active == "orders"){echo 'active';}?>">
                        <i class="fa fa-reorder fa-fw"></i>
                        <span>Orders</span>
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
                      <a href="<?=ROOT?>admin/vzkazy" class="<?php if(isset($type_active) && $type_active == "vzkazy"){echo 'active';}?>">
                        <i class="fa fa-reorder fa-fw"></i>
                        <span>Sauna</span>
                      </a>
                      <ul class="sub">
                            <li><a class="<?php if(isset($type_active) && $type_active == "vzkazy"){echo 'active';}?>" href="<?=ROOT?>admin/vzkazy">Vzkazy</a></li>
                        </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="<?=ROOT?>admin/settings" class="<?php if(isset($type_active) && $type_active == "settings"){echo 'active';}?>">
                        <i class="fa fa-cogs fa-fw"></i>
                        <span>Settings</span>
                      </a>

                        <ul class="sub">
                            <li><a class="<?php if(isset($page_title) && $page_title == "Admin - Slider"){echo 'active';}?>" href="<?=ROOT?>admin/slider_add/settings">Slider Images</a></li>
                            <li><a class="<?php if(isset($page_title) && $page_title == "Admin - socials"){echo 'active';}?>" href="<?=ROOT?>admin/settings/settings">Social links</a></li>
                            <li><a class="<?php if(isset($page_title) && $page_title == "Admin - Shop_menu"){echo 'active';}?>" href="<?=ROOT?>admin/shop_menu">Shop menu</a></li>
                            <li><a class="<?php if(isset($page_title) && $page_title == "Admin - main_menu"){echo 'active';}?>" href="<?=ROOT?>admin/main_menu">Main menu</a></li>
                            <li><a class="<?php if(isset($page_title) && $page_title == "Admin - footer_menu"){echo 'active';}?>" href="<?=ROOT?>admin/footer_menu">Footer menu</a></li>
                            <li><a class="<?php if(isset($page_title) && $page_title == "Admin - sauna_text"){echo 'active';}?>" href="<?=ROOT?>admin/sauna_text">Sauna text</a></li>
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