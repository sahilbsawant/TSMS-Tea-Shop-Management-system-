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
    <?php
    session_start();

    //Check if the 'username' session variable is set
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    } else {
        header("Location: /tea/stafflogin.php"); // Redirect to the login page or display a message
        exit();
    }
    ?>
    <?php include('./layout/stafflayout/navbar.php') ?>
    <div id="layoutSidenav">
        <?php include('./layout/stafflayout/sidebar.php') ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container">
                    <h3>Hello <h3><?php echo $user ?></h3>

                    </h3>
                    <!-- <button class="btn btn-primary " id="logout">Logout</button> -->
                    <form>

                        <input type="hidden" id="sessionname" value="<?php echo $user ?> " />

                        <div class="form-group">
                            <label for="textInput">Office :</label>
                            <input type="number" class="form-control" id="numvalidate" min="1" max="999">
                            <p id="errorofficeno" class="text-danger"></p>
                            <div id="error-message" style="color: red;"></div>
                        </div>


                        <div class="form-group">
                            <label for="selectBox">Drink:</label>
                            <select class="form-control" id="selectdrink" name="selectBox">
                                <option value="">Select</option>
                                <option value="10">Tea(Chai)</option>
                                <option value="15">Coffee</option>
                                <option value="15">Lemon Tea</option>
                                <option value="10">Black Tea</option>
                                <option value="20">Green Tea</option>
                                <option value="15">Jaggery Tea</option>
                                <option value="15">Ukala</option>

                            </select>
                            <p id="err" class="text-danger"></p>
                        </div>

                        <div class="form-group">
                            <label for="textInput">Quantity:</label>
                            <input type="" class="form-control readonly" id="quantity" name="textInput">

                            <span class="input-group-btn">
                                <button class="btn btn-default  mt-1" style="background-color: gold;" type="button" id="add">+</button>
                            </span>
                            <span class="input-group-btn">
                                <button class="btn btn-default  mt-1" style="background-color: gold;" type="button" id="minus">-</button>
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="anotherInput">Amount:</label>
                            <input type="text" class="form-control readonly" name="anotherInput" id="amount">
                        </div>
                        <br>

                        <button type="submit" class="btn btn-primary" id="submit">ADD</button>
                    </form>


                </div>
                <script>
                    $(document).ready(function() {
                        // Attach the validate function to the input's change event
                        $("#numvalidate").on("input", validate);

                        function validate() {
                            var inputValue = $("#numvalidate").val();
                            var errorMessage = $("#error-message");
                            // Check if the input is empty or not a number
                            if (inputValue.length > 3) {
                                errorMessage.text("Maximum length exceeded (3 characters).");
                                // Truncate the input to 10 characters
                                $("#numvalidate").val(inputValue.substring(0, 3));
                            }
                        }



                    });
                    // $(document).ready(function() {
                    // increment
                    // var count;
                    // var selectvalue;

                    $("#amount").prop("readonly", true);
                    $("#quantity").prop("readonly", true);
                    // var sessionname = $("#sessionname").val();




                    var selectvalue;
                    $("#selectdrink").on("change", function() {
                        $("#quantity").val("");
                        $("#amount").val("");

                        selectvalue = Number($(this).val());
                        // console.log((selectvalue));
                        //Number($("#amount").val(selectvalue));
                        // $("#selectdrink").val("");  




                    });

                    $("#add").on("click", function() {

                        count = Number($("#quantity").val());
                        increment = count + 1;
                        console.log(increment);
                        Number($("#quantity").val(increment));

                        if (isNaN(selectvalue) || selectvalue === "" || selectvalue === 0) {
                            // Show an alert if selectvalue is NaN or 0 (not selected)
                            $("#err").html("Please select a valid drink value before adding.");
                            Number($("#quantity").val(""));

                            return; // Stop further execution
                        }

                        //Calculate the final value

                        var finalValue = Number(increment * selectvalue);
                        // console.log('selected value: ', selectvalue);
                        console.log(finalValue);
                        $("#amount").val(finalValue);




                    });

                    //decrement
                    $("#minus").on("click", function() {
                        count = Number($("#quantity").val());
                        var decrement = count - 1;
                        if (decrement <= 0) {
                            decrement = 0;

                        }
                        //alert(decrement);
                        // console.log(decrement);
                        $("#quantity").val(decrement);

                        selectValue = $("#amount").val();
                        // console.log(selectvalue);
                        var finalvalue = selectValue - selectvalue
                        if (finalvalue <= 0) {
                            finalvalue = 0;
                        }
                        $("#amount").val(finalvalue);
                        // console.log(finalvalue);
                    });
                    $("#submit").on("click", function(e) {
                        e.preventDefault();
                        var officeno = $("#numvalidate").val();
                        // var drink = $("#selectdrink").val();
                        var drinktext = $("#selectdrink option:selected").text();
                        var quantity = $("#quantity").val();
                        var amount = $("#amount").val();
                        var sessionname = $("#sessionname").val();




                        // console.log(officeno, sessionname, drinktext);

                        if (officeno == "" || drinktext == "" || quantity == "" || amount == "" && quantity == 0 || amount == 0) {
                            alert("please filled all the details");
                        } else {
                            confirm("Are You Sure all details are correct");

                            $.ajax({
                                url: "http://localhost/tea/api-staff-insert-data.php",
                                type: "POST",
                                data: JSON.stringify({
                                    sessionname: sessionname,
                                    officeno: officeno,
                                    drinktext: drinktext,
                                    quantity: quantity,
                                    amount: amount

                                }),
                                contentType: "application/json",
                                success: function(data) {
                                    // console.log(data);
                                    var obj = JSON.parse(data);

                                    if (obj.status === true) {
                                        alert(obj.message);
                                        // console.log(obj.message);
                                        $("#numvalidate").val('');
                                        $("#selectdrink").val('');
                                        $("#quantity").val('');
                                        $("#amount").val('');
                                        $("#sessionname").val('');
                                        window.location.replace('staff-today-entries.php');
                                    } else {
                                        $("#errorofficeno").text(obj.message);
                                    }
                                }


                            })
                        }
                        // alert($("#session").text());


                    });



                    // $("#logout").on("click", function() {
                    //     window.location.replace('/tea/logout.php');
                    // })
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