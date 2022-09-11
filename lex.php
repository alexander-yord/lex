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
        <div class="lex">
            <?php
                $path = $_SERVER['DOCUMENT_ROOT'];
                $path .= "/general/connectionInfo.php";
                include($path);
                $uid = $_GET["uid"];
                $sql = "SELECT l.content, h.url, lc.username, a.first_name, a.last_name, l.date_cr FROM lexes l
                        LEFT JOIN hyperlinks h ON l.hyperlink = h.uid 
                        LEFT JOIN accounts a ON l.account_id = a.account_id
                        LEFT JOIN login_credentials lc ON l.account_id = lc.account_id
                        WHERE l.uid = '$uid' AND l.public_yn = 'Y';";
                $result = mysqli_query($conn, $sql);
                
                $exists = true;

                if(mysqli_num_rows($result) > 0) {
                    $exists = true;
                    $row = mysqli_fetch_assoc($result);
                    $author_name = $row["a.first_name"] . " " . $row["a.last_name"];
                    $author_usrn = $row["lc.username"];
                    $content = $row["content"];
                    $url = $row["h.url"];
                    $date_cr = $row["l.date_cr"];

                }
                else {
                    $exists = false;
                    // echo this lex does not exist or you do not have permission to view it
                }

            ?>
            <?php if($exists): ?>
                <normalsize style="float:left;"><b><?php echo $author_name ?></b>&nbsp &nbsp</normalsize>
                <a style="float: left; font-size: 16px;">@<?php echo $author_usrn ?></a>
                <a style="float: right;" onclick="copyUrl()"> Share</a> <br>
                <p>
                    Content goes here
                </p>
                <?php if(!is_null($url)): ?>
                    <a href="<?php echo $url?>">Click here to learn more</a>
                <?php endif;?>
                <br>
                <normalsize style="float: right">
                    Published: <?php echo $date_cr ?> 
                </normalsize> <br>

            <?php else: ?>
                <p>This lex either does not exist or is not public.</p>
            <?php endif; ?>
        </div>
        <script type="text/javascript">
            function copyUrl(){
                var uid = "<?php echo $uid ?>";
                var url = "<?php echo $_SERVER['DOCUMENT_ROOT'] ?>";
                url += "/lex.php?url=" + uid;
                navigator.clipboard.writeText(url.value);
                alert("Link copies to clipboard!")
            }
        </script>
    </body>
</html>