<?php
session_start();
include('connection.php');

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];

    $today = date("Y/m/d");
    $todayshow = "SELECT * FROM entries WHERE DATE(Created_at) ='$today' and Entry_by = '$user'";
    $todayshowquery = mysqli_query($con, $todayshow);


    if (mysqli_num_rows($todayshowquery) > 0) {
        $output = mysqli_fetch_all($todayshowquery, MYSQLI_ASSOC);
        // print_r($output);
        // $result = mysqli_fetch_assoc($todayshowquery);
        echo json_encode($output);
    } else {
        echo json_encode(array("message" => "NO Today's Record found", "status" => false));
    }
} else {
    echo json_encode(array("message" => "session is not set properly", "status" => false));
    // echo $user;
}
