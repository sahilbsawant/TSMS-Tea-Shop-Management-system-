<?php
session_start();
include('connection.php');

$data = json_decode(file_get_contents("php://input"), true);

$username = $data['username'];
$password = $data['password'];



$select = "select * from admin_login where username = '$username'";
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
        // $_SESSION['user'] = $username;
        echo json_encode(array('message' => 'Login successful.', 'status' => true));
    } else {
        echo json_encode(array('message' => 'Wrong password.', 'status' => false));
    }
} else {
    echo json_encode(array('message' => 'Invalid Username  .', 'status' => false));
}
