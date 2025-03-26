<?php

// nazte se v sidebaru
class Search {

	use Model;


	public function get_categories() {

		$categories = $this->query("SELECT category_id, count(*) AS pocet_productu FROM product_category RIGHT JOIN sklad ON product_category.product_id=sklad.product_id RIGHT JOIN product_prodej ON sklad.id=sklad_id_sklad GROUP BY category_id");
		show($categories);
		
		foreach($categories as $key => $value) {
			$result = $this->query("SELECT id, category FROM categories WHERE categories.id = :category_id AND categories.disabled = 1 ORDER BY views DESC", ["category_id"=>$value->category_id])[0];
			if(is_object($result)) {
				$data[$key] = $result;
				$data[$key]->pocet_productu = $value->pocet_productu;
			}
			
		}
		show($data);
		
		// $data = $this->query("SELECT id, category FROM categories WHERE disabled = 1 ORDER BY views DESC");

		if(is_array($data)) {
			foreach ($data as $key => $row) {
				# code...
				// echo "<option value='$row->id' ".old_select("category", $row->id, "", 'get').">".$row->category."</option>";
				echo "<option value='$row->id' ".old_select("category", $row->id, "", 'get').">".$row->category." ".$row->pocet_productu."</option>";
			}
		}
	}

	public function get_year() {

		$query= "SELECT id, date FROM products GROUP BY year(date)";
		$data = $this->query($query);

		if(is_array($data)) {
			foreach ($data as $key => $row) {
				# code...
				$datum = date("Y",strtotime($row->date));
				echo "<option ".old_select("year", $datum, "", 'get').">$datum</option>";
			}
		}
	}

	public function get_brand() {

		$query= "SELECT brands.brand, brands.id FROM products JOIN brands ON brands.id=products.brand GROUP BY brands.brand";
		$data = $this->query($query);

		if(is_array($data)) {
			foreach ($data as $key => $row) {
				# code...
				?>
					<div style="display:inline-block;">
						<!-- <input type="checkbox" name="brand_<?=$key?>" value="<?=$row->id?>" class="form-checkbox-input" id="<?=$row->brand?>" <?=old_checked("brand", $row->id)?>> -->
						<input type="checkbox" name="brand[]" value="<?=$row->id?>" class="form-checkbox-input" id="<?=$row->brand?>" <?=old_checked("brand", $row->id)?>>
						&nbsp;<label for="<?=$row->brand?>"><?=$row->brand?>. </label> 
					</div>
					
				<?php
			}
		}
	}


}

