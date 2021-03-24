<?php
require_once dirname(__FILE__)."/../vendor/autoload.php";
$openapi = \OpenApi\scan(dirname(__FILE__)."/routes");
header('Content-Type: application/json');
echo $openapi->toJson();
/*
$acc=new AccountsDao();
/*print_r($_GET);
die;

$result=$acc->getEntity(1);

echo json_encode($result,JSON_PRETTY_PRINT);


*/


 ?>
