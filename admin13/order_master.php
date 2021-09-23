<?php
include ("top.inc.php");
?>


<!-- Content -->
<div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <div class="clearfix"></div>
                <!-- Orders -->
                <div class="orders">
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="box-title">order Master </h4>
                                    <!-- <h4 class="box-h"><a href="manage_categories.php">Add Categories</a></h4> -->

                                </div>
                                <div class="card-body--">
                                    <div class="table-stats order-table ov-h">
                                    <table class="table">
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

                                             $sql = "select `order`.*,order_status.name as order_status_str from `order`,order_status where  order_status.id=order.order_status";
                                             $result= mysqli_query($con,$sql);
                                             while($row=mysqli_fetch_assoc($result))
                                             {
                                            ?>
                                            <tr>
                                                <td class="product-add-to-cart"><a href="order_master_detail.php?id=<?php echo $row['id'];?>"> <?php echo $row['id']; ?></a>
                                                <br>
                                                <a href="../order_pdf.php?id=<?php echo $row['id']; ?>">PDF</a>
                                                
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
                                    </div> <!-- /.table-stats -->
                                </div>
                            </div> <!-- /.card -->
                        </div> <!-- /.col-lg-8 -->
                    </div>
                </div><!-- /.orders -->
            </div><!-- .animated -->  
        </div><!-- /.content --> 
<?php

include ("footer.inc.php");

?>