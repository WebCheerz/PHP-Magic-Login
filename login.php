<?php
session_start();
ob_start();
require 'config.php';
$db_connection = new Database();
$connect = $db_connection->dbConnection();
if (isset($_GET["token"])) {

    $token = $_GET["token"];
    $query = "SELECT * FROM magicLogin WHERE token='" . $token . "'";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            'token'     =>     $token
        )
    );
    $count = $statement->rowCount();
    if ($count > 0) {

        //Pick the Details
        $stmt = $connect->prepare("SELECT * FROM magicLogin WHERE token='" . $token . "'");
        $stmt->execute();
        $users = $stmt->fetch(PDO::FETCH_ASSOC);
        $email = isset($users['email']) ? $users['email'] : NULL;
        $_SESSION['email'] = $email;
        $_SESSION['magicRequest'] = 'false';
        $_SESSION['magicFailed'] = 'false';

        //Invalidate the Login Token
        $UpdateToken = "UPDATE magicLogin SET token=NULL WHERE token='" . $token . "'";
        $UpdateToken = $connect->prepare($UpdateToken);
        $UpdateToken->execute();

        header('location: dashboard.php');
    } else {
        $_SESSION['magicFailed'] = 'true';
        header('location: message.php?failed=true');
    }
} else {
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Check</title>
</head>

<body>

</body>

</html>