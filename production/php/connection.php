<?php
//$mysqli = mysqli_connect("localhost", "aldeiacr_dev", "voanubo2016", "aldeiacr_dev");
$mysqli = mysqli_connect("localhost", "root", "root", "aldeia_crystal");

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>