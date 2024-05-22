<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../admin/vendor/autoload.php';

class User
{
    private $conn;
    public $id, $username, $email, $password, $created_date, $remember;

    public function __construct()
    {
        $this->conn = new mysqli('localhost', 'root', '', 'anidb');
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    function sendVerifyEmail($uname, $email_id, $token)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'notabandoned01@gmail.com';
            $mail->Password   = 'sekeakuxndqmzalx'; // App-specific password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            //Recipients
            $mail->setFrom('notabandoned01@gmail.com', 'Otaku Oasis');
            $mail->addAddress($email_id, $uname);
            $mail->addReplyTo('notabandoned01@gmail.com', 'Otaku Oasis');

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Email Verification Message | Otaku Oasis';
            $mail->Body    = "This is the HTML message body <b>in bold!</b><br><p><a href='http://localhost/project/user/verify_user.php?token=$token'> Click here to verify your email address</a></p>";
            $mail->AltBody = "Click the following link to verify your email address: http://localhost/project/user/verify_user.php?token=$token";

            $mail->send();
            header('location:signup.php');
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function signup()
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
        $stmt->bind_param('s', $this->email);
        $stmt->execute();
        $check_user_query_run = $stmt->get_result();

        if ($check_user_query_run->num_rows > 0) {
            $_SESSION['status'] = "User Already Exists";
            return false;
        } else {
            $token = md5(rand());
            $stmt = $this->conn->prepare("INSERT INTO users (username, email, password, created_at, token) VALUES (?, ?, ?, NOW(), ?)");
            $stmt->bind_param('ssss', $this->username, $this->email, $this->password, $token);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $_SESSION['status'] = "User Registration successful. Please verify your email address!!";
                $this->sendVerifyEmail($this->username, $this->email, $token);
                return true;
            } else {
                $_SESSION['status'] = "Registration failed. Please try again.";
                return false;
            }
        }
    }

    public function login()
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $stmt->bind_param('ss', $this->email, $this->password);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows > 0) {
            $data = $res->fetch_object();
            $_SESSION['id'] = $data->id;
            $_SESSION['uname'] = $data->username;
            if ($this->remember) {
                setcookie('uname', $data->username, time() + 28 * 24 * 60 * 60, '/');
            } else {
                setcookie('uname', $data->username, time() + 24 * 60 * 60, '/');
            }
            header('location:../index.php');
            exit();
        } else {
            $_SESSION['status'] = "Invalid login credentials";
            return false;
        }
    }
}
