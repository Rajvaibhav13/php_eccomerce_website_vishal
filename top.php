<?php

include ('connection.inc.php');
include ('functions.inc.php');
include ('add_to_cart.inc.php');

// echo prx($_SESSION);

$sql = "select * from categories where status=1 order by categories asc";
$cat_res=mysqli_query($con,$sql);
$cat_arr = array();
while($row=mysqli_fetch_assoc($cat_res))
{
    $cat_arr[]=$row;

}
$obj=new add_to_cart();
$totalProduct =$obj->totalProduct();


////////////////////////////////////Product.php/////////////////////////////

//prx($_SERVER['SCRIPT_NAME']);
$script_name= $_SERVER['SCRIPT_NAME'];
$script_name_arr=explode('/',$script_name);
// prx($script_name_arr);
$mypage=$script_name_arr[count($script_name_arr)-1];


$meta_title="ecom website";
$meta_desc="my desc";
$meta_keyword="my keyword";

if($mypage=='product.php'){
$product_id = get_safe_value($con,$_GET['id']);
$product_meta_res=mysqli_query($con,"select * from product where id='$product_id'");
$row = mysqli_fetch_assoc($product_meta_res);
// echo prx($row);
$meta_title=$row['meta_title'];
$meta_desc=$row['meta_desc'];
$meta_keyword=$row['meta_keyword'];
}

if($mypage=='contact.php'){
    $meta_title="contactus.php"; 
}
    
if($mypage=='categories.php'){
    $meta_title="categories.php"; 
}
    
if($mypage=='index.php'){
    $meta_title="index.php"; 
}
    
if($mypage=='login.php'){
    $meta_title="login.php"; 
}
    
/////////////////////////////////////////////////////////////////////////////////



?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $meta_title?></title>
    <meta name="description" content="<?php echo $meta_desc?>">
    <meta name="keywords" content="<?php echo $meta_keyword?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/core.css">
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/custom.css">
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- for contact us form include jquery cdn and main.js file from js file -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="jsmy/main.js"></script>
    <!-- ////////////////////////////////below links for insert.php page /////////////////// -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <!-- /////////////////////////////////////////////////////////////////////////////////// -->
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!-- Body main wrapper start -->
    <div class="wrapper">
        <!-- Start Header Style -->
        <header id="htc__header" class="htc__header__area header--one">
            <!-- Start Mainmenu Area -->
            <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
                <div class="container">
                    <div class="row">
                        <div class="menumenu__container clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
                                <div class="logo">
                                    <a href="index.html"><img src="images/logo/4.png" alt="logo images"></a>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-8 col-sm-5 col-xs-3">
                                <nav class="main__menu__nav hidden-xs hidden-sm">
                                    <ul class="main__menu">
                                        <li class="drop"><a href="index.php">Home</a></li>
                                            <?php

                                                foreach($cat_arr as $list){
                                                ?>
                                                 <li><a href="categories.php?id=<?php echo $list['id'] ?>"><?php echo $list['categories'] ?></a></li>

                                                <?php
                                                }
                                            ?>

                                        <li><a href="contact.php">contact</a></li>
                                    </ul>
                                </nav>

                                <div class="mobile-menu clearfix visible-xs visible-sm">
                                    <nav id="mobile_dropdown">
                                        <ul>
                                            <li><a href="index.php">Home</a></li>
                                            <?php

                                                foreach($cat_arr as $list){
                                                ?>
                                                 <li><a href="categories.php?id=<?php echo $list['id'] ?>"><?php echo $list['categories'] ?></a></li>

                                                <?php
                                                }
                                            ?>

                                            <li><a href="contact.php">contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-2 col-sm-4 col-xs-4">
                                <div class="header__right">
                                    <div class="header__search search search__open">
                                        <a href="#"><i class="icon-magnifier icons"></i></a>
                                    </div>
                                    <div class="header__account">
                                        <?php 
                                              if(isset($_SESSION['USER_LOGIN']))
                                              {
                                                echo '<a href="logout.php">Logout</a><a href="my_order.php">My Order</a>';
                                              }
                                              else
                                              {
                                                echo '<a href="login.php">Login/Register</i></a>';
                                              }
                                        ?>
                                               
                                    </div>
                                    <div class="htc__shopping__cart">
                                        <a class="cart__menu" href="cart.php"><i class="icon-handbag icons"></i></a>
                                        <a href="cart.php"><span class="htc__qua"><?php echo $totalProduct; ?></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div><!-- End Mainmenu Area -->
        </header> <!-- End Header Area -->
        
        <div class="body__overlay"></div>
        <!-- Start Offset Wrapper -->
        <div class="offset__wrapper">
            <!-- Start Search Popap -->
            <div class="search__area">
                <div class="container" >
                    <div class="row" >
                        <div class="col-md-12" >
                            <div class="search__inner">
                                <form action="search.php" method="get">
                                    <input placeholder="Search here... " type="text" name="str">
                                    <button type="submit"></button>
                                </form>
                                <div class="search__close__btn">
                                    <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Search Popap -->
        </div>