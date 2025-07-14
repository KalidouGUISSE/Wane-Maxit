<?php

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

define('HOST',$_ENV['HOST']);
define('URI_HOST',$_ENV['URI_HOST']);
define('DB_NAME',$_ENV['DB_NAME']);
define('USER_NAME',$_ENV['USER_NAME']);
define('PASSWORD',$_ENV['PASSWORD']);

define('TWILIO_SID',$_ENV['TWILIO_SID']);
define('TWILIO_TOKEN',$_ENV['TWILIO_TOKEN']);
define('TWILIO_FROM',$_ENV['TWILIO_FROM']);


// $_ENV['TWILIO_SID'] = getenv('TWILIO_SID');
// $_ENV['TWILIO_TOKEN'] = getenv('TWILIO_TOKEN');
// $_ENV['TWILIO_FROM'] = getenv('TWILIO_FROM');
