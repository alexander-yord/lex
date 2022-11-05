<?php
    session_start();
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
<style>

</style>

    </head>
    
    <body>
        <div class="header">
            <div class="topnav" id="myHeader">
                <a href="/index.php" style="float: left;">Home</a>
                <a href="logout.php" style="display: none">My Account</a>
                <a href="/new">Lex Now!</a>
            </div>
        </div>
        <?php
            $path = $_SERVER['DOCUMENT_ROOT']; //account.php?id=
            $path .= "/general/connectionInfo.php";
            include($path);
            $account_id = $_GET["id"]; //id of the account
            $user_account_id = $_SESSION["id"]; //id of the viewer of the account

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
        ?>

        <?php if($account_exists):?>
            <h2><?php echo $first_name . " " . $last_name; ?></h2> 
            <a>@<?php echo $first_name . " " . $last_name; ?></a>
            <input type="button" value="Follow" id="follow-unfollow" style="float: right;"/>
            <br><br>
        <?php else: ?>
        
        <?php endif ?>
        
        <script>
            const btn = document.getElementById("follow-unfollow");
            btn.addEventListener("click", ()=>{
                if(btn.value === "Follow"){
                    btn.value = "Unfollow";
                }else{
                    btn.value= "Follow";
                }
            })
        </script>
        
    </body>
    
</html>