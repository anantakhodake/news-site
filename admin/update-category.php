<?php
    ini_set ('display_errors', 1);  
    ini_set ('display_startup_errors', 1);  
    error_reporting (E_ALL);  
include "header.php";

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="adin-heading"> Update Category</h1>
            </div>
            <?php
            include "config.php";
            $category_id = $_GET['id'];
            $sql = "select * from category where category_id = '{$category_id}' ";
            $result = mysqli_query($connection, $sql) or die("query failed");
            if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
                        
            if (isset($_POST['submit'])) {
                echo"ananta";
                include "config.php";
                $category_id = mysqli_real_escape_string($connection, $_POST['cat_id']);
                $category_name = mysqli_real_escape_string($connection, $_POST['cat_name']);
                $sql = "update category set category_name='$category_name' where category_id='$category_id'";
            echo $sql;
                // $result= mysqli_query($connection,$sql) or die("query failed");
                if (mysqli_query($connection, $sql)) {
                    header("Location:$hostname/admin/category.php");
                }
            }else{
                echo 'else';
            }
            ?>
                    <div class="col-md-offset-3 col-md-6">
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="cat_id" class="form-control" value="<?php echo $row['category_id']; ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name']; ?>" placeholder="" required>

                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                        </form>
                <?php
                }
            
                ?>
                    </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>