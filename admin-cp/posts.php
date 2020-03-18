<?php
include_once('include/header.php');
include_once('include/side_bar.php');
include_once('../include/confg.php');
$msg = "";
if (isset($_GET['status']) and isset($_GET['post'])) {
    $sql = mysqli_query($con, "UPDATE post SET status='$_GET[status]' WHERE post_id='$_GET[post]'");
}
if (isset($_GET["delete"])) {
    $sqlD = mysqli_query($con, "DELETE FROM post WHERE post_id='$_GET[delete]'");
    if (isset($sqlD)) {
        $msg = '<div class="alert alert-danger" role="alert">تم الحذف بنجاح  </div>';
    }
}

?>
<article class="col-lg-9">
    <?= $msg ?>
    <div class="panel panel-info" style="margin-top:20px">
        <div class="panel-heading">المقالات</div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>صوره المقال </th>
                        <th>عنوان المقال </th>
                        <th>الكاتب</th>
                        <th>تاريخ النشر</th>
                        <th>مشاهده </th>
                        <th>الحاله</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $posts = mysqli_query($con, "SELECT * FROM `post` LEFT  JOIN `users` ON auther=userid  ORDER BY post_id DESC");

                    // ازاي احدد ان اخر مقال اضاف اعرضو اول حاجه 
                    // ORDER BY CATOGRYID DESC ودي بتجيب اخر حاجه ف الاول
                    // ORDER BY CATOGRYID ASC ودي العكس
                    $num = 1;

                    while ($row = mysqli_fetch_array($posts)) {
                        echo '<tr>
                            <td> ' . $num . ' </td>
                            <td><img src="../' . ($row['img'] == '' ? 'images/no-img.jpg' : $row['img']) . '" alt="" class="img-rounded" width="100px"></td>
                            <td>' . substr($row['title'], 0, 40) . '...</td>
                            <td>' . $row['username'] . '</td>
                            <td>' . $row['post_date'] . '</td>
                            <td><a href="../post.php?id='.$row['post_id'].'" target="_blank"  class="btn btn-primary btn-xs">مشاهده المقال</a></td>

                            <td>' . ($row['status'] == 'puplished' ? '<a href="posts.php?status=dreft&post=' . $row['post_id'] . '" class="btn btn-success btn-xs">تعطيل</a>' : '<a href="posts.php?status=puplished&post=' . $row['post_id'] . ' " class="btn btn-info btn-xs">نشر</a>') . '</td>
                            <td><a href="edite-post.php?edite=' . $row['post_id'] . '"  class="btn btn-warning btn-xs">تعديل</a></td>
                            <td><a href="posts.php?delete=' . $row['post_id'] . '" class="btn btn-danger btn-xs">حذف</a></td>
                        </tr>
                         ';
                        $num++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</article>
<?php
include_once('include/footer.php');

?>