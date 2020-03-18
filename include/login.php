<?php
session_start();
include('confg.php');
if (isset($_POST["login"])) {
    $user = stripslashes(mysqli_real_escape_string($con, $_POST['user']));
    $password = md5($_POST['password']);
    if (empty($user)) {
        echo '<div class="alert alert-danger" role="alert"> ادخل اسم المستخدم او بريدك الالكتروني </div>';
    } elseif (empty($_POST['password'])) {
        echo '<div class="alert alert-danger" role="alert"> ادخل كلمه المرور</div>';
    } else {
        $sql = mysqli_query($con, "SELECT * FROM users WHERE (username = '$user' OR email='$user') AND  password='$password' ");
        if (mysqli_num_rows($sql) != 1) {
            echo '<div class="alert alert-danger" role="alert"> اسم الدخول او كلمه المرور غير صحيحه   </div>';
        } else {
            $user = mysqli_fetch_assoc($sql);
            $_SESSION['userid'] = $user['userid'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['gender'] = $user['gender'];
            $_SESSION['avatar'] = $user['avatar'];
            $_SESSION['aboute_user'] = $user['aboute_user'];
            $_SESSION['facebook'] = $user['facebook'];
            $_SESSION['twitter'] = $user['twitter'];
            $_SESSION['youtube'] = $user['youtube'];
            $_SESSION['linkedin'] = $user['linkedin'];
            $_SESSION['date'] = $user['reg_data'];
            $_SESSION['role'] = $user['role'];
            echo '<div class="alert alert-success" role="alert"> تم تسجيل دخولك بنجاح ,سيتم تحويلك للصفحه الرئسيه</div>';
            echo '<meta http-equiv="refresh" content="2; \'index.php\'"/>';                                       
        }
    }
}
?>