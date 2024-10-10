<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$Mqtd = $Mmarca = $Mnome = $Mcategoria = "";
$Mqtd_err = $Mreservado_err = $Mmarca_err = $Mnome_err = $Mcategoria_err = "";

 
// Processing form data when form is submitted
if(isset($_POST["numero"]) && !empty($_POST["numero"])){
    // Get hnumeroroden input value
    $numero = $_POST["numero"];


//Nome
$input_Mnome = trim($_POST["Mnome"]);
if(empty($input_Mnome)){
    $Mnome_err = "Por favor digite o nome  do medicamento.";     
} else{
    $Mnome = $input_Mnome;
}

// Quantidade
$input_Mqtd = trim($_POST["Mqtd"]);
if(empty($input_Mqtd)){
    $Mqtd_err = "Por favor digite a Quantidade."; 
} else{
    $Mqtd = $input_Mqtd;
}

// Marca
$input_Mmarca = trim($_POST["Mmarca"]);
if(empty($input_Mmarca)){
    $Mmarca_err = "Por favor digite a marca do medicamento.";     
} else{
    $Mmarca = $input_Mmarca;
}

//Categoria
$input_Mcategoria = trim($_POST["Mcategoria"]);
if(empty($input_Mcategoria)){
    $Mcategoria_err = "Por favor digite a categoria  do medicamento.";     
} else{
    $Mcategoria= $input_Mcategoria;
}

    
    // Check input errors before inserting in database
    if(empty($Mnome_err) && empty($Mqtd_err)  && empty($Mmarca_err)  && empty($Mcategoria_err)){
        // Prepare an update statement
        $sql = "UPDATE tbmedicamentos SET Mnome=?, Mquantidade=?, Mmarca=? Mcategoria=? WHERE numero=?";
    
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sissi", $Mqtd, $Mmarca, $Mnome, $Mcategoria, $numero);
            
            // Set parameters
            // $param_Mqtd = $Mqtd;
            // $param_Mmarca = $Mmarca;
            // $param_Mnome = $Mnome;
            // $param_Mcategoria= $Mcategoria;
            
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($sql)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo  "Oops! Alguma coisa deu errado. Tente novamente mais tarde.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["numero"]) && !empty(trim($_GET["numero"]))){
        // Get URL parameter
        $numero =  trim($_GET["numero"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM tbmedicamentos WHERE numero = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_numero);
            
            // Set parameters
            $param_numero = $numero;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve indivnumeroual field value
                    $Mqtd = $row ["Mqtd"];
                    $Mmarca = $row ["Mmarca"];
                    $Mnome = $row ["Mnome"];
                    $Mcategoria = $row ["Mcategoria"];
                } else{
                    // URL doesn't contain valnumero numero. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <title>Atualizar Medicamento</title>
    <link rel="icon" type="image/x-icon" href="logo.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Atualizar Medicamento</h2>
                    <p>Edite os valores de entrada e envie para atualizar o registro do Medicamento.</p>
                    <form action="updateexec.php" method="post">
                        <div class="form-group">
                        <label>Nome</label>
                            <input type="text" name="Mnome" class="form-control <?php echo (!empty($Mnome_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Mnome; ?>">
                            <span class="invalid-feedback"><?php echo $Mnome_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Quantidade</label>
                            <textarea name="Mqtd" class="form-control <?php echo (!empty($Mqtd_err)) ? 'is-invalid' : ''; ?>"><?php echo $Mqtd; ?></textarea>
                            <span class="invalid-feedback"><?php echo $Mqtd_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Marca</label>
                            <input type="text" name="Mmarca" class="form-control <?php echo (!empty($Mmarca_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Mmarca; ?>">
                            <span class="invalid-feedback"><?php echo $Mmarca_err;?></span>
                        </div>
                      
                        <div class="form-group">
                            <label>Categoria</label>
                            <input type="text" name="Mcategoria" class="form-control <?php echo (!empty($Mcategoria_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Mcategoria; ?>">
                            <span class="invalid-feedback"><?php echo $Mcategoria_err;?></span>
                            </div>
                        <input type="hidden" name="numero" value="<?php echo $numero; ?>"/>
                        <input type="submit" class="btn btn-info" value="Atualizar">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
