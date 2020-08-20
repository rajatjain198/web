<?php 
require('top.inc.php');
if(isset($_POST['update'])){
    $status=get_safe_value($con,$_POST['status']);
    $order_id=$_POST['order_id'];
    
    
    $update_sql="UPDATE orders SET order_status='$status' WHERE id='$order_id'";
    mysqli_query($con,$update_sql);
    
}

$sql="SELECT * FROM orders ORDER BY id desc ";
$res=mysqli_query($con,$sql);

?>
         <div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">ORDERS</h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">#</th>
                                       <th>Order Date</th>
                                       <th class="avatar">Order ID</th>
                                       <th>User ID</th>
                                       <th>Product ID</th>
                                       <th>Address</th>
                                       <th>Payment Type</th>
                                       <th>Total Price</th>
                                       <th>Payment Status</th>
                                       <th>Order Status</th>
                                       <th>Update Order</th>
                                       <th>Status</th>
                                       </tr>
                                 </thead>
                                 <tbody>
                                     <?php
                                     $i=1;
                                     while($row=mysqli_fetch_assoc($res)){
                                         $pid='';
                                         $oid=$row['id'];
                                         $pid=mysqli_query($con,"SELECT product_id FROM order_detail WHERE order_id='$oid'");
                                         $an=mysqli_fetch_assoc($pid);
                                         ?>
                                    <tr>
                                       <td class="serial"><?php echo $i?></td>
                                       <td> <?php echo $row['added_on']?> </td>
                                       <td> <?php echo $row['id']?> </td>
                                       <td> <span class="name"><?php echo $row['user_id']?></span> </td>
                                       <td> <span class="name"><?php echo $an['product_id']  ?></span> </td>
                                       <td> <span class="name"><?php echo $row['address']?><?php echo $row['city']?><?php echo $row['state']?><?php echo $row['pincode']?></span> </td>
                                       <td> <span class="name"><?php echo $row['payment_type']?></span> </td>
                                       <td> <span class="name"><?php echo $row['total_price']?></span> </td>
                                       <td> <span class="name"><?php echo $row['payment_status']?></span> </td>
                                       <td> <span class="name"><?php echo $row['order_status']?></span> </td>
                                       <td> <form method="post">
                                           <input type="hidden" name="order_id" value="<?php echo $row['id']?>">
                                           <select name="status" id="status" placeholder="Order Status"class="form-control" required>
                                                <option <?php echo ($row['order_status'] == "Placed")?'selected':"" ?> value="Placed">Placed</option>
                                                <option <?php echo ($row['order_status'] == "Shipped")?'selected':"" ?> value="Shipped">Shipped</option>
                                                <option <?php echo ($row['order_status'] == "Out for Delivery")?'selected':"" ?> value="Out for Delivery">Out for Delivery</option>
                                                <option <?php echo ($row['order_status'] == "Delivered")?'selected':"" ?> value="Delivered">Delivered</option>
                                            </select></td>
                                      <td><span class="product box-link"> <button type="submit" name="update" class="btn btn-secondary rounded text-light px-1">Update</button>
                                       </span></form> </td>
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