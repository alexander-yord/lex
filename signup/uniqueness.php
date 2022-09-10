<?php
    $q = $_REQUEST["q"];
    
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/general/connectionInfo.php";
    include($path);
    
    $sql = "SELECT username from login_credentials where lower(username) = lower('$q')";
    $result = mysqli_query($conn, $sql);
    $isUnique;
    if (mysqli_num_rows($result) == 0) {
        $isUnique = true;
    }
    else {
        $isUnique = false;
    }
    echo $isUnique;
?>