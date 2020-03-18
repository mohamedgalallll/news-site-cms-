<?php
function registor()
{
    if (isset($_SESSION['userid'])) {
        echo '<div class="alert alert-danger" role="alert" >  عذرا يا  '  .  $_SESSION['username']  .  ' ولاكن مسجل لدينا بالفعل  </div>';
    } else {
        echo ' <form class="form-horizontal" method="post" id="registor" action="include/registor.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label"> <span style=" color:red">*</span> اسم المستخدم</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="username" style="font-size: 13px" name="username">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label"><span style=" color:red">*</span> البريد الالكتروني</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="password"><span style=" color:red">*</span> كلمه المرور </label>
                <div class="col-sm-10">
                    <input type="password" id="password" class="form-control" style="font-size: 13px" name="password">
                </div>
            </div>
            <div class="form-group">
                <label for="con_password" class="col-sm-2 control-label"><span style=" color:red">*</span> تأكيد كلمه المرور</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="con_password" name="con_password">
                </div>
            </div>
            <div class="form-group">
                <label for="gender" class="col-sm-2 control-label"> <span style=" color:red">*</span> الجنس </label>
                <div class="col-sm-2">
                    <select name="gender" class="form-control" id="gender" style="font-size: 13px">
                        <option value="">النوع</option>
                        <option value="male">ذكر</option>
                        <option value="female">انثي</option>

                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="img" class="col-sm-2 control-label"> الصوره الشخصيه</label>
                <div class="col-sm-10">
                    <input type="file" name="img" id="img" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="about" class="col-sm-2 control-label">وصف مختصر عنك</label>
                <div class="col-sm-10">
                    <textarea name="about" id="about" cols="30" rows="10" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="facebook" class="col-sm-2 control-label"><i class="fab fa-facebook fa-2x"></i></label>
                <div class="col-sm-10">
                    <input class="form-control" name="facebook" id="facebook" style="font-size: 13px" placeholder="ادخل رابط الفيس بوك الخاص بك ">
                </div>
            </div>
            <div class="form-group">
                <label for="twitter" class="col-sm-2 control-label"><i class="fab fa-twitter fa-2x"></i></label>
                <div class="col-sm-10">
                    <input class="form-control" name="twitter" id="twitter" placeholder="ادخل الرابط تويتر الخاص بك">
                </div>
            </div>
            <div class="form-group">
                <label for="youtube" class="col-sm-2 control-label"><i class="fab fa-youtube fa-2x"></i></label>
                <div class="col-sm-10">
                    <input class="form-control" name="youtube" id="youtube" style="font-size: 13px" placeholder="ادخل  رابط اليوتيوب الخاص بك">
                </div>
            </div>
            <div class="form-group">
                <label for="linkedin" class="col-sm-2 control-label"> <i class="fab fa-linkedin fa-2x"></i></label>
                <div class="col-sm-10">
                    <input class="form-control" name="linkedin" id="linkedin" placeholder="ادخل   رابط لينكدان الخاص بك">
                </div>
            </div>
            <div class="text-center">
                <div id="result">

                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-5 text-center">
                    <button type="submit" name="submit" class="btn btn-info btn-block">انشاء حساب <i class="fas fa-user-edit"></i> </button>
                </div>
            </div>
        </form>';
    }
}
function login()
{
    if (isset($_SESSION['userid'])) {
        echo ' <div class="panel panel-default">
                <div class="panel-heading text-center"><b> اهلا وسهلا بك يا ' . ucwords($_SESSION['username']) . ' </b></div>
                <div class="panel-body">
                    <div class="text-center">
                        <img src="' . $_SESSION['avatar'].'" alt="">
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <p><b>الريد الالكتروني :</b> ' . $_SESSION['email'] . '</p>
                            <p><b>روابط التواصل الاجتماعي :</b>
                                <a href="' . $_SESSION['facebook'] . '" target="_blank"><i class="fab fa-facebook-square  log_fa"></i></a>
                                <a href="' . $_SESSION['twitter'] . '" target="_blank"><i class="fab fa-twitter log_tw"></i></a>
                                <a href="' . $_SESSION['youtube'] . '" target="_blank"><i class="fab fa-youtube log_yo"></i></a>
                                <a href="' . $_SESSION['linkedin'] . '" target="_blank"><i class="fab fa-linkedin log_lin"></i></a> 
                            </p>

                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                            '; 
                            if($_SESSION['role'] == 'admin' ){
                               echo '<a href="admin-cp/index.php" type="button" class="btn btn-danger pull-left btn-xm"> لوحه التحكم </a>';
                            }
                            echo ' 
                            </div>
                            <div class="col-md-6">
                              <a href="admin-cp/profile.php" type="button" class="btn btn-info pull-right btn-xm">الصفحه الشخصيه </a>

                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>';
    } else {
        echo '
            <div class="panel panel-default">
                <div class="panel-heading text-center">تسجيل الدخول </div>
                <div class="panel-body">
                    <div class="text-center">
                        <img src="images/iconfinder_scientist_einstein_avatar_professor_4043274.png" alt="">
                    </div>
                    <form action="include/login.php" class="form-horizontal" id="login" method="post">
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label"><i class="fas fa-user fa-2x"></i></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="username" name="user" style="font-size: 13px" placeholder="ادخل اسم المستخدم او البريد الالكتروني">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label"><i class="fas fa-lock fa-2x"></i></label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" id="password" placeholder="ادخل كلمه المرور">
                            </div>
                        </div>
                        <div id="login_result" style="text-align:center">
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-info" name="login">تسجيل دخول</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer"> <i class="fas fa-exclamation-triangle" style="color: red"></i>اذا لم تكون مسجل لدينا<a href="registor.php"> اضغط هنا </i></a> </div>
            </div>';
    }
}
?>