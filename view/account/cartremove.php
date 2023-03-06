<?php
session_start();
include('../../model/database.php');

$pId = $_GET['proId'];
$sId = $_GET['specId'];

$sql = "DELETE FROM Cart WHERE Cart.productId = ". $pId ." and Cart.specId = ". $sId . " and Cart.userId = ". $_SESSION["userID"] . " ";

$result = $db->prepare($sql);
$result->execute();
$result->closeCursor();

if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
?>