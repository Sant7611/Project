<?php
include('headerFooter/header.php');
include('../class/category.class.php');

$category = new Category();
@session_start();
if (isset($_POST['submit'])) {
    if (isset($_POST['CategoryEntry']) && !empty($_POST['CategoryEntry'])) {
        $category->set('name', $_POST['name']);
        $category->set('rank', $_POST['rank']);
        $category->set('status', $_POST['status']);
        $category->set('created_by', $_SESSION['id']);
        $category->set('created_date', date('Y-m-d H:i:s'));
        $result = $category->save();
        if ($result) {
            $ErrMsg = "";
            $msg = "Category inserted Successfully with id " . $result;
        } else {
            $msg = "";
        }
    } else {
        $ErrMsg = "Category Already Taken!";
    }
}
include('sideBar.php');

?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Create Category</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?php if (isset($msg)) { ?>
                <div class="alert alert-success" role="alert"><?php echo $msg;  ?></div>
            <?php  } ?>
            <?php if (isset($ErrMsg)) { ?>
                <div class="alert alert-danger"><?php echo $ErrMsg;  ?></div>
            <?php  } ?>
            <form role="form" id="submitForm" method="post" noValidate>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                    <input type="hidden" name="CategoryEntry" id="CategoryEntry">
                    <span id="categoryError" style="color:red"></span>
                </div>
                <div class="form-group">
                    <label>Rank</label>
                    <input type="number" class="form-control" name="rank" placeholder="Enter Rank" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" id="optionsRadios1" value="1" checked>Active
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" id="optionsRadios2" value="0">Inactive
                        </label>
                    </div>
                </div>
                <button type="submit" name="submit" value='submit' class="btn btn-success">Submit Button</button>
                <button type="reset" class="btn btn-danger">Reset Button</button>
            </form>
        </div>
    </div>
</div>
</div>
<?php
include('headerFooter/footer.php');
?>

<script>
    $(document).ready(function() {
        $('#name').keyup(function() {
            const value = $("#name").val();
            $.ajax({
                url: "checkCategoryName.php",
                method: "post",
                dataType: "text",
                data: {
                    'categoryName': value
                },
                success: function(res) {
                    if (res != "success") {
                        $("#categoryError").text(res);
                        $("#CategoryEntry").val("");
                    } else {
                        $("#categoryError").text("");
                        $("#CategoryEntry").val("success");

                    }
                }
            })
        })
    })
</script>