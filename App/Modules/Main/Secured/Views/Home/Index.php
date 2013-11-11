<?php
use Spherus\Core\Workbench;
use Spherus\Core\View;
echo ('Current layout: ' . Workbench::getCurrentController()->getLayout() . '<br />');

var_dump(View::$actionResult);

?>
index view


<br />
<a href="/home/about">about</a>

<div class="line"></div>