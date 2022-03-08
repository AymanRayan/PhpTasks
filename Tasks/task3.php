<form action="task3.php" method="post">
    <label for="name">The Name</label>
    <input type="text" name="name" placeholder="Enter Your name" id="name">
    <br>
    <label for="email">The Email</label>
    <input type="email" name="email" placeholder="Enter Your Email" id="email">
    <br>
    <label for="password">The Password</label>
    <input type="password" name="password" placeholder="Enter Your password" id="password">
    <br>
    <label for="address">The Addresses</label>
    <input type="text" name="address" placeholder="Enter Your address" id="address">
    <br>
    <label for="link">The LinkedIn Url</label>
    <input type="text" name="link" placeholder="Enter Your LinkedIn" id="link">
    <br>
    <input type="submit" value="Register" name="submit">

</form>
<?php
if(isset($_POST['submit'])){
    verification();
}

function verification(){
    $name = nameVerified($_POST['name']);
    $email = mailVerified($_POST['email']);
    $password = passVerified($_POST['password']);
    $address = addressVerified($_POST['address']);
    $link = isAlink($_POST['link']);
    echo $name ."<br>". $email ."<br>".$password ."<br>".$link ."<br>".$address."<br>";
}

function nameVerified($nam){
    if(empty($nam)){
        $message = "Name is required";
        return $message;
    }else{
        if(ctype_alpha($nam)){
            return $nam;
        }else{
            $message = "$nam contains other char not a string";
            return $message;
        }  
    } 
}
function mailVerified($mail){
    if(empty($mail)){
        $message = "Email is required";
        return $message;
    }else{
        if (filter_var($mail, FILTER_VALIDATE_EMAIL)){
            return $mail;
        }else{
            $message = "$mail is not a valid email"; 
            return $message;
        }
    }
}
function addressVerified($addr){
    if(empty($addr)){
        $message = "Address is required";
        return $message;
    }else{
        if(strlen($addr) >= 10){
            return $addr;
        }else{
            $message = "$addr is not a valid Address";
            return $message;
        } 
    }  
}
function passVerified($pass){
    if(empty($pass)){
        $message = "Password is required";
        return $message;
    }else{
        if(strlen($pass) >= 6){
            return $pass;
        }else{
            $message = "$pass is not a valid password";
            return $message;
        }
    }
}
function isAlink($url){
    if(empty($url)){
        $message = "LinkedIn url is required";
        return $message;
    }else{
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            return $url;
        }else{
            $message = "$url is not a valid URL";
            return $message;
        }
    }
}


?>