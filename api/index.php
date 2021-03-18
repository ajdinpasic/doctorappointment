<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__)."/dao/BaseDao.class.php";
require dirname (__FILE__).'/../vendor/autoload.php';

//$baseObject=new BaseDao();

Flight::route('/', function(){
    echo 'hello world!';
});

Flight::route('/testiram', function(){
    echo 'flight php testing';
});

Flight::start();


 ?>
