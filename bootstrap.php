<?php
// bootstrap.php
require_once "vendor/autoload.php";
session_start();

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array("src/Entity");
$isDevMode = true;

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => 'root',
    'dbname'   => 'doctrine',
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);

if (!empty($_SESSION['user'])) {
    // Permet à doctrine de récupérer une référence à notre objet "User" en session
    $currentUser = $entityManager->merge($_SESSION['user']);
}
