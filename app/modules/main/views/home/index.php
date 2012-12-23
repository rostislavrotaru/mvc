<?php
	use Spherus\Core\Workbench;
	echo('Current theme: '.Workbench::getCurrentTheme()->getName().'<br />');
?>
index view<br />
<a href="/main/home/about">about</a><br />
<a href="/main/home/redirect">redirect</a><br />
<a href="/main/home/unsetsession">unset session</a>