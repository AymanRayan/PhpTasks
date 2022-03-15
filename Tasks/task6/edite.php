<?php
require 'dbConnection.php';

$id = $_GET['id'];

$sql = "select * from blog where id = $id";
$op = mysqli_query($opp,$sql);
$data = mysqli_fetch_assoc($op);
   
$errors = [];
$content =[];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

$title =$_POST["Title"] ;
$article =$_POST["Article"] ;
$fileName = $_FILES['img']['name'];

if(empty($title)){
    $GLOBALS['errors']['Title'] = "Required Field ";
  }elseif(!ctype_alpha($title)){
    $GLOBALS['errors']['Title'] = "The Title must contain alpha chars only";
}
 


if(empty($article)){
    $GLOBALS['errors']['Article']  = "Required Field"; 
  }elseif(strlen($article) < 10){
    $GLOBALS['errors']['Article']  = "Article can't be less than 50 ch"; 
}



if(!empty($fileName) && !isThereAProblem($GLOBALS['errors'])){
    $filetype = $_FILES['img']['type'];
    $fileTempName = $_FILES['img']['tmp_name'];
    $fileArr = explode('/', $filetype);
    $fileExt = end($fileArr);
    if(!in_array($fileExt ,['jpeg' ,'png'])){
        $GLOBALS['errors']["img"] = "Img must be png or jpg only.";
    }else{
        $imgName = time() . rand().'.'.$fileExt;
        $path = 'img/'.$imgName;
        if (move_uploaded_file($fileTempName, $path)) {
            $GLOBALS['content']["imgUrl"]=$path;
        } else {
            echo 'Error at uploading';
        }
    }
}


printErrorMessage($GLOBALS['errors'],"Title");
printErrorMessage($GLOBALS['errors'],"Article");
printErrorMessage($GLOBALS['errors'],"img");

if(!isThereAProblem($GLOBALS['errors']) && isset($_POST['submit'])){
    if(!empty($fileName)){
    $url = $GLOBALS['content']['imgUrl'];
    if($url != $GLOBALS['data']['url']){
        unlink($GLOBALS['data']['url']);
        $sql = "update blog set title ='$title', article = '$article' ,url = '$url' where id = $id";
        $op = mysqli_query($opp,$sql);
    }
    }else{
        $img=$GLOBALS['data']['url'];
        $sql = "update blog set title ='$title', article = '$article' ,url ='$img' where id = $id";
        $op = mysqli_query($opp,$sql);
    }

    mysqli_close($opp);
    header("location: blog.php");
} 

}

function isThereAProblem(array $arr){
    $re=False;
    if(count($arr) > 0){
     $re=true;
    }
    return $re;
}
function printErrorMessage(array $err,$key){
    if(count($err) > 0 ){
        foreach ($err as $k => $v) {
            if($key == $k){
               echo '<div class="alert alert-danger">
                     <strong>Danger!</strong>' .$k.' : '.$v.'</div>';
            }
        }
    }else{
        echo '<div class="alert alert-success">
        <strong>Success!</strong> Data Saved Successfully.
      </div>';
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit the post</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Post here</h2>

        <form action="edite.php?id=<?php echo $data['id'] ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="Name" aria-describedby=""   name="Title" placeholder="The Topic's Title" value="<?php echo $data['title']?>">
            </div>
           <?php
        
              
            ?>

            <div class="form-group">
                <label for="Article">What's in your mind?</label>
                <textarea class="form-control" id="Article" name="Article" rows="5" cols="40" ><?php echo $data['article']?></textarea>
            </div>
            <?php
            
             ?>

            <div class="form-group">
                <label for="myimg">Upload Image</label>
                <input type="file" class="form-control" id="myimg" name="img">
                <img src="<?php echo $data['url']?>" alt="">
            </div>
            <?php
           
            ?>

            <button type="submit" name="submit" class="btn btn-primary">Save</button>
        </form>
    </div> 
</body>
</html>   