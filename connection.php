<?php

$server = "localhost";
$dbusername = "root";
$dbpassword = "";
$database = "tea";

$con = mysqli_connect($server, $dbusername, $dbpassword, $database);
if (!$con) {
    echo "mysql Not conmected";
}
