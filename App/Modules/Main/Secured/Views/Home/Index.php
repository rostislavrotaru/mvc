<?php
use Spherus\Core\Workbench;
use Spherus\Core\View;
echo ('Current layout: ' . Workbench::getCurrentController()->getLayout() . '<br />');

//var_dump(Workbench::getCurrentController()->ViewData['query']);
var_dump(View::$viewData['query']);

?>
index view


<br />
<a href="/home/about">about</a>

<div class="line"></div>