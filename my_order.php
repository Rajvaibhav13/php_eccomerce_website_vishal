<?php
include 'top.php';
?>

<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.html">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">Wishlist</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- wishlist-area start -->
        <div class="wishlist-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="wishlist-content">
                            <form action="#">
                                <div class="wishlist-table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-remove"><span class="nobr">Order id</span></th>
                                                <th class="product-thumbnail">order date</th>
                                               
                                                <th class="product-price"><span class="nobr"> address </span></th>
                                                <th class="product-stock-stauts"><span class="nobr"> Payment type </span></th>
                                                <th class="product-stock-stauts"><span class="nobr"> Payment Status </span></th>
                                                <th class="product-stock-stauts"><span class="nobr"> order Status </span></th>
                                                
                                                <!-- <th class="product-add-to-cart"><span class="nobr"></span></th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                             $uid = $_SESSION['USER_ID'];
                                             $sql = "select `order`.*,order_status.name as order_status_str from `order`,order_status where `order`.user_id='$uid' and order_status.id=order.order_status";
                                             $result= mysqli_query($con,$sql);
                                             while($row=mysqli_fetch_assoc($result))
                                             {
                                            ?>
                                            <tr>
                                                <td class="product-add-to-cart"><a href="my_order_details.php?id=<?php echo $row['id'];?>"> <?php echo $row['id']; ?></a>
                                                <br>
                                                <a href="order_pdf.php?id=<?php echo $row['id'];?>">pdf</a>
                                                </td>                                                
                                                <td class="product-name"><a href="#"><?php echo $row['added_on']?></a></td>
                                                <td class="product-name"><a href="#">
                                                <?php echo $row['address']?></a>
                                                <?php echo $row['city']?></a>
                                                <?php echo $row['pincode']?></a>
                                                
                                                </td>
                                                <td class="product-name"><a href="#"><?php echo $row['payment_type']?></a></td>
                                                <td class="product-price"><span class="amount"><?php echo $row['payment_status']?></span></td>
                                                <td class="product-stock-status"><span class="wishlist-in-stock"><?php echo $row['order_status_str'] ?></span></td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                        
                                    </table>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- wishlist-area end -->

<?php
include 'footer.php';
?>