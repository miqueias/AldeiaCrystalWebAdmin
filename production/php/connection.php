<?php
//$mysqli = mysqli_connect("localhost", "nubohost_luke", "r2d2vader", "nubohost_nuboadmin");
$mysqli = mysqli_connect("localhost", "root", "root", "aldeia_crystal");

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>