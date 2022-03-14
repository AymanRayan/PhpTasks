<?php
require_once 'dbconnection.php';

$sql = "select id ,title , article , url from blog";

$blogData = mysqli_query($opp,$sql);

function deleteThePost ($id){
    $deleteSql = "delete from blog where id=$id";
    $del = mysqli_query($GLOBALS['opp'],$deleteSql);
    if(!$del){
    echo "error ".mysqli_error($GLOBALS['opp']);
}
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
    <?php 
    while($data = mysqli_fetch_assoc($blogData)){
    ?>
<div class="container my-4">
<h5><?php 
echo $data['title'];
//echo $_SESSION['Posts']['title'];
//echo $theContent['title'];
    ?>
    </h5>
  <div>
    <p><?php
    echo $data['article'];
     //echo $_SESSION['Posts']['article'];
     //echo $theContent['article'];
     ?></p>
    <img width=400px; height="300px"  src="./<?php
    echo $data['url'];
     //echo $_SESSION['Posts']['imgUrl'];
     //echo $theContent['imgUrl'];
     ?>">
     </div>
     <div class="mt-2">
     <form method="post">
    <button  name="delete" value="<?php echo $data['id'];?>" class="btn btn-danger">Delete</button>
    </form>
    </div>
</div>
<?php
}
if(isset($_POST['delete'])){
    deleteThePost($_POST['delete']);
}


?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
