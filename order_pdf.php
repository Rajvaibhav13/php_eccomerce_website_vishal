<?php
include ("vendor/autoload.php");
include ('connection.inc.php');
include ('functions.inc.php');

// $order_id=$_SESSION['pdf_order_id'];
// // $order_id= get_safe_value($con,$_GET['id']);
if(!$_SESSION['ADMIN_LOGIN']){
   if(!isset($_SESSION['USER_ID'])){

      die();
   }
}

$order_id= get_safe_value($con,$_GET['id']);

$css =file_get_contents('css/bootstrap.min.css');
$css =file_get_contents('style.css');
// <link rel="stylesheet" href="css/bootstrap.min.css">
// <link rel="stylesheet" href="style.css">

$html='<div class="col-md-12 col-sm-12 col-xs-12">
<div class="wishlist-content">
   <form action="#">
      <div class="wishlist-table table-responsive">
         <table>
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
            <tbody>';
            

            if(isset($_SESSION['ADMIN_LOGIN'])){

               $sql = "select distinct(order_detail.id),order_detail.*,product.name,product.image from order_detail,product,`order`  where order_detail.order_id='$order_id'  and  order_detail.product_id=product.id";
               $result=mysqli_query($con,$sql);

            }else{
               $uid =$_SESSION['USER_ID'];
               $sql = "select distinct(order_detail.id),order_detail.*,product.name,product.image from order_detail,product,`order`  where order_detail.order_id='$order_id' and `order`.user_id='$uid' and  order_detail.product_id=product.id";
               $result=mysqli_query($con,$sql);
            }
            
             $total_price=0;
             if(mysqli_num_rows($result)==0){
                die();
             }
             while($row=mysqli_fetch_assoc($result))
             {
                $total_price=$total_price+($row['qty']*$row['price']);
                $pp=$row['qty']*$row['price'];
                $html.='<tr>
               <td class="product-name">'.$row['name'].'</td>
               <td class="product-name"><img
                  src="'.PRODUCT_IMAGE_SITE_PATH.$row['image'].'"
                  alt="full-image" height="100px"></td>
               <td class="product-name">'.$row['qty'].'</td>
               <td class="product-name">'.$row['price'].'</td>
               <td class="product-name">'.$pp.'</td>
               </tr>';
             } 

            $html.='<tr>
                        <td colspan="3"></td>
                        <td class="product-name">Total Price</td>
                        <td class="product-name">'.$total_price.'</td>
                   </tr>'; 
            $html.='</tbody>
         </table>
      </div>
   </form>
</div>
</div>
';
$mpdf=new \Mpdf\Mpdf() ;
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html,2);
$file=time().'.pdf';
$mpdf->output($file,'D');//D for auto download

?>










<!-- 
$html='<div class="col-md-12 col-sm-12 col-xs-12">
<div class="wishlist-content">
   <form action="#">
      <div class="wishlist-table table-responsive">
         <table>
            <thead>
               <tr>
                  <th class="product-remove"><span class="nobr">Product name</span></th>
                  <th class="product-thumbnail">product image</th>
                  <th class="product-price"><span class="nobr"> Qty </span></th>
                  <th class="product-stock-stauts"><span class="nobr"> price </span></th>
                  <th class="product-stock-stauts"><span class="nobr"> Total Price </span></th>
               </tr>
            </thead>
            <tbody>';
            
            $uid =$_SESSION['USER_ID'];
                                             
              // echo 'order id is :'.$order_id;
              // $sql = "select order_detail.*,product.name,product.image from order_detail,product,`order`  where order_detail.order_id='$order_id' and `order`.user_id='$uid' and  product.id=order_detail.product_id";
              $sql = "select distinct(order_detail.id),order_detail.*,product.name,product.image from order_detail,product,`order`  where order_detail.order_id='$order_id' and `order`.user_id='$uid' and  order_detail.product_id=product.id";
               $result=mysqli_query($con,$sql);
               $total_price=0;
               while($row=mysqli_fetch_assoc($result))
               {
                  $total_price=$total_price+($row['qty']*$row['price']);
                  $pp=$row['qty']*$row['price'];

               $html.='<tr>
                  <td class="product-name">'.$row['name'].'</td>
                  <td class="product-name"><img
                     src="'.PRODUCT_IMAGE_SITE_PATH.$row['image'].'"
                     alt="full-image" hight="20px"></td>
                  <td class="product-name">'.$row['qty'].'</td>
                  <td class="product-name">'.$row['price'].'</td>
                  <td class="product-name">'.$pp.'</td>
               </tr>';
               }
               $html.='<tr>
                  <td colspan="3"></td>
                  <td class="product-name">Total Price</td>
                  <td class="product-name">'.$total_price.'</td>
               </tr>
            </tbody>';
               
         $html.='</table>
      </div>
   </form>
</div>
</div>'; -->

