<?php include('header.php'); ?>


<?php
if (count($search) > 0) {
    echo "<div class='uk-child-width-1-4@m uk-grid-match' uk-grid>";

    foreach ($search as $s) {

        echo "<div><div class='uk-card uk-card-default ty'>
                <div class='uk-card-media-top'>
                <a href='.?action=product_details&proId=" . $s['productId'] . "&specId=" . $s['specId'] . "'><img src='view/" . $s['image'] . "' width='1400' height='400'></a>
                </div>
                
                <div class='uk-card-body '>
                    <h3 class='uk-card-title'><a href='.?action=product_details&proId=" . $s['productId'] . "&specId=" . $s['specId'] . "' >" . $s['productName'] . "</a></h3>
                    <p>" . $s["cpuType"] . ' ' . $s["ram"]        . ' ' . $s["storage"]        . ' ' . $s["graphics"] . "</p>";
        if ($s['discountPercent'] > "0") {
            echo "<p><strike>$" . $s['price'] . "</strike> &nbsp; <b> $" . round($s['price'] * (1 - ($s['discountPercent'] / 100)), 2) . "</b>  Save " . $s['discountPercent'] . "%</p> ";
        } else {
            echo "<p><b>" . $s['price'] . "</b></p>";
        }
        echo "</div></div></div>";
    }

    echo "</div><br />";
} else {
    echo "<p>0 results</p>";
}
?>

<?php include('footer.php'); ?>