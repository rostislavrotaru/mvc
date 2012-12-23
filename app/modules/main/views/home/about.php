<?php
	use Spherus\Core\Workbench;

	echo('about view<br />');
	echo('Current layout: '.Workbench::getCurrentController()->layout.'<br />');
?>
<a href="/">index</a>