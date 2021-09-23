<?php

include 'connection.inc.php';
include 'functions.inc.php';

// prx($_POST);
$name=get_safe_value($con,$_POST['name']);
$email=get_safe_value($con,$_POST['email']);
$mobile=get_safe_value($con,$_POST['mobile']);
$password=get_safe_value($con,$_POST['password']);

$sql = "select * from users where email='$email'";
$result = mysqli_query($con,$sql);
$check_user = mysqli_num_rows($result);
if($check_user>0)
{
    echo "present";

}
else
{
    $sql="INSERT INTO `users` (`name`,`email`,`mobile`,`password`) VALUES ( '$name','$email','$mobile','$password')";
    $result=mysqli_query($con,$sql);

    echo "insert";

}






?>