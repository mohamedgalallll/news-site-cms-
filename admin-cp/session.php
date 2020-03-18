<?php
session_start();
include_once("../include/confg.php");
if (isset($_SESSION['userid'])) {
    $msql = mysqli_query($con, "SELECT * FORM users WHERE userid='$_SESSION[userid]' AND role='admin' OR 'writer'");
    if (mysqli_num_rows($msql) != 1) {
        header("location:../index.php");
    } else {
        header("location:../index.php");
    }
}
?>