<?php

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

define('HOST',$_ENV['HOST']);
define('URI_HOST',$_ENV['URI_HOST']);
define('DB_NAME',$_ENV['DB_NAME']);
define('USER_NAME',$_ENV['USER_NAME']);
define('PASSWORD',$_ENV['PASSWORD']);