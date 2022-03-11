<?php
session_start();
$content = $_SESSION['Posts'];
//print_r($_SESSION['Posts']);

//convert data to json for the file
$toJson = json_encode($content); 
$addToFile = fopen('posts.txt','w') or die ('unable to open file');
fwrite($addToFile,$toJson);

//read and get the data as object
$readedData =fopen('posts.txt','r') or die ('unable to open file');
$theJson=fread($readedData,filesize('posts.txt'));
$toObject=json_decode($theJson);

//print_r($toObject);
//convert data from object to array
$theContent=[];
foreach($toObject as $k => $v){
    $theContent +=[
        $k => $v
    ];
}
//print_r($theContent);
//echo $theContent['imgUrl'];

if(isset($_POST['delete'])){
    fclose($addToFile);
    unlink("posts.txt");
    session_destroy();
    echo "data is deleted";
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
<div class="container my-4">
<h5><?php 
//echo $_SESSION['Posts']['title'];
echo $theContent['title'];
    ?>
    </h5>
  <div>
    <p><?php
     //echo $_SESSION['Posts']['article'];
     echo $theContent['article'];
     ?></p>
    <img width=400px; height="300px"  src="./<?php
     //echo $_SESSION['Posts']['imgUrl'];
     echo $theContent['imgUrl'];
     ?>">
     </div>
     <div class="mt-2">
     <form method="post">
    <button name="delete" class="btn btn-danger">Delete</button>
    </form>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
