<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>HOME</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
        <link rel="stylesheet" href="general/headers.css">
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
            <a href="logout.php">Log out</a> <br><br>
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
                        echo "<embed type='text/html' src='lex.php?uid=$uid' style='width:100%;height:auto;'>";
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
