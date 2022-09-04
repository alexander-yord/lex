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
            Version: TEST.0.1.1 <br>
	    On SignupEdits Branch <br>
	    Uncommitted Change
        </p>
        <?php if(isset($_SESSION["id"])): ?>
            <a href="logout.php">Log out</a>
        <?php else: ?>
            <a href="/login">Log in / Sign up</a> <br>
        <?php endif; ?>
        
        
    </body>
    
</html>
