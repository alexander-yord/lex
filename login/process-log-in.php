<?php
	$u_username = $_POST["username"];
	$u_password = $_POST["password"];
	
// 	$q = $_REQUEST["q"];
    
    include("connectionInfo.php");
    
    $sql = "SELECT username, password from login_credentials where lower(username) = lower('$u_username')";
    $result = mysqli_query($conn, $sql);
    $isUnique;
    
    if (mysqli_num_rows($result) > 0) {
        // echo "exists";
        $row = mysqli_fetch_assoc($result);
        if ($u_password == $row["password"]){
            echo "You successfully logged";
        }
        else {
            echo "Your password was wrong";
        }
        
    }
    else {
        echo "User does not exist";
    }
    
	mysqli_close($conn);
	
	header("Location: index.html");
    die();
?>