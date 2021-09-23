<?php

include 'connection.inc.php';
include 'functions.inc.php';

// prx($_POST);

$email=get_safe_value($con,$_POST['email']);
$password=get_safe_value($con,$_POST['password']);

$sql = "select * from users where email='$email' and password='$password'";
$result = mysqli_query($con,$sql);
$check_user = mysqli_num_rows($result);
if($check_user>0)
{
    $row=mysqli_fetch_assoc($result);
    $_SESSION['USER_LOGIN']='yes';
    $_SESSION['USER_ID']=$row['id'];
    $_SESSION['USER_NAME']=$row['name'];

    echo "valid";

}
else
{
    echo 'wrong';
}






?>