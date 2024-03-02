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

/* edit form */
#model{
    background: rgba(0,0,0,0.9);
    color: white; 
    position: fixed;
    left: 0%;
    top: 0%;
    width: 100%;
    height: 100%;
    z-index: 100;
    display: none;
}

#model-form{
    background-color: black;
    
    
    width: 40%;
    position: relative;
    top: 20%;
    left:30%;
    left: calc(50%-20%);
    padding: 15px;
    border-radius: 4px;
    
}

/* to close the Edit Form */

/* #Close-btn{
    background: red;
    color:white;
    width: 30px;
    height: 30px;
    line-height: 30px;
    text-align: center;
    border-radius: 50%;
    position: absolute;
    top: -15px;
    right: -15px;
    cursor: pointer;

 
} */


</style>

</head>
<body>
    <div class="d-flex justify-content-between mb-3 m-4 p-3">
        <div class="container text-start mb-3 m-4 ">
            <h4> PHP with Ajax</h4>
        </div>
        <div class="container text-end mb-3 m-4">
        <div class="form-outline mb-4" data-mdb-input-init>
            <input type="search" class="form-control" id="datatable-search-input" placeholder="Search">
            
            </div>
            <div id="datatable">
        </div>

        </div>
        
    </div>
    <div class="py-7">
        
        <div class="container">
            <div class="col-md-13">
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
                        <div class="mb-3 m-4">
                                <label>State</label>
                                
                                <select name="state" id="state" class="form-control">
                                    <option value="">---</option>
                                    <option value="Karnataka">Karnataka</option>
                                    <option value="Mumbai">Mumbai</option>
                                    <option value="Pune">Pune</option>
                                    <option value="Hydrabad">Hydrabad</option>

                                </select>
                        </div>
                        <div class="mb-3 m-4">
                                <label for="text">Mobile</label>
                                <input type="text" name="mobile" id="mobile_number" placeholder="Enter Mobile Number" class="form-control">

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

    <div id="model">
        <div id="model-form">
            <h1 class="text-center">Edit Form</h1>
            <div class="container  m-3">
                <form id="AddForm" >
                    

                </form>
                
            </div>
            
        </div>   
    </div> 

    <!-- Corrected script tag -->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript">
        // Load Table
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

            // Insert Table
            $("#load-button").on("click",function(e){
                e.preventDefault();  
                var First_name=$("#First_name").val();
                var Last_name=$("#Last_name").val();
                var state=$("#state").val();
                var Mobile=$("#mobile_number").val();
                if(First_name == "" || Last_name == "" || state == "" || Mobile == ""){
                    $("#error-message").html("All Fiels are Required").slideDown();
                    $("#success-message").slideUp();

                }
                else
                {
                        $.ajax({
                        url:"ajax-insert.php",
                        type:"POST",
                        data:{
                            firstname:First_name,lastname:Last_name,state:state,mobile:Mobile
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

            //Delete Table
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

            // Show Edit Form Once click on Edit
            $(document).on("click","#Edit-btn",function(){
                $("#model").show();                                     //show() : is  jquery method to show hiden data (display:none)
                var studentId=$(this).data("id");
                $.ajax({
                    url:"Edit-form.php",
                    type:"POST",
                    data:{id:studentId},
                    success:function(data){
                        $("#model-form form").html(data);      

                    }

                })

            });

            //Hide Form
            $("#Close-btn").on("click",function(){
                $("#model").hide();
            });

            //

            $(document).on("click","#Edit-Submit-button",function(){

                var stuId=$("#edit-id").val();
                var First_name=$("#edit-First_name").val();
                var Last_name=$("#edit-Last_name").val();
                var state=$("#edit-state").val();
                var mobile_edit=$("#edit-mobile").val();
                $.ajax({
                    url:"update-data.php",
                    type:"POST",
                    data:{id:stuId,fname:First_name,lname:Last_name,state:state,Mobile:mobile_edit},
                    success:function(data){
                        if(data==1){
                            $("#model").hide();  // to hide edit form , successful
                            loadTable();   // to load the table
                        }
                        



                    }

                })




            });

            //search
            $("#datatable-search-input").on("keyup",function(){
                var search_term=$(this).val();

                $.ajax({
                    url:"ajax-search.php",
                    type:"POST",
                    data:{search:search_term},
                    success:function(data){
                        $("#table-data").html(data);

                    }
                })




            })


        });
    </script>

</body>
</html>