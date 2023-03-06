<?php include('order_header.php'); 

global $db;
if(isset($_SESSION['userID'])){
    
        $nme = "";
        $output = "";
      foreach($result as $row){
      
        $output .= '<li><div uk-grid>
                              <div class="uk-width-1-3@m"><img src="view/' . $row['image'] . '" alt=""></div> 
                              <div class="uk-width-2-3@m"><p> '. $row["productName"] . '</p><p>' . $row["cpuType"]        . ' ' . $row["ram"]        . ' ' . $row["storage"]        . ' ' . $row["graphics"]  .'</p><p>Order Date: ' . $row["orderDate"] .' </p> <div uk-grid>
                              <div class="uk-width-1-3"></div>
                              <div class="uk-width-1-3"> QTY: '. $row["amt"] .'</div>
                              <div class="uk-width-1-3">$'. $row["finalPrice"] . '</div></div></div>
                          </div>
                              </li>
           ';
           
      } 
  }


?>
<div class="uk-grid-large uk-text-center" uk-grid>
<div class="uk-width-1-3@m">
<div class="uk-card uk-card-default uk-card-body ty">
<h3 class="uk-card-title">Hi <?php if(isset($_SESSION['nme'])) { echo $_SESSION['nme'] ?>, </h3>
<ul class='uk-list uk-list-small'>
                        <li><a href='/view_info'>My Account</a></li>
                        <li><a href='/myorders'>My Orders</a></li>
                        <li><a href='view/account/logout.php'>Sign Out</a></li>
                        </ul>
                        <?php } else { echo "invalid arguments"; }?>
</div>
</div>
<div class="uk-width-2-3@m">
 <div class="uk-card uk-card-default uk-card-body ty ">
 <ul class="uk-list uk-list-divider">
<?php 
if(isset($_SESSION['userID'])){
    echo $output;    
}
else{
    echo "<li><div uk-grid> This page is invalid </div></li>";
}
 ?>
</ul>
</form>
</div>
</div>
</div>

</div>
</div>

<?php include('../footer.php') ?>