<?php
session_start();
// session_unset();
// session_destroy();

//form data
    
    $errors = [];
    $content =[];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $title =$_POST["Title"] ;
    $article =$_POST["Article"] ;
    $fileName = $_FILES['img']['name'];

    if(!empty($fileName)){
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
        
     }else{
        $GLOBALS['errors']["img"] = "Required input"; 
    }

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
    
    printErrorMessage($GLOBALS['errors'],"Title");
    printErrorMessage($GLOBALS['errors'],"Article");
    printErrorMessage($GLOBALS['errors'],"img");
    if(!isThereAProblem($GLOBALS['errors'])){
        $GLOBALS['content']["title"] = $title;
        $GLOBALS['content']["article"] = $article;
    } 
}

print_r($content);
$_SESSION['Posts'] = $content;
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
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Post here</h2>

        <form action="<?php echo  $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="Name" aria-describedby=""   name="Title" placeholder="The Topic's Title">
            </div>
           <?php
           // printErrorMessage($errors,"Title");
              
            ?>

            <div class="form-group">
                <label for="Article">What's in your mind?</label>
                <textarea class="form-control" id="Article" name="Article" rows="5" cols="40"></textarea>
            </div>
            <?php
            //printErrorMessage($errors,"Article");
             ?>

            <div class="form-group">
                <label for="myimg">Upload Image</label>
                <input type="file" class="form-control" id="myimg" name="img">
            </div>
            <?php
            //printErrorMessage($errors,"img"); 
            ?>

            <button type="submit" class="btn btn-primary">Submit</button>
           <!-- <span style=" <?php 
            //if(isThereAProblem($errors)){
            //echo "visibility:hidden";
           // }else{
           //     echo "visibility:visibale";
           // } 
            ?>"><button  class="btn btn-success"><a href="./blog.php" style="text-decoration:none; color:#FFF; " >Go!!</a></button></span>-->
        </form>
    </div> 
</body>
</html>   