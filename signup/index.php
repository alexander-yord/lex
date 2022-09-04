<?php
	if($_SERVER["REQUEST_METHOD"] === "POST") {
        $f_name = $_POST["f_name"];
	    $l_name = $_POST["l_name"];
	    $u_name = $_POST["username"];
	    $u_pass = $_POST["password"];
        
	    include("connectionInfo.php");
        
    	$sql_account = "insert into accounts (first_name, last_name) 
	        values (?, ?)";
        
	    $stmt = mysqli_stmt_init($conn);
	
	    if (!mysqli_stmt_prepare($stmt, $sql_account)) {
	        die(mysqli_error($conn));
	    }
	    // if ($u_name==""){
	    //    die("Empty username");
	    // }
	
	    mysqli_stmt_bind_param($stmt, "ss", $f_name, $l_name);
	
	    mysqli_stmt_execute($stmt);
	
	    $stmt2 = mysqli_stmt_init($conn);
	
	    $sql_pass = "INSERT INTO login_credentials 
	             (account_id, username, password, active) VALUES
	             ((SELECT account_id FROM accounts WHERE first_name='$f_name' AND last_name='$l_name' ORDER BY date_cr DESC LIMIT 1), 
	             ?, ?, 'A')";
	    if (!mysqli_stmt_prepare($stmt2, $sql_pass)) {
	        die(mysqli_error($conn));
	    }
	    mysqli_stmt_bind_param($stmt2, "ss", $u_name, $u_pass); 
	    mysqli_stmt_execute($stmt2); 

        //automatic log in upon sign up
        $sql = "SELECT lc.account_id, lc.username, ac.first_name, ac.last_name 
                FROM login_credentials lc 
                LEFT JOIN accounts ac 
                ON lc.account_id = ac.account_id 
                WHERE lower(username) = lower('$u_username')";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
	
	    session_start();
        $_SESSION["id"] = $row["account_id"];
        $_SESSION["usrn"] = $row["username"];
        $_SESSION["first_name"] = $row["first_name"];
        $_SESSION["last_name"] = $row["last_name"];
            
        header("Location: ../index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sign Up</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    </head>
    <body>
        <script src="functions.js"></script>
        <form id = "signUpForm" method="post" class="sign-up">
            <h2>Sign Up</h2>
            <label for = "f_name">First Name:</label><br>
            <input id = "f_name" type = "text" name = "f_name" required maxlength="12"><br>
            <label for = "l_name">Last Name:</label><br>
            <input id = "l_name" type = "text" name = "l_name" required maxlength="12"><br>
            <label for = "username">Username:</label><br>
            <input id = "username" type = "text" name = "username" onkeyup="checkUnique()" required minlength="4" maxlength = "16"> <br>
            <label id = "notUnique" style = "color: red; display: none">
                This username is taken! <br>
            </label>                    
            <label for = "password">Password:</label><br>
            <input id = "password" type = "password" name = "password" required minlength="4" maxlength = "16"><br>
            <label id = "label" style = "display: none">Fill in all the information boxes</label>
            <button type = "button" id = "button" onclick = "Submit()">Sign up</button> <br>
            <a href="/login">Already have an account? Log In</a>
        </form>
    </body>
</html>
