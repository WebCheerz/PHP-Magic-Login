<?php
session_start();
ob_start();
require 'config.php';
$db_connection = new Database();
$connect = $db_connection->dbConnection();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';


if (isset($_SESSION['email'])) {
    header('location: dashboard.php');
}


//Generate Token
$token = bin2hex(random_bytes(24));
$ServerURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] ;


if (isset($_POST['login'])) {

    $emailTo = $_POST["email"];

    $query = "SELECT * FROM magicLogin WHERE email =:email";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            'email'     =>   $emailTo
        )
    );
    $count = $statement->rowCount();
    if ($count > 0) {

        //If the Email is Present
        // Insert Token into User Table
        $UpdateToken = "UPDATE magicLogin SET token='" . $token . "' WHERE email='" . $emailTo . "'";
        $UpdateToken = $connect->prepare($UpdateToken);
        $UpdateToken->execute();
        SendEmail();
    } else {
        // Insert User &  Token into User Table
        $AddNew = "INSERT INTO magicLogin (email, token, date_created) VALUES (?,?,now())";
        $AddNew = $connect->prepare($AddNew);
        $AddNew->execute([$emailTo, $token]);
        SendEmail();
    }
}

function SendEmail()
{
    //PHPMailer Object
    $mail = new PHPMailer(true); //Argument true in constructor enables exceptions

    global $smtpUsername;
    global $smtpPassword;
    global $smtpHost;
    global $smtpPort;
    global $emailFrom;
    global $emailFromName;
    global $emailTo;
    global $token;
    global $ServerURL;
    $emailToName = $emailTo;

    $mail->isSMTP();
    $mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
    $mail->Host = $smtpHost; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
    $mail->Port = $smtpPort; // TLS only
    $mail->SMTPSecure = 'tls'; // ssl is deprecated
    $mail->SMTPAuth = true;
    $mail->Username = $smtpUsername;
    $mail->Password = $smtpPassword;
    $mail->setFrom($emailFrom, $emailFromName);
    $mail->addAddress($emailTo, $emailToName);
    $mail->Subject = 'Here is your magic login url'; // '. $token .'
    $mail->msgHTML("Hey, <br><br> Here is the Magic Login URL <br><br> <a href='$ServerURL/login.php?token=$token' target='_blank'>Click here to Open in New Tab</a><br><br>Or Copy paste below link in New Tab<br><br><b>$ServerURL/login.php?token=$token</b><br><br><b>This link will expire in 60 minutes<br><br>Note: If you didn't requested login url.You can ignore this email.<br><br>Thank you."); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
    $mail->AltBody = 'HTML messaging not supported';
    // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file

    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        $_SESSION['magicRequest'] === 'true';
        header('location: message.php?success=true');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Email Sender</title>
    <link rel="stylesheet" href="./assets/style.css">
</head>

<body>
    <div class="container">
        <div class="box">
            <form method="POST">
                <h2>🪄 PHP Magic Login</h2>
                <p>No need of Password, Enter your email and get login link</p>
                <p><a href="https://webcheerz.com/">✍🏻 Show me the Tutorial</a></p>
                <div class="field">
                    <input type="email" name="email" class="email" placeholder="📨 Enter your Email" autocomplete="off" autofocus="on">
                </div>
                <div class="field">
                    <input type="submit" class="login" name="login" value="Login" />
                </div>
            </form>
        </div>
    </div>
</body>

</html>