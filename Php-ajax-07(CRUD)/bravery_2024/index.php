<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        .container {
            max-width: 40%;
        }

        .box-title {
            border-radius: 5px;
            box-shadow: 0px 0px 3px 1px gray;
            padding: 10px 0px;
        }

        .error-msg {
            color: #dc3545;
            font-weight: 600;
        }

        .success-msg {
            color: green;
            font-weight: 600;
        }



        #model {
            background: rgba(0, 0, 0, 0.9);
            /* color: white; */
            position: fixed;
            left: 0%;
            top: 0%;
            width: 100%;
            height: 100%;
            z-index: 100;
            display: none;
        }

        #model-form {
            background-color: black;
            color: white;
            width: 50%;
            position: relative;
            top: 5%;
            left: 25%;
            left: calc(50%-25%);
            padding: 15px;
            border-radius: 4px;

        }


        #Close-btn {
            background: red;
            color: white;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            border-radius: 50%;
            position: absolute;
            top: -15px;
            right: -15px;
            cursor: pointer;


        }
    </style>
</head>

<body>
    <div class="container ">
        <div class="cal-md-14">
            <div class="card mt-4">

                <div class="crud-head mt-4">
                    <H4 class="text-center">Register Form</H4>
                </div>

                <form method="POST" id="ins_rec">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>User Name</label>
                            <input type="text" name="username" class="form-control" placeholder="Username">
                            <span class="error-msg" id="msg_1"></span>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" placeholder="YourEmail@email.com">
                            <span class="error-msg" id="msg_2"></span>
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <select class="custom-select" name="country" id="country">
                                <option value="" selected>Choose...</option>
                                <option value="India">India</option>
                                <option value="USA">USA</option>
                                <option value="Germany">Germany</option>
                                <option value="UK">UK</option>
                            </select>
                            <span class="error-msg" id="msg_3"></span>
                        </div>
                        <div class="form-group">
                            <label>Birth Date</label>
                            <input type="date" name="bod" class="form-control">
                            <span class="error-msg" id="msg_4"></span>
                        </div>
                        <div class="form-group">
                            <label class="mr-3">Gender :- </label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="Male">
                                <label class="form-check-label">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="Female">
                                <label class="form-check-label">Female</label>
                            </div>
                            <span class="error-msg" id="msg_5"></span>
                        </div>
                        <div class="form-group">
                            <span class="success-msg" id="sc_msg"></span>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <h4 class="text-center">User Data Table</h4>
        <table class="table table-bordered mt-3">

            <tbody id="userDataTable">

            </tbody>
        </table>
    </div>



    <div id="model">
        <div id="model-form">
            <h4 class="text-center">Edit Form</h4>


            <form method="POST" id="ins_rec">


            </form>




        </div>
    </div>






    <script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" type="text/javascript"></script>


    <script type="text/javascript">
        $(document).ready(function() {


            function load() {
                $.ajax({
                    type: "POST",
                    url: "load.php",
                    success: function(result) {
                        $("#userDataTable").html(result);
                    }
                });
            }

            load();




            $('#ins_rec').on("submit", function(e) {
                e.preventDefault();


                var isValid = true;

                var username = $("input[name='username']").val();
                var usernameRegex = /^[a-zA-Z]+$/;

                if (username === "") {
                    $("#msg_1").text("Username is required");
                    isValid = false;
                } else if (!usernameRegex.test(username)) {
                    $("#msg_1").text("Username should not include numbers");
                    isValid = false;
                } else {
                    $("#msg_1").text("");
                }

                var email = $("input[name='email']").val();
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (email === "") {
                    $("#msg_2").text("Email is required");
                    isValid = false;
                } else if (!emailRegex.test(email)) {
                    $("#msg_2").text("Please enter a valid email address");
                    isValid = false;
                } else {
                    $("#msg_2").text("");
                }

                var country = $("#country").val();
                if (country === "") {
                    $("#msg_3").text("Country is required");
                    isValid = false;
                } else {
                    $("#msg_3").text("");
                }

                var birthDate = $("input[name='bod']").val();
                if (birthDate === "") {
                    $("#msg_4").text("Birth Date is required");
                    isValid = false;
                } else {
                    $("#msg_4").text("");
                }


                var gender = $("input[name='gender']:checked").val();
                if (!gender) {
                    $("#msg_5").text("Please select a gender");
                    isValid = false;
                } else {
                    $("#msg_5").text("");
                }

                if (isValid) {
                    $.ajax({
                        type: 'POST',
                        url: 'insprocess.php',
                        data: $(this).serialize(),
                        success: function(response) {
                            $("#sc_msg").text(response);
                            load();

                        }
                    });


                }

            });


            function deleteUser(id) {
                $.ajax({
                    type: "POST",
                    url: "delete.php",
                    data: {
                        delete_id: id
                    },
                    success: function(response) {
                        $("#sc_msg").text(response);
                        load();
                    }
                });
            }

            $('#userDataTable').on('click', '.btn-delete', function() {
                var id = $(this).data('id');
                deleteUser(id);
            });



            $(document).on("click", ".btn-edit", function() {
                $("#model").show();
                var sId = $(this).data('id-edit');
                $.ajax({

                    url: "Edit-form.php",
                    type: "POST",
                    data: {
                        id: sId
                    },
                    success: function(response) {
                        $("#model-form form").html(response);

                    }
                })
            });



            $("#Cancel-btn").on("click", function() {
                $("#model").hide();
            })


            $(document).on("click", "#Update-btn", function() {
                var id = $("#edit_id").val();
                var username = $("#edit_username").val();
                var email = $("#edit_email").val();
                var country = $("#edit_country").val();
                var bod = $("#edit_bod").val();
                var gender = $("input[name='edit_gender']:checked").val();

                $.ajax({
                    url: "update.php",
                    type: "POST",
                    data: {
                        id: id,
                        username: username,
                        email: email,
                        country: country,
                        bod: bod,
                        gender: gender
                    },
                    success: function(response) {
                        $("#userDataTable").html(response);
                        $("#model").hide();
                        load();
                    }
                });
            });



        });
    </script>
</body>

</html>