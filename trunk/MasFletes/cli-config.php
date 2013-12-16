<?php
set_include_path('../library/' . PATH_SEPARATOR . get_include_path());
require_once 'Doctrine/Common/ClassLoader.php';

$classLoader = new \Doctrine\Common\ClassLoader('Entity', __DIR__);
$classLoader->register();

$classLoader = new \Doctrine\Common\ClassLoader('Proxy', __DIR__);
$classLoader->register();

$config = new \Doctrine\ORM\Configuration();
$config->setMetadataCacheImpl(new \Doctrine\Common\Cache\ArrayCache);
$driverImpl = $config->newDefaultAnnotationDriver('application/Model/DefaultDb/Entity');
        $config->setMetadataDriverImpl($driverImpl);
$config->setProxyDir(__DIR__ . '/Proxy');
$config->setProxyNamespace('Proxy');

$connectionOptions = array(
            'dbname' => 'masfletesweb',
            'user' => 'root',
            'password' => 'h3ct0r',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        );

$em = \Doctrine\ORM\EntityManager::create($connectionOptions, $config);

$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new
\Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));
