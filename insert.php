<?php

include ('top.php');
$amt = $_SESSION['payu'];
$user_id =$_SESSION['USER_ID'];
$sql = "select * from users where id='$user_id'";
$result =mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
?>

    <form>
        <input type="textbox" name="name" id="name" placeholder="Enter your name" value="<?php echo $name; ?>"></br><br>
        <input type="textbox" name="amt" id="amt" placeholder="Enter your amount" value="<?php echo $amt; ?>" readonly></br><br>
        <input type="button" name="btn" id="btn" value="pay now " onclick="pay_now()" /><br><br>
    </form>
<?php 

include "footer.php";

?>
<script>
function pay_now() {

    var name = jQuery('#name').val();
    var amt = jQuery('#amt').val();
   
   

    jQuery.ajax({


        type: 'post',
        url: 'payment_proccess.php',
        data: "amt=" + amt + "&name=" + name,
        success: function(result) {

            var options = {
                "key": "rzp_test_irngMMQcA5xrGH", // Enter the Key ID generated from the Dashboard
                "amount": amt *
                    100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                "currency": "INR",
                "name": "All tree planet india",
                "description": "Test Transaction",
                "image": "https://i.pinimg.com/originals/33/b9/3d/33b93d759a549cf03b7dec5997a965b8.jpg",

                "handler": function(response) {
                    // console.log(response);
                    jQuery.ajax({


                        type: 'post',
                        url: 'payment_proccess.php',
                        data: "payment_id=" + response.razorpay_payment_id,
                        success: function(result) {

                            window.location.href = "thank_you.php.";
                        }
                    });
                }
            };

            var rzp1 = new Razorpay(options);
            rzp1.open();
        }
    });



}
</script>