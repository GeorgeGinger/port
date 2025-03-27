	
	<footer id="footer"><!--Footer-->
		
		
	</footer><!--/Footer-->
	
	<script>


		const single_productAll = document.querySelectorAll(".js_img_singleproduct");
		const overlay_productAll = document.querySelectorAll(".product-overlay");

		single_productAll.forEach((element)=>{
			// console.log("foreach",element);
			element.addEventListener("mouseenter", overlayDown);
		});
	

		overlay_productAll.forEach((element)=>{
			// console.log("foreach",element);
			element.addEventListener("mouseleave", overlayUp);
		});
		

		function overlayDown(e) {
			// console.log(e.target);

			overlay_productAll.forEach((element)=>{
				element.style.height = 0+"px";
			});
		
			const single_img = e.currentTarget;
			// console.log("single_product",single_product);

			const img_height = single_img.offsetHeight;
			// console.log("img_heght",img_height);

			// nejde ovwrlay k obrazku, parentNode aby vyskocil o dva divi nahoru
			const owerlay = single_img.parentNode.parentNode.querySelector(".product-overlay");

			owerlay.style.height = img_height+"px";
		}
		
		function overlayUp(e) {
			// console.log("up");
			const product = e.currentTarget;
			const owerlay = product.parentNode.parentNode.querySelector(".product-overlay");
			owerlay.style = 0+"px";
		}

	</script>

  
    <script src="<?= ASSETS . THEME ?>js/jquery.js"></script>
	<script src="<?= ASSETS . THEME ?>js/bootstrap.min.js"></script>
	<script src="<?= ASSETS . THEME ?>js/jquery.scrollUp.min.js"></script>
	<script src="<?= ASSETS . THEME ?>js/price-range.js"></script>
    <script src="<?= ASSETS . THEME ?>js/jquery.prettyPhoto.js"></script>
    <script src="<?= ASSETS . THEME ?>js/main.js"></script>
</body>
</html>