<?php
require_once 'vendor/autoload.php';
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$isDevMde = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;

$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/../src"), $isDevMde, $proxyDir, $cache, $useSimpleAnnotationReader);

$conn = [
    'driver' => 'pdo_mysql',
    'dbname' => 'blog',
    'user' => 'root',
    'password' => '0p;/9ol.8ik,',
    'host' => 'mysql',
];

$em = EntityManager::create($conn, $config);