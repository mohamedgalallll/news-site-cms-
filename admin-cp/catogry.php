<?php
include_once('include/header.php');
include_once('include/side_bar.php');
include_once('../include/confg.php');
$msg = '';
$msg2 = '';
if (isset($_POST['addcat'])) {
    if (empty($_POST['catogry'])) {
        $msg = '<div class="alert alert-danger" role="alert">الرجاء ادخال التصنيف </div>';
    } else {
        $insert = mysqli_query($con, " INSERT INTO catogry (catogry) VALUES('$_POST[catogry]')");
        if (isset($insert)) {
            $msg = '<div class="alert alert-success" role="alert">تم الادخال بنجاح </div>';
        }
    }
}
if (isset($_GET['delete'])) {
    $delet = mysqli_query($con, " DELETE FROM catogry WHERE  catogryid='$_GET[delete]' ");
    if (isset($delet)) {
        $msg2 = '<div class="alert alert-success" role="alert">تمت عمليه الحذف بنجاح</div>';
    }
}
?>
<article class="col-lg-9">
    <div class="row">
        <div class="col-md-8">
            <?= $msg2 ?>
            <div class="panel panel-info" style="margin-top:20px">
                <div class="panel-heading">التصنيفات</div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم التصنيف</th>
                                <th>تعديل </th>
                                <th>حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cat = mysqli_query($con, " SELECT * FROM catogry ORDER BY catogryid DESC ");
                            // ازاي احدد ان اخر مقال اضاف اعرضو اول حاجه 
                            // ORDER BY CATOGRYID DESC ودي بتجيب اخر حاجه ف الاول
                            // ORDER BY CATOGRYID ASC ودي العكس
                            $num = 1;
                            while ($row = mysqli_fetch_array($cat)) {
                                echo '  <tr>
                                <td>' . $num . '</td>
                                <td>' . $row['catogry'] . '</td>
                                <td><a href="edite-catogry.php?edite=' . $row['catogryid'] . '" class="btn btn-warning btn-xs">تعديل</a>
                                </td>
                                <td><a href="catogry.php?delete=' . $row['catogryid'] . '" class="btn btn-danger btn-xs">حذف</a></td>
                            </tr>';
                                $num++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-info" style="margin-top:20px">
                <div class="panel-heading">اضافه تصنيف جديد</div>
                <div class="panel-body">
                    <form class="form-horizontal" action="" method="post">
                        <div class="form-group">
                            <label for="catogry" class="col-sm-4 control-label">اسم التصنيف</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="catogry" id="catogry" placeholder="ادخل اسم التصنيف الجديد">
                            </div>
                        </div>

                        <hr>
                        <div class="form-group">
                            <?= $msg ?>
                            <div class="col-sm-offset-4 col-sm-8">
                                <input type="submit" class="btn btn-info" name="addcat" value="اضافه التصنيف" />
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