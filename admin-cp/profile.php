<?php
include_once('include/header.php');
include_once('include/side_bar.php');
include_once('../include/confg.php');
$msg = '';
$get_user = mysqli_query($con, "SELECT * FROM users WHERE userid='$_SESSION[userid]'");
$user = mysqli_fetch_object($get_user);
if (isset($_GET['status']) and isset($_GET['post'])) {
    $sql = mysqli_query($con, "UPDATE post SET status='$_GET[status]' WHERE post_id='$_GET[post]'");
    if ($sql) {
        $msg = '<div class="alert alert-success" role="alert">تم تغير الحاله بنجاح  </div>';
    }
}
if (isset($_GET["delete"])) {
    $sqlD = mysqli_query($con, " DELETE FROM post WHERE post_id='$_GET[delete]'");
    if (isset($sqlD)) {
        $msg = '<div class="alert alert-danger" role="alert">تم الحذف بنجاح  </div>';
    }
}
?>
<article class="col-lg-9">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <?= $msg ?>
        <div class="panel panel-info" style="margin-top:20px">
            <div class="panel-heading"> اهلا وسهلا بك يا <?= $user->username ?></div>
            <div class="panel-body">
                <div class="col-md-9">
                    <p><b>اسم المستخدم <?= $user->username ?></b></p>
                    <p><b>البريد الالكتروني<?= $user->email ?></b></p>
                    <p><b>الجنس <?php if($user->gender=='male'){echo ' <img src="../images/male.png" class="img-circle" width="30px">';
                    }else{echo'<img src="../images/female.png " class="img-circle" width="30px">';}?></b></p>
                    <p><b>تاريخ التسجيل <?= $user->reg_data ?></b></p>
                    <p><b> روابط التواصل : <a class="btn log_fa" href="<?= $user->facebook ?>" target="_blank"> <i class="fab fa-facebook-square fa-lg"></i> | </a> <a class="btn log_tw" href="<?= $user->twitter ?>" target="_blank"><i class="fab fa-twitter fa-lg"></i> | </a> <a class=" btn" href="<?= $user->youtube ?>" target="_blank"> <i class="fab fa-youtube log_yo"></i> | </a> <a class=" btn" href="<?= $user->linkedin ?>" target="_blank"><i class="fab fa-linkedin log_lin"></i></a> </b></p>
                </div>
                <div class=" col-md-3">
                    <img src="../<?= $user->avatar ?>" class="img-circle" width="100%" alt="">
                </div>
                <div class="col-md-12">
                    <hr>
                    <p><b> : الوصف المختصر</b></p>
                    <p><b><?= strip_tags($user->aboute_user) ?></b></p>
                    <a href="edite_user.php?user=<?= $user->userid ?>" class="btn btn-danger pull-left">نعديل البيانات</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="panal panel-warning">
                    <div class="panel-heading">
                        <b> اخر المواضيع التي كتبتها</b>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>صوره المقال </th>
                                    <th>عنوان المقال </th>
                                    <th>تاريخ النشر</th>
                                    <th>مشاهده </th>
                                    <th>الحاله</th>
                                    <th>تعديل</th>
                                    <th>حذف</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $posts = mysqli_query($con, " SELECT * FROM post   WHERE auther='$_SESSION[userid]' ORDER BY post_id DESC LIMIT 3 ");
                                // حاجه مهمه السيشن هنا بتجيب بينات الي فاتح او مسجل حالا بمعني انها هنا بتجيب الكاتب للبوستات 
                                // وبحط ف السيشن الايدي بتاع اليوزر وهيظهر انها مثلا الحجات الي نشرها او الي تخصو
                                // ازاي احدد ان اخر مقال اضاف اعرضو اول حاجه 
                                // ORDER BY CATOGRYID DESC ودي بتجيب اخر حاجه ف الاول
                                // ORDER BY CATOGRYID ASC ودي العكس
                                // limit 3 اعرض 3 من الداتا بيز فقط
                                $num = 1;
                                while ($row = mysqli_fetch_array($posts)) {
                                    echo '<tr>
                            <td> ' . $num . ' </td>
                            <td><img src="../' . ($row['img'] == '' ? 'images/no-img.jpg' : $row['img']) . '" alt="" class="img-rounded" width="100px"></td>
                            <td>' . substr($row['title'], 0, 40) . '...</td>
                            <td>' . $row['post_date'] . '</td>
                            <td><a href="../post.php?id=' . $row['post_id'] . '" target="_blank"  class="btn btn-primary btn-xs">مشاهده المقال</a></td>

                            <td>' . ($row['status'] == 'puplished' ? '<a href="profile.php?status=dreft&post=' . $row['post_id'] . '" class="btn btn-success btn-xs">تعطيل</a>' : '<a href="profile.php?status=puplished&post=' . $row['post_id'] . ' " class="btn btn-info btn-xs">نشر</a>') . '</td>
                            <td><a href="edite-post.php?edite=' . $row['post_id'] . '"  class="btn btn-warning btn-xs">تعديل</a></td>
                            <td><a href="profile.php?delete=' . $row['post_id'] . '" class="btn btn-danger btn-xs">حذف</a></td>
                        </tr>
                         ';
                                    $num++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</article>
<?php
include_once('include/footer.php');

?>