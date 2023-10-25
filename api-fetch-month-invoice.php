<?php
include('connection.php');

$data = json_decode(file_get_contents("php://input"), true);
// file_put_contents('debug.log', print_r($data, true));


if (isset($data['Office_no']) && isset($data['yearMonth'])) {
    $number = $data['Office_no'];
    $month = $data['yearMonth'];

    // echo $number;
    // echo $month;




    // Your SQL query to fetch data based on number and month
    $query = "SELECT * FROM entries WHERE Office_no = '$number' AND DATE_FORMAT(Created_at, '%Y-%m') = '$month'";

    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode($output);
    } else {
        echo json_encode(array('message' => 'No data found for the provided number and month', "status" => false));
    }
} else {
    echo json_encode(array('message' => 'number & month is not set'));
}
