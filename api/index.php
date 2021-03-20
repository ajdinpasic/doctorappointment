<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__)."/dao/BaseDao.class.php";
require_once dirname(__FILE__)."/dao/AccountsDao.class.php";
require_once dirname (__FILE__)."/../vendor/autoload.php";
require_once dirname (__FILE__)."/routes/AccountRoutes.php";


Flight::register('account', 'AccountsDao');






Flight::start();


 ?>
