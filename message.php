<?php
session_start();
ob_start();

$msg = '';

if (isset($_SESSION['magicRequest']) || isset($_SESSION['magicFailed'])) {
    if (isset($_GET['success']) && $_GET['success'] === "true") {
        if (isset($_SESSION['email'])) {
            header('location: dashboard.php');
        } else {
            $msg = "<p class='message'>🎉 Magic URL Sent! Please Check your Email inbox</p>";
            $title = "Magic URL Sent!";
        }
    } elseif (isset($_GET['failed']) && $_GET['failed'] === "true") {
        if (isset($_SESSION['email'])) {
            header('location: dashboard.php');
        } else {
            $msg = "<div class='message'><h2><a class='login-again' href='index.php'>Please Login Again</a></button></h2><p>😢 Looks like your Magic URL is Expired.</p></div>";
            $title = "Magic URL Expired!";
        }
    } else {
        unset($_SESSION['magicRequest']);
        unset($_SESSION['magicFailed']);
        header('location: index.php');
    }
} else {
    unset($_SESSION['magicRequest']);
    unset($_SESSION['magicFailed']);
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magic URL Sent</title>
    <link rel="stylesheet" href="./assets/style.css">
</head>

<body>
    <div class="container">
        <?php echo $msg; ?>
    </div>
</body>

</html>