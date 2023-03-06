<!DOCTYPE html>
<html>

<head>
  <title>| Rusty's |</title>
  <!-- UIkit CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.6.14/dist/css/uikit.min.css" />

  <!-- UIkit JS -->
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.14/dist/js/uikit.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.14/dist/js/uikit-icons.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="view/css/main.css" />
  <style>
    .inf {
    height: 10px;
    position: relative;
  }

  .inf div {
    display: inline-block;
    position: relative;
  }

  .alignleft {
    left: 0px;

  }

  .aligncenter {
    left: 40%;
  }

  .alignright {
    float: right;
  }

  .cont {
    margin-top: 20px;
  }

  .uk-offcanvas-bar {
    background: #102542ff;
  }

  .navlinks {
    font-size: 15px;
    text-align: center;
  }

  .nn {
    font-size: 25px;
    font-style: italic;
    text-align: center;
  }
  </style>
</head>

<body>

  <!-- aligns width of the entire page -->
  <div class="uk-container uk-container-xlarge">
    <div class="cont">
      <div class="uk-card uk-card-default">
        <!-- nav bar contents -->
        <nav class="uk-navbar-container uk-margin test" uk-navbar>
          <div class="nav-overlay uk-navbar-left">
            <ul class="uk-navbar-nav">
              <li>
                <!-- company logo -->
                <a href="/"><img src="view/images/unnamed.png" width="75" height="75" /></a>
              </li>
            </ul>
          </div>

          <!-- nav links to products -->
          <div class="nav-overlay uk-navbar-right">
            <ul class="uk-navbar-nav">
              <li>
              <a href="" >
                  <span uk-icon="icon: cart; ratio: 1.25"></span>
                  <div class="amount"><?php

                  if ($cart) {

                    if ($cart->rowCount() > 0)
                      echo $cart->rowCount();
                    else
                      echo "0";
                  } else
                    echo "0";

                  ?></div>


                </a>
                <div uk-dropdown='mode: click; pos: bottom-right; boundary: .uk-navbar-container; boundary-align: true; ' class="uk-width-1-2@m">
                  <ul class='uk-list uk-list-large uk-list-divider'>
                    <?php

                    if ($cart_content) {


                      $totalCart = "0";
                      if (count($cart_content) > 0) {
                        foreach ($cart_content as $con) { ?>
                          <li>
                            <div uk-grid>
                              <div class="uk-width-1-3@m"><img src="view/<?= $con['image'] ?>" alt=""></div>
                              <div class="uk-width-2-3@m">
                                <p> <?= $con["productName"] ?> </p>
                                <p> <?= $con["cpuType"]  ?> <?= $con['ram']    ?> <?= $con["storage"]  ?> <?= $con["graphics"]  ?></p>
                                <div uk-grid>
                                  <a class="uk-width-1-3" href="./././index.php?action=remove_cart&proId='<?= $con["productId"] ?>'&specId='<?= $con["specId"] ?>'"> Remove </a>
                                  <div class="uk-width-1-3"> QTY: <?= $con["quantity"] ?></div>
                                  <div class="uk-width-1-3">$<?= $con["finalPrice"] ?> </div>
                                </div>
                              </div>
                            </div>
                          </li>

                    <?php
                          $totalCart += $con["finalPrice"];
                        }
                      } else {
                        echo "<li> Cart is Empty </li>";
                      }
                    } else {
                      echo "<li> Cart is Empty </li>";
                    }
                    ?>
                    <li>
                      <div class="inf">
                        <div class="alignleft">$<?php if (isset($totalCart))
                                                  echo $totalCart;
                                                else
                                                  echo "0.00"; ?> </div>
                        <?php if(isset($_SESSION['userID'])) {?>
                        <a class="uk-button uk-button-primary alignright custom" href="/order_details">Checkout</a>
                        <?php } else { ?>
                          <a class="uk-button uk-button-primary alignright custom" href="">Checkout</a>
                        <?php } ?>
                      </div>
                    </li>
                  </ul>

                </div>
                <!-- <div uk-dropdown='mode: click; pos: bottom-left' class="uk-width-1-2">
                        <ul class='uk-list uk-list-large uk-list-divider'>
                        <li>
                        <div uk-grid>
                        <div class="uk-width-1-3@m"><img src="../images/ipX.jpg" alt=""></div> 
                        <div class="uk-width-2-3@m">
                        <p> Acer Nitro 5</p>
                        <p> 5000 jigga watts yeah</p>
                        <p><p style="text-align: left">something</p><p style="text-align: right"> $500 </p></p></div>
                    </div>
                        </li>
                        </ul>
                        </div> -->
              </li>
              <li>
              <a href="" uk-icon="icon: user; ratio: 1.25">
                </a>
                <?php

                if (isset($_SESSION["userID"])) {
                  echo "<div uk-dropdown='mode: click; pos: bottom-right; boundary: .uk-navbar-container; boundary-align: true;' class='uk-child-width-1-1'>
                 <h3> Hi " . $_SESSION['nme'] . " </h3>
                        <ul class='uk-list uk-list-small'>
                        <li><a href='../view_info'>My Account</a></li>
                        <li><a href='/myorders'>My Orders</a></li>
                        <li><a href='../account/logout.php'>Sign Out</a></li>
                        </ul>
                        </div>";
                } else {
                  echo "<div uk-dropdown='mode: click; pos: bottom-right; boundary: .uk-navbar-container; boundary-align: true;'>
                        <a class='uk-button uk-button-default uk-width-1-1 custom./paccount/signin.php'>Login</a>
                        </div>";
                }
                ?>
              </li>
              <li>
                <a class="uk-navbar-toggle"  uk-icon="icon: search; ratio: 1.25"  uk-toggle="target: .nav-overlay; animation: uk-animation-fade" href="#"></a>
              </li>
            </ul>
            <div>
              <div class="navBtn" style="padding-right: 10px; padding-left: 10px;">
              <span uk-icon="icon: menu; ratio: 1.25"></span>
              </div>
              <div class="uk-width-medium" uk-dropdown="pos: bottom-justify; boundary: .test; boundary-align: true; mode: click">
                <div class="uk-dropdown-grid uk-child-width-1-2@m " uk-grid>

                  <div>
                    <ul class="uk-nav uk-dropdown-nav navlinks">
                      <li class="uk-nav-header nn">Laptops</li>
                      <li><a href="../products&filter=Gaming">Gaming</a></li>
                      <li><a href="../products&filter=2in1">2-in-1</a></li>
                      <li><a href="../products&filter=Chromebook">Chromebook</a></li>
                      <li><a href="../products&filter=Ultrabook">Ultrabook</a></li>
                    </ul>
                  </div>
                  <div>
                    <ul class="uk-nav uk-dropdown-nav navlinks">
                      <li class="uk-nav-header nn">Brands</li>
                      <li><a href="../products&filter=Asus">Asus</a></li>
                      <li><a href="../products&filter=Dell">Dell</a></li>
                      <li><a href="../products&filter=Lenovo">Lenovo</a></li>
                      <li><a href="../products&filter=Acer">Acer</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="nav-overlay uk-navbar-left uk-flex-1" hidden>

            <!-- search bar and design -->
            <div class="uk-navbar-item uk-width-expand">
              <form action="../../" class="uk-search uk-search-navbar uk-width-1-1" method="get">
                <button href="" class="uk-search-icon-flip" uk-search-icon></button>
                <input class="uk-search-input" name="q" type="search" placeholder="Search..." autofocus>
              </form>
            </div>

            <a class="uk-navbar-toggle" uk-close uk-toggle="target: .nav-overlay; animation: uk-animation-fade" href="#"></a>

          </div>

        </nav>

      </div>
    </div>