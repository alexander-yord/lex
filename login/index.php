<?php
    $is_invalid = false;
    
    if($_SERVER["REQUEST_METHOD"] === "POST") {
	$u_username = $_POST["username"];
	$u_password = $_POST["password"];
    
    include("connectionInfo.php");
    
    $sql = "SELECT account_id, username, password FROM login_credentials WHERE lower(username) = lower('$u_username')";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) { //check if a record for this usrn is returned
        $row = mysqli_fetch_assoc($result);
        if ($u_password == $row["password"]){ //checks if password is correct
            //die("You successfully logged in");
            $id = $row["account_id"];
            $sql_info = "SELECT first_name, last_name FROM accounts WHERE account_id = '$id' "; //gets first and last name for the user
            $info = mysqli_query($conn, $sql_info);
            $row_info = mysqli_fetch_assoc($info);
            
            session_start();
            $_SESSION["id"] = $row["account_id"];
            $_SESSION["usrn"] = $row["username"];
            $_SESSION["first_name"] = $row_info["first_name"];
            $_SESSION["last_name"] = $row_info["last_name"];
            
            header("Location: ../index.php");
            exit;
        }
    }
    $is_invalid = true;
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <title>
            Login
        </title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    </head>
    <body>
        <div class="loginSignup">
            <form method="POST">
                <h2>Log In</h2>
                <?php if($is_invalid):?>
                    <em style="color: red;">Invalid log-in information</em><br><br>
                <?php endif; ?>
                
                <label for="username">
                    Username:
                </label> <br>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($_POST["username"] ?? "") ?>"><br>
                <label for="password">
                    Password:
                </label><br>
                <input type="password" id="password" name="password"> <br>
                <button>Log In</button> <br>
                <a href="/signup">Don't have an account? Sign Up</a>
                
            </form>
        </div>
    </body>
</html>