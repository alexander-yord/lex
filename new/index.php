<?php
    include("connectinoInfo.php");
    session_start();
    if(isset($_SESSION["id"])){
        $acount_id = $_SESSION["id"];
        $first_name = $_SESSION["first_name"];
        $last_name = $_SESSION["last_name"];
        
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $content = $_POST["content"];
            $url = $_POST["url"];

            if (strlen($url) === 0) {
                $sql = "insert into lexes (content, account_id, public_yn) 
	                values (?, ?, 'Y')";
	            $stmt = mysqli_stmt_init($conn);
	            if (!mysqli_stmt_prepare($stmt, $sql)) {
	                die(mysqli_error($conn));
	            }
	            mysqli_stmt_bind_param($stmt, "ss", $content, $account_id);
	            mysqli_stmt_execute($stmt); 

                //go back to home page
                header("Location: ../index.php");
            }
            else { //if an url has been entered 
                //insert the url into the hyperlinks table
                $sql_link = "insert into hyperlinks (url) 
	                values (?)";
	            $stmt = mysqli_stmt_init($conn);
	            if (!mysqli_stmt_prepare($stmt, $sql)) {
	                die(mysqli_error($conn));
	            }
	            mysqli_stmt_bind_param($stmt, "s", $url);
	            mysqli_stmt_execute($stmt); 

                //insert the content of the lex into the lexes table 
                $sql_content = "INSERT INTO lexes (content, hyperlink, account_id, public_yn)
                values (?, (SELECT uid FROM hyperlinks WHERE url = ? ORDER BY uid DESC LIMIT 1), ?, 'Y')";
                $stmt2 = mysqli_stmt_init($conn);
	            if (!mysqli_stmt_prepare($stmt2, $sql)) {
	                die(mysqli_error($conn));
	            }
	            mysqli_stmt_bind_param($stmt2, "sss", $content, $url, $account_id);
	            mysqli_stmt_execute($stmt2);
            }
        }
    }
    else{
        header("Location: ../login");
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
        <form method="post">
            <h2>Lex It Now!</h2> <br> 
            <label for="content">Your Lex:</label> <br>
            <textarea maxlength="512" id="content" name="content" maxlength="512" onkeyup="contentCounter()" style="width: 100%; box-sizing: border-box;" required></textarea>
            <div id="contentCounter" style="float: right">0/512</div> <br>
            <label for="url">Add a link (optional):</label> <br>
            <input type="url" id="url" name="url" style="width: 100%; box-sizing: border-box;" onkeyup="urlCounter()" maxlength="512">
            <div id="urlCounter" style="float: right">0/512</div> <br>
            <button type="submit">Lex It Now</button>
        </form>
    </body>
</html>
