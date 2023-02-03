<?php
    
require 'vendor/autoload.php';

$dbManager = new \Illuminate\Database\Capsule\Manager;
$dbManager->addConnection([
    'driver'   => 'mysql',
    'host'     => 'localhost',
    'database' => 'bookshop',
    'username' => 'root',
    'password' => '',
    'charset'  => 'utf8',
    'collation'=> 'utf8_unicode_ci',
    'prefix'   => '',
]);

$dbManager->setAsGlobal();
$dbManager->bootEloquent();

?>
    