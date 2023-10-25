<?php
include('connection.php');

$limit_per_page = 4;
if (isset($_GET['page_no'])) {
    $page = $_GET['page_no'];
} else {
    $page = 1;
}

$offset = ($page - 1) * $limit_per_page;

// Query to fetch paginated data
$select = "SELECT * FROM customer LIMIT {$offset}, {$limit_per_page}";
$query = mysqli_query($con, $select);

if (mysqli_num_rows($query) > 0) {
    $output = mysqli_fetch_all($query, MYSQLI_ASSOC);

    // Get the total number of records for pagination
    $select_total = "SELECT COUNT(*) as total_records FROM customer";
    $query_total = mysqli_query($con, $select_total);
    $total_records = mysqli_fetch_assoc($query_total)['total_records'];
    $total_pages = ceil($total_records / $limit_per_page);

    $response = [
        'status' => true,
        'data' => $output,
        'total_pages' => $total_pages,
    ];
    echo json_encode($response);
} else {
    echo json_encode(['message' => 'No records found.', 'status' => false]);
}
