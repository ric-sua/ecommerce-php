<?php
session_start();
require('model/database.php');
require('model/functions.php');

$username = filter_input(INPUT_POST, "usr");
$first_name = filter_input(INPUT_POST, "fn");
$last_name = filter_input(INPUT_POST, "ln");
$em = filter_input(INPUT_POST, "em");
$ad1 = filter_input(INPUT_POST, "ad1");
$ad2 = filter_input(INPUT_POST, "ad2");
$ct = filter_input(INPUT_POST, "ct");
$pc = filter_input(INPUT_POST, "pc");
$st = filter_input(INPUT_POST, "st");
$cu = filter_input(INPUT_POST, "cu");
$cardName = filter_input(INPUT_POST, "cardName");
$credNum = filter_input(INPUT_POST, "credNum");
$cvv = filter_input(INPUT_POST, "cvv");
$exDate = filter_input(INPUT_POST, "exDate");
$phone = filter_input(INPUT_POST, "ph");
$email = filter_input(INPUT_POST, "eml");
$password = filter_input(INPUT_POST, "pass");
$password2 = filter_input(INPUT_POST, "pass2");
$product_id = filter_input(INPUT_POST, "pid", FILTER_VALIDATE_INT);
$spec_id = filter_input(INPUT_POST, "sid", FILTER_VALIDATE_INT);
$quantity = filter_input(INPUT_POST, "quan", FILTER_VALIDATE_INT);
$price = filter_input(INPUT_POST, "p");
$discount = filter_input(INPUT_POST, "dis");
$uid = filter_input(INPUT_POST, "usrid", FILTER_VALIDATE_INT);
$proID = filter_input(INPUT_POST, "productId", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
$specID = filter_input(INPUT_POST, "specId", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
$quan = filter_input(INPUT_POST, "quan", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
$pr = filter_input(INPUT_POST, "finalPrice", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
$ud = filter_input(INPUT_POST, "ud", FILTER_VALIDATE_INT);
$routes = [];
$search_term = filter_input(INPUT_GET, "q");

route('/', function () {
    if (isset($_SESSION['userID'])) {
        $cart = cart_results($_SESSION['userID']);
        $cart_content = cart_content($_SESSION['userID']);
    }
    include('view/main_page.php');
});

route('/products', function () use ($search_term) {
    $filter = filter_var($_GET['filter'], FILTER_SANITIZE_ENCODED);
    if (isset($_SESSION['userID'])) {
        $cart = cart_results($_SESSION['userID']);
        $cart_content = cart_content($_SESSION['userID']);
    }
    if ($search_term) {
        if ($search_term && strlen(trim($search_term)) !== 0) {
            $results = search_results($search_term);
        }
    } else
        $results = all_products();
    include('view/products/product_page.php');
});


// route('/finder', function() {
//     if (isset($_SESSION['userID'])) {
//         $cart = cart_results($_SESSION['userID']);
//         $cart_content = cart_content($_SESSION['userID']);
//     }
//     if ($search_term && strlen(trim($search_term)) !== 0) {
//         $search = search_results(trim($search_term));
//         include('view/search.php');
//     } else {
//         header("Location: " . $_SERVER["HTTP_REFERER"]);
//     }
// });

route('/product_details', function () {
    if (isset($_SESSION['userID'])) {
        $cart = cart_results($_SESSION['userID']);
        $cart_content = cart_content($_SESSION['userID']);
    }
    $prod_id = $_GET['proId'];
    $spec_id = $_GET['specId'];
    $prod_details = product_details($prod_id, $spec_id);
    include('view/products/product_details.php');
});

function route(string $path, callable $callback)
{
    global $routes;
    $routes[$path] = $callback;
}

route('/myorders', function () {
    if (isset($_SESSION['userID'])) {
        $cart = cart_results($_SESSION['userID']);
        $cart_content = cart_content($_SESSION['userID']);
        $result = order_details($_SESSION['userID']);
    }
    include('view/account/myorders.php');
});


route('/order_details', function () {
    if (isset($_SESSION['userID'])) {
        $cart = cart_results($_SESSION['userID']);
        $cart_content = cart_content($_SESSION['userID']);
    }
    $user_info = select_all_users($_SESSION['userID']);
    include('view/account/orderdetails.php');
});

route('/view_info', function () {
    if (isset($_SESSION['userID'])) {
        $cart = cart_results($_SESSION['userID']);
        $cart_content = cart_content($_SESSION['userID']);
    }
    $update_info = info($_SESSION['userID']);
    include('view/account/info.php');
});


run($search_term);

function run($search_term)
{
    global $routes;
    $uri = $_GET['url'];
    foreach ($routes as $path => $callback) {
        if ($path !== $uri) continue;
        if ($search_term) {
            $srh = $routes['/products'];
            $srh();
            break;
        }
        $callback();
    }
}

$action = filter_input(INPUT_POST, 'action');
if (!$action) {
    $action = filter_input(INPUT_GET, 'action');
    if (!$action) {
        $sction = 'main_page';
    }
}

//     $queries = array();
// filter_var(parse_str($_SERVER['QUERY_STRING'], $queries));

//     if(isset($queries)){
//             switch(key($queries)){
//                 case 'filter':
//                     $products = all_products();
//                     print_r($queries);
//                     // $_SESSION['all'] = $products;
//                     // header("Location: view/products/product_page.php?filter={$queries['filter']}");
//                     include('view/products/product_page.php');    
//                     $action = 'no';
//                         break; 

//             }


//     }


switch ($action) {
    case 'signup':
        if ($username && $first_name && $last_name && $password) {
            $result = signup($username, $first_name, $last_name, $email, $password, $password2);
            foreach ($result as $user) {
                $_SESSION['userID'] = $user['userId'];
                $_SESSION['nme'] = $user['firstName'];
                $_SESSION['check'] = "true";
            }
            $cart = cart_results($_SESSION['userID']);
            $cart_content = cart_content($_SESSION['userID']);
            header("Location: /");
        }
        break;
    case 'signin':
        if ($username && $password) {
            $result = signin($username, $password);
            if (count($result) == 0) {
                echo "invalid credentials. returning to login.";
                header('Refresh:2; url=view/account/signin.php');
            } else {
                foreach ($result as $user) {
                    $_SESSION['userID'] = $user['userId'];
                    $_SESSION['nme'] = $user['firstName'];
                    $_SESSION['check'] = "true";
                }
                $cart = cart_results($_SESSION['userID']);
                $cart_content = cart_content($_SESSION['userID']);
                header("Location: /");
            }
        }
        break;
    case 'cartadd':
        if ($product_id && $spec_id && $quantity && $price && $uid) {
            add_to_cart($product_id, $spec_id, $quantity, $price, $discount, $uid);
            header("Location: /product_details&proId={$product_id}&specId={$spec_id}");
        } else {
            echo "error: unable to add to cart.";
            header('Refresh:2;');
        }
        break;
        // case 'order_details':

        //     break;
    case 'remove_cart':
        if (isset($_SESSION['userID'])) {
            $pI = $_GET['proId'];
            $sI = $_GET['specId'];
            remove_from_cart($pI, $sI, $_SESSION['userID']);
            $cart = cart_results($_SESSION['userID']);
            $cart_content = cart_content($_SESSION['userID']);
            if (isset($_SERVER["HTTP_REFERER"])) {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }
        }
        break;
    case 'order':
        if (isset($_SESSION['userID'])) {
            $cart = cart_results($_SESSION['userID']);
            $cart_content = cart_content($_SESSION['userID']);
        }
        if ($proID && $specID && $quan && $pr) {
            $verify = add_orders($proID, $specID, $quan, $pr, $ud);
            if ($verify) {
                header("Location: /myorders");
            } else {
                echo "Error: make sure address and payment information is not empty. <br>";
                echo '<a href="/order_details">go back</a>';
            }
        } else {
            echo "error";
            header('Refresh:2;');
        }
        break;
        // case 'myorders':

        //     break;
        // case 'view_info':
        //     if (isset($_SESSION['userID'])) {
        //         $cart = cart_results($_SESSION['userID']);
        //         $cart_content = cart_content($_SESSION['userID']);
        //     }
        //     $update_info = info($_SESSION['userID']);
        //     include('view/account/info.php');
        //     break;
    case 'info':
        update_info($first_name, $last_name, $em, $ad1, $ad2, $ct, $pc, $st, $phone, $cu, $password, $cardName, $credNum, $cvv, $exDate, $ud);
        header("Location: /view_info");
        break;
}
