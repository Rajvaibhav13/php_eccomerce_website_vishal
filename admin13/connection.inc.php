<?php
session_start();
$server = "localhost";
$username = "root";
$password = "";
$database ="ecom";
$con = mysqli_connect($server,$username,$password ,$database);
if(!$con){
    echo "connection failed to the databse".mysqli_connect_error();    
}
else
{
    echo "connection done succesfully with database";
}


define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/php/ecom/');
define('SITE_PATH','http://127.0.0.1/php/ecom/');

define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/product/');
define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/product/');


?>