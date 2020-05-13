<?php
require_once 'vendor/autoload.php';
//require_once 'config/doctrine.php';

$b = new \App\Config();
$em = $b -> getEntityManager();

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($em);