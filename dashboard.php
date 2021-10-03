<?php
session_start();
ob_start();

$_SESSION['magicRequest'] = 'false';
$_SESSION['magicFailed'] = 'false';

if (!isset($_SESSION['email'])) {
    header('location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./assets/style.css">

</head>

<body>
    <div class="container">
        <h2><span class="wave">👋</span> Hello, <?php echo $_SESSION['email']; ?></h2>
        <p><a href="https://webcheerz.com/php-magic-login">✍🏻 Show me the Tutorial</a></p>
        <a href="logout.php">
            <p class="logout">Logout?</p>
        </a>
    </div>
</body>

</html>