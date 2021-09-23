<?php

include ("top.inc.php");
$order_id= get_safe_value($con,$_GET['id']);
if(isset($_POST['update_order_status']))
{
    echo $update_order_status=$_POST['update_order_status'];
    $sql = "update `order` set order_status='$update_order_status' where id='$order_id'";
    $result=mysqli_query($con,$sql);
}

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
                                    <h4 class="box-title">Order Detail </h4>
                                    <!-- <h4 class="box-h"><a href="manage_categories.php">Add Categories</a></h4> -->

                                </div>
                                <div class="card-body--">
                                    <div class="table-stats order-table ov-h">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="product-remove"><span class="nobr">Product name</span></th>
                                                <th class="product-thumbnail">product image</th>
                                               
                                                <th class="product-price"><span class="nobr"> Qty </span></th>
                                                <th class="product-stock-stauts"><span class="nobr"> price </span></th>
                                                <th class="product-stock-stauts"><span class="nobr"> Total Price </span></th>
                                                
                                                
                                                <!-- <th class="product-add-to-cart"><span class="nobr"></span></th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php


                                            $sql = "select distinct(order_detail.id),order_detail.*,product.name,product.image,`order`.address,`order`.city,`order`.pincode,`order`.order_status from order_detail,product,`order`  where order_detail.order_id='$order_id' and   order_detail.product_id=product.id GROUP by order_detail.id";
                                             $result=mysqli_query($con,$sql);
                                             $total_price=0;
                                             
                                             while($row=mysqli_fetch_assoc($result))
                                             {
                                                $total_price=$total_price+($row['qty']*$row['price']);
                                                $address=$row['address'];
                                                $city=$row['city'];
                                                $pincode =$row['pincode'];
                                                $order_status=$row['order_status'];
                                            ?>
                                            <tr>
                                                  <td class="product-name"><?php echo $row['name'] ?></td>
                                                  <td class="product-name"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image'] ?>"alt="full-image"></td>
                                                  <td class="product-name"><?php echo $row['qty']?></td>
                                                  <td class="product-name"><?php echo $row['price'] ?></td>
                                                  <td class="product-name"><?php echo $row['qty']*$row['price']?></td>  
                                            </tr>
                                            <?php }?>
                                            <tr>
                                                  <td colspan="3"></td>
                                                  <td class="product-name">Total Price</td>
                                                  <td class="product-name"><?php echo $total_price ?></td>
                                            </tr>
                                        </tbody>   
                                    </table>
                                            <div>
                                                <strong>Address</strong>
                                                <?php echo $address?>  <?php echo $city?>  <?php echo $pincode?><br><br>

                                                <strong>Order Status : </strong>
                                                <?php

                                                // $order_status_arr=mysqli_fetch_assoc(mysqli_query($con,"select name from order_status where id='$order_status'"));
                                                $order_status_arr=mysqli_fetch_assoc(mysqli_query($con,"select order_status.name from order_status,`order` where `order`.id='$order_id' and `order`.order_status=order_status.id"));
                                                // prx($order_status_arr);
                                                echo $order_status_arr['name'].'<br><br>';

                                                ?>
                                                <div>
                                                    <form method="post">
                                                       
                                                        
                                                            <select class="form-control" name="update_order_status">
                                                                <option>Select Status</option>
                                                                <?php

                                                                        $sql = "select * from order_status order by id asc";
                                                                        $result=mysqli_query($con,$sql); 
                                                                        while($row=mysqli_fetch_assoc($result))
                                                                        {
                                                                            $id = $row['id'];
                                                                            $name = $row['name'];
                                                                            if($id== $category_id)
                                                                            {
                                                                                echo "<option selected value=".$id.">".$name."</option>";
                                                                            }else
                                                                            {
                                                                                echo "<option value=".$id.">".$name."</option>";
                                                                            }
                                                                            
                                                                        }
                                                                    ?>
                                                            </select><br>
                                                            <input type="submit" />
                                                       
                                                    </form>
                                                </div>

                                                
                                            </div>
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