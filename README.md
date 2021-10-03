### 🪄 PHP Magic Login

🔒 Password-less login system - Generating login link with Email Address

#### 🍔 Tech Stack
- PHP
- MySQL

#### ✨ Library
- PHPMailer (Included)

#### 💎 Features
- Easy Login & Signup
- Signup & Login in single form just with Email Address
- Auto Token Expiry after successful login
- Token Expiry every X Minutes with CRON
- SMTP Support
- Less Configuration

#### 🧰 Installation

- Clone or Download the Repo

```
git clone https://github.com/WebCheerz/PHP-Magic-Login.git
```

- Import the `login.sql` into Database

- Open `config.php` file

- Edit all these values

|   Variable     |       Value         |  
|----------------|---------------------|
| $smtpUsername  | SMTP Username       | 
| $smtpPassword  | SMTP Password       | 
| $emailFrom     | From Email Address  | 
| $emailFromName | From Address Name   | 
| $smtpHost      | SMTP HOST           | 
| $smtpPort      | SMTP Port Value     | 

Example:
```
$smtpUsername = 'myemail@gmail.com';
$smtpPassword = 'myemailpassword';
$emailFrom = 'myemail@gmail.com';
$emailFromName = 'My Name';
$smtpHost = 'smtp.gmail.com';
$smtpPort = 587; #SMTP Port
```

#### 🏃 Auto Reset token every X Minutes
- To auto reset token every x minutes you need CRON
- Here is how to do that
- Run this command in Terminal
```
crontab -e
```
- Paste this line in bottom of the file (This is for every 60 Minutes)
```
0 * * * * /usr/bin/php /var/www/magicLogin/ResetToken.php
```
- Make sure to change the File path of `ResetToken.php`
- If you want custom time. Please refer to [CronTab.Guru](https://crontab.guru/)
- Now Save and Exit

#### 📝 Todo

- [ ] Captcha

#### License
- MIT