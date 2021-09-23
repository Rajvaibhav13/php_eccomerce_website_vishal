<?php 
include 'top.php';

if(isset($_POST['amt']) && isset($_POST['name']))
{

    $amt = $_POST['amt'];
    $name = $_POST['name'];
    $payment_status="pending";
    $added_on=date('Y-m-d h:i:s');
    $id=$_SESSION['order_id'];
    // mysqli_query($con,"insert into `order`(name,payment_status,added_on) values('$name','$payment_status','$added_on')");
    mysqli_query($con,"update `order` set name='$name',payment_status='$payment_status',added_on='$added_on' where id='$id'");
    $_SESSION['OID']=mysqli_insert_id($con);
}


if(isset($_POST['payment_id']) && isset($_SESSION['OID']))
{

    $id=$_SESSION['order_id'];
    $payment_id =$_POST['payment_id'];
    mysqli_query($con,"update `order` set payment_status='complete',payment_id='$payment_id' where id='$id'");
    
}

?>
