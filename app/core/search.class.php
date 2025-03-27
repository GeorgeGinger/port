<?php

// nazte se v sidebaru
class Search {

	use Model;


	public function get_categories() {

		
		$query= "SELECT id, category FROM categories WHERE disabled = 1 ORDER BY views DESC";
		$data = $this->query($query);

		if(is_array($data)) {
			foreach ($data as $key => $row) {
				# code...
				echo "<option value='$row->id' ".old_select("category", $row->id, "", 'get').">$row->category</option>";
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

