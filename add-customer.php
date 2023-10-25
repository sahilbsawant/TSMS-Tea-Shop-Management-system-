<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php include('./layout/navbar.php') ?>
    <div id="layoutSidenav">
        <?php include('./layout/sidebar.php') ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container">
                    <h3>Hello</h3>
                    <form>
                        <div class="form-group">

                            <label class="form-label">Office_No</label>
                            <input class="form-control" type="number" id="officenumvalidate" required />
                            <p id="errorofficenum" class="text-danger"></p>
                        </div>
                        <div class="form-group">

                            <label class="form-label">First_Name</label>
                            <input class="form-control" type="text" id="name" required />
                            <p id="errorfname" class="text-danger"></p>
                        </div>
                        <div class="form-group">

                            <label class="form-label">Last_name</label>
                            <input class="form-control" type="text" id="lastname" required />
                            <p id="errorlname" class="text-danger"></p>
                        </div>
                        <div class="form-group">

                            <label class="form-label">Mobile_No</label>
                            <input class="form-control" type="number" id="mobnumvalidate" required />
                            <p id="errormobnumvalidate" class="text-danger"></p>
                        </div>
                        <div class="form-group">

                            <label class="form-label">Email_id</label>
                            <input class="form-control" type="text" id="emailvalidate" required />
                            <p id="erroremailvalidate" class="text-danger"></p>
                        </div>
                        <br>
                        <button class="btn btn-primary" id="addcustomer">Add Customer</button>
                    </form>
                </div>

                <script>
                    $(document).ready(function() {
                        $("#officenumvalidate").on("input", function() {
                            var inputvalue = $("#officenumvalidate").val();
                            if (inputvalue.length > 3) {
                                $("#errorofficenum").text("Maximum length exceeded (3 characters).");
                                $(this).val(inputvalue.substring(0, 3));

                            } else {
                                $("#errorofficenum").text("");
                            }

                        });
                        $("#name").on("input", function() {
                            var fname = $("#name").val();
                            var sanitizedvalue = fname.replace(/[^a-zA-Z]/g, ''); // Remove non-alphabet characters
                            $(this).val(sanitizedvalue);

                            if (sanitizedvalue != fname) {
                                $("#errorfname").text("Please enter only letters. No special characters allowed");

                            } else {
                                $("#errorfname").text("");
                            }

                        });
                        $("#lastname").on("input", function() {
                            var name = $("#lastname").val();
                            var sanitizedsvalue = name.replace(/[^a-zA-Z]/g, ''); // Remove non-alphabet characters
                            $(this).val(sanitizedsvalue);

                            if (sanitizedsvalue != name) {
                                $("#errorlname").text("Please enter only letters. No special characters allowed");

                            } else {
                                $("#errorlname").text("");
                            }

                        });
                        $("#mobnumvalidate").on("input", function() {
                            var inputvalue = $("#mobnumvalidate").val();
                            if (inputvalue.length > 10) {
                                $("#errormobnumvalidate").text(" Check the Number Maximum length exceeded (10 characters).");
                                $(this).val(inputvalue.substring(0, 10));

                            } else {
                                $("#errormobnumvalidate").text("");
                            }

                        });
                        $("#emailvalidate").on("click", function() {
                            var email = $("#emailvalidate").val();
                            var emailvalidation = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

                            if (emailvalidation.test(email)) {

                                // $("#erroremailvalidate").text("ok : " + email);
                                // $("#erroremailvalidate").text(""); // Clear error message
                                // alert("Valid email address: " + email);

                                $("#erroremailvalidate").text("");


                            } else {
                                $("#erroremailvalidate").text("check email address");
                            }
                        });


                        $("#addcustomer").on("click", function(e) {
                            e.preventDefault();
                            var officeno = $("#officenumvalidate").val();
                            var firstname = $("#name").val();
                            var lastname = $("#lastname").val();
                            var mobileno = $("#mobnumvalidate").val();
                            var emailid = $("#emailvalidate").val();
                            var emailvalidation = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

                            if (officeno == "" || firstname == "" || lastname == "" || mobileno == "" || emailid == "") {

                                alert("please fill all the details");

                            } else if (mobileno.length !== 10) {
                                $("#errormobnumvalidate").text(" Check the Number only contains 10 number ");
                            } else if (firstname.length < 3) {
                                $("#errorfname").text("Firstname Must be more than 3 characters  ");

                            } else if (lastname.length < 3) {
                                $("#errorlname").text("Lastname Must be more than 3 characters");
                            } else if (emailid == emailvalidation) {
                                $("#erroremailvalidate").text("check email address");


                            } else {
                                // Perform AJAX request here to submit the form data
                                $.ajax({
                                    url: "http://localhost/tea/api-customer-add.php",
                                    type: "POST",
                                    data: JSON.stringify({
                                        officeno: officeno,
                                        firstname: firstname,
                                        lastname: lastname,
                                        mobileno: mobileno,
                                        emailid: emailid
                                    }),
                                    contentType: "application/json",
                                    success: function(data) {
                                        var obj = JSON.parse(data);
                                        if (obj.status == true) {
                                            alert(obj.message);
                                            // console.log(obj.message);
                                            $("#officenumvalidate").val("");
                                            $("#name").val("");
                                            $("#lastname").val("");
                                            $("#mobnumvalidate").val("");
                                            $("#emailvalidate").val("");


                                        } else {
                                            // alert(obj.message);
                                            // console.log(obj.message);
                                            $("#errorofficenum").text(obj.message);
                                        }
                                    }
                                });
                            }
                        });
                    });
                </script>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>