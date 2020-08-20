<?php 
require('top.inc.php');
if(isset($_GET['type']) && $_GET['type']!=''){
    $type=get_safe_value($con,$_GET['type']);
  
    if($type=='delete'){
    $id=get_safe_value($con,$_GET['id']);
    $delete_sql="DELETE FROM user WHERE user_id='$id'";
    mysqli_query($con,$delete_sql);
    }
}

$sql="SELECT * FROM user ORDER BY user_id desc ";
$res=mysqli_query($con,$sql);

?>
         <div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">USERS</h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">#</th>
                                       <th class="avatar">ID</th>
                                       <th>First Name</th>
                                       <th>Last Name</th>
                                       <th>Mobile</th>
                                       <th>Email</th>
                                       <th>Date</th>
                                       <th>Options</th>
                                       </tr>
                                 </thead>
                                 <tbody>
                                     <?php
                                     $i=1;
                                     while($row=mysqli_fetch_assoc($res)){?>
                                    <tr>
                                       <td class="serial"><?php echo $i?></td>
                                       <td> <?php echo $row['user_id']?> </td>
                                       <td> <span class="name"><?php echo $row['first_name']?></span> </td>
                                       <td> <span class="name"><?php echo $row['last_name']?></span> </td>
                                       <td> <span class="name"><?php echo $row['mobile']?></span> </td>
                                       <td> <span class="name"><?php echo $row['email']?></span> </td>
                                       <td> <span class="name"><?php echo $row['register_date']?></span> </td>
                                       <td> <span class="product box-link"><?php
                                           echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['user_id']."'>Delete</a></span>";                      
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