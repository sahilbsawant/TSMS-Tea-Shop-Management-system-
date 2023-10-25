<?php
include('connection.php');

$data = json_decode(file_get_contents("php://input"), true);

$session = $data['sessionname'];
$officeno = $data['officeno'];
$drink = $data['drinktext'];
$quantity = $data['quantity'];
$amount = $data['amount'];

$checkofficenoquery = "select * from customer where office_no = $officeno";
$checkofficenoresult = mysqli_query($con, $checkofficenoquery);

// print_r($checkofficenoresult);
// exit;
if (mysqli_num_rows($checkofficenoresult) > 0) {
    $insert = "insert into entries (Office_no,Drink,Quantity,Amount,Entry_by)values('$officeno','$drink','$quantity','$amount','$session')";
    $query = mysqli_query($con, $insert);

    if ($query) {
        echo json_encode(array("message" => 'Data Added Successfuly', "status" => true));
    } else {
        echo json_encode(array("message" => 'Data Not Added', "status" => false));
    }
} else {
    echo json_encode(array("message" => 'Office number not found in the customer table', "status" => false));
}
