<?php
$con=mysqli_connect("localhost","root","", "cms_system");
mysqli_set_charset($con, "utf8mb4");
if (!$con) {
    mysqli_connect_error("هناك خطأ ف الاتصال");
};
function close_db()
{
    global $con;
    mysqli_close($con);
}
?>