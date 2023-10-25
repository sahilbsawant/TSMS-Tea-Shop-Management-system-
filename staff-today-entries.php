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
    <?php include('./layout/stafflayout/navbar.php') ?>
    <div id="layoutSidenav">
        <?php include('./layout/stafflayout/sidebar.php') ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Office_No</th>
                                <th scope="col">Drink</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Entry_by</th>
                                <th scope="col">Date/Time</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>



                            </tr>
                        </thead>
                        <tbody id="load-table">


                        </tbody>
                    </table>

                </div>
                <script>
                    $(document).ready(function() {
                        $.ajax({
                            url: "http://localhost/tea/api-staff-entries.php",
                            type: "GET",
                            success: function(data) {
                                console.log('hello');
                                console.log(data);
                                var obj = JSON.parse(data);
                                if (obj.length > 0) {

                                    $.each(obj, function(key, value) {
                                        $("#load-table").append(
                                            "<tr>" +
                                            "<td>" + value.ID + "</td>" +
                                            "<td>" + value.Office_no + "</td>" +
                                            "<td>" + value.Drink + "</td>" +
                                            "<td>" + value.Quantity + "</td>" +
                                            "<td>" + value.Amount + "</td>" +
                                            "<td>" + value.Entry_by + "</td>" +
                                            "<td>" + value.Created_at + "</td>" +
                                            "<td>" +
                                            "<button class='btn btn-primary btn-edit' data-eid='" + value.id + "'>Edit</button>" +
                                            "</td>" +
                                            "<td> <button class='btn btn-primary edit-button' data-did='" + value.id + "'>Delete</button> </td>" +
                                            "</tr>"
                                        );
                                    });
                                } else {
                                    $("#load-table").html("<tr><td colspan='9'>No Today's Record found.</td></tr>");
                                }
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