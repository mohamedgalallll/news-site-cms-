<?php
include_once('include/header.php');
include_once('include/side_bar.php');
include_once('../include/confg.php');
$msg = '';
if (isset($_GET['edite'])) {
    $sql = mysqli_query($con, "SELECT * FROM catogry WHERE catogryid='$_GET[edite]' ");
    $catog = mysqli_fetch_array($sql);
}
if (isset($_POST['addcat'])) {
    if (empty($_POST['catogry'])) {
        $msg = '<div class="alert alert-danger" role="alert">الرجاء ادخال اسم التصنيف </div>';
    } else {
        $upd = mysqli_query($con, "UPDATE `cms_system`.`catogry`SET`catogry` = '$_POST[catogry]' WHERE catogryid='$_GET[edite]'");
        if (isset($upd)) {
            header("location:catogry.php");
        }
    }
}

?>
<article class="col-lg-9">

    <div class="row">
        <div class="col-md-4">
            <?= $msg ?>
            <div class="panel panel-info" style="margin-top:20px">
                <div class="panel-heading"> تعديل التصنيف :: <?= $catog['catogry'] ?></div>
                <div class="panel-body">
                    <form class="form-horizontal" action="" method="post">
                        <div class="form-group">
                            <label for="catogry" class="col-sm-4 control-label">اسم التصنيف</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="<?= $catog['catogry'] ?>" name="catogry" id="catogry" placeholder="ادخل اسم التصنيف الجديد">
                            </div>
                        </div>

                        <hr>
                        <div class="form-group">

                            <div class="col-sm-offset-4 col-sm-8">
                                <input type="submit" class="btn btn-info" name="addcat" value="اضافه التعديل " />
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