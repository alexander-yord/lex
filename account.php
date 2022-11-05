<?php
    session_start();

    $path = $_SERVER['DOCUMENT_ROOT']; //account.php?id=
    $path .= "/general/connectionInfo.php";
    include($path);
    $account_id = $_GET["id"]; //id of the account

    $sql = "SELECT a.first_name as first_name, a.last_name as last_name, c.username as username 
        FROM accounts a LEFT JOIN login_credentials c ON
        a.account_id = c.account_id
        WHERE a.account_id = '$account_id'";    
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) { //check if a record for this account_number is returned
        $account_exists = true;
        $row = mysqli_fetch_assoc($result);
        $first_name = $row["first_name"];
        $last_name = $row["last_name"];
        $username = $row["username"];
    }
    else {
        $account_exists = false;
    }
    
    $path = $_SERVER['DOCUMENT_ROOT']; //account.php?id=
    $path .= "/general/connectionInfo.php";
    include($path);
    $account_id = $_GET["id"]; //id of the account

    $sql = "SELECT a.first_name as first_name, a.last_name as last_name, c.username as username 
            FROM accounts a LEFT JOIN login_credentials c ON
            a.account_id = c.account_id
            WHERE a.account_id = '$account_id'";
    
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) { //check if a record for this account_number is returned
        $account_exists = true;
        $row = mysqli_fetch_assoc($result);
        $first_name = $row["first_name"];
        $last_name = $row["last_name"];
        $username = $row["username"];
        }
    else {
        $account_exists = false;
    }

    //check if the user is following this account
    $following = false;
    if (isset($_SESSION["id"]) && $account_exists) {
        $user_account_id = $_SESSION["id"]; //id of the viewer of the account
        $sql_following = "SELECT uid FROM followers where account_id = '$account_id' 
                          and follower_id = '$user_account_id'";
        $result_f = mysqli_query($conn, $sql_following);
        if (mysqli_num_rows($result_f) > 0) {
            $following = 1; // evaluates to true in js 
        }
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Account | Lex</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
        <link rel="stylesheet" href="/general/theme.css">
        <link rel="stylesheet" href="/general/headers.css">
        <meta name="theme-color" content="#76B947"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    
    <body>
        <div class="header">
            <div class="topnav" id="myHeader">
                <a href="/index.php" style="float: left;">Home</a>
                <a href="logout.php" style="display: none">My Account</a>
                <a href="/new">Lex Now!</a>
            </div>
        </div> <br><br>

        <?php if($account_exists):?>
            <h2><?php echo $first_name . " " . $last_name; ?></h2> 
            <a>@<?php echo $username; ?></a>
            <input type="button" value="Follow!" id="follow-unfollow" style="float: right;"/>
            <br><br>

        <?php else: ?>
            <center>
                <h2>Sorry, this account does not exist!</h2>
            </center>
        <?php endif ?>
        
        <script>
            const btn = document.getElementById("follow-unfollow");
            btn.addEventListener("click", ()=>{
                if(btn.value === "Follow!"){ // if not following 
                    btn.value = "Unfollow"; // changes the text to be following 
                    btn.style.backgroundColor = "#d0cfcf"; 
                    btn.style.color = "#000";
                }else{
                    if (confirm('Are you sure you want to unfollow this account?')) {
                        btn.value= "Follow!";
                        btn.style.backgroundColor = "#76B947";
                        btn.style.color = "white";
                    } else {
                        // Do nothing!
                    }
                }
            });
            
            if(<?php echo $following ?> == true) { //clicks the following button if the user is following this account
                document.getElementById("follow-unfollow").click();
            }
        </script>
        
    </body>
    
</html>