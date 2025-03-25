<?php
echo "<menu>";
// echo "<ul>";
// 	foreach ($seznamStranek as $idStranky => $instanceStranky) {
// 		// aby se nevypisovala polozka menu ktera vede na stranku s errorem
// 		if ($instanceStranky->menu == "") {
// 			continue;
// 		} else {
// 			echo "<li><a href='$idStranky'>{$instanceStranky->menu}</a></li>";
// 		}

// 	}
// echo "</ul>";

foreach ($seznamStranek as $idStranky => $instanceStranky) {
	if ($instanceStranky->menu == "") {
		continue;
	} else {
		if ($stranka == $instanceStranky->getId()) {
			echo "<a href='{$instanceStranky->getId()}' id='ramMenu'>{$instanceStranky->getMenu()}</a>";
		} else {
			echo "<a href='{$instanceStranky->getId()}'>{$instanceStranky->getMenu()}</a>";
		}
	}


}
echo "</menu>";