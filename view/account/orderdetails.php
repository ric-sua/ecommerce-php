<?php
include('order_header.php');

$output = "";
$cot = "";
if (count($user_info) > 0) {
    foreach ($user_info as $row) {
        $output = "<p>" . $row['firstName'] . " " . $row['lastName'] . " <br>" . $row['address1'] . " " .  $row['address2'] . " <br>" . $row['city'] . ", " . $row['state'] . " " . $row['country'] . "<br>" . $row['email'] . " <br>" . $row['phone'] . "</p>";
        $cot = "<p> Type: " . $row['cardName'] . " <br>Account Number: ****-****-****-" . substr($row['creditNumber'], 12, 15) . "<br> CVV: *** <br> ExpiryDate: " . $row['expiryDate'] . "</p>";
    }
} else {
    $output = "invalid access. please login to account";
}
?>

<div class="uk-grid-large uk-text-center" uk-grid>
    <div class="uk-width-1-3@m">
        <div class="uk-card uk-card-default uk-card-body ty">
            <h3 class="uk-card-title">Confirm Address </h3>
            <?php echo $output; ?>
        </div>
        <div class="uk-card uk-card-default uk-card-body ty">
            <h3 class="uk-card-title">Payment Info </h3>
            <?php echo $cot; ?>
        </div>
    </div>
    <div class="uk-width-2-3@m">
        <div class="uk-card uk-card-default uk-card-body ty">
            <form class="uk-form-horizontal uk-margin-small" action='./././index.php' method='post'>
                <ul class="uk-list uk-list-divider">
                    <?php if ($cart_content) {

                        foreach ($cart_content as $con) {
                            echo '<li><div uk-grid>
     <div class="uk-width-1-3@m"><input type="hidden" name="action" value="order"><img src="view/' . $con['image'] . '" alt=""></div> 
     <div class="uk-width-2-3@m"><p> ' . $con["productName"] . '</p><p>' . $con["cpuType"]        . ' ' . $con["ram"]        . ' ' . $con["storage"]        . ' ' . $con["graphics"]  . '</p>
     <div uk-grid><a class="uk-width-1-3" href=".?action=remove_cart&proId=' . $con["productId"] . '&specId=' . $con["specId"] . '" /> Remove </a>
     <div class="uk-width-1-3"> QTY: ' . $con["quantity"] . '</div>
     <div class="uk-width-1-3">$' . $con["finalPrice"] . '</div></div>
     <input type="hidden"  name ="productId[]" value=' . $con["productId"] . ' />
 <input type="hidden"  name="specId[]" value=' .  $con["specId"] . ' />
 <input type="hidden"  name="quan[]" value=' . $con["quantity"] . ' />
 <input type="hidden"  name="ud" value=' . $_SESSION["userID"] . ' />
 <input type="hidden"  name="finalPrice[]" value=' . $con["finalPrice"] . ' /></div>
 </div>
     </li>';
    }
} else {
    echo "<li> Cart is Empty </li>";
} ?>
<li>
    <div class='inf'>
    <div class='alignright' style='font-size: 20px; font-weight: bold; margin-bottom: 5px;'>$<?php if (isset($totalCart))
                                    echo $totalCart;
                                else
                                    echo "0.00"; ?>
    </div>
</div>
</li>
                </ul>
                <button class='uk-button uk-button-default uk-width-1-1 custom' type='submit' value='Submit'>Order</a>
            </form>
        </div>
    </div>
</div>

</div>
</div>

<?php include('../footer.php'); ?>