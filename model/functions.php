<?php

function view_products(){
  global $db;
  $sql = "SELECT Products.*, Categories.*, Specs.* ,Discount.* FROM Products, Categories, Specs, Discount WHERE Products.categoryId = Categories.categoryId AND Products.productId = Specs.productId AND Specs.specId = Discount.specId";


$statement = $db->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();

return $result;
}

function all_products(){
  global $db;
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

// echo($outp);

$statement->closeCursor();

return $outp;
}

function select_all_users($uid){
    global $db;
        $query = 'SELECT * 
        FROM Users, Payment
        WHERE Users.userId = Payment.userId AND Users.userId = :u'; 
        $statement = $db->prepare($query);
        $statement->bindValue(':u', $uid);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;
}

function signup($username,$first_name,$last_name,$email,$password,$password2){
    global $db;
    $checkIfExists = "SELECT * FROM Users WHERE username = :usr OR email =  :eml";
    $statement = $db->prepare($checkIfExists);
    $statement->bindValue(':usr', $username);
    $statement->bindValue(':eml', $email);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
      if($password !== $password2){
          echo "invalid credentials. Redirecting now....";
          header('Refresh:2; url= view/account/signup.php');
      }
      else if($result){
      echo "Username or email already exists";
      header('Refresh:2; url= view/account/signup.php');
    }
    else {
    
        $sql = "INSERT INTO Users (firstName, lastName, email, pass, username)
    VALUES (:fn, :ln, :eml, :ps, :usr);";
     $s = $db->prepare($sql);
     $s->bindValue(':usr', $username);
        $s->bindValue(':eml', $email);
        $s->bindValue(':fn', $first_name);
        $s->bindValue(':ln', $last_name);
        $s->bindValue(':ps', $password);
     $s->execute();

     $s->closeCursor();

     $sql = "INSERT INTO Payment (userid) SELECT userId FROM Users WHERE Users.email = :eml;";
     $t = $db->prepare($sql);
     $t->bindValue(':eml', $email);
     $t->execute();
     $t->closeCursor();
    
    if ($s->rowCount() > 0) {
      $loginCred = "SELECT * FROM Users WHERE username = :usr ";
       $user = $db->prepare($loginCred);
       $user->bindValue(':usr', $username);
     $user->execute();
     $user_fetch = $user->fetchAll();
     $user->closeCursor();
    } else {
      echo "Error: something went wrong during login";
    }
}
return $user_fetch;
}

function signin($username,$password){
  global $db;
    $checkIfExists = "SELECT * FROM Users WHERE username = :usr AND pass =  :pass";
    $statement = $db->prepare($checkIfExists);
    $statement->bindValue(':usr', $username);
    $statement->bindValue(':pass', $password);
        $statement->execute();
        $users = $statement->fetchAll();
        $statement->closeCursor();
        return $users;
}

function add_to_cart($productId,$specId,$quantity,$price,$discount,$uid){
  global $db;
	
		$ch = "SELECT * FROM `Cart` JOIN Products on Products.productId = Cart.productId 
    Join Specs on Specs.specId = Cart.specId 
    WHERE Cart.productId = :pdId AND Cart.userId = ". $uid ." AND Cart.specId = :spId ";
		
		$cart = $db->prepare($ch);
    $cart->bindValue(':pdId', $productId);
    $cart->bindValue(':spId', $specId);
        $cart->execute();
        $content = $cart->fetchAll();
        $cart->closeCursor();
		
		if($cart->rowCount() > 0)
		{
			 foreach($content as $c){
				 $am = "";
                 $total = $price * (1 - ($discount/100));
				 if($c["quantity"] >= $c["amount"]){
					$_SESSION["msg"] = "yes";
          $amtu = $c["amount"];
          $adder = round((($c["amount"]) * $total) + 4.99, 2);
          $carid = $c['cartId'] ;
					$s = "UPDATE `Cart` SET `quantity` = ${amtu}, finalPrice = ${adder} WHERE `Cart`.`CartId` = ${carid} ";
				 }
				else{
					$am = $c["quantity"];
          $adder = round((($c["quantity"]+1) * $total) + 4.99, 2);
          $carid = $c['cartId'];
					$s = "UPDATE `Cart` SET `quantity` = ${am}+1, finalPrice = ${adder} WHERE `Cart`.`CartId` = ${carid} ";
				}
		
				 
				$ct = $db->prepare($s);
        $ct->execute();
        $ct->closeCursor();
				
			}
		}
		else {
            $total = $price * (1 - ($discount/100));
            $fp = round(($quantity * $total) + 4.99, 2);
			$sql = "INSERT INTO Cart (productId, userId, specId, quantity, finalPrice) VALUES (${productId}, ${uid} ,${specId} , ${quantity} , ${fp})";
			
		//	$m = "UPDATE `Specs` SET `amount` = amount - 1 WHERE Specs.specId = ". $spid . " AND Specs.productId = ". $pdid . " ";
			
    $ck = $db->prepare($sql);
    $ck->execute();
    $ck->closeCursor();
		//	$conn->query($m);
		}
}

function remove_from_cart($pId,$sId,$uid){
  global $db;
  $sql = "DELETE FROM Cart WHERE Cart.productId = ". $pId ." and Cart.specId = ". $sId . " and Cart.userId = ". $uid . " ";

$result = $db->prepare($sql);
$result->execute();
$result->closeCursor();
}

function add_orders($proID,$specID,$quan,$pr,$uid){
global $db;
$valid = true;
  $verify = select_all_users($uid);
  foreach($verify as $v){
    if($v['address1'] == NULL || $v['city'] == NULL || $v['state'] == NULL || $v['country'] == NULL || $v['phone'] == NULL || $v['cardName'] == NULL || $v['creditNumber'] == NULL || $v['expiryDate'] == NULL || $v['cvv'] == NULL){
      $valid = false;
    }
  }
  if($valid){
    for($h = 0; $h < count($proID); $h++){
      $sq = "INSERT INTO Orders (productId, specId, amt, userId, finalPrice) VALUES (" . $proID[$h] . ", " . $specID[$h]. ", " . $quan[$h] . ", " .  $uid . ", " . $pr[$h] .")";
          $ins = $db->prepare($sq);		
          $ins->execute();
          $ins->closeCursor();
          $m = "UPDATE `Specs` SET `amount` = amount -" . $quan[$h] . " WHERE Specs.specId = " . $specID[$h] . " AND Specs.productId = " . $proID[$h] . " ";
          $up = $db->prepare($m);
          $up->execute();
          $up->closeCursor();
  
    }
    
    $del = "DELETE FROM Cart WHERE Cart.userId = " . $uid. "";
    
    $d = $db->query($del);
    $d->execute();
   $d->closeCursor();
  }

  return $valid;
}

function update_info($first_name,$last_name,$em,$ad1,$ad2,$ct,$pc,$st,$phone,$cu,$pass,$cardName,$credNum,$cvv,$exDate,$uid){
global $db;

$sql = "UPDATE Users SET firstName = '". $first_name . "', lastName = '". $last_name ."', email = '". $em . "', phone = '". $phone ."', address1 = '". $ad1 ."', address2 = '". $ad2."', city = '". $ct ."' , postalCode = '". $pc ."', state = '". $st."' , country = '". $cu."' , pass = '". $pass ."' WHERE Users.userId =" . $uid . "";

$re = $db->prepare($sql);
$re->execute();
$re->closeCursor();

$sh = "UPDATE Payment SET creditNumber = '". $credNum . "', cvv = '". $cvv ."', expiryDate = '". $exDate . "', cardName = '". $cardName ."' WHERE Payment.userId =" . $uid. "";

$e = $db->prepare($sh);
$e->execute();
$e->closeCursor();

}

function search_results($search_term){
  global $db;

  $sql = "SELECT * from Products, Specs, Categories, Discount where Products.categoryId = Categories.categoryId and Products.productId = Specs.productId and Specs.specId = Discount.specId and CONCAT(Products.productName, ' ', Products.manufacturer, ' ', Specs.cpuType, ' ', Specs.cpuBrand, ' ', Specs.ram, ' ', Specs.storage, ' ', Specs.display, ' ', Specs.graphics, ' ', Specs.cores, ' ', Specs.os) LIKE '%${search_term}%'";
  $re = $db->prepare($sql);
  $re->execute();
  $results = $re->fetchAll();
$re->closeCursor();

$outp = "";
  $item_array = array();
  
  foreach($results as $rs) {
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

return $outp;
}

function cart_results($uid){
    global $db;
    $sqle = "SELECT * FROM Cart WHERE Cart.userId = ". $uid . " ";
    $tst = $db->prepare($sqle);
    $tst->execute();
    $tst->closeCursor();
    return $tst;
}

function cart_content($uid){
  if(isset($uid)){
    global $db;
                    $fn = "SELECT * FROM `Cart` join Products on Products.productId = Cart.productId JOIN Specs on Specs.specId = Cart.specId WHERE Cart.userId = :sesid ";
    $hk = $db->prepare($fn);
    $hk->bindValue(':sesid',$uid);
    $hk->execute();
    $cart_add_result = $hk->fetchAll();
    $hk->closeCursor();
  }
  return $cart_add_result;
}

function info($uid){
  global $db;

if($uid){

    $sql = "SELECT * FROM Users, Payment WHERE Users.userId = Payment.userId ANd Users.userId =" . $uid . "";
    
    $cn = $db->prepare($sql);
    $cn->execute();
    $result = $cn->fetchAll();
    $cn->closeCursor();
    
    $output = "";
    if($cn->rowCount() > 0){
    foreach($result as $row){
        // $nme = $row['firstName'] .' ' . $row['lastName'];
      $output = "<input type='hidden' name='ud' value='" . $uid ."'>
         <li><div class='uk-margin'><label class='uk-form-label' for='form-horizontal-text'>First Name: </label><div class='uk-form-controls'><input class='uk-input' id='form-horizontal-text' type='text' name='fn' value='" . $row['firstName'] . "' /></div></div></li>
         <li><div class='uk-margin'><label class='uk-form-label' for='form-horizontal-text'>Last Name: </label><div class='uk-form-controls'><input class='uk-input' id='form-horizontal-text' type='text' name='ln' value='" . $row['lastName'] . "' /></div></div></li>
         <li><div class='uk-margin'><label class='uk-form-label' for='form-horizontal-text'>Email: </label><div class='uk-form-controls'><input class='uk-input' id='form-horizontal-text' type='text' name='em' value='" . $row['email'] . "' /></div></div></li>
         <li><div class='uk-margin'><label class='uk-form-label' for='form-horizontal-text'>Phone: </label><div class='uk-form-controls'><input class='uk-input' id='form-horizontal-text' type='text' name='ph' value='" . $row['phone'] . "' /></div></div></li>
         <li><div class='uk-margin'><label class='uk-form-label' for='form-horizontal-text'>Address: </label><div class='uk-form-controls'><input class='uk-input' id='form-horizontal-text' type='text' name='ad1' value='" . $row['address1'] . "' /></div></div></li>
         <li><div class='uk-margin'><label class='uk-form-label' for='form-horizontal-text'>Address: </label><div class='uk-form-controls'><input class='uk-input' id='form-horizontal-text' type='text' name='ad2' value='" . $row['address2'] . "' /></div></div></li>
         <li><div class='uk-margin'><label class='uk-form-label' for='form-horizontal-text'>City: </label><div class='uk-form-controls'><input class='uk-input' id='form-horizontal-text' type='text' name='ct' value='" . $row['city'] . "' /></div></div></li>
         <li><div class='uk-margin'><label class='uk-form-label' for='form-horizontal-text'>Postal Code: </label><div class='uk-form-controls'><input class='uk-input' id='form-horizontal-text' type='text' name='pc' value='" . $row['postalCode'] . "' /></div></div></li>
         <li><div class='uk-margin'><label class='uk-form-label' for='form-horizontal-text'>State: </label><div class='uk-form-controls'><input class='uk-input' id='form-horizontal-text' type='text' name='st' value='" . $row['state'] . "' /></div></div></li>
         <li><div class='uk-margin'><label class='uk-form-label' for='form-horizontal-text'>Country: </label><div class='uk-form-controls'><input class='uk-input' id='form-horizontal-text' type='text' name='cu' value='" . $row['country'] . "' /></div></div></li>
         <li><div class='uk-margin'><label class='uk-form-label' for='form-horizontal-text'>Username: </label><div class='uk-form-controls'><input class='uk-input' id='form-horizontal-text' type='text' name='ur' value='" . $row['username'] . "' disabled/></div></div></li>
         <li><div class='uk-margin'><label class='uk-form-label' for='form-horizontal-text'>Password: </label><div class='uk-form-controls'><input class='uk-input' id='form-horizontal-text' type='password' name='pass' value='" . $row['pass'] . "' /></div></div></li>
         <li><div class='uk-margin'><label class='uk-form-label' for='form-horizontal-text'>Card Type: </label><div class='uk-form-controls'><input class='uk-input' id='form-horizontal-text' type='text' name='cardName' value='" . $row['cardName'] . "'/></div></div></li>
         <li><div class='uk-margin'><label class='uk-form-label' for='form-horizontal-text'>Credit Number: </label><div class='uk-form-controls'><input class='uk-input' id='form-horizontal-text' type='text' name='credNum' maxlength='16' value='" . $row['creditNumber'] . "' /></div></div></li>
         <li><div class='uk-margin'><label class='uk-form-label' for='form-horizontal-text'>CVV: </label><div class='uk-form-controls'><input class='uk-input' id='form-horizontal-text' type='text' name='cvv' maxlength='3' value='" . $row['cvv'] . "'/></div></div></li>
         <li><div class='uk-margin'><label class='uk-form-label' for='form-horizontal-text'>Expiry Date (MMYY):</label><div class='uk-form-controls'><input class='uk-input' id='form-horizontal-text' type='text' name='exDate' maxlength='4' value='" . $row['expiryDate'] . "'/></div></div></li>";
    }
    }
}



return $output;
}

function product_details($pid,$sid){
  global $db;
  $sql = "SELECT * FROM `Specs` JOIN Products ON Specs.productId = Products.productId JOIN Discount ON Discount.specId = Specs.specId JOIN Categories ON Categories.categoryId = Products.CategoryId WHERE Products.productId = " . $pid . " AND Specs.specId = " . $sid . "; ";


$statement = $db->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();

        $sql2 = "SELECT * FROM `Specs` JOIN Products ON Specs.productId = Products.productId JOIN Discount ON Discount.specId = Specs.specId JOIN Categories ON Categories.categoryId = Products.CategoryId WHERE Specs.specId != " . $sid . " AND Categories.categoryName = '". $result[0]['categoryName'] ."' ORDER BY Specs.amount DESC LIMIT 3; ";


$statement2 = $db->prepare($sql2);
        $statement2->execute();
        $sim = $statement2->fetchAll();

        return [$result, $sim];
}

function order_details($uid){
  global $db;
  $n = "SELECT * FROM Orders Join Products on Orders.productId = Products.productId JOIN Specs on Specs.specId = Orders.SpecId where Orders.userId = " . $uid . "";
        
  $r = $db->prepare($n);
  $r->execute();
  $result = $r->fetchAll();
  $r->closeCursor();
  return $result;
}
