<?php
include "config.php";
$post_id=$_GET['id'];
$catid=$_GET['catid'];
$sql1="SELECT * FROM post WHERE post_id={$post_id}";
$result1=mysqli_query($con,$sql1) or die ("query failled");
$row=mysqli_fetch_assoc($result1);
unlink("upload/".$row['post_img']);
$sql="DELETE FROM post WHERE post_id={$post_id};";
$sql.="UPDATE category SET post=post-1 WHERE category_id={$catid}";
if(mysqli_multi_query($con,$sql)){
    header("Location: http://localhost/news-site/admin/post.php");
}else{
    echo "queru failled";
}
?>