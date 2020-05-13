<?php


namespace App;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class Config
{
    public function getEntityManager()
    {
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

        return $em;
    }

    public function getTwig()
    {
        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader, [
            'cache' => 'var/cache/twig',
            'auto_reload' => true,
        ]);
        return $twig;
    }
}