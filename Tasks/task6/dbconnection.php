<?php

$server = "localhost"; //127.0.0.1
$dbName =  "task6";
$dbUser = "root";
$dbPassword ="";

//open the connection by build in function.
 $opp = mysqli_connect($server,$dbUser,$dbPassword,$dbName);

if(!$opp){
    //echo 'connected';
//}else{
    //die fun execute btw braket code then finish/quit/stop the running script code
    die('error'.mysqli_connect_error());
}

?>