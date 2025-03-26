<?php
$data["stranka"] = "home";
$this->view("header", $data) ?>

<div class="container text-center px-1">
	
<div class="mb-3">
		<a href="<?= ROOT ?>/obsazenost" class="btn btn-outline-warning mb-1"><b>Obsazenost</b></a>
		<a href="<?= ROOT ?>/sluzby?pravidelnaSauna" class="btn btn-outline-dark mb-1"><b>Pravidelná Sauna</b></a>
		<a href="<?= ROOT ?>/sluzby?privatniSauna" class="btn btn-outline-dark mb-1"><b>Privátní Sauna</b></a>
		<a href="<?= ROOT ?>/sluzby?saunovaniDeti" class="btn btn-outline-dark mb-1"><b>Saunování dětí</b></a>
		<a href="<?= ROOT ?>/sluzby?masaze" class="btn btn-outline-dark mb-1"><b>Masáže</b></a>
</div>

	<div class="d-lg-flex justify-content-center">

	<?php $this->view("poukazy", $data) ?>

		<div class="card border rounded mb-4 mx-1 shadow-sm col-lg-6">
			<div class="card-body text-center py-4">
				<h3 class="card-title">OTEVÍRACÍ DOBA</h3>
				<div class="d-flex justify-content-center">
					<table>
						<tbody>
							<tr>
								<th colspan="3">
									<p><span style="color: #ba372a; font-size: 18pt;">Pravidelné saunování od <span
												style="color: #e03e2d;">září</span> do <span
												style="color: #e03e2d;">května</span></span></p>
								</th>
							</tr>
							<tr>
								<td>PO</td>
								<td>
									<p>SPOLEČNÁ</p>
								</td>
								<td>
									<p>16:00 – 21:00</p>
								</td>
							</tr>
							<tr>
								<td>ÚT</td>
								<td>DĚTSKÁ SAUNA</td>
								<td>15:00 – 16:30</td>
							</tr>
							<tr>
								<td></td>
								<td>DÁMSKÁ SAUNA</td>
								<td>17:00 – 21:00</td>
							</tr>
							<tr>
								<td>ST</td>
								<td>
									<p>----</p>
								</td>
								<td>
									<p>----</p>
								</td>
							</tr>
							<tr>
								<td>ČT</td>
								<td>
									<p>SPOLEČNÁ</p>
								</td>
								<td>
									<p>16:00 – 21:00</p>
								</td>
							</tr>
							<tr>
								<td>PÁ</td>
								<td>
									<p>----</p>
								</td>
								<td>
									<p>----</p>
								</td>
							</tr>
							<tr>
								<td>SO</td>
								<td>
									<p>----</p>
								</td>
								<td>
									<p>----</p>
								</td>
							</tr>
							<tr>
								<td>NE</td>
								<td>
									<p>----</p>
								</td>
								<td>
									<p>----</p>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->view("footer") ?>