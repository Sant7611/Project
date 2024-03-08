<?php
include('header.php');
include('../class/category_class.php');

session_start();
$category = new Category();

$error = [];

if (isset($_POST['submit'])) {
    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $existingCategory = $category->retrieve();

        if (!$existingCategory) {
            $category->set('name', $_POST['name']);
            $category->set('status', $_POST['status']);
            $category->set('created_date', date('Y-m-d H:i:s'));
            $result = $category->save();

            if($result) {
                $msg = "Category inserted successfully with id" . $category->save();
            } else {
                $error['msg'] = "Failed to insert the data";
            }
        } else {
            $error['msg'] = "Category already exists.";
        }
    } else {
        $error['msg'] = "Please fill the name field.";
    }
}
?>

<div class="category">
    <div class="row">
        <div class="heading">
            <p>Create Category</p>
        </div>
    </div>
    <div class="row">
        <div class="headings">
        <?php if(isset($error['msg']) && !empty($error['msg'])){?>
                <label class="error"><?php echo $error['msg']; ?></label>
            <?php } ?>
            <?php if(isset($msg) && !empty($msg)){?>
                <label ><?php echo $msg; ?></label>
            <?php } ?>

            <form action="" method="post" novalidate>
                <fieldset>
                    <div class="form-grp">
                        <label>Name</label><br>
                        <input type="text" class="form_input" name="name" id="name" required>
                        <br>
                        <!-- <span id="categoryError" style="color:red"></span> -->
                    </div>
                    <div class="form-grp">
                        <label>Status</label><br>
                        <div class="select">
                            <label for="option1">
                                <input type="radio" name="status" id="option1" value="1" checked> Active
                            </label>
                            <label for="option2">
                                <input type="radio" name="status" id="option2" value="0"> Inactive
                            </label>
                        </div>
                    </div>
                    <button type="submit" name="submit" value="submit" class="success">Submit Button</button>
                    <button type="reset" class="danger">Reset Button</button>
                </fieldset>
            </form>
        </div>
    </div>
</div>