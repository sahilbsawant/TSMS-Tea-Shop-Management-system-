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
                     <h3 class="mt-3">List of all Customers</h3>
                     <div class="row ">
                         <div class="col-lg-6 ms-auto">
                             <form class="ms-auto ">
                                 <div class="input-group">
                                     <input class="form-control" type="text" placeholder="Search for..." />

                                 </div>
                             </form>

                         </div>

                     </div>


                     <br>
                     <table class="table table-bordered">
                         <thead>
                             <tr>
                                 <th scope="col">ID</th>
                                 <th scope="col">Office_No</th>
                                 <th scope="col">First_Name</th>
                                 <th scope="col">Last_Name</th>
                                 <th scope="col">Mobile_NO</th>
                                 <th scope="col">Email_ID</th>
                                 <th scope="col">Edit</th>
                                 <th scope="col">Delete</th>
                             </tr>
                         </thead>
                         <tbody id="load-table">

                         </tbody>


                     </table>
                     <div id="pagination">

                     </div>

                 </div>



                 <script>
                     // Function to generate pagination buttons
                     //  

                     function generatePaginationButtons(totalPages, currentPage) {
                         var pagination = $("#pagination");
                         pagination.empty();

                         var ul = $("<ul>").addClass("pagination pagination-sm");

                         for (var i = 1; i <= totalPages; i++) {
                             var liClass = i === currentPage ? "active" : "";
                             ul.append('<li class="page-item ' + liClass + '"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>');
                         }

                         pagination.append(ul);
                     }


                     $(document).ready(function() {

                         var currentPage = 1;


                         function loadTable(page) {
                             $.ajax({
                                 url: 'http://localhost/tea/api-fetch-all-customer-list.php',
                                 type: 'GET',
                                 data: {
                                     page_no: page
                                 },
                                 success: function(data) {
                                     //  console.log(data);
                                     var obj = JSON.parse(data);
                                     console.log(obj);


                                     if (obj.status === true) {
                                         $("#load-table").empty();
                                         $.each(obj.data, function(key, value) {
                                             $("#load-table").append(
                                                 "<tr>" +
                                                 "<td>" + value.id + "</td>" +
                                                 "<td>" + value.office_no + "</td>" +
                                                 "<td>" + value.first_name + "</td>" +
                                                 "<td>" + value.last_name + "</td>" +
                                                 "<td>" + value.mobile_no + "</td>" +
                                                 "<td>" + value.email_id + "</td>" +
                                                 "<td>" +
                                                 "<button class='btn btn-primary btn-edit' data-id='" + value.id + "'>Edit</button>" +
                                                 "</td>" +
                                                 "<td> <button class='btn btn-primary edit-button' data-did='" + value.id + "'>Delete</button> </td>" +
                                                 "</tr>"
                                             );

                                         });

                                         // Generate pagination buttons
                                         generatePaginationButtons(obj.total_pages, currentPage);
                                     } else {
                                         $("#load-table").html("<tr><td colspan='8'>" + obj.message + "</td></tr>");
                                         // Clear pagination buttons when there are no results
                                         $("#pagination").empty();
                                     }
                                 }
                             });
                         }

                         // Initial load
                         loadTable();

                         // Function to handle pagination click

                         // Function to handle pagination click
                         $(document).on('click', '#pagination a', function(e) {
                             e.preventDefault();
                             currentPage = $(this).data('page'); // Update currentPage when a pagination link is clicked
                             loadTable(currentPage); // Load data for the new page
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