<?php

include ("top.inc.php");

if(isset($_GET['type']) && $_GET['type']!='')
{
    // This code for active deactive opration
    $type = get_safe_value($con,$_GET['type']);
    if($type=='status')
    {
        $opration = get_safe_value($con,$_GET['opration']);
        $id = get_safe_value($con,$_GET['id']);
        // echo $opration;
        // echo $id;

        if($opration=='active')
        {
            $status='1';
        }
        else
        {
            $status='0';
        }

        $update_status_sql = "update categories set status='$status' where id='$id'";
        mysqli_query($con,$update_status_sql);


    }

    //this code for delete category from the database
    $type = get_safe_value($con,$_GET['type']);
    if($type=='delete')
    {
        
        $id = get_safe_value($con,$_GET['id']);
        $delete_sql = "delete from  categories  where id='$id'";
        mysqli_query($con,$delete_sql);


    }
}
// this query for dispalying content in table below
$sql = "select * from categories order by categories asc";
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
                                    <h4 class="box-title">Categories </h4>
                                    <h4 class="box-h"><a href="manage_categories.php?type=addcat">Add Categories</a></h4>

                                </div>
                                <div class="card-body--">
                                    <div class="table-stats order-table ov-h">
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th class="serial">#</th>
                                                    <th class="avatar">ID</th>
                                                    <th>Categories</th>
                                                    <th>status</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $i=1;
                                                while($row=mysqli_fetch_assoc($result)){?>
                                                    <tr>
                                                        <td class="serial"><?php echo $i; ?></td>
                                                        
                                                        <td><?php echo $row['id'];?></td>
                                                        <td><?php echo $row['categories'];?></td>
                                                        <td>
                                                            <?php 
                                                            if($row['status']==1)
                                                            {
                                                                // echo "Active";
                                                                echo '<a href="?type=status&opration=deactive&id='.$row['id'].'"><span class="badge badge-complete">Active</span></a>&nbsp';
                                                            }
                                                            else
                                                            {
                                                                // echo "Deactive";
                                                                echo '<a href="?type=status&opration=active&id='.$row['id'].'"><span class="badge badge-pending">Deactive</span></a>&nbsp';

                                                            }
                                                            echo '&nbsp<a href="manage_categories.php?type=edit&id='.$row['id'].'"><span class="badge badge-edit">Edit</span></a>&nbsp';
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