<form action="task1.php" method="post">
    <label>The Consumption</label>
    <input type="number" name="theConsumption" placeholder="Enter Your consumption">
    <br>
    <input type="submit" value="Show the cost">

</form>


<?php

$theConsumption=$_POST["theConsumption"];
$theCost = (50 * 3.5);
if($theConsumption > 150 ){
  $theCost += (100 * 4) + (($theConsumption - 150) * 6.5);
  echo "Your Consumption costs = ",$theCost , " L.E";
}elseif($theConsumption > 50 || $theConsumption >= 100){
  $theCost += ($theConsumption - 50) * 4;
  echo "Your Consumption costs = ",$theCost , " L.E";
}elseif($theConsumption > 0 && $theConsumption <= 50){
  $theCost = $theConsumption * 3.5;
  echo "Your Consumption costs = ",$theCost , " L.E";
}else{
    echo "The Consumption must be positive number";
}

?>