<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>HOME</title>
        <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">-->
        <link rel="stylesheet" href="/general/theme.css">
        <link rel="stylesheet" href="/general/headers.css">
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
        </div>
        <br>

        <?php if(!isset($_SESSION["id"])): ?>
            <h2>Welcome!</h2>
            Lex It Now is a platform, which lets you share your thoughts on ongoing events. <br>
            <a href="/login">Log in / Sign up</a> <br>
        <?php else: ?>
            <h2>Welcome, <?= htmlspecialchars($_SESSION["first_name"]) ?>! </h2>
            <?php 
                $path = $_SERVER['DOCUMENT_ROOT'];
                $path .= "/general/connectionInfo.php";
                include($path);

                $account_id = $_SESSION["id"];
                $sql = "SELECT a.first_name, a.last_name, c.username 
                        FROM accounts a LEFT JOIN login_credentials c ON c.account_id=a.account_id 
                        WHERE a.account_id NOT IN 
                        (SELECT follower_id FROM followers WHERE account_id = '$account_id')";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0) {
                    echo "<div class='horizontal-scroll'>";
                    while($row = mysqli_fetch_assoc($result)) {
                        $first_name = $row["a.first_name "];
                        $last_name = $row["a.last_name "];
                        $username = $row["c.username"];
                        echo "<div class='follower-card'>
                        <b>$first_name $last_name</b><br>
                        <a>@$username</a> <br><br>
                        <button>Follow!</button>
                    </div>";
                    }
                    echo "<\div>";
                }
            ?>
            <a href="logout.php">Log out</a> <br><br>

            <div class="horizontal-scroll">
                <div class="follower-card">
                    <b>First Last</b><br>
                    <a>@ddss</a> <br><br>
                    <button>Follow!</button>
                </div>
            </div>

            <?php 
                $path = $_SERVER['DOCUMENT_ROOT'];
                $path .= "/general/connectionInfo.php";
                include($path);

                $sql = "SELECT uid FROM lexes WHERE public_yn = 'Y' ORDER BY date_cr DESC";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0) {
                    echo "<h3>The most recent lexes:</h3>";
                    while($row = mysqli_fetch_assoc($result)) {
                        $uid = $row["uid"];
                        echo "<embed type='text/html' src='lex.php?uid=$uid' style='width:100%;height:30vh;'>";
                    }
                }

            ?>
        <?php endif; ?>

        <div class="footer" id="versionBranchInfo">
            <small>
                <?php //branch info
                    $stringfromfile = file('.git/HEAD', FILE_USE_INCLUDE_PATH);
                    $firstLine = $stringfromfile[0]; //get the string from the array
                    $explodedstring = explode("/", $firstLine, 3); //seperate out by the "/" in the string
                    $branchname = $explodedstring[2]; //get the one that is always the branch name
                ?>
                Version: TEST.0.2 <br>
	            On <?php echo $branchname ?> Branch <br>
            </small>
        </div> 
    </body>
</html>
