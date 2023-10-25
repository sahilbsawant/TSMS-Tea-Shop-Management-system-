 <?php

  include('connection.php');

  $data = json_decode(file_get_contents("php://input"), true);

  if (isset($data['office_no']) && ($data['monthyear'])) {

    $office_no = $data['office_no'];
    $monthyear = $data['monthyear'];

    $select = "SELECT Drink, SUM(Quantity) AS TotalQuantity, SUM(Amount) AS TotalAmount
  FROM entries
  WHERE Office_no = '$office_no'
    AND DATE_FORMAT(Created_at, '%Y-%m') = '$monthyear'
  GROUP BY Drink
  WITH ROLLUP";
    $query = mysqli_query($con, $select);

    if (mysqli_num_rows($query) > 0) {
      $output = mysqli_fetch_all($query, MYSQLI_ASSOC);


      echo json_encode($output);
    } else {
      echo json_encode(array("message" => 'No Data Found', "status" => false));
    }
  } else {
    echo json_encode(array("message" => 'office_no and monthyear parameters are required', "status" => false));
  }
  // include('connection.php');

  // // Ensure that both office_no and monthyear are passed in the request data
  // $data = json_decode(file_get_contents("php://input"), true);

  // // if (isset($data['monthyear'])) {
  // $yearMonth = $data['yearMonth'];

  // // Modify the SQL query to remove the filter by office_no
  // $select = "SELECT Office_no, Drink, SUM(Quantity) AS TotalQuantity, SUM(Amount) AS TotalAmount
  //   FROM entries
  //   WHERE DATE_FORMAT(Created_at, '%Y-%m') = '$yearMonth'
  //   GROUP BY Office_no, Drink
  //   WITH ROLLUP";

  // $query = mysqli_query($con, $select);

  // if (mysqli_num_rows($query) > 0) {
  //   $output = mysqli_fetch_all($query, MYSQLI_ASSOC);

  //   echo json_encode($output);
  // } else {
  //   echo json_encode(array("message" => 'No Data Found', "status" => false));
  // }
  // // } else {
  // // echo json_encode(array("message" => 'monthyear parameter is required', "status" => false));
  // // }
