<?php
use Krokhmal\Tasker\Test;

$loader = require (__DIR__ . '/vendor/autoload.php');

$loader->addPsr4( 'Krokhmal\\', __DIR__ . '/lib/Krokhmal/');
echo "<pre>";
var_dump($loader);
echo "</pre>";

$test = new Test();

echo __DIR__;

echo "test server";