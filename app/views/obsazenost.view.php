
<?php 
$data["stranka"]="obsazenost";
$this->view("header", $data) ?>

<div class="card border rounded  shadow-sm">
	<div class="card-body text-center  overflow-x-scroll">
	<iframe class="m-0" src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=2&amp;bgcolor=%23F6BF26&amp;ctz=Europe%2FPrague&amp;showCalendars=0&amp;showTz=1&amp;showTabs=1&amp;showPrint=0&amp;showNav=1&amp;mode=WEEK&amp;src=NzIxNTQ0Yjg4ZjUyZDIzNzkwMzEwNDhmZmM4ODgxMDg0ZDNkZmY1NGViYTQ2ZTRkYzgzMmE1ZmU3NGVmMGY1MUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&amp;src=Y3MuY3plY2gjaG9saWRheUBncm91cC52LmNhbGVuZGFyLmdvb2dsZS5jb20&amp;color=%23D81B60&amp;color=%230B8043" style="border: solid 1px #777;" width="100%" height="600" frameborder="0" scrolling="no"></iframe>
	</div>
</div>

<?php $this->view("footer") ?>