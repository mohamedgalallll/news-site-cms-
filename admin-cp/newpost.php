<?php
include_once('include/header.php');
include_once('include/side_bar.php');
include_once('../include/confg.php');
$msg = '';
$title = '';
$post = '';
$date = date("Y-m-d");
if (isset($_POST["add_post"])) {
    $title = strip_tags($_POST["title"]);
    $post = $_POST['post'];
    $catogry = $_POST['catogry'];
    $status = $_POST['status'];
    if (empty($title)) {
        $msg = '<div class="alert alert-danger" role="alert">الرجاء ادخال عنوان المقال</div>';
    } elseif (empty($post)) {
        $msg = '<div class="alert alert-danger" role="alert"> الرجاء ادخال المقال</div>';
    } elseif (empty($catogry)) {
        $msg = '<div class="alert alert-danger" role="alert"> الرجاء ادخال تصنيف  </div>';
    } else {
        $img = $_FILES["img"];
        $img_name = $img["name"];
        $img_tmp = $img["tmp_name"];
        $img_size = $img["size"];
        $img_error = $img["error"];
        if ($img_name != '') {
            $img_exe = explode('.', $img_name);
            // استبعاد الاسم لحد .
            $img_exe = strtolower(end($img_exe));
            // تحويل الامتداد بتاع الصوره الي small
            $alllode = array('png', 'jpg', 'gif', 'jpeg');
            // محدد ايه الصور الي تترفع
            if (in_array($img_exe, $alllode)) {
                // هيتم الكشف علي كل الحجات الي محددها من مقاس وامتداد ولو كلو صح هبتدي اطبع اسم انا الي هحددو عشان انا كنت بمسح اسم الصوره
                if ($img_error === 0) {
                    if ($img_size <= 3000000) {
                        $new_name = uniqid('post', false) . '.' . $img_exe;
                        // هنا بننشأ اسم جديد عشان يبقي
                        $img_dir = '../images/posts/' . $new_name;
                        // هنا بنختار مكان حفظ الصوره بالاضافه لاسم الصوره الي جديد
                        $img_db = 'images/posts/' . $new_name;

                        if (move_uploaded_file($img_tmp, $img_dir)) {
                            // هنا هنطبع الصوره عشان نشوفها لما تتحفظ من المسارالي موجوده فيه 

                            $insert = mysqli_query($con, "INSERT INTO post(title,post,catogry,img,auther,status,post_date)
                           VALUES('$title','$post','$catogry','$img_db','$_SESSION[userid]','$status','$date')");
                            if (isset($insert)) {
                                $msg = '<div class="alert alert-success" role="alert"> تم اضافه مقال بنجاح ,جاري تحويلك للمقالت</div>';
                                echo '<meta http-equiv="refresh" content="3;\'posts.php\'"/>';
                            }
                        } else {
                            $msg = '<div class="alert alert-warning" role="alert">عذراً , حدث خطأ اثناء تحميل الصوره  </div>';
                        }
                    } else {
                        $msg = '<div class="alert alert-warning" role="alert">عذرا! ,لاكن حجم الصوره كبير جدا يجب ان لا يتعدى 2MB  </div>';
                    }
                } else {
                    $msg = '<div class="alert alert-warning" role="alert">عذرا حدث خطأ اثناء رفع الصوره</div>';
                }
            } else {
                $msg = '<div class="alert alert-warning" role="alert"> الرجاء ادخال امتداد الصوره المطلوب</div>';
            }
        } else {
            $insert = mysqli_query($con, "INSERT INTO post(title,post,catogry,auther,status,post_date)
            VALUES('$title','$post','$catogry','$_SESSION[userid]','$status','$date')");
            if (isset($insert)) {
                $msg = '<div class="alert alert-success" role="alert"> تم اضافه مقال بنجاح ,جاري تحويلك للمقالت</div>';
                echo '<meta http-equiv="refresh" content="3;\'posts.php\'"/>';
            }
        }
    }
}
?>
<article class="col-lg-9">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <?= $msg ?>
            <div class="panel panel-info" style="margin-top:20px">
                <div class="panel-heading"><b>اضافه مقال جديد</b></div>
                <div class="panel-body">
                    <form class="form-horizontal" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">عنوان المقال</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" value="<?= $title ?>" name="title" id="title" placeholder="ادخل عنوان المقال">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="full-featured" class="col-sm-2 control-label">المقال</label>
                            <div class="col-sm-10">
                                <textarea name="post" id="full-featured" cols="8" class="form-control" rows="10"> <?= $post ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="catogry" class="col-sm-2 control-label">اختر التصنيف</label>
                            <div class="col-sm-4">
                                <select name="catogry" id="catogry" class="form-control">
                                    <option value="">اختر التصنيف</option>
                                    <?php
                                    $cato = mysqli_query($con, "SELECT * FROM catogry");
                                    while ($row = mysqli_fetch_array($cato)) {
                                        echo '<option value="' . $row['catogry'] . '">' . $row['catogry'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="img" class="col-sm-2 control-label">اختر صوره</label>
                            <div class="col-sm-5">
                                <input type="file" class="form-control" name="img" id="img">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status" class="col-sm-2 control-label">حاله المقال </label>
                            <div class="col-sm-4">
                                <select name="status" id="status" class="form-control">
                                    <option >اختار الحاله </option>
                                    <option value="puplished">نشر </option>
                                    <option value="derft">تعطيل </option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-danger" name="add_post">اضافه المقال</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</article>
<?php
include_once('include/footer.php');
?>