<menu>
	<?php
	foreach ($poleStranek as $stranka) {
		echo "<a href='?id-stranky={$stranka->getId()}'>{$stranka->getMenu()}</a></li>";
	}
	?>
</menu>
