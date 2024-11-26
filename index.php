<?php

require_once 'vendor/autoload.php';
require_once 'controller/Controller.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

Controller::main();
