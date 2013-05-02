<?php

//****************************************************
//Replace here the path that the framework is located
set_include_path('/Volumes/DATA/Programming/SPHERUS');
define('ROOT', __DIR__.'/../');
include 'Spherus/Autoloader.php';
//****************************************************


use Spherus\Components\Data\Component;
$component = new Component();
echo $component->getDescription();