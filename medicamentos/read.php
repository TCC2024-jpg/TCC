<?php
// Check existence of id parameter before processing further
if(isset($_GET["numero"]) && !empty(trim($_GET["numero"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM tbmedicamentos WHERE numero = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_numero);
        
        // Set parameters
        $param_numero = trim($_GET["numero"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
            
                $Mqtd = $row ["Mqtd"];
                $Mmarca = $row ["Mmarca"];
                $Mnome = $row ["Mnome"];
                $Mcategoria = $row ["Mcategoria"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Alguma coisa deu errado. Tente novamente mais tarde.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <title>Ver Produto</title>
    <link rel="icon" type="image/x-icon" href="logo.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        .top-center-image {
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: 20px;
        }
       
    </style>
</head>
<body>
<img src="logo.png"  class="top-center-image" width="100" height="100">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">Ver Produto</h1>
                    <div class="form-group">
                        <label>Nome</label>
                        <p><b><?php echo $row["Mnome"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Quantidade</label>
                        <p><b><?php echo $row["Mqtd"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Marca</label>
                        <p><b><?php echo $row["Mmarca"]; ?></b></p>
                    </div>
                 
                    <div class="form-group">
                        <label>Categoria</label>
                        <p><b><?php echo $row["Mcategoria"]; ?></b></p>
                    </div>
                    
                    <p><a href="index.php" class="btn btn-info">Voltar</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>