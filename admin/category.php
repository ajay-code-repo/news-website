<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <?php 
                include "config.php";
                $limit = 3;
                if(isset($_GET["page"])){
                    $page = $_GET["page"];
                }
                else{
                    $page = 1;
                };
                $offset = ($page-1)* $limit;
                $sql="SELECT * FROM  category ORDER BY category_id DESC Limit $offset,$limit";
                $result=mysqli_query($con,$sql) or die ("query unsuccessfull");
                if(mysqli_num_rows($result)>0){
                ?>
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php $serrial=1; while($row=mysqli_fetch_assoc($result)){
                             ?>
                           <tr>
                            <td class='id'><?php echo $serrial ?></td>
                            <td><?php echo $row['category_name'];?></td>
                            <td><?php echo $row['post'];?></td>
                            <td class='edit'><a href='update-category.php'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <?php $serrial++;
                        }
                    ?>
                    </tbody>
                </table>
                <?php 
                }
                $sql1 = "SELECT COUNT(category_id) FROM category";
                $result_1 = mysqli_query($con,$sql1);
                $row_db = mysqli_fetch_row($result_1);
                $total_record = $row_db[0];
                $total_page = ( $total_record / $limit);
                echo  "<ul class='pagination admin-pagination'>";
                if($page>1){
                    echo "<li><a href='category.php?page=".($page-1)."'>Prev</a></li>";
                }
                if($total_record > $limit){
                    for ($i=1; $i<=$total_page ; $i++) {
                        if($i == $page){
                            $cls ='btn-primary active';
                        }else{
                            $cls ='btn-primary';
                        }
                        echo"<li><a href='category.php?page=".$i."' class='{$cls}'>$i</a></li>";
                    }
                }

                if($total_page>$page){
                    echo"<li> <a href='category.php?page=".($page+1)."'>Next</a></li>";
                }
            echo "</ul>";
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
