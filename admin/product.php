<?php 
require('top.inc.php');
if(isset($_GET['type']) && $_GET['type']!=''){
    $type=get_safe_value($con,$_GET['type']);
    if($type=='status'){
        $operation=get_safe_value($con,$_GET['operation']);
        $id=get_safe_value($con,$_GET['id']);
    
    if($operation=='active'){
        $status='1';
    }else{
    $status='0';
    }
    $update_status="UPDATE product SET status='$status' WHERE item_id='$id'";
    mysqli_query($con,$update_status);
    }
    if($type=='delete'){
    $id=get_safe_value($con,$_GET['id']);
    $delete_sql="DELETE FROM product WHERE item_id='$id'";
    mysqli_query($con,$delete_sql);
    }
}

$sql="SELECT * FROM product ORDER BY item_id asc ";
$res=mysqli_query($con,$sql);

?>
         <div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Product</h4>
                           <h4 ><a href="manage_product.php">Add Products</a></h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">#</th>
                                       <th class="avatar">ID</th>
                                       <th>Category</th>
                                       <th>Name</th>
                                       <th>MRP</th>
                                       <th>Selling Price</th>
                                       <th>Quantity</th>
                                       <th>Image</th>
                                       <th>Short Desc</th>
                                       <th>Long Desc</th>
                                       <th>Status</th>
                                       <th></th>
                                       </tr>
                                 </thead>
                                 <tbody>
                                     <?php
                                     $i=1;
                                     while($row=mysqli_fetch_assoc($res)){?>
                                    <tr>
                                       <td class="serial"><?php echo $i?></td>
                                       <td> <?php echo $row['item_id']?> </td>
                                       <td> <span class="name"><?php echo $row['item_brand']?></span> </td>
                                       <td> <?php echo $row['item_name']?> </td>
                                       <td> <?php echo $row['item_mrp']?> </td>
                                       <td> <?php echo $row['item_price']?> </td>
                                       <td> <?php echo $row['qty']?> </td>
                                       <td> <img src="../assets/<?php echo $row['item_image']?>"> </td>
                                       <td> <?php echo $row['short_desc']?> </td>
                                       <td> <?php echo $row['description']?> </td>
                                       <td> <?php echo $row['status']?> </td>
                                       <td> <span class="product box-link"><?php
                                       if($row['status']==1){
                                           echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['item_id']."'>Active</a></span>&nbsp;&nbsp;";
                                       }else{
                                           echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['item_id']."'>Deactive</a></span>&nbsp;&nbsp;";
                                       }
                                           echo "<span class='badge badge-edit'><a href='manage_product.php?&id=".$row['item_id']."'>Edit</a></span>&nbsp;&nbsp;";
                                           echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['item_id']."'>Delete</a></span>";                      
                                       ?>
                                       </span> </td>
                                    </tr>
                                    <?php }?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </div>
         <div class="clearfix"></div>
         <?php 
         require('footer.inc.php');
         ?>