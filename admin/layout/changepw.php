<?php
include('header_footer/header.php');
include('../class/admin.class.php');
session_start();
// include('sidebar.php');
// echo $_SESSION['password'];
$admin = new Admin();
if (isset($_POST['submit'])) {
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    $curr = $_POST['current_pw'];
    $new = $_POST['new_pw'];
    $confirm = $_POST['confirm_pw'];

    if (!empty($curr) && !empty($new) && !empty($confirm)) {
        if ($curr == $_SESSION['password']) {

            if ($confirm == $new) {
                $admin->newPassword = $new;
                $res = $admin->ResetPw();
                echo $res;
                if ($res == "success") {
                    $msg = "Password successfully Updated.";
                } else {
                    $Errmsg = "Password cannot be updated!!";
                }
            } else {
                $Errmsg = "The new password doesn't match";
            }
        } else {
            $Errmsg = "You entered incorrect password!!Try again";
        }
    } else {
        $Errmsg = "Please enter all details";
    }
}
?>

<div id="page-wrapper">
    <form action="" method="post" novalidate>
        <div>
            <?php if (isset($msg)) { ?>
                <div class="alert alert-success">
                    <?php echo $msg;  ?>
                </div>
            <?php } ?>
            <?php if (isset($Errmsg)) { ?>
                <div class="alert alert-danger">
                    <?php echo $Errmsg;  ?>
                </div>
            <?php } ?>
            <div class="title">
                <h1 class="page-header">Change Password</h1>
            </div>

            <div class="row">
                <div class="form-group">
                    <label for="current" class="label">
                        Enter current password
                    </label>
                    <div class="toggle-password">
                        <input type="password" class="form-control pw" name="current_pw" id="current_pw">
                        <span class="material-icons-outlined  eye">visibility</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="new_pw" class="label">
                        Enter New password
                    </label>
                    <div class="toggle-password">
                        <input type="password" class="form-control pw" name="new_pw" id="new_pw">
                        <span class="material-icons-outlined eye ">visibility</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirm_pw" class="label">
                        Confirm New password
                    </label>
                    <div class="toggle-password">
                        <input type="password" name="confirm_pw" class="form-control pw" id="confirm_pw">
                        <span class="material-icons-outlined eye">visibility</span>
                    </div>
                </div>
                <input class="btn btn-success" type="submit" name="submit" value="submit">
            </div>
        </div>
    </form>
</div>
<?php
include('header_footer/footer.php');
?>