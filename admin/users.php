 <?php
 ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
  include "header.php";
  if($_SESSION['user_role']==0){
    header("Location:$hostname/admin/post.php");
  }
  
   ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                <?php
                include "config.php";
                $limit = 3;
                if(isset($_GET['page'])){
                  $page =$_GET['page'];
                }else{
                  $page = 1;
                }
                $offset = ($page-1)*$limit; 
                $sql = "select * from user order by user_id desc limit {$offset},{$limit}";
                $result = mysqli_query($connection,$sql) or die("query unsuccesful");
                if(mysqli_query($connection,$sql)){ 
                ?>
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php 
                        while($row = mysqli_fetch_assoc($result)){
                        ?>
                          <tr>
                              <td class='id'><?php echo $row['user_id'];?></td>
                              <td><?php echo $row['first_name'] ."". $row['last_name'];?></td>
                              <td><?php echo $row['username'];?></td>
                              <td><?php
                              if($row['role']==1){
                                echo"admin";
                              }else{
                                echo"normal user";
                              }
                              ?>
                              </td>
                              <td class='edit'><a href='update-user.php?id=<?php echo $row['user_id'];?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-user.php?id=<?php echo $row["user_id"]; ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php } ?>
                      </tbody>
                  </table>
                  <?php
                } 
                $sql1 = "select * from user";
                $result1 = mysqli_query($connection,$sql1) or die("query unsuccesful");
                if(mysqli_num_rows($result1)>0){
                  $totalrecords = mysqli_num_rows($result1);
                  $total_pages =ceil($totalrecords/$limit);
                  echo  "<ul class='pagination admin-pagination'>";
                  if($page>1){
                    echo '<li><a href="users.php?page='.($page-1).'">prev</a></li>';
                  }
             
                  }
                  for($i=1;$i<=$total_pages;$i++){
                    if($i==$page){
                      $active ="active";
                    }else{
                      $active = "";
                    } 
                    echo '<li class="'.$active.'"><a href="users.php?page='.$i.'">'.$i .'</a></li>';
                  }
                  if( $total_pages > $page){
                    echo '<li><a href="users.php?page='.($page+1).'">next</a></li>';
                  }
                  echo ' </ul>';
                  ?>
              </div>
          </div>
      </div>
  </div>
<?php include "header.php"; ?>
