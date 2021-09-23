<?php
include "top.php";
// prx($_SESSION['cart']);
if(!isset($_SESSION['cart']) || count($_SESSION['cart'])==0){
    ?>

<script>
window.location.href = 'index.php';
</script>;
<?php
    
}


    $cart_total=0;
    foreach ($_SESSION['cart'] as $key=>$val){
    $productArr = get_product($con,'','',$key);
    $price=$productArr[0]['price'];
    $qty=$val['qty'];
    $cart_total=$cart_total+($price*$qty);
    }


if(isset($_POST['submit']))
{
    // prx($_POST);
    $address=$_POST['address'];
    $city=$_POST['city'];
    $pincode = $_POST['pincode'];
    $payment_type = $_POST['payment_type'];
    $user_id=$_SESSION['USER_ID'];
    $total_price=$cart_total;
    //////////////////////////////////////////////////
    $_SESSION['payu']=$total_price;  //total price is taking for online payment 
    //////////////////////////////////////////////////
    $payment_status='pending';
    if($payment_type=='COD')
    {
        $payemnt_status = 'success';

    } 
    $order_status = '1';
    $added_on = date('Y-m-d h:i:s');

    
    $sql = "insert into `order`(user_id,address,city,pincode,payment_type,total_price,payment_status,order_status,added_on) values('$user_id','$address','$city','$pincode','$payment_type','$total_price','$payment_status','$order_status','$added_on')";
    $result=mysqli_query($con,$sql);

    /////////////////////insert at order time data in order_details table ////////////////////////////////
    $order_id = mysqli_insert_id($con);//it returns current inserted id from order table id
    $_SESSION['order_id']=$order_id;
    foreach ($_SESSION['cart'] as $key=>$val){
        $productArr = get_product($con,'','',$key);//$key return product id from get_product function
        $price=$productArr[0]['price'];
        $qty=$val['qty'];
        $sql2 = "insert into `order_detail`(order_id,product_id,qty,price) values('$order_id','$key','$qty',' $price')";
        $result = mysqli_query($con,$sql2);
        unset($_SESSION['cart']);//empty cart after checkout 
    //////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////This code for razarpay payment////////////////////////////////////////////

            if($payment_type=='payu')
            {
                    ?>
                    <script>
                    window.location.href="insert.php";
                    </script>
                        

            <?php 
            }




////////////////////////////////////////////////////////////////////////////////////////////////////////////
         
        ?>

<script>
window.location.href = 'thank_you.php';
</script>
<?php


        
    }
    ///////////////////////////////////////////////////////////////////////////////////


   
    
}
?>
<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area"
    style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="index.html">Home</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">checkout</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- cart-main-area start -->
<div class="checkout-wrap ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="checkout__inner">
                    <div class="accordion-list">
                        <div class="accordion">

                            <?php 
                                
                                $accordian_class='accordion__title';
                                if(!isset($_SESSION['USER_LOGIN'])){
                                    $accordian_class='accordion__hide'; 
                                    ?>

                            <div class="accordion__title">
                                Checkout Method
                            </div>
                            <div class="accordion__body">
                                <div class="accordion__body__form">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="checkout-method__login">
                                                <form id="login-form" method="post">
                                                    <h5 class="checkout-method__title">Login</h5>
                                                    <div class="single-input">
                                                        <label for="user-email">Email Address</label>
                                                        <input type="text" name="login_email" id="login_email"
                                                            placeholder="Your Email*" style="width:100%">
                                                        <span class="field_error" id="login_email_error"></span>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="user-pass">Password</label>
                                                        <input type="text" name="login_password" id="login_password"
                                                            placeholder="Your Password*" style="width:100%">
                                                        <span class="field_error" id="login_password_error"></span>
                                                    </div>
                                                    <p class="require">* Required fields</p>
                                                    <div class="dark-btn">
                                                        <!-- <a href="#">LogIn</a> -->
                                                        <button type="button" onclick="user_login()"
                                                            class="fv-btn">Login</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-method__login">
                                                <form id="register-form" method="post">
                                                    <h5 class="checkout-method__title">Register</h5>
                                                    <div class="single-input">
                                                        <label for="user-email">Name</label>
                                                        <input type="text" name="name" id="name"
                                                            placeholder="Your Name*" style="width:100%">
                                                        <span class="field_error" id="name_error"></span>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="user-email">Email Address</label>
                                                        <input type="text" name="email" id="email"
                                                            placeholder="Your Email*" style="width:100%">
                                                        <span class="field_error" id="email_error"></span>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="user-pass">Mobile</label>
                                                        <input type="text" name="mobile" id="mobile"
                                                            placeholder="Your Mobile*" style="width:100%">
                                                        <span class="field_error" id="mobile_error"></span>
                                                    </div>

                                                    <div class="single-input">
                                                        <label for="user-pass">Password</label>
                                                        <input type="text" name="password" id="password"
                                                            placeholder="Your Password*" style="width:100%">
                                                        <span class="field_error" id="password_error"></span>
                                                    </div>
                                                    <div class="dark-btn">
                                                        <!-- <a href="#">Register</a> -->
                                                        <button type="button" class="fv-btn"
                                                            onclick="user_register()">Register</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                            <div class="<?php echo $accordian_class;?>">
                                Address Information
                            </div>
                            <form method="post">
                                <div class="accordion__body">
                                    <div class="bilinfo">

                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="single-input">
                                                    <input type="text" name="address" placeholder="Street Address"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">

                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input type="text" name="city" placeholder="City/State" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input type="text" name="pincode" placeholder="Post code/ zip"
                                                        required>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <!-- <div class="accordion__hide"> -->
                                <div class="<?php echo $accordian_class;?>">
                                    payment information
                                </div>
                                <div class="accordion__body">
                                    <div class="paymentinfo">
                                        <div class="single-method">
                                            COD <input type="radio" name="payment_type" value="COD" required />
                                            &nbsp; payU <input type="radio" name="payment_type" value="payu" required />
                                        </div>
                                        <div class="single-method">

                                        </div>
                                    </div>
                                </div>
                                <div class="dark-btn">
                                    <input type="submit" name="submit" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="order-details">
                    <h5 class="order-details__title">Your Order</h5>
                    <div class="order-details__item">

                        <?php

                                $cart_total=0;

                                foreach ($_SESSION['cart'] as $key=>$val){
                                    $productArr = get_product($con,'','',$key);
                                    // pr($productArr);
                                    $pname=$productArr[0]['name'];
                                    $mrp=$productArr[0]['mrp'];
                                    $price=$productArr[0]['price'];
                                    $image=$productArr[0]['image'];
                                    $qty=$val['qty'];
                                    $cart_total=$cart_total+($price*$qty)


                            ?>
                        <div class="single-item">
                            <div class="single-item__thumb">
                                <!-- <img src="images/cart/2.png" alt="ordered item"> -->
                                <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image ?>" alt="product img" />
                            </div>
                            <div class="single-item__content">
                                <a href="#"><?php echo $pname;?></a>
                                <span class="price"><?php echo $price*$qty; ?></span>
                            </div>
                            <div class="single-item__remove">
                                <!-- <a href="#"><i class="zmdi zmdi-delete"></i></a> -->
                                <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','remove')"><i
                                        class="zmdi zmdi-delete"></i></a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>

                    <div class="ordre-details__total">
                        <h5>Order total</h5>
                        <span class="price"><?php echo $cart_total;?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- cart-main-area end -->

<?php
include "footer.php";
?>