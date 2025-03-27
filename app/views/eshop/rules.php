<?php $this->view("header", $data);?>

	<section>
		<div class="container">
			<div class="row">

				<div class="col-sm-8 col-sm-offset-2">
					<div class="blog-post-area">
						<h2 class="title text-center">Rules of the Game</h2>

						<p>
							Hra je vhodná pro skupinu osob pobývající ve společném prostoru (horská chata, hotel, internát, tábor). Teoreticky stačí jen jeden telefon propřístup k internetu.
							 Vytvořit hru a každý hráč si musí v této hře vytvořit postavu. Poté aplikace vylosuje každému hráči jeho oběť. Dále už nemusíte telefon používat.
							 Vrah zabije svojí objěť v okamžiku kdy je s ní o samotě a položí jí ruku na rameno a zdělí jí že je zabita. Oběť se nesní bránít ani utíkat. Oběť zdělí vrahovy jméno 
							 oběti kterou měla zabít a tak má vrah svou další oběť. Vše se drží v tajnosti. Zabití lze zaznamenat do aplikace jak je popsáno níže.
						</p>

						<p>
							Tato <ins>aplikace řeší rozlosování hráčů</ins> tak aby oběti na sebe navazovaly a na konci hry zůstali pouze dva vrazi, kteří se mají zabít navzájem.
						</p>
						<p>
							Na začátku hry dostane každý hráč jméno osoby kterou musí zavraždit. Dále může hra probýhat i bez ní.
						</p>

						<p>
							<ins>Vražda</ins> musí proběhnout pouze pokud je vrah s obětí o samotě. Vrah položí oběti ruku na rameno a zdělí jí, že je zabita.
						</p>

						<p>
							<ins>Oběť zdělí vrahovi jméno hráče kterého měla zabít.</ins> Stejné jméno by mu měla předat i aplikace pokud klikne na TO KILL v tabucle VICTIM. Tento hráč se stává novou obětí pro vraha.
						</p>

						<p>
							Vše se opakuje dokud se nepotkaji dva hráči co se mají zabít navzájem.
						</p>

						<ol>
							<li>
								Vytvořte hru. tzn. Klikněte na <button class="btn btn-xs">Login</button>  pak na <button class="btn btn-success btn-xs">Start new game</button> a vyplňte název hry a přístupové heslo
							</li>
							<li>
							<button class="btn btn-xs">Login</button> a přihlaste se do vámi vytvořené hry.
							</li>
							<li>
								<p>
									Vytvoření Vaší postavy <button class="btn btn-xs">Login player</button> <button class="btn btn-success btn-xs">New Killer</button> zadejte jméno podle ktereho vás ostatní poznají a hesla <button class="btn btn-warning btn-xs">Signup</button>.
								</p>
								<p>
									První vytvořená postava bude <mark>admin.</mark>
								</p>
								Admin může:
									<ul>
										<li>
											<ins>Zamíchat</ins> hráče a spustit tak novou hru.
										</li>
										<li>
											V sekci Admin_Player <ins>vymazat, zabit nebo oživit</ins> jakéhokoliv hráče.
										</li>
										<li>
											<ins>Předat admina</ins> jinému hráči tak, že klikne na ikonku tušky u hráče a změní jeho rank z player na admin.
										</li>
									</ul>
							</li>
							<li>
								Poté se přihlašte v <button class="btn btn-xs">Login_player</button>.
							</li>
							<li>
								Ostani hráči se také prihlasi ho hry s použitím přihlašovačích údajů z bodu 1 a vytvoří si vlastní postavu jako v bodě 3.
							</li>
							<li>
								V Home jsou zobrazeny 4 tabulky
								<ol>
									<li>
										<ins>Killer</ins> jste Vy jako přihlášený hráč.
									</li>
									<li>
										<ins>Victim</ins> je jméno vaší objeti, kterou máte zabít. Zabití provedete jak bylo popsáno výše. Potvrzení zabití provedete kliknutím na <button class="btn btn-success btn-xs">TO KILL</button> u jména objeti. Poté co provedete zabití se Vám zobrazí další oběť.
									</li>
									<li>
											<ins>Tabulka players</ins> zobrazuje přehled hráčů bez jmen v náhodném pořadí jak bylo vylosováno po zmáčknutí tlačítka ZAMÍCHAT, které je zobrazeno pouze u admina hry. Dále je zde zobrazeno jestli je hráč ještě naživu.
									</li>
									<li>
										<ins>All players in the game</ins>, jak název naznačuje zobrazuje všechny hráče přihlášené do hry v pořadí ve kterém se přihlasili. Dále je zde zobrazena úloha ve hře.
									</li>
								</ol>
							</li>
						</ol>
						
						
						<!-- end blog-post-area -->
					</div>

				</div>
			</div>
		</div>
	</section>

	<?php $this->view("footer", $data);?>