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
                <div class="container-fluid px-4 mt-3  border  ">


                    <!-- Brand Name and Address -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <h2>Brand Name</h2>
                            <p>123 Address Street, City, Country</p>
                        </div>
                    </div>
                    <!-- Invoice Table -->
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sr.no</th>
                                        <th>Drink</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="load-data">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Total Amount -->
                    <div class="row">
                        <div class="col-12 text-end" id="total-amount">
                            <p><strong>Total Amount: <span id="total-amount-value">0.00</span></strong></p>
                        </div>
                    </div>
                    <!-- Signature and Date -->
                    <div class="row">
                        <div class="col-12 text-end">
                            <p>Signature: ___________________</p>
                            <p>Date: <?php echo date('Y-m-d'); ?></p>
                        </div>
                    </div>



                </div>


                <script>
                    $(document).ready(function() {
                        // Retrieve stored data from localStorage
                        var check = JSON.parse(localStorage.getItem("invoiceData"));
                        console.log(check);
                        var totalAmount = 0; // Initialize totalAmount

                        $.each(check, function(key, value) {
                            if (key < check.length - 1) {
                                var number = key + 1;
                                $("#load-data").append(
                                    "<tr>" +
                                    "<td>" + number + "</td>" +
                                    "<td>" + (value.Drink ? value.Drink : "<strong>Total</strong>") + "</td>" +
                                    "<td>" + value.TotalQuantity + "</td>" +
                                    "<td>" + "₹" + value.TotalAmount + ".00</td>" +
                                    "</tr>"
                                );

                                totalAmount += parseFloat(value.TotalAmount); // Calculate total amount
                            }
                        });

                        // Update the total amount in the <span> inside the #total-amount element
                        $("#total-amount-value").text("₹" + totalAmount.toFixed(2));
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