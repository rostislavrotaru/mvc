<?php

//****************************************************
//Replace here the path that the framework is located
set_include_path('D:\Programming\SPHERUS_PHP\SOURCECODE');
include 'Spherus/Autoloader.php';
//****************************************************


use Spherus\Components\Query\Component;
use Spherus\Components\Query\Component\SqlDatabaseQuery\SqlFactory;

$component = new Component();
echo('<pre>');
var_dump($component);
echo('</pre>');

$column = SqlFactory::Column('test', null, 'test_alias');

$t =2;