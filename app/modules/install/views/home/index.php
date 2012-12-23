<?php
	use Spherus\Core\Workbench;

	echo('index view<br />');
	echo('Current theme: '.Workbench::getCurrentTheme()->getName().'<br />');
?>
<a href="/main/home/redirect">redirect</a><br />
<a href="/main/home/about">about</a><br />
<a href="/main/home/unsetsession">unset session</a><br />

