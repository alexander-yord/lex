<?php
    session_start();
    // print_r($_SESSION);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>HOME</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    </head>
    
    <body>
        <?php if(isset($_SESSION["id"])): ?>
            <h2>Welcome, <?= htmlspecialchars($_SESSION["first_name"]) ?>! </h2>
        <?php else: ?>
            <h2>Welcome!</h2>
        <?php endif; ?>
        <p>
            This is <b>evidently</b> a draft version.
        </p>
        <p>
            <?php //branch info
               $stringfromfile = file('.git/HEAD', FILE_USE_INCLUDE_PATH);
               $firstLine = $stringfromfile[0]; //get the string from the array
               $explodedstring = explode("/", $firstLine, 3); //seperate out by the "/" in the string
               $branchname = $explodedstring[2]; //get the one that is always the branch name
            ?>
            Version: TEST.0.2 <br>
	        On <?php echo $branchname ?> Branch <br>
        </p>
        <?php if(isset($_SESSION["id"])): ?>
            <a href="logout.php">Log out</a> <br><br>
            <button onclick="location.href='/new'" type="button">Lex Now!</button>
        <?php else: ?>
            <a href="/login">Log in / Sign up</a> <br>
        <?php endif; ?>
        
    </body>
</html>
