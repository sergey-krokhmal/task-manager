<?php
use Krokhmal\Soft\Tasker\Test;
use Krokhmal\Soft\Helpers\UUID;

$loader = require (__DIR__ . '/vendor/autoload.php');

$loader->addPsr4( 'Krokhmal\\Soft\\', __DIR__ . '/lib/Krokhmal-Soft/');

echo UUID::generateV4();