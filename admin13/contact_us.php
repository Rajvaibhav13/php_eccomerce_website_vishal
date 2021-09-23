<?php

include ("top.inc.php");

if(isset($_GET['type']) && $_GET['type']!='')
{
    // This code for active deactive opration
    $type = get_safe_value($con,$_GET['type']);
    
    //this code for delete contact from the database
    $type = get_safe_value($con,$_GET['type']);
    if($type=='delete')
    {
        
        $id = get_safe_value($con,$_GET['id']);
        $delete_sql = "delete from  contact_us  where id='$id'";
        mysqli_query($con,$delete_sql);


    }
}
// this query for dispalying content in table below
$sql = "select * from contact_us order by id desc";
$result = mysqli_query($con,$sql);
// if($result){
//     echo "query succesfully Exicuted";
// }
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
                                    <h4 class="box-title">Contactus </h4>
                                    <!-- <h4 class="box-h"><a href="manage_categories.php">Add Categories</a></h4> -->

                                </div>
                                <div class="card-body--">
                                    <div class="table-stats order-table ov-h">
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th class="serial">sr.No</th>
                                                    <th class="avatar">ID</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile</th>
                                                    <th>Comment</th>
                                                    <th>Date</th>
                                                    <th></th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $i=1;
                                                while($row=mysqli_fetch_assoc($result)){?>
                                                    <tr>
                                                        <td class="serial"><?php echo $i; ?></td>
                                                        
                                                        <td><?php echo $row['id'];?></td>
                                                        <td><?php echo $row['name'];?></td>
                                                        <td><?php echo $row['email'];?></td>
                                                        <td><?php echo $row['mobile'];?></td>
                                                        <td><?php echo $row['comment'];?></td>
                                                        <td><?php echo $row['added_on'];?></td>
                                                        <td>
                                                            <?php 
                                                                
                                                                echo '&nbsp<a href="?type=delete&id='.$row['id'].'"><span class="badge badge-delete">Delete</span></a>&nbsp';
                                                                // echo '&nbsp<a href="?type=edit&id='.$row['id'].'">Edit</a>&nbsp';

                                                            
                                                            ?>
                                                        </td>
                                                    </tr>
                                                
                                                <?php $i++; }?>
                                                  
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