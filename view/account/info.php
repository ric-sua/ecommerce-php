<?php include('order_header.php');
?>

<div class="uk-grid-large uk-text-center" uk-grid>
    <?php if (isset($_SESSION['userID'])) { ?>
        <div class="uk-width-1-3@m">
            <div class="uk-card uk-card-default uk-card-body ty">
                <h3 class="uk-card-title">Hi <?php echo $_SESSION['nme'] ?>, </h3>
                <ul class='uk-list uk-list-small '>
                    <li><a href='/view_info'>My Account</a></li>
                    <li><a href='/myorders'>My Orders</a></li>
                    <li><a href='view/account/logout.php'>Sign Out</a></li>
                </ul>
            </div>
        </div>
    <?php } ?>
    <div class="uk-width-2-3@m">
        <div class="uk-card uk-card-default uk-card-body ty">
            <form class="uk-form-horizontal uk-margin-small" action='.' method='post'>
                <ul class="uk-list uk-list-divider">
                    <input type='hidden' name='action' value='info'>
                    <?php
                    if (isset($_SESSION['userID'])) {
                        echo $update_info;
                    } else {
                        echo "<li><div uk-grid> invalid access. please login to account </div></li>";
                    } ?>
                </ul>
                <button class='uk-button uk-button-default uk-width-1-1' type='submit' value='Submit'>Update</a>
            </form>
        </div>
    </div>
</div>

</div>
</div>