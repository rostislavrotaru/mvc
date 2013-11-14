<?php
use Spherus\Core\Workbench;
use Spherus\Core\View;
echo ('Current layout: ' . Workbench::getCurrentController()->getLayout() . '<br />');
echo '<pre>';
var_dump(View::$actionResult);
echo '</pre>';
?>


<br />
<a href="/home/about">about</a>