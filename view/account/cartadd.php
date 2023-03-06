<?php

session_start();

    include ('../dataConn.php');
	
	$pdid = $_POST["pid"];
	$spid = $_POST["sid"];
	$q = $_POST["quan"];
	$pr = $_POST["p"];
    $ds = $_POST["dis"];
	$_SESSION["msg"] = "no";
	
	if(!isset($_SESSION['userID'])){
		header("Location: ../account/login.php");
	}
	else{
		
		$ch = "SELECT * FROM `Cart` JOIN Products on Products.productId = Cart.productId Join Specs on Specs.specId = Cart.specId WHERE Cart.productId = " . $pdid . " AND Cart.userId = ". $_SESSION["userID"] ." AND Cart.specId = ". $spid . " ";
		
		$result = $conn->query($ch);
		
		
		if($result->num_rows > 0)
		{
			 while($rs = $result->fetch_array(MYSQLI_ASSOC)){
				 $am = "";
                 $total = $pr * (1 - ($ds/100));
				 if($rs["quantity"] >= $rs["amount"]){
					$_SESSION["msg"] = "yes";
					$s = "UPDATE `Cart` SET `quantity` = " . $rs["amount"]  . ", finalPrice = ". round((($rs["amount"]) * $total) + 4.99, 2) ." WHERE `Cart`.`CartId` = ". $rs['CartId'] . " ";
				 }
				else{
					$am = $rs["quantity"];
					$s = "UPDATE `Cart` SET `quantity` = " . $am  . "+1, finalPrice = ". round((($am+1) * $total) + 4.99, 2) ." WHERE `Cart`.`CartId` = ". $rs['CartId'] . " ";
				}
		
				 
				// $m = "UPDATE `Specs` SET `amount` = amount - 1 WHERE Specs.specId = ". $spid . " AND Specs.productId = ". $pdid . " ";
				$conn->query($s);
				// $conn->query($m);
			}
		}
		else {
            $total = $pr * (1 - ($ds/100));
			$sql = "INSERT INTO Cart (productId, userId, specId, quantity, finalPrice) VALUES (" . $pdid .", " . $_SESSION["userID"] . ", " . $spid . ", " . $q . ", " . round(($q * $total) + 4.99, 2) . ")";
			
		//	$m = "UPDATE `Specs` SET `amount` = amount - 1 WHERE Specs.specId = ". $spid . " AND Specs.productId = ". $pdid . " ";
			
			$conn->query($sql);
		//	$conn->query($m);
		}
		
	}
	
	$conn->close();

    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

?>