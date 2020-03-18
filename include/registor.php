<?php
session_start();  

        include_once("confg.php");
        if (isset($_POST['submit'])) {
            $username = strip_tags($_POST['username']);
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            $about =  strip_tags($_POST['about']);
            $facebook = htmlspecialchars($_POST['facebook']);
            $twitter =  htmlspecialchars($_POST['twitter']);
            $youtube = htmlspecialchars($_POST['youtube']);
            $linkedin = htmlspecialchars($_POST['linkedin']);
            $date = date("Y-m-d");
            if (empty($username)) {
                echo '<div class="alert alert-warning" role="alert">الرجاء ادخال اسم المستخدم</div>';
            } elseif (empty($email)) {
                echo '<div class="alert alert-warning" role="alert"> الرجاء ادخال بريدك الالكتروني</div>';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo '<div class="alert alert-warning" role="alert"> الرجاء ادخال بريدك الالكتروني صحيح !!</div>';
            } elseif (empty($_POST['password'])) {
                echo '<div class="alert alert-warning" role="alert">الرجاء ادخال  كلمه المرور </div>';
            } elseif (empty($_POST['con_password'])) {
                echo '<div class="alert alert-warning" role="alert">الرجاء تأكيد كلمه المرور</div>';
            } elseif ($_POST['password'] != $_POST['con_password']) {
                echo '<div class="alert alert-warning" role="alert"> كلمه المرور غير متطابقه</div>';
            } else {
                $sql_user = mysqli_query($con, " SELECT * FROM users WHERE username= ' $username' or email = ' $email'");
                if (mysqli_num_rows($sql_user) > 0) {
                    echo '<div class="alert alert-warning" role="alert"> عذرا اسم المستخدم او البريد الالكتروني مسجل بالفعل </div>';
                } else {
                    if (isset($_FILES["img"])) {
                        $img = $_FILES["img"];
                        $img_name = $img["name"];
                        $img_tmp = $img["tmp_name"];
                        $img_size = $img["size"];
                        $img_error = $img["error"];
                        $img_exe = explode('.', $img_name);
                        // استبعاد الاسم لحد .
                        $img_exe = strtolower(end($img_exe));
                        // تحويل الامتداد بتاع الصوره الي small
                        $alllode = array('png','jpg','gif','jpeg');
                        // محدد ايه الصور الي تترفع
                        if (in_array($img_exe, $alllode)) {
                            // هيتم الكشف علي كل الحجات الي محددها من مقاس وامتداد ولو كلو صح هبتدي اطبع اسم انا الي هحددو عشان انا كنت بمسح اسم الصوره
                            if ($img_error === 0) {
                                if ($img_size <= 3000000) {
                                    $new_name = uniqid('user', false) . '.' . $img_exe;
                                    // هنا بننشأ اسم جديد عشان يبقي
                                    $img_dir = '../images/imguser/' . $new_name;
                                    // هنا بنختار مكان حفظ الصوره بالاضافه لاسم الصوره الي جديد
                                    $img_db = 'images/imguser/' . $new_name;

                                    if (move_uploaded_file($img_tmp, $img_dir)) {
                                        // هنا هنطبع الصوره عشان نشوفها لما تتحفظ من المسارالي موجوده فيه 
                                        $password = md5($_POST['password']);
                                        $insert = " INSERT INTO users (username,
                                                                    email,
                                                                    password,
                                                                    gender,
                                                                    avatar,
                                                                    aboute_user,
                                                                    facebook,
                                                                    twitter,
                                                                    youtube,
                                                                    linkedin,
                                                                    reg_data,
                                                                    role)
                                                                    VALUES 
                                                                    ('$username',
                                                                    '$email',
                                                                    '$password',
                                                                    '$gender',
                                                                    '$img_db',
                                                                    '$about',
                                                                    '$facebook',
                                                                    '$twitter',
                                                                    '$youtube',
                                                                    '$linkedin',
                                                                    '$date',
                                                                    'user'
                                                                    )";
                                        $insert_sql = mysqli_query($con, $insert);
                                        if (isset($insert_sql)) {
                                            if (isset($insert_sql)) {
                                                $user_info = mysqli_query($con, "SELECT * FROM users WHERE username = '$username' ");
                                                $user = mysqli_fetch_assoc($user_info);
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
                                                echo '<div class="alert alert-success" role="alert"> ...تم تحميلك بنجاح ,جاري تحويلك للصفحه الرئيسيه</div>';
                                                echo '<meta http-equiv="refresh" content="2;\'index.php\'"/>';                                       
                                         }
                                        }
                                    } else {
                                        echo '<div class="alert alert-warning" role="alert">عذراً , حدث خطأ اثناء تحميل الصوره  </div>';
                                    }
                                } else {
                                    echo '<div class="alert alert-warning" role="alert">عذرا! ,لاكن حجم الصوره كبير جدا يجب ان لا يتعدى 2MB  </div>';
                                }
                            } else {
                                echo '<div class="alert alert-warning" role="alert">عذرا حدث خطأ اثناء رفع الصوره</div>';
                            }
                        } else {
                            echo '<div class="alert alert-warning" role="alert"> الرجاء ادخال امتداد الصوره المطلوب</div>';
                        }
                    } else {
                        $password = md5($_POST['password']);
                        $insert = " INSERT INTO users (username,
                                                        email,
                                                        password,
                                                        gender,
                                                        avatar,
                                                        aboute_user,
                                                        facebook,
                                                        twitter,
                                                        youtube,
                                                        linkedin,
                                                        reg_data,
                                                        role)
                                                        VALUES 
                                                        ('$username',
                                                        '$email',
                                                        '$password',
                                                        '$gender',
                                                        'images/avatar6.png',
                                                        '$about',
                                                        '$facebook',
                                                        '$twitter',
                                                        '$youtube',
                                                        '$linkedin',
                                                        '$date',
                                                        'user'
                                                        )";
                $insert_sql = mysqli_query($con, $insert);
                if (isset($insert_sql)) {
                    $user_info = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
                    $user = mysqli_fetch_assoc($user_info);
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
                    echo '<div class="alert alert-success" role="alert"> ...تم تحميلك بنجاح ,جاري تحويلك للصفحه الرئيسيه</div>';
                    echo '<meta http-equiv="refresh" content="2;\'index.php\'"/>';                                       
                }
                    }
                }
            }
        }
?>