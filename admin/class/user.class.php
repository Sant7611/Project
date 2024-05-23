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
            $_SESSION['status'] = "<p class = 'msg'>User Already Exists</p>";
            return false;
        } else {
            $token = md5(rand());
            $status = 'pending';
            $stmt = $this->conn->prepare("INSERT INTO users (username, email, status, password, created_at, token) VALUES (?, ?,?, ?, NOW(), ?)");
            $stmt->bind_param('sssss', $this->username, $this->email, $status, $this->password, $token);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $_SESSION['status'] = "User Registration successful. Please verify your email address!!";
                $this->sendVerifyEmail($this->username, $this->email, $token);
                return true;
            } else {
                $_SESSION['status'] = "<p class = 'msg'>Registration failed. Please try again.</p>";
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
            if($data->status != 'verified'){
                $_SESSION['status']  = '<p class = "msg">Please verify your email address to continue</p>';
                header('location:login.php');
                exit();
            }else{
                if ($this->remember) {
                    setcookie('uname', $data->username, time() + 28 * 24 * 60 * 60, '/');
                } else {
                    setcookie('uname', $data->username, time() + 24 * 60 * 60, '/');
                }
                header('location:../index.php');
                exit();
            }
        } else {
            $_SESSION['status'] = "<p class = 'msg' >Invalid login credentials</p>";
            return false;
        }
    }
}
