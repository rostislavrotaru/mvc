<?php

//****************************************************
//Replace here the path that the framework is located
set_include_path('/Volumes/DATA/Programming/SPHERUS');
include 'Spherus/Autoloader.php';
//****************************************************


use Spherus\Components\Query\Component;

$component = new Component();
echo $component->getDescription();
echo('<pre>');
var_dump($component->getDependingComponents());
echo('</pre>');