<?php
 include('headerFooter/header.php');
 include('../class/category.class.php');
 include('../class/news.class.php');

 $category = new Category();
 $categoryList = $category->retrieve();

 $news = new News();
 $news->set('id', $_GET['id']);
 $retrieveData = $news->getById();

 @session_start();
 if(isset($_POST['submit'])){
    $news->set('title', $_POST['title']);
    $news->set('short_detail', $_POST['short_detail']);
    $news->set('detail', $_POST['detail']);
    $news->set('featured', $_POST['featured']);
    $news->set('breaking', $_POST['breaking']);
    $news->set('status', $_POST['status']);
    $news->set('slider_key', $_POST['slider_key']);
    $news->set('category_id', $_POST['category_id']);
    $news->set('modified_by',$_SESSION['id']);
    $news->set('modified_date', date('Y-m-d H:i:s'));
    if(empty($_FILES['image']['name'])){
        $news->set('image',$_POST['old_image']);
    }else{
        if($_FILES['image']['error'] == 0){
            if($_FILES['image']['type'] == "image/png" ||
               $_FILES['image']['type'] == "image/jpg" || 
               $_FILES['image']['type'] == "image/jpeg"){
               if($_FILES['image']['size'] <= 1024 *1024){
                   $imageName = uniqid().$_FILES['image']['name'];
                   move_uploaded_file($_FILES['image']['tmp_name'],
                    '../images/'.$imageName);
                   $news->set('image', $imageName);
               }else{
                $imageError ="Error, Exceeded 1mb!";
               }
            }else{
                $imageError = "Invalid Image!";
            }
        }
    }

    $result = $news->edit();   
    if($result){
        $ErrMs= "";
        $news->set('id', $_GET['id']);
        $retrieveData = $news->getById();
        $msg = "News updated Successfully with id ".$result;
    }else{
        $msg = ""; 
    }
 }
 include('sideBar.php');

?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit News</h1>
                </div>
            </div>
            <div class="row">
                 <div class="col-lg-6">
                    <?php  if(isset($msg)) { ?>
                    <div class="alert alert-success"><?php echo $msg;  ?></div>
                    <?php  } ?>
                    <?php  if(isset($ErrMsg)) { ?>
                    <div class="alert alert-danger"><?php echo $ErrMsg;  ?></div>
                    <?php  } ?>
                    <form role="form" id="submitForm" method="post" enctype="multipart/form-data" noValidate>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" id="title" value="<?php echo $retrieveData->title;  ?>" required>
                        </div>
                        <div class="form-group">
                            <label>News Category</label>
                            <select class="form-control" name="category_id" required>
                                <option value="">Select Category</option>
                                <?php foreach($categoryList as $category) {  ?>
                                   <option value="<?php echo $category['id'];  ?>" 
                                       <?php  if($retrieveData->category_id == $category['id']) { echo "selected"; }  ?>>
                                         <?php echo $category['name'];  ?>
                                   </option>
                                <?php  } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Short Detail</label>
                            <textarea class="form-control" rows="3" name="short_detail" required><?php echo $retrieveData->short_detail;  ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Detail</label>
                            <textarea class="form-control ckeditor" rows="3" name="detail" ><?php echo $retrieveData->detail;  ?></textarea>
                        </div>
                        <div class="form-group" enctype="multipart/form-data">
                            <label>Image</label><br>
                            <input type="hidden" value="<?php echo $retrieveData->image;  ?>" name="old_image">
                            <img src="../images/<?php echo $retrieveData->image;  ?>" height="100" width="200" alt="" srcset=""><br>
                            <br><input type="file" name="image">
                        </div>
                        <div class="form-group">
                            <label>Featured News</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="featured" id="optionsRadios1" value="1" <?php if($retrieveData->featured == 1) { echo "checked"; }  ?>>Yes
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="featured" id="optionsRadios2" value="0" <?php if($retrieveData->featured != 1) { echo "checked"; }  ?>>No
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Breaking News</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="breaking" id="optionsRadios1" value="1" <?php if($retrieveData->breaking == 1) { echo "checked"; }  ?>>Yes
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="breaking" id="optionsRadios2" value="0" <?php if($retrieveData->breaking != 1) { echo "checked"; }  ?>>No
                                </label>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label>Slider Key</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="slider_key" id="optionsRadios1" value="1" <?php if($retrieveData->slider_key == 1) { echo "checked"; }  ?>>Yes
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="slider_key" id="optionsRadios2" value="0" <?php if($retrieveData->slider_key != 1) { echo "checked"; }  ?>>No
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="status" id="optionsRadios1" value="1" <?php if($retrieveData->status == 1) { echo "checked"; }  ?>>Active
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="status" id="optionsRadios2" value="0" <?php if($retrieveData->status != 1) { echo "checked"; }  ?>>Inactive
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
   <script src="../js/ckeditor/ckeditor.js"></script>  

   <script>
    $(document).ready(function(){
       $('#name').keyup(function(){
          const value = $("#name").val();
          $.ajax({
            url:"checkCategoryName.php",
            method:"post",
            dataType:"text",
            data:{'categoryName':value},
            success:function(res){
                if(res != "success"){
                    $("#categoryError").text(res);
                    $("#CategoryEntry").val("");
                }else{
                    $("#categoryError").text("");
                    $("#CategoryEntry").val("success");

                }
            }
          })
       })
    })
   </script>