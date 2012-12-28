<?php
	use Spherus\Core\Workbench;
	echo('Current theme: '.Workbench::getCurrentTheme()->getName().'<br />');
?>
index view<br />
<a href="/home/about">about</a><br />
<a href="/home/redirect">redirect</a><br />
<a href="/home/unsetsession">unset session</a>