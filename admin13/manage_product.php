<?php
include "top.inc.php";
$msg ='';
$category_id='';
$name='';
$mrp='';
$price='';
$qty='';
$image='';
$short_desc='';
$description='';
$meta_title='';
$meta_desc='';
$meta_keyword='';
$best_seller='';

$image_required='required';
// This code for edit button
if(isset($_GET['id'])  && $_GET['id']!='')
{
    $image_required='';
    $id=get_safe_value($con,$_GET['id']);
    $sql = "select * from product where id='$id'";
    $result = mysqli_query($con,$sql);

    $check = mysqli_num_rows($result);
    if($check>0)
    {
        $row = mysqli_fetch_assoc($result);

        $category_id = $row['category_id'];
        $name = $row['name'];
        $mrp = $row['mrp'];
        $price = $row['price'];
        $qty = $row['qty'];
        // $image = $row['image'];
        $short_desc = $row['short_desc'];
        // echo "Short desc is : ".$short_desc;
        
        $description = $row['description'];
        $meta_title = $row['meta_title'];
        $meta_desc = $row['meta_desc'];
        $meta_keyword = $row['meta_keyword'];
        $best_seller=$row['best_seller'];


        // echo "the meta keyword is :".$meta_keyword;
       
    }
    else{
        echo '<script>window.location.href="product.php"</script>';
        die();
    }


}



$method = $_SERVER['REQUEST_METHOD'];
// echo "The method is :".$method;
// This code for insert categories into database
// if(isset($_POST['submit']))
if($method=='POST')
{

    $category_id =get_safe_value($con,$_POST['category_id']);
    $name =get_safe_value($con,$_POST['name']);

    // echo $category_id;
    // echo $name;
    // exit();
    $mrp =get_safe_value($con,$_POST['mrp']);
    $price =get_safe_value($con,$_POST['price']);
    $qty =get_safe_value($con,$_POST['qty']);
    $short_desc =get_safe_value($con,$_POST['short_desc']);
    $description =get_safe_value($con,$_POST['description']);
    $meta_title =get_safe_value($con,$_POST['meta_title']);
    $meta_desc =get_safe_value($con,$_POST['meta_desc']);
    $meta_keyword =get_safe_value($con,$_POST['meta_keyword']);
    $best_seller =get_safe_value($con,$_POST['best_seller']);

    $sql = "select * from product where name ='$name' ";
    $result = mysqli_query($con,$sql);
    $check2 = mysqli_num_rows($result);
    if($check2>0)
    {
        //khalchya if code ha category update veles category already exist asa msg yeu naye mhanun aahe
        $edit = $_GET['type'];
        if($edit=='edit')
        {
            $id=get_safe_value($con,$_GET['id']);
            $getdata = mysqli_fetch_assoc($result);
            if($id=$getdata['id'])
            {

            }

        }
        else{
            $msg = "category already exist";
            echo '<script>
            alert("category already exist please Enter New Category!");
            </script>';
            echo '<script>window.location.href="product.php"</script>';
            die();
        }
            

    }
    else
    {
             
                // This code is remaining  not working come back and do it
            //         // below code for cheking image format///////////////////////////////////////////
            // if($_FILES['image']['type']!='' && ($_FILES['image']['type']!=' image/png' && ($_FILES['image']['type']!=' image/jpg') && ($_FILES['image']['type']!=' image/jpeg')))
            // {

            //     echo '<script>
            // alert("please select only jpg.png and jpeg image format!");
            // </script>';
            // echo '<script>window.location.href="manage_product.php"</script>';

            // }
            // /////////////////////////////////////////////////////////////////////////



            // echo $categories;
            $type = $_GET['type'];
            // echo 'parameter pass is :'.$type;
            if($type=='addcat')
            {

                $image =rand(111111111,999999999).'_'. $_FILES['image']['name'];
                // move_uploaded_file($_FILES['image']['tmp_name'],'../media/product/'.$image);
                move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);


                // $sql = "insert into categories(categories,status) values('$categories','1')";
                $sql = "insert into product(category_id,name,mrp,price,qty,short_desc,description,meta_title,meta_desc,meta_keyword,status,image,best_seller) values('$category_id','$name','$mrp','$price','$qty','$short_desc','$description','$meta_title','$meta_desc','$meta_keyword',1,'$image','$best_seller')";
                $result = mysqli_query($con,$sql);

            }
            else
            {

                // $edit = $_GET['type'];
                // if($edit=='edit')
                // {
                    // echo 'we are inside the edit';
                    $id=get_safe_value($con,$_GET['id']);
                    // echo 'id is :'.$id;
                    if($_FILES['image']['name']!='')
                    {
                        $image =rand(111111111,999999999).'_'. $_FILES['image']['name'];
                        // move_uploaded_file($_FILES['image']['tmp_name'],'../media/product/'.$image);
                        move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);

                        $update_sql = "update product set category_id='$category_id',name='$name',mrp='$mrp',price='$price',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword',image='$image',best_seller='$best_seller' where id='$id'";

                    }
                    else
                    {

                        $update_sql = "update product set category_id='$category_id',name='$name',mrp='$mrp',price='$price',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword',best_seller='$best_seller' where id='$id'";

                    }
                    
                    
                    // $sql = "update product set category_id='$category_id',name='$name',mrp='$mrp',price='$price',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword' where id='$id'";
                    $result = mysqli_query($con,$update_sql);
            
                // }


            }
            



    }
   
    
    
    echo '<script>window.location.href="product.php"</script>';
    die();


}




?>


<div class="card-body">
    <h4 class="box-title"> Product<small> Form</small></h4>
</div>

<div class="container">
    <!-- <form action="manage_categories.php" method="post"> -->
    <?php echo '<form action="'.$_SERVER['REQUEST_URI'].'" method="post" enctype="multipart/form-data">'?>

        <label for="category_id">Categories</label>
        <select name="category_id">
            <option>Select Categories</option>
            <?php

                    $sql = "select id,categories from categories order by categories asc";
                    $result=mysqli_query($con,$sql); 
                    while($row=mysqli_fetch_assoc($result))
                    {
                        $id_cat = $row['id'];
                        $cat = $row['categories'];
                        if($id_cat== $category_id)
                        {
                            echo "<option selected value=".$id_cat.">".$cat."</option>";
                        }else
                        {
                            echo "<option value=".$id_cat.">".$cat."</option>";
                        }
                        
                    }
                ?>
        </select><br>

        <br><label for="name">Product Name</label>
        <input type="text" id="name" name="name" placeholder="Enter product name" required value="<?php echo $name;?>">
        
        <label for="category_id">Best Seller</label>
        <select name="best_seller" required>
                    <option value=''>select</option>
                    <?php

                    if($best_seller==1){
                        echo '<option value="1" selected >Yes</option>
                        <option value="0" >No</option>
                        ';
                    }
                    elseif($best_seller==0){
                        echo '<option value="0" selected>No</option>
                        <option value="1" >Yes</option>
                        ';
                    }
                    else{
                        echo '<option value="" >selected</option>';
                    }
                    ?>
        </select><br><br>

        <label for="mrp">MRP</label>
        <input type="text" id="mrp" name="mrp" placeholder="Enter Product MRP..." required value="<?php echo $mrp;?>">

        <label for="price">Price</label>
        <input type="text" id="price" name="price" placeholder="Enter product Price..." required value="<?php echo $price;?>">

        <label for="qty">Qty</label>
        <input type="text" id="qty" name="qty" placeholder="Enter quantity..." required value="<?php echo $qty;?>">

        <label for="qty">image</label><br>
        <input type="file" id="image" name="image" <?php echo $image_required;?>><br><br>

        <label for="short_desc">Short Description</label>
        <input type="text" id="short_desc" name="short_desc" placeholder="please Enter Product Short Description..."
            required value="<?php echo $short_desc;?>"><br><br>

        <!-- <label for="price"> Description</label>
            <br><textarea type="text" id="description" name="description" placeholder="please Enter Product  Description..." required value="<?php echo $description;?>"></textarea><br><br> -->
        <label for="description"> Description</label>
        <br><input type="text" id="description" name="description" placeholder="please Enter Product  Description..."
            required value="<?php echo $description;?>"><br><br>

        <!-- <label for="price"> Meta Title</label>
            <br><textarea type="text" id="meta_title" name="meta_title" placeholder="please Enter meta Title  ..."  value="<?php echo $meta_title;?>"></textarea><br><br> -->
        <label for="meta_title"> Meta Title</label>
        <br><input type="text" id="meta_title" name="meta_title" placeholder="please Enter meta Title  ..."
            value="<?php echo $meta_title;?>"><br><br>

        <!-- <label for="price"> Meta Description</label>
            <br><textarea type="text" id="meta_desc" name="meta_desc" placeholder="please Enter Product  Description..."  value="<?php echo $meta_desc;?>"></textarea><br><br> -->
        <label for="meta_desc"> Meta Description</label>
        <br><input type="text" id="meta_desc" name="meta_desc" placeholder="please Enter Product  Description..."
            value="<?php echo $meta_desc;?>"><br><br>

        <!-- <label for="price"> Meta Keyword</label>
            <br><textarea type="text" id="meta_keyword" name="meta_keyword" placeholder="please Enter meta keywords..."  value="<?php echo $meta_keyword;?>"></textarea><br><br> -->
        <label for="meta_keyword"> Meta Keyword</label>
        <br><input type="text" id="meta_keyword" name="meta_keyword" placeholder="please Enter meta keywords..."
            value="<?php echo $meta_keyword;?>"><br><br>




        <br><input type="submit" name="submit" value="Submit">

    </form>
</div>

<?php

include "footer.inc.php";

?>