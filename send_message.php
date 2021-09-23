<?php 

include 'connection.inc.php';
include 'functions.inc.php';
$name = get_safe_value($con,$_POST['name']);
$email = get_safe_value($con,$_POST['email']);
$mobile = get_safe_value($con,$_POST['mobile']);
$message = get_safe_value($con,$_POST['message']);

$sql ="insert into contact_us(name,email,mobile,comment) values('$name','$email','$mobile','$message')";
$result=mysqli_query($con,$sql);

echo "your from submited succesfully ...!";
?>