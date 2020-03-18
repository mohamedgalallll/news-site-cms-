<?php
session_start();
include("include/confg.php");
include("include/function.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Training news site
    </title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="css/bootstrap-rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">اسم الموقع</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">الرئيسية <span class="sr-only">(current)</span></a></li>

                    <?php
                    $linksql = mysqli_query($con, "SELECT * FROM catogry");
                    while ($row = mysqli_fetch_array($linksql)) {
                        echo ' <li><a href="category.php?cate=' . $row['catogry'] . '">' . $row['catogry'] . '</a></li>';
                    }
                    ?>


                </ul>
                <?php if (isset($_SESSION['userid'])) {
                    ?>
                    <ul class="nav navbar-nav navbar-left">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">الإعدادات <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">الصفحة الشخصية</a></li>
                                <li role="separator" class="divider"></li>
                                <?php
                                    if ($_SESSION['role'] == 'admin') {
                                        echo '<li><a href="admin-cp/index.php">لوحه التحكم</a></li>';
                                    }
                                    ?>
                                <li><a href="logout.php?id=<?php echo $_SESSION['userid'] ?>">تسجيل الخروج</a></li>
                                <!--  -->
                            </ul>
                        </li>
                    </ul>
                <?php
                } else {
                    ?>
                    <ul class="nav navbar-nav navbar-left">
                        <li><a href="registor.php">التسجيل</a></li>
                    </ul>
                <?php
                }
                ?>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <!-- logo site -->
    <section id="logo">
        <img src="images/photo-1515940175183-6798529cb860.jpg" width="100%" height="200px" />
    </section>

    <!-- end logo site -->

    <!-- body -->
    <section class="container-fluid" style="margin-top: 20px;">