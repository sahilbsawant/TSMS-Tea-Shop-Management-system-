
<?php
include('connection.php');

$data = json_decode(file_get_contents("php://input"), true);

$office_no = $data['officeno'];
$firstname = $data['firstname'];
$lastname = $data['lastname'];
$mobileno = $data['mobileno'];
$emailid = $data['emailid'];

// Check if the office_no already exists in the database
$validate = "SELECT * FROM customer WHERE office_no = '$office_no'";
$validatequery = mysqli_query($con, $validate);

if ($validatequery) {
    if (mysqli_num_rows($validatequery) > 0) {
        echo json_encode(array("message" => "Customer with office_no $office_no already exists.", "status" => false));
    } else {
        // Insert the new customer if office_no doesn't exist
        $insert = "INSERT INTO customer (office_no, first_name, last_name, mobile_no, email_id) VALUES ('$office_no', '$firstname', '$lastname', '$mobileno', '$emailid')";
        $query = mysqli_query($con, $insert);

        if ($query) {
            echo json_encode(array("message" => "Customer Added Successfully", "status" => true));
        } else {
            echo json_encode(array("message" => "Failed to add customer", "status" => false));
        }
    }
} else {
    echo json_encode(array("message" => "Validation query failed", "status" => false));
}
