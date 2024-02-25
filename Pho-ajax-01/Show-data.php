<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="py-5">
        <h1 class="text-center"> PHP with Ajax</h1><br><br>
        <div class="container">
            <div class="col-md-15">
            <div class="card border-success">
                <div class="card-head">
                    <div class="container m-2">
                        <input type="button" class="btn btn-primary " id="load-button" value="Load Button">
                    </div>
                    
                </div>
                    <div class="card-body ">
                    <table class="table table-hover">
                        <thead class="table-primary">
                            
                        </thead>
                        <tbody id="table-data">
                           
                            
                        </tbody>
                    </table>
                    </div>
                
            </div>
            </div>
        </div>
    </div>
    <!-- Corrected script tag -->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#load-button").on("click", function(e){
                $.ajax({
                    url: "Ajax-load.php",
                    type: "POST",
                    success: function(data){
                        $("#table-data").html(data);
                    }
                });
            });
        });
    </script>

</body>
</html>