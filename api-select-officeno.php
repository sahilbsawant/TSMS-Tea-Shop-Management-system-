<?php

include('connection.php');

$select = "SELECT * FROM customer ORDER BY office_no ASC";
$query = mysqli_query($con, $select);

if (mysqli_num_rows($query) > 0) {
    $output = mysqli_fetch_all($query, MYSQLI_ASSOC);

    echo json_encode($output);
} else {
    echo json_encode(array("message" => "no record found", "status" => false));
}
