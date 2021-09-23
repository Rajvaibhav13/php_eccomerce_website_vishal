<?php


include "top.inc.php";


$categories='';
$msg ='';

// This code for edit button
if(isset($_GET['id'])  && $_GET['id']!='')
{
    $id=get_safe_value($con,$_GET['id']);
    $sql = "select * from categories where id='$id'";
    $result = mysqli_query($con,$sql);

    $check = mysqli_num_rows($result);
    if($check>0)
    {
        $row = mysqli_fetch_assoc($result);
        $categories = $row['categories'];
        // echo "Category is :".$categories;
    }
    else{
        echo '<script>window.location.href="categories.php"</script>';
        die();
    }


}


$method = $_SERVER['REQUEST_METHOD'];
// echo "The method is :".$method;

// This code for insert categories into database
// if(isset($_POST['submit']))
if($method=='POST')
{

    $categories =get_safe_value($con,$_POST['categories']);
    $sql = "select * from categories where categories ='$categories' ";
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
            echo '<script>window.location.href="categories.php"</script>';
            die();
        }
            

    }
    else
    {
            // echo $categories;
            $type = $_GET['type'];
            // echo 'parameter pass is :'.$type;
            if($type=='addcat')
            {

                $sql = "insert into categories(categories,status) values('$categories','1')";
                $result = mysqli_query($con,$sql);

            }
            else
            {

                $edit = $_GET['type'];
                if($edit=='edit')
                {
                    // echo 'we are inside the edit';
                    $id=get_safe_value($con,$_GET['id']);
                    // echo 'id is :'.$id;
                    
                    $sql = "update categories set categories='$categories' where id='$id'";
                    $result = mysqli_query($con,$sql);
            
                }


            }
    }
    
    
    echo '<script>window.location.href="categories.php"</script>';
    die();


}




?>


<div class="card-body">
    <h4 class="box-title"> Categories<small> Form</small></h4>
</div>

<div class="container">
    <!-- <form action="manage_categories.php" method="post"> -->
    <?php echo '<form action="'.$_SERVER['REQUEST_URI'].'" method="post">'?>
        <label for="categories">Add Category</label>
        <input type="text" id="categories" name="categories" placeholder="Your categories.." required value="<?php echo $categories?>">

        <input type="submit" name="submit" value="Submit">
        <div class="field_error"><?php echo $msg; ?></div>
    </form>
</div>

<?php

include "footer.inc.php";

?>