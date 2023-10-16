<?php

session_start();
use CSY2028\EntryPoint;
use Ijdb\Routes;

require '../autoload.php';

$routes = new Routes();

$entryPoint = new CSY2028\EntryPoint($routes);

$entryPoint->run();