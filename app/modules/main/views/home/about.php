<?php
	use Spherus\Core\Context;

	echo('about view<br />');
	echo('Current layout: '.Context::getCurrentController()->layout.'<br />');
?>
<a href="/">index</a>