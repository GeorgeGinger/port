<?php $this->view("admin/header", $data);?>
<?php $this->view("admin_player/sidebar", $data);?>

<!-- <?php show($data) ?> -->

<link rel="stylesheet" type="text/css" href="<?= ASSETS . THEME?>admin/css/zabuto_calendar.css">
   
    <link rel="stylesheet" type="text/css" href="<?= ASSETS . THEME?>admin/lineicons/style.css">   
    <script src="<?= ASSETS . THEME?>admin/js/chart-master/Chart.js"></script>
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!-- main content start -->
      <!-- <section id="main-content">
          <section class="wrapper"> -->

			<div class="row">
				<div class="col-lg-9 main-chart">
					<div class="row mtbox">
                  		<div class="col-md-2 col-sm-2 col-md-offset-1 box0">
                  			<div class="box1">
					  			<span class="li_heart"></span>
					  			<h3><?=$number_of_customers?></h3>
                  			</div>
					  			<p><?=$number_of_customers?> number of customers</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_cloud"></span>
					  			<h3><?=$number_of_orders?></h3>
                  			</div>
					  			<p><?=$number_of_orders?> number of orders.</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_stack"></span>
					  			<h3><?=$number_payments?></h3>
                  			</div>
					  			<p>You have <?=$number_payments?> number of payments.</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_news"></span>
					  			<h3><?=$total_payment?></h3>
                  			</div>
					  			<p>You have <?=$total_payment?> Kč total payments.</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_data"></span>
					  			<h3>OK!</h3>
                  			</div>
					  			<p>Your server is working perfectly. Relax & enjoy.</p>
                  		</div>
                  	
                  	</div><!-- /row mt -->	
				</div>
			</div><!-- /col-lg-9 END SECTION MIDDLE -->
                 
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2014 - Alvarez.is
              <a href="index.html#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?= ASSETS . THEME?>admin/js/jquery.js"></script>
    <script src="<?= ASSETS . THEME?>admin/js/jquery-1.8.3.min.js"></script>
    <script src="<?= ASSETS . THEME?>admin/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="<?= ASSETS . THEME?>admin/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?= ASSETS . THEME?>admin/js/jquery.scrollTo.min.js"></script>
    <script src="<?= ASSETS . THEME?>admin/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="<?= ASSETS . THEME?>admin/js/jquery.sparkline.js"></script>

    


    <!--common script for all pages-->
    <script src="<?= ASSETS . THEME?>admin/js/common-scripts.js"></script>
    
   
    <!--script for this page-->
    <script src="<?= ASSETS . THEME?>admin/js/sparkline-chart.js"></script>    
	<script src="<?= ASSETS . THEME?>admin/js/zabuto_calendar.js"></script>	
	
	
	
	<script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
  

  </body>
</html>
