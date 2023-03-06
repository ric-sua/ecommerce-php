<?php 

include('model/database.php');

global $sql;

  $sql = "SELECT Products.*, Categories.*, Specs.* ,Discount.* FROM Products, Categories, Specs, Discount WHERE Products.categoryId = Categories.categoryId AND Products.productId = Specs.productId AND Specs.specId = Discount.specId";
  
  
  $statement = $db->prepare($sql);
          $statement->execute();
          $result = $statement->fetchAll();
          
          $outp = "";
  $item_array = array();
  
  foreach($result as $rs) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"id":"'  . $rs["productId"] . '",';
    $outp .= '"sid":"'  . $rs["specId"] . '",';
    $outp .= '"name":"'  . $rs["productName"] . '",';
    $outp .= '"des":"'   . $rs["cpuType"]        . ' ' . $rs["ram"]        . ' ' . $rs["storage"]        . ' ' . $rs["graphics"]        .'",';
    $outp .= '"manu":"'   . $rs["manufacturer"]        . '",';
    $outp .= '"stor":"'   . $rs["storage"]        . '",';
    $outp .= '"cores":"'   . $rs["cores"]        . '",';
    $outp .= '"ram":"'   . $rs["ram"]        . '",';
    $outp .= '"price":"'. $rs["price"]     . '",';
    $outp .= '"cat":"'. $rs["categoryName"]     . '",';
    $outp .= '"img":"'. $rs["image"]     . '",';
    $outp .= '"disPer":"'. $rs["discountPercent"]     . '"}';
    $item_array[] = $rs["productId"];
  }
  $outp ='{"records":['.$outp.']}';
  
  echo($outp);
  
  $statement->closeCursor();

 ?>