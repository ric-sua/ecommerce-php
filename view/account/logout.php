<?php



session_start();



if(isset($_SESSION['userID']) && (time() - $_SESSION['userID'] > 1800)){

    
    echo "logout successful";

    unset($_SESSION);

    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    session_destroy();

}



?>