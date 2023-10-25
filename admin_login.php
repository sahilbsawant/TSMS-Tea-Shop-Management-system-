<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body class="" style="background-image: url('./assets/loginbg.jpg');">
    <div class="container ">
        <div class="row justify-content-center align-items-center ">
            <div class="col-lg-6">
                <div class="card border-white mt-5" style="background-color: rgba(0, 0, 0, 0.5);">
                    <div class="card-header text-white  border-white">
                        Login Page

                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <div>
                                <label for="textInput " class="text-white">Username :</label>
                                <input type="text" class="form-control text-white" id="uname" style="background-color: rgba(0, 0, 0, 0.5);">

                            </div>
                            <div class="form-group">
                                <label for="textInput" class="text-white">Password :</label>
                                <input type="text" class="form-control text-white" id="pass" style="background-color: rgba(0, 0, 0, 0.5);">

                            </div>
                            <br>
                            <button class="btn btn-primary" id="login">Login</button>





                        </div>

                    </div>


                </div>
            </div>





        </div>

    </div>

    <script>
        $(document).ready(function() {

            $("#login").on("click", function() {
                var uname = $("#uname").val();
                var pass = $("#pass").val();
                // console.log(uname, pass);

                $.ajax({
                    url: "http://localhost/TEA/api-admin-login.php",
                    type: "POST",
                    data: JSON.stringify({
                        username: uname,
                        password: pass
                    }),
                    contentType: "application/json",
                    success: function(data) {
                        var responseData = JSON.parse(data);
                        // console.log(responseData);
                        if (responseData.status == true) {
                            // alert(responseData.message);
                            // Redirect to '/staff.php'
                            // window.location.replace('tea/staff.php');
                            location.href = "dashboard.php";
                        } else {
                            alert(responseData.message);
                        }

                    }
                });

            });


        }); // document ready ka end
    </script>

</body>

</html>