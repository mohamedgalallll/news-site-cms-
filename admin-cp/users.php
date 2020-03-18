<?php
include_once('include/header.php');
include_once('include/side_bar.php');
include_once('../include/confg.php');
$msg="";
if(isset($_GET['delete'])){
    $sqldel=mysqli_query($con, "DELETE FROM users WHERE userid='$_GET[delete]'");
    if ($sqldel){
        $msg='<div class="alert alert-success" role="alert">تمت عمليه الحذف بنجاح</div>';
    }
}
?>
<article class="col-lg-9">
    <?=$msg?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info" style="margin-top:20px">
                <div class="panel-heading"><b>الاعضاء</b></div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الصوره الشخصيه </th>
                                <th>اسم العضو </th>
                                <th>الريد الالكتروني</th>
                                <th>الجنس</th>
                                <th>الصفحه الشخصيه</th>
                                <th>تعديل البيانات </th>
                                <th>حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $users = mysqli_query($con," SELECT * FROM `users` ");
                            // ازاي احدد ان اخر مقال اضاف اعرضو اول حاجه 
                            // ORDER BY CATOGRYID DESC ودي بتجيب اخر حاجه ف الاول
                            // ORDER BY CATOGRYID ASC ودي العكس
                            $num = 1;
                            while ($user= mysqli_fetch_array($users)) {
                                echo '  <tr>
                                <td>' . $num . '</td>
                                <td><img src="../' . $user['avatar'] . '" width="50px"></td>
                                <td>' . $user['username'] . '</td>
                                <td>' . $user['email'] . '</td>
                                <td>' . ($user['gender'] =='male' ? '<img src="../images/male.png" width="30px">' : '<img src="../images/female.png" width="30px">') . '</td>
                                <td><a href="../profile.php?user=' . $user['userid'] . '" class="btn btn-info btn-xs" target="_blank">مشاهده</a></td>
                                <td><a href="edite_user.php?user=' . $user['userid'] . '" class="btn btn-warning btn-xs">تعديل</a></td>
                                <td><a href="users.php?delete=' . $user['userid'] . '" class="btn btn-danger btn-xs">حذف</a></td>
                            </tr>';
                                $num++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</article>
<?php
include_once('include/footer.php');
?>