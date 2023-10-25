<?php

include('connection.php');

$select = "select * from entries";
$query = mysqli_query($con, $select);

// print_r($query);
if (mysqli_num_rows($query) > 0) {
    $output =  mysqli_fetch_all($query, MYSQLI_ASSOC);
    // print_r($output);
    echo json_encode($output);
} else {
    echo json_encode(array('message' => 'no record found.', 'status' => false));
}
