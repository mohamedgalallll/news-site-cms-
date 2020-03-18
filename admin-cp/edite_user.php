<?php
include_once('include/header.php');
include_once('include/side_bar.php');
include_once('../include/confg.php');
$msg = '';
$id = intval($_GET["user"]);
// INTVAL بتخلي القيمه رقميه فقط 
if (isset($_GET['user'])) {
    $sql = mysqli_query($con, "SELECT * FROM users WHERE userid='$id' ");
    $user = mysqli_fetch_array($sql);
}
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    if (empty($username)) {
        $msg = '<div class="alert alert-danger" role="alert"> الرجاء ادخال اسم المستخدم</div>';
    } elseif (empty($email)) {
        $msg = '<div class="alert alert-danger" role="alert"> الرجاء ادخال الايميل</div>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = '<div class="alert alert-danger" role="alert"> الرجاء ادخال بريد الكتروني صحيح </div>';
    } else {
        $img = $_FILES["img"];
        $img_name = $img["name"];
        $img_tmp = $img["tmp_name"];
        $img_size = $img["size"];
        $img_error = $img["error"];
        if ($img_name != '') {
            $img_exe = explode('.', $img_name);
            $img_exe = strtolower(end($img_exe));
            $alllode = array('png', 'jpg', 'gif', 'jpeg');
            if (in_array($img_exe, $alllode)) {
                if ($img_error === 0) {
                    if ($img_size <= 3000000) {
                        $new_name = uniqid('user', false) . '.' . $img_exe;
                        $img_dir = '../images/imguser/' . $new_name;
                        $img_db = 'images/imguser/' . $new_name;
                        if (move_uploaded_file($img_tmp, $img_dir)) {
                            $upd = mysqli_query($con, "UPDATE users SET username=' $username', email='$email', password='$_POST[password]' , gender='$_POST[gender]' ,avatar='$img_db',aboute_user='$_POST[about]', facebook='$_POST[facebook]',twitter='$_POST[twitter]',youtube='$_POST[youtube]',linkedin='$_POST[linkedin]',role='$_POST[role]'  WHERE userid='$id'");
                            if (isset($upd)) {
                                $msg = '<div class="alert alert-success" role="alert"> تم تحديث البيانات بنجاح ,جاري تحويلك للأعضاء</div>';
                                echo '<meta http-equiv="refresh" content="3;\'users.php\'"/>';
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
        }
    }
}
?>
<article class="col-lg-9">
    <?= $msg ?>
    <div class="panel panel-info" style="margin-top:20px">
        <div class="panel-heading">تعديل بيانات العضو : <?= $user['username'] ?></div>
        <div class="panel-body">
            <form class="form-horizontal col-md-9" method="post" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="username" class="col-sm-2 control-label"> <span style=" color:red">*</span> اسم المستخدم</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="username" style="font-size: 13px" name="username" value="<?= $user['username'] ?>" placeholder="اسم المستخدم">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label"><span style=" color:red">*</span> البريد الالكتروني</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="email" value="<?= $user['email'] ?>" name=" email" placeholder="البريد الالكتروني">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="password">كلمه المرور </label>
                    <div class="col-sm-9">
                        <input type="password" id="password" class="form-control" style="font-size: 13px" name="password" placeholder="كلمه المرور ">
                    </div>
                </div>
                <div class="form-group">
                    <label for="con_password" class="col-sm-2 control-label">تأكيد كلمه المرور</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="con_password" name="con_password" placeholder="تأكيد كلمه المرور ">
                    </div>
                </div>
                <div class="form-group">
                    <label for="gender" class="col-sm-2 control-label"> الجنس </label>
                    <div class="col-sm-2">
                        <select name="gender" class="form-control" id="gender" style="font-size: 13px">
                            <option value="">النوع</option>
                            <option value="male" <?= ($user['gender'] == 'male' ? 'selected' : '') ?>>ذكر</option>
                            <option value="female" <?= ($user['gender'] == 'female' ? 'selected' : '') ?>>انثي</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="img" class="col-sm-2 control-label"> الصوره الشخصيه</label>
                    <div class="col-sm-9">
                        <input type="file" name="img" id="img" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="about" class="col-sm-2 control-label">وصف مختصر عنك</label>
                    <div class="col-sm-9">
                        <textarea name="about" id="about" class="form-control"> <?= $user['aboute_user'] ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="facebook" class="col-sm-2 control-label"><i class="fab fa-facebook fa-2x"></i></label>
                    <div class="col-sm-9">
                        <input class="form-control" name="facebook" id="facebook" <?= $user['facebook'] ?> style="font-size: 13px" placeholder="ادخل رابط الفيس بوك الخاص بك ">
                    </div>
                </div>
                <div class="form-group">
                    <label for="twitter" class="col-sm-2 control-label"><i class="fab fa-twitter fa-2x"></i></label>
                    <div class="col-sm-9">
                        <input class="form-control" name="twitter" id="twitter" <?= $user['twitter'] ?> placeholder="ادخل الرابط تويتر الخاص بك">
                    </div>
                </div>
                <div class="form-group">
                    <label for="youtube" class="col-sm-2 control-label"><i class="fab fa-youtube fa-2x"></i></label>
                    <div class="col-sm-9">
                        <input class="form-control" name="youtube" id="youtube" <?= $user['youtube'] ?> style="font-size: 13px" placeholder="ادخل  رابط اليوتيوب الخاص بك">
                    </div>
                </div>
                <div class="form-group">
                    <label for="linkedin" class="col-sm-2 control-label"> <i class="fab fa-linkedin fa-2x"></i></label>
                    <div class="col-sm-9">
                        <input class="form-control" name="linkedin" id="linkedin" <?= $user['linkedin'] ?> placeholder="ادخل   رابط لينكدان الخاص بك">
                    </div>
                </div>
                <div class="form-group">
                    <label for="role" class="col-sm-2 control-label"> الصلاحيه </label>
                    <div class="col-sm-2">
                        <select name="role" class="form-control" id="role" style="font-size: 13px">
                            <option value="">اختر الصلاحيه</option>
                            <option value="user" <?= ($user['role'] == 'user' ? 'selected' : '') ?>>عضو</option>
                            <option value="admin" <?= ($user['role'] == 'admin' ? 'selected' : '') ?>>مدير</option>
                            <option value="writir" <?= ($user['role'] == 'writir' ? 'selected' : '') ?>>كاتب</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-9 text-center">
                        <button type="submit" name="submit" class="btn btn-info btn-block">تعديل حساب <i class="fas fa-user-edit"></i> </button>
                    </div>
                </div>
            </form>
            <div class="panel panel-default col-md-3">
                <div class="panel-body text-center">
                    <img src="../<?= $user['avatar'] ?>" class="img-circle" width="100%" alt="">
                </div>
            </div>
        </div>
    </div>
</article>
<?php
include_once('include/footer.php');

?>