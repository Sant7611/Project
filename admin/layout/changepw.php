<?php
include('header_footer/header.php');
include('../class/admin.class.php');
include('sidebar.php');

$admin = new Admin();

if (isset($_POST['submit'])) {
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    $curr = $_POST['current_pw'];
    $new = $_POST['new_pw'];
    $confirm = $_POST['confirm_pw'];

    if (!empty($curr) && !empty($new) && !empty($confirm)) {
        if ($curr == $_SESSION['password']) {
            if ($confirm == $new) {
                $_SESSION['password'] = $new;
                $admin->$newPassword = $new;
                $res = $admin->ResetPw();
                if ($res == "success") {
                    $msg = "Password successfully Updated.";
                } else {
                    $msg = "Password cannot be updated!!";
                }
            } else {
                $msg = "The new password doesn't match";
            }
        } else {
            $msg = "You entered incorrect password!!Try again";
        }
    } else {
        $msg = "Please enter all details";
    }
}
?>

<div id="page-wrapper">
    <form action="">
        <div>
            <?php if (isset($msg)) { ?>
                <div class="msg">
                    <?php echo $msg;  ?>
                </div>
            <?php } ?>
            <label for="">
                Enter current password
            </label>
            <input type="password" name="current_pw" id="">
        </div>
        <div>
            <label for="">
                Enter New password
            </label>
            <input type="password" name="new_pw" id="">
        </div>
        <div>
            <label for="">
                Confirm New password
            </label>
            <input type="password" name="confirm_pw" id="">
        </div>
        <input type="submit" name="submit" value="submit">
    </form>
</div>