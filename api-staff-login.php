<?php
session_start();
include('connection.php');

$data = json_decode(file_get_contents("php://input"), true);

$username = $data['username'];
$password = $data['password'];



$select = "select * from staff_login where username = '$username'";
$query = mysqli_query($con, $select);

// print_r($query);
$usernameCount = mysqli_num_rows($query);
// echo "$usernameCount";
if ($usernameCount) {
    $fetchedarray =  mysqli_fetch_assoc($query);
    // print_r($fetchedarray);
    $db_password = $fetchedarray['password'];
    // echo "$db_password";
    if ($db_password == $password) {
        $_SESSION['user'] = $username;
        echo json_encode(array('message' => 'Login successful.', 'status' => true));

        // if (isset($_SESSION['user'])) {
        //     $user = $_SESSION['user'];

        //     $today = date("Y/m/d");
        //     $todayshow = "SELECT * FROM entries WHERE DATE(Created_at) ='$today' and Entry_by = '$user'";
        //     $todayshowquery = mysqli_query($con, $todayshow);


        //     if (mysqli_num_rows($todayshowquery) > 0) {
        //         $output = mysqli_fetch_all($todayshowquery, MYSQLI_ASSOC);
        //         // print_r($output);
        //         // $result = mysqli_fetch_assoc($todayshowquery);
        //         echo json_encode($output);
        //     } else {
        //         echo json_encode(array("message" => "NO Record found", "status" => false));
        //     }
        // } else {
        //     echo json_encode(array("message" => "session is not set properly", "status" => false));
        // }
    } else {
        echo json_encode(array('message' => 'Wrong password.', 'status' => false));
    }
} else {
    echo json_encode(array('message' => 'Invalid Username  .', 'status' => false));
}
