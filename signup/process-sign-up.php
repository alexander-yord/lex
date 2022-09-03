<?php
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
	if ($u_name==""){
	    die("Empty username");
	}
	
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
	
	echo "<br><h2><center> &#10004 Record Saved </center></h2>";
	
	mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
	</head>
    <body>
        <center>
			<br><a href="/login">Now you can log in here</a>
		</center>
    </body>
</html>