<form action="task2.php" method="post">
    <label>The Letter</label>
    <input type="text" name="theLetter" placeholder="Enter the letter">
    <br>
    <input type="submit" name='submision' value="Show the Next letter">

</form>
<?php
$theLetter =$_POST['theLetter'];
function getTheResult($x){
    $arr=['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
    $r="";
    for($i = 0; $i < count($arr); $i++){
        if($x == $arr[$i]){
            if($i == 25){
             $r = $arr[0];
            }else{
             $r = $arr[$i +1];
            }
        }
    }
    return $r;
}
function printNextLetter($letter){
    $result = getTheResult($letter);
    if(!$result){
        echo "The date should be in LOWER case!!";
    }else{
        echo "The Next Letter is: '".$result."'.";
    } 
}
if(isset($_POST['submision'])){
    printNextLetter($theLetter);
}
//note
//nextchar = ++char 
//as ASCII code 
?>
<<<<<<< HEAD
=======

>>>>>>> e9d2ecda4241185b80428f10cf474d3ba1f2dd3e
