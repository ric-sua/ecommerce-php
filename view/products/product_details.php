<?php include('product_details_header.php'); ?>

<div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin ty" uk-grid>
    <div class="uk-card-media-left uk-cover-container">
        <?php foreach ($prod_details[0] as $rs) { ?>
            <img src="view/<?php echo $rs["image"] ?>" alt="" uk-cover>
            <canvas width="600" height="400"></canvas>
    </div>
    <div>
        <div class="uk-card-body">
            <?php

            if (isset($_SESSION["msg"]) && $_SESSION["msg"] == "yes")
                echo "<p> amount exceeded </p>"    ?>
            <h2 class="uk-card-title"> <?php echo $rs["productName"] ?> </h2>
            <form action="./././index.php" method="post">
                <input type="hidden" name="action" value="cartadd">
                <p>
                <ul>
                    <li> <?php echo $rs["cpuType"] ?> </li>
                    <li> <?php echo $rs["ram"] ?> </li>
                    <li> <?php echo $rs["storage"] ?> </li>
                    <li> <?php echo $rs["graphics"] ?> </li>
                    <li> <?php echo $rs["os"] ?> </li>
                </ul>

                <?php if (($rs["price"] * (1 - ($rs["discountPercent"] / 100))) < $rs["price"]) {
                    echo "<strike class='n'>$" . $rs["price"] . "</strike> &nbsp; <b class='n'>$" . round(($rs["price"] * (1 - ($rs["discountPercent"] / 100))), 2) . "</b> Save " . $rs["discountPercent"] . "%";
                } else {
                    echo "<b class='n'>$" . $rs["price"] . "</b>";
                }
                ?>
                </p>
                <?php if ($rs["amount"] > 0) {
                    echo "<p><b> In Stock </b></p>";
                } else {
                    echo "<p><b> Out of Stock </b></p>";
                } ?>
                <p>$4.99 Shipping</p>
                <input type="hidden" name="pid" value="<?php echo $rs["productId"] ?>" />
                <input type="hidden" name="sid" value="<?php echo $rs["specId"] ?>" />
                <input type="hidden" name="quan" value="1" />
                <input type="hidden" name="p" value="<?php echo $rs["price"] ?>" />
                <input type="hidden" name="dis" value="<?php echo $rs["discountPercent"] ?>" />
                <input type="hidden" name="usrid" value="<?php if (isset($_SESSION['userID'])) echo $_SESSION['userID'] ?>" />
            <?php

            if ((isset($_SESSION["msg"]) && $_SESSION["msg"] == "yes") || $rs["amount"] <= 0) {
                echo    "<button class='uk-button uk-button-primary' type='submit' value='Submit' disabled>Add to Cart</button>";
                unset($_SESSION["msg"]);
            } else if (!isset($_SESSION['userID'])) {
                echo "<a class='uk-button uk-button-default uk-margin-small-bottom custom' href='view/account/signin.php'>Add to Cart</a>";
            } else {
                echo    "<button class='uk-button uk-button-default uk-margin-small-bottom custom'  type='submit' value='Submit'>Add to Cart</button>";
            }
        } ?>
            </form>
        </div>
    </div>
</div>

<br />
<h1 class="uk-text-center"> Similar Items </h1>
<br />

<?php
echo "<div class='uk-child-width-1-3@m uk-grid-match' uk-grid>";

foreach ($prod_details[1] as $s) {

    echo "<div><div class='uk-card uk-card-default ty'>
            <div class='uk-card-media-top'>
            <a href='.?action=product_details&proId=" . $s['productId'] . "&specId=" . $s['specId'] . "'><img src='view/" . $s['image'] . "' width='1000' height='200'></a>
            </div>
            
            <div class='uk-card-body '>
                <h3 class='uk-card-title'><a href='/product_details&proId=" . $s['productId'] . "&specId=" . $s['specId'] . "' >" . $s['productName'] . "</a></h3>
                <p>" . $s["cpuType"] . ' ' . $s["ram"] . ' ' . $s["storage"] . ' ' . $s["graphics"] . "</p>";
    if ($s['discountPercent'] > "0") {
        echo "<p><strike>$" . $s["price"] . "</strike> &nbsp; <b> $" . round(($s["price"] * (1 - ($s["discountPercent"] / 100))), 2) . "</b>  Save " . $s['discountPercent'] . "%</p> ";
    } else {
        echo "<p><b>$" . $s["price"] . "</b></p>";
    }
    echo "</div></div></div>";
}

echo "</div>";
?>
<br />

<?php include('../footer.php'); ?>