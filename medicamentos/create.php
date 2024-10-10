
<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$Mqtd = $Mmarca = $Mnome = $Mcategoria = $Mfoto = "";
$Mqtd_err = $Mmarca_err = $Mnome_err = $Mcategoria_err = $Mfoto_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nome
    $input_Mnome = trim($_POST["Mnome"]);
    if (empty($input_Mnome)) {
        $Mnome_err = "Por favor digite o nome do medicamento.";
    } else {
        $Mnome = $input_Mnome;
    }

    // Quantidade
    $input_Mqtd = trim($_POST["Mqtd"]);
    if (empty($input_Mqtd)) {
        $Mqtd_err = "Por favor digite a Quantidade.";
    } else {
        $Mqtd = $input_Mqtd;
    }

    // Marca
    $input_Mmarca = trim($_POST["Mmarca"]);
    if (empty($input_Mmarca)) {
        $Mmarca_err = "Por favor digite a marca do medicamento.";
    } else {
        $Mmarca = $input_Mmarca;
    }

    // Categoria
    $input_Mcategoria = trim($_POST["Mcategoria"]);
    if (empty($input_Mcategoria)) {
        $Mcategoria_err = "Por favor digite a categoria do medicamento.";
    } else {
        $Mcategoria = $input_Mcategoria;
    }

    // Foto (verifica se o arquivo foi enviado corretamente)
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $target_dir = "uploads/";
        $file_name = uniqid() . basename($_FILES["file"]["name"]);
        $target_file = $target_dir . $file_name;

        // Verifica o tipo de arquivo
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = array("jpg", "jpeg", "png", "gif");

        if (!in_array($file_type, $allowed_types)) {
            $Mfoto_err = "Somente arquivos JPG, JPEG, PNG e GIF são permitidos.";
        } else {
            // Move o arquivo para o diretório de uploads
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                $Mfoto = $file_name; // Define o nome do arquivo salvo no servidor
            } else {
                $Mfoto_err = "Houve um erro ao fazer o upload da foto.";
            }
        }
    } else {
        $Mfoto_err = "Por favor, selecione a foto do medicamento.";
    }

    // Check input errors before inserting in database
    if (empty($Mnome_err) && empty($Mqtd_err) && empty($Mmarca_err) && empty($Mcategoria_err) && empty($Mfoto_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO tbmedicamentos (Mqtd, Mmarca, Mnome, Mcategoria, Mfoto) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_Mqtd, $param_Mmarca, $param_Mnome, $param_Mcategoria, $param_Mfoto);

            // Set parameters
            $param_Mqtd = $Mqtd;
            $param_Mmarca = $Mmarca;
            $param_Mnome = $Mnome;
            $param_Mcategoria = $Mcategoria;
            $param_Mfoto = $Mfoto;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else {
                echo "Oops! Alguma coisa deu errado. Tente novamente mais tarde.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="icon" type="image/x-icon" href="logo.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        #preview {
            margin-top: 10px;
            max-width: 200px;
            max-height: 200px;
        }
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
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Cadastrar Medicamento</h2>
                    <p>Por favor, preencha este formulário e envie para adicionar o medicamento.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="Mnome" class="form-control <?php echo (!empty($Mnome_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Mnome; ?>">
                            <span class="invalid-feedback"><?php echo $Mnome_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Quantidade</label>
                            <input type="text" name="Mqtd" class="form-control <?php echo (!empty($Mqtd_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Mqtd; ?>">
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
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" name="file" class="form-control <?php echo (!empty($Mfoto_err)) ? 'is-invalid' : ''; ?>">
                            <span class="invalid-feedback"><?php echo $Mfoto_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-info" value="Cadastrar">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>

    <script>
         const form = document.getElementById('uploadForm');
        const responseDiv = document.getElementById('response');

        form.addEventListener('submit', async function (event) {
            event.preventDefault();  // Evita que o formulário seja enviado da maneira tradicional
            
            const fileInput = document.getElementById('fileInput').files[0];

            if (!fileInput) {
                responseDiv.innerHTML = '<p style="color: red;">Por favor, selecione uma imagem.</p>';
                return;
            }

            const formData = new FormData();
            formData.append('file', fileInput);

            try {
                const response = await fetch('http://127.0.0.1:5000/upload', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();
                if (response.ok) {
                    responseDiv.innerHTML = `<p style="color: green;">Imagem enviada com sucesso! Nome do arquivo: ${result.filename}</p>`;
                } else {
                    responseDiv.innerHTML = `<p style="color: red;">Erro: ${result.error}</p>`;
                }
            } catch (error) {
                responseDiv.innerHTML = `<p style="color: red;">Ocorreu um erro ao enviar a imagem.</p>`;
            }
        });
    
        const fileInput = document.getElementById('fileInput');
        const preview = document.getElementById('preview');

        fileInput.addEventListener('change', function() {
            const file = fileInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block'; // Mostra a imagem
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>