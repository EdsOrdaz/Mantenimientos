
<?php
$myObj = new stdClass();
$myObj->name = "Geeks";
$myObj->college="NIT";
$myObj->gender = "Male";
$myObj->age = 30;
  
$myJSON = json_encode($myObj);
  
echo $myJSON;
?>