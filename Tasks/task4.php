<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    //form data
    $name =$_POST["Name"] ;
    $email =$_POST["Email"] ;
    $password =$_POST["Password"] ;
    $address =$_POST["Address"];
    $gender=$_POST["Gender"];
    $link=$_POST["Link"];
   
    //file data
   

    $errors = []; 

    if(!empty($fileName = $_FILES['Cv']['name'])){
        $filetype = $_FILES['Cv']['type'];
        $fileTempName = $_FILES['Cv']['tmp_name'];
        $fileArr = explode('/', $filetype);
        $fileExt = end($fileArr);
        if($fileExt != "pdf"){
            $errors["Cv"] = "Cv file must be in PDF";
        }else{
            $cvName = time() . rand().'.pdf';
            $path = 'cv/'.$cvName;
            move_uploaded_file($fileTempName,$path); 
        }
        
     }else{
        $errors["Cv"] = "The Cv is required"; 
    }
     

    if(empty($name)){
        $errors['Name'] = "Required Field ";
      }elseif(!ctype_alpha($name)){
        $errors['Name'] = "The name must contain alpha chars only";
    }
     

    if(empty($email)){
        $errors['Email']  = "Required Field"; 
      }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors['Email']  = "Invalid Format"; 
    }


    if(empty($password)){
          $errors['Password']  = "Required Field"; 
       }elseif(strlen($password) < 6){
        $errors['Password']  = "Length Must Be >= 6 Chars"; 
    }
    

    if(empty($address)){
          $errors['address'] = "Address is Required";
      }elseif(strlen($address) < 10){
        $errors['address'] = "Address must contain 10 Chars";
    }


    
    if(empty($gender)){
        $errors['Gender'] = "Gender is required!";
      }elseif(!in_array($gender,['male','female'])){
        $errors['Gender'] = "Please choose one.";
    } 


    if(empty($link)){
        $errors['Link']  = "LinkedIn Url is a required"; 
        }elseif(!str_contains($link,"linkedin")){
            $errors['Link']  = "That's Not Linkedin account"; 
        }elseif(filter_var($link,FILTER_VALIDATE_URL)){
            $errors['Link']  = "please enter a valid URL";
       
    }

      
  //print_r($errors);
      
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
        <h2>Register</h2>

        <form action="<?php echo  $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="Name">Name</label>
                <input type="text" class="form-control" id="Name" aria-describedby=""   name="Name" placeholder="Enter Name">
            </div>
           <?php
           //if(isset($_POST['submit'])){
            printErrorMessage($errors,"Name");
               //}
            ?>

            <div class="form-group">
                <label for="Email">Email address</label>
                <input type="text" class="form-control" id="Email" aria-describedby="emailHelp" name="Email" placeholder="Enter email">
            </div>
            <?php printErrorMessage($errors,"Email"); ?>

            <div class="form-group">
                <label for="Password">New Password</label>
                <input type="password" class="form-control" id="Password" name="Password" placeholder="Password">
            </div>
            <?php printErrorMessage($errors,"Password"); ?>

            <div class="form-group">
                <label for="Address">Address</label>
                <input type="text" class="form-control" id="Address" name="Address" placeholder="Enter address">
            </div>
            <?php printErrorMessage($errors,"Address"); ?>

            <div class="form-group">
                <label for="gender">Gender</label>
                <select name="Gender" id="gender" class="form-control">
                <option value="male">Male</option> 
                <option value="female">Female</option>  
                </select>
            </div>
            <?php printErrorMessage($errors,"Gender"); ?>

            <div class="form-group">
                <label for="Link">LinkedIn URL</label>
                <input type="text" class="form-control" id="Link" name="Link" placeholder="Enter your Linkedin Url">
            </div>
            <?php printErrorMessage($errors,"Link"); ?>

            <div class="form-group">
                <label for="mycv">Upload your CV</label>
                <input type="file" class="form-control" id="mycv" name="Cv">
            </div>
            <?php printErrorMessage($errors,"Cv"); ?>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div> 
</body>
</html>   