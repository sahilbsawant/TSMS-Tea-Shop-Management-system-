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
                <div class="container-fluid px-4">
                    <form>
                        <label class="form-lable">Office_NO<span class="text-danger">*</span></label>
                        <select class="form-control" id="officeno">
                            <option value="">Select</option>
                        </select>
                        <p class=" text-danger" id="error-officeno"></p>

                        <!-- <label>Select a Date:</label>
                        <input type="date" class="form-control" id="datepicker"> -->


                        <label>Select a Year & Month<span class="text-danger">*</span></label>
                        <input type="month" id="yearMonthPicker" class="form-control">
                        <p class=" text-danger" id="error-month"></p>
                        <br>


                        <button class="btn btn-primary" id="add">Add</button>

                    </form>
                    <br>
                    <button class="btn btn-primary align-content-end justify-content-end d-flex ms-auto d-none" id="btn-createInvoice">Create Invoice</button><br>
                    <table class="table table-bordered d-none" id="load-table">
                        <thead>
                            <tr>
                                <th scope="col">Sr_no</th>
                                <th scope="col">office_no</th>
                                <th scope="col">Drink</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Entry_by</th>
                                <th scope="col">Date & Time</th>
                            </tr>
                        </thead>
                        <tbody id="load-tbody">

                        </tbody>

                    </table>

                </div>
            </main>

            <script>
                var globalData = [];
                $(document).ready(function() {




                    //for Select office number
                    $.ajax({
                        url: "http://localhost/tea/api-select-officeno.php",
                        type: "GET",
                        success: function(data) {
                            // console.log(data);
                            var obj = JSON.parse(data);
                            // console.log(obj);

                            if (obj.status !== false) {
                                $.each(obj, function(key, value) {
                                    // console.log(value.office_no);
                                    $("#officeno").append(
                                        "<option value = " + value.office_no + " >" + value.office_no + "</option>"


                                    );

                                })
                            } else {
                                alert("select box have some error");
                            }
                        }
                    })


                    //fetch data month wise
                    $("#add").on("click", function(e) {
                        e.preventDefault();
                        var office_no = $("#officeno").val();
                        var month = $("#yearMonthPicker").val();
                        // console.log(office_no);
                        // console.log(month);

                        // if (office_no === "") {
                        //     alert("please fill all the details");
                        // } else 
                        $("#error-officeno").text("").slideUp();
                        $("#error-month").text("").slideUp();


                        if (office_no === "") {
                            $("#error-officeno").text("please select office number").slideDown();



                        } else if (month === "") {
                            $("#error-month").text("please select Month").slideDown();
                        } else {
                            $.ajax({
                                url: "http://localhost/tea/api-fetch-month-invoice.php",
                                type: "POST",
                                data: JSON.stringify({
                                    Office_no: office_no,
                                    yearMonth: month
                                }),
                                contentType: "application/json",
                                success: function(data) {
                                    // console.log(typeof(data));
                                    var obj = JSON.parse(data);
                                    // console.log(typeof(obj));
                                    // console.log(obj);

                                    if (obj.status !== false) {
                                        $("#load-table").removeClass("d-none");
                                        $("#btn-createInvoice").removeClass("d-none");
                                        $.each(obj, function(key, value) {
                                            var number = key + 1;



                                            $("#load-tbody").append(
                                                "<tr>" +
                                                "<td>" + number + "</td>" +
                                                "<td>" + value.Office_no + "</td>" +
                                                "<td>" + value.Drink + "</td>" +
                                                "<td>" + value.Quantity + "</td>" +
                                                "<td>" + value.Amount + "</td>" +
                                                "<td>" + value.Entry_by + "</td>" +
                                                "<td>" + value.Created_at + "</td>" +

                                                "</tr>"
                                            );


                                        });

                                    } else {
                                        alert(obj.message);

                                    }




                                }
                            });

                        }

                    });

                    //create invoice by clicking create invoice button
                    $("#btn-createInvoice").on("click", function() {

                        var office_no = $("#officeno").val();
                        var monthyear = $("#yearMonthPicker").val();

                        $.ajax({
                            url: "http://localhost/tea/api-create-invoice.php",
                            type: "POST",
                            data: JSON.stringify({
                                office_no: office_no,
                                monthyear: monthyear,
                            }),
                            contentType: "application/json",
                            success: function(data) {
                                // console.log(data);
                                var obj = JSON.parse(data);
                                // console.log(obj);
                                localStorage.setItem("invoiceData", JSON.stringify(obj));
                                // var check = JSON.parse(localStorage.getItem("invoiceData")); // Retrieve and parse the data
                                // console.log(check);

                                window.location.href = "create_invoice.php";





                                // $.each(obj, function(key, value) {
                                //     var drink = value.Drink
                                // })




                            }
                        });
                    });


                });
            </script>
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