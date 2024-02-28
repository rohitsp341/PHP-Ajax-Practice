<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>

#success-message{
    background-color: #DEF1D8;
    color: green;
    padding: 10px;
    margin: 10px;
    display: none;
    position: absolute;
    right: 15px;
    top: 15px;
}

#error-message{
    background-color: #EFDCDD;
    color: red;
    padding: 10px;
    margin: 10px;
    display: none;
    position: absolute;
    right: 15px;
    top: 15px;

}




</style>

</head>
<body>
    <div class="py-5">
        <h4 class="text-center"> PHP with Ajax</h4><br><br>
        <div class="container">
            <div class="col-md-15">
            <div class="card border-success">
                <div class="card-head">
                  
                </div>
                <div class="container  m-3">
                    <form id="AddForm">
                        <div class="mb-3 m-4">
                            <label for="First_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="First_name" placeholder="Enter First Name">
                        </div>
                        <div class="mb-3 m-4">
                            <label for="Last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="Last_name" placeholder="Enter Last Name">
                        </div>
                        <div class="container m-2">
                                <input type="submit" class="btn btn-success " id="load-button" value="Save">
                        </div>

                    </form>
                    
                </div>
               
                <div class="card-body ">
                    <table class="table table-hover">
                    
                        <tbody id="table-data">
                        
                            
                        </tbody>
                    </table>
                </div>
                
            </div>
            </div>
        </div>
    </div>
    <div id="error-message"></div>
    <div id="success-message"></div>
    <!-- Corrected script tag -->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            function loadTable(){

                $.ajax({
                    url: "Ajax-load.php",
                    type: "POST",
                    success: function(data){
                        $("#table-data").html(data);
                    }
                });
            
            }
            loadTable();

            $("#load-button").on("click",function(e){
                e.preventDefault();  // The preventDefault method allows you to stop or prevent the browser from executing its default action for a given event.
                var First_name=$("#First_name").val();
                var Last_name=$("#Last_name").val();
                if(First_name == "" || Last_name == ""){
                    $("#error-message").html("All Fiels are Required").slideDown();
                    $("#success-message").slideUp();

                }
                else
                {
                        $.ajax({
                        url:"ajax-insert.php",
                        type:"POST",
                        data:{
                            firstname:First_name,lastname:Last_name
                            },
                            success:function(data){
                                if(data==1){          // if data inserted , load the table
                                    loadTable();
                                    $("#AddForm").trigger("reset");  // to reset form input fields   
                                    $("#success-message").html("Data Inserted Successfully").slideDown();
                                    $("#error-message").slideUp();
                                }
                                else{
                                    
                                    $("#error-message").html("Can't Save Data").slideDown();
                                     $("#success-message").slideUp();
                                }
                                

                            }


                    });

                }
                
                

            });
            $(document).on("click","#delete-btn",function(){
                if(confirm("Do you Really Want to Delete this Record ? ")){

                    var studentId=$(this).data("id");
                    // alert(studentId);
                    var element=this;
                    $.ajax({
                        url:"Delete.php",
                        type:"POST",
                        data:{id:studentId},
                        success:function(data){
                            if(data==1){
                                $(element).closest("tr").fadeOut();   // jquery method which identifies nearest element
                                $("#success-message").html("Deleted Successfully").slideDown();
                                $("#error-message").slideUp();
                            }
                            else{
                                $("#error-message").html("Can't Delete Records").slideDown();
                                $("#success-message").slideUp();

                            }

                        }


                    })
                }

            });

        });
    </script>

</body>
</html>