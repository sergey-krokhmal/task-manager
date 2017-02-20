<?php
use Krokhmal\Soft\Tasker\Test;

$loader = require (__DIR__ . '/vendor/autoload.php');

$loader->addPsr4( 'Krokhmal\\Soft\\', __DIR__ . '/lib/Krokhmal-Soft/');
echo "<pre>";
var_dump($loader);
echo "</pre>";

$test = new Test();

echo __DIR__;

echo "test server";