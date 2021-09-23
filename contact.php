<?php 
include ("top.php");
?>
<?php

$method = $_SERVER['REQUEST_METHOD'];
if($method=='POST')
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $message = $_POST['message'];
    
    // echo $name  ;
    // echo $email ;
    // echo $mobile;
    // echo $message;

    // $sql = "insert into contact_us values('$name','$email','$mobile','$message')";
    $sql = "INSERT INTO `contact_us` ( `name`, `email`, `mobile`, `comment`) VALUES ( '$name', '$email', '$mobile', '$message')";
    $result = mysqli_query($con,$sql);

        

}

?>


<!-- End Offset Wrapper -->
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
                            <span class="breadcrumb-item active">Contact Us</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- Start Contact Area -->
<section class="htc__contact__area ptb--100 bg__white">
    <div class="container">

        <div class="row">
            <div class="contact-form-wrap mt--60">
                <div class="col-xs-12">
                    <div class="contact-title">
                        <h2 class="title__line--6">Contact Us</h2>
                    </div>
                </div>
                <div class="col-xs-12">
                    <form action="contact.php" method="post" id="contact-form" >
                        <div class="single-contact-form">
                            <div class="contact-box name">
                                <input type="text" id="name" name="name" placeholder="Your Name*">
                                <input type="email" id="email" name="email" placeholder="Email*">
                                <input type="text" id="mobile" name="mobile" placeholder="Mobile*">
                            </div>
                        </div>
                       
                        <div class="single-contact-form">
                            <div class="contact-box message">
                                <textarea name="message" id="message" placeholder="Your Message"></textarea>
                            </div>
                        </div>
                        <div class="contact-btn">
                        <button type="submit" name="submit" class="fv-btn">Send MESSAGE</button>
                        </div>
                    </form>
                    <div class="form-output">
                        <p class="form-messege"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Contact Area -->
<!-- End Banner Area -->
<!-- Start Footer Area -->


<?php
include ("footer.php");
?>