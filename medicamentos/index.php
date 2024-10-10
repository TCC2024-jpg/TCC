<?php
    include_once("../crud.php");
    verificaloginadm();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="icon" type="image/x-icon" href="logo.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
        body {
            background-color: #F8F8FF. ;
            ;
        }
        .top-center-image {
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: 20px;
        }
        /* Ajusta a tabela abaixo da imagem */
        table {
            margin-top: 50px;
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
    
    
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
<img src="logo.png"  class="top-center-image" width="100" height="100">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Medicamentos</h2>
                        <a href="create.php" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Adicione novo Medicamento</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM tbmedicamentos";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Nome</th>";
                                        echo "<th>Quantidade</th>";
                                        echo "<th>Marca</th>";
                                        echo "<th>Categoria</th>";
                                        echo "<th>Ação</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['Mnome'] . "</td>";
                                        echo "<td>" . $row['Mqtd'] . "</td>";
                                        echo "<td>" . $row['Mmarca'] . "</td>";
                                        echo "<td>" . $row['Mcategoria'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="read.php?numero='. $row['numero'] .'" class="mr-3" title="Ver Medicamento" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="update.php?numero='. $row['numero'] .'" class="mr-3" title="Atualizar" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="delete.php?numero='. $row['numero'] .'" title="Apagar Medicamento" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>Nenhum Medicamento Cadastro</em></div>';
                        }
                    } else{
                        echo "Oops! Alguma coisa deu errado. Tente novamente mais tarde.";
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>