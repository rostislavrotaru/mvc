<?php
use Spherus\Core\Workbench;
echo ('Current theme: ' . Workbench::getCurrentTheme()->getName() . '<br />');

var_dump(Workbench::getCurrentController()->ViewData['query']);
?>
index view
<br />
<a href="/home/about">about</a>