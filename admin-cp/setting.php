<?php
include_once('include/header.php');
include_once('include/side_bar.php');
include_once('../include/confg.php');
$msg='';
function catogry()
{
    global $con;
    $catogry = mysqli_query($con, "SELECT * FROM catogry");
    while ($cat = mysqli_fetch_array($catogry)) {
        echo ' <option value="' . $cat['catogry'] . '">' . $cat['catogry'] . '</option>';
    }
}
if (isset($_POST['submit'])) {
    $sel_setting = mysqli_query($con, "SELECT * FROM setting ");
    if (mysqli_num_rows($sel_setting) != 1) {
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
                        $new_name = uniqid('logo', false) . '.' . $img_exe;
                        // هنا بننشأ اسم جديد عشان يبقي
                        $img_dir = '../images/' . $new_name;
                        // هنا بنختار مكان حفظ الصوره بالاضافه لاسم الصوره الي جديد
                        $img_db = 'images/' . $new_name;

                        if (move_uploaded_file($img_tmp, $img_dir)) {
                            // هنا هنطبع الصوره عشان نشوفها لما تتحفظ من المسارالي موجوده فيه 
                            $insert = mysqli_query($con, "INSERT INTO setting (
                               site_name ,
                                logo,
                                slide,
                                slide_value,
                                section_a,
                                section_a_value,
                                section_b,
                                section_b_value,
                                tab_a,
                                tab_a_value,
                               tab_b ,
                               tab_b_value ,
                              tab_c ,
                               tab_c_value,
                              facebook ,
                              twitter,
                              google,
                              instegram,
                            ) VALUES('$_POST[LOGO]','$_POST[slide]','$_POST[slide_value]'
                            ,'$_POST[section_a]','$_POST[section_a_value]','$_POST[section_b]','$_POST[section_b_value]','$_POST[tab_a]','$_POST[tab_a_value]'
                            ,'$_POST[tab_b]','$_POST[tab_b_value]','$_POST[tab_c]','$_POST[tab_c_value]'
                            ,'$_POST[facebook]','$_POST[twitter]','$_POST[google]','$_POST[instegram]'
                            )");
                            if (isset($insert)) {
                                $msg = '<div class="alert alert-success" role="alert"> تم تحديث الاعداداتبنجاح</div>';
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
            $insert = mysqli_query($con, "INSERT INTO setting (
                               site_name ,
                                slide,
                                slide_value,
                                section_a,
                                section_a_value,
                                section_b,
                                section_b_value,
                                tab_a,
                                tab_a_value,
                               tab_b ,
                               tab_b_value ,
                              tab_c ,
                               tab_c_value,
                              facebook ,
                              twitter,
                              google,
                              instegram,
                            ) VALUES('$_POST[LOGO]','$_POST[slide]','$_POST[slide_value]'
                            ,'$_POST[section_a]','$_POST[section_a_value]','$_POST[section_b]','$_POST[section_b_value]','$_POST[tab_a]','$_POST[tab_a_value]'
                            ,'$_POST[tab_b]','$_POST[tab_b_value]','$_POST[tab_c]','$_POST[tab_c_value]'
                            ,'$_POST[facebook]','$_POST[twitter]','$_POST[google]','$_POST[instegram]'
                            )");
            if (isset($insert)) {
                $msg = '<div class="alert alert-success" role="alert"> تم تحديث الاعداداتبنجاح</div>';
            }
        }
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
                        $new_name = uniqid('logo', false) . '.' . $img_exe;
                        // هنا بننشأ اسم جديد عشان يبقي
                        $img_dir = '../images/' . $new_name;
                        // هنا بنختار مكان حفظ الصوره بالاضافه لاسم الصوره الي جديد
                        $img_db = 'images/' . $new_name;

                        if (move_uploaded_file($img_tmp, $img_dir)) {
                            // هنا هنطبع الصوره عشان نشوفها لما تتحفظ من المسارالي موجوده فيه 
                            $insert = mysqli_query($con, "UPDATE setting SET 
                               site_name= '$_POST[LOGO]',
                                logo=' $img_db',
                                slide='$_POST[slide]',
                                slide_value='$_POST[slide_value]',
                                section_a='$_POST[section_a]',
                                section_a_value='$_POST[section_a_value]',
                                section_b='$_POST[tab_c_value]',
                                section_b_value= '$_POST[section_b_value]',
                                tab_a='$_POST[tab_a]',
                                tab_a_value='$_POST[tab_a_value]',
                               tab_b ='$_POST[tab_b]',
                               tab_b_value ='$_POST[tab_b_value]',
                              tab_c ='$_POST[tab_c]',
                               tab_c_value='$_POST[tab_c_value]',
                              facebook ='$_POST[facebook]',
                              twitter='$_POST[twitter]',
                              google='$_POST[google]',
                              instegram='$_POST[instegram]',
                            ");
                            if (isset($insert)) {
                                $msg = '<div class="alert alert-success" role="alert"> تم تحديث الاعداداتبنجاح</div>';
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
            $insert = mysqli_query($con, "INSERT INTO setting (
                               site_name ,
                                slide,
                                slide_value,
                                section_a,
                                section_a_value,
                                section_b,
                                section_b_value,
                                tab_a,
                                tab_a_value,
                               tab_b ,
                               tab_b_value ,
                              tab_c ,
                               tab_c_value,
                              facebook ,
                              twitter,
                              google,
                              instegram,
                            ) VALUES('$_POST[LOGO]','$_POST[slide]','$_POST[slide_value]'
                            ,'$_POST[section_a]','$_POST[section_a_value]','$_POST[tab_c_value]','$_POST[section_b_value]','$_POST[tab_a]','$_POST[tab_a_value]'
                            ,'$_POST[tab_b]','$_POST[tab_b_value]','$_POST[tab_c]','$_POST[facebook]'
                            ,'$_POST[twitter]','$_POST[google]','$_POST[instegram]'
                            )");
            if (isset($insert)) {
                $msg = '<div class="alert alert-success" role="alert"> تم تحديث الاعدادات بنجاح</div>';
            }
        }
    }
}
?>
<article class="col-lg-9">
    <?=$msg?>
    <div class="panel panel-info" style="margin-top:20px">
        <div class="panel-heading"> الاعدادات </div>
        <div class="panel-body">
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="site" class="col-sm-2 control-label">اسم الموقع:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="site" id="site" placeholder="ادخل اسم الموقع">
                    </div>
                </div>
                <div class="form-group">
                    <label for="img" class="col-sm-2 control-label">شعار الموقع</label>
                    <div class="col-sm-6">
                        <input type="file" class="form-control" id="img">
                    </div>
                </div>
                <div class="form-group">
                    <label for="slide" class="col-sm-2 control-label">السلايد شو </label>
                    <div class="col-sm-3">
                        <select name="slide" id="slide" class="form-control">
                            <option value="">اختر التصنيف</option>
                            <?php catogry() ?>
                        </select>
                    </div>
                    <label for="site" class="col-sm-2 control-label">عدد المقالات :</label>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" name="site" id="site" min="3" max="9">
                    </div>
                </div>
                <div class="form-group">
                    <label for="section" class="col-sm-2 control-label"> القسم الاول </label>
                    <div class="col-sm-3">
                        <select name="section" id="section" class="form-control">
                            <option value="">اختر التصنيف</option>
                            <?php catogry() ?>
                        </select>
                    </div>
                    <label for="site" class="col-sm-2 control-label">عدد المقالات :</label>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" name="site" id="site" min="3" max="9">
                    </div>
                </div>
                <div class="form-group">
                    <label for="section2" class="col-sm-2 control-label">القسم الثاني </label>
                    <div class="col-sm-3">
                        <select name="section2" id="section2" class="form-control">
                            <option value="">اختر التصنيف</option>
                            <?php catogry() ?>
                        </select>
                    </div>
                    <label for="site" class="col-sm-2 control-label">عدد المقالات :</label>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" name="site" id="site" min="3" max="9">
                    </div>
                </div>
                <div class="form-group">
                    <label for="tab1" class="col-sm-2 control-label"> التاب الاول </label>
                    <div class="col-sm-3">
                        <select name="tab1" id="tab1" class="form-control">
                            <option value="">اختر التصنيف</option>
                            <?php catogry() ?>
                        </select>
                    </div>
                    <label for="site" class="col-sm-2 control-label">عدد المقالات :</label>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" name="site" id="site" min="3" max="9">
                    </div>
                </div>
                <div class="form-group">
                    <label for="tab2" class="col-sm-2 control-label"> التاب الثاني </label>
                    <div class="col-sm-3">
                        <select name="tab2" id="tab2" class="form-control">
                            <option value="">اختر التصنيف</option>
                            <?php catogry() ?>
                        </select>
                    </div>
                    <label for="site" class="col-sm-2 control-label">عدد المقالات :</label>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" name="site" id="site" min="3" max="9">
                    </div>
                </div>
                <div class="form-group">
                    <label for="tab3" class="col-sm-2 control-label"> التاب الثالث </label>
                    <div class="col-sm-3">
                        <select name="tab3" id="tab3" class="form-control">
                            <option value="">اختر التصنيف</option>
                            <?php catogry() ?>
                        </select>
                    </div>
                    <label for="site" class="col-sm-2 control-label">عدد المقالات :</label>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" name="site" id="site" min="3" max="9">
                    </div>
                </div>
                <div class="form-group">
                    <label for="site" class="col-sm-2 control-label"> facebook</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="site" id="site" placeholder="ادخل اسم الموقع">
                    </div>
                </div>
                <div class="form-group">
                    <label for="twitter" class="col-sm-2 control-label">twitter</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="twitter" id="twitter" placeholder="ادخل اسم الموقع">
                    </div>
                </div>
                <div class="form-group">
                    <label for="google" class="col-sm-2 control-label">google+</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="google" id="google" placeholder="ادخل اسم الموقع">
                    </div>
                </div>
                <div class="form-group">
                    <label for="instegram" class="col-sm-2 control-label">instegram</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="instegram" id="instegram" placeholder="ادخل اسم الموقع">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10 text-center">
                        <button type="submit" name="submit" class="btn btn-danger ">تحديث الاعدادات</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</article>
<?php
include_once('include/footer.php');

?>