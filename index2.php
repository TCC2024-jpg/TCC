<?php
    include_once("crud.php");
    verificalogin();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <meta name="author" content="" />
        <title>FarmaNet</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/logo.png" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <style>
            .search-button {
    background-color: #007bff; /* Cor de fundo */
    color: white; /* Cor do texto */
    border: none; /* Remove a borda padrão */
    border-radius: 25px; /* Cantos arredondados */
    padding: 10px 15px; /* Espaçamento interno */
    margin-left: 10px; /* Espaço entre input e botão */
    cursor: pointer; /* Muda o cursor para indicar clicável */
    transition: background-color 0.3s; /* Transição suave para a cor de fundo */
    display: flex; /* Flexbox para centralizar o ícone */
    align-items: center; /* Alinha verticalmente o ícone */
}

.search-button i {
    font-size: 18px; /* Tamanho do ícone */
}

.search-button:hover {
    background-color: #0056b3; /* Cor de fundo ao passar o mouse */
}
.search-form {
    display: flex;
    justify-content: center; /* Centraliza o formulário */
    margin: 20px 0; /* Margem superior e inferior */
}

.search-input {
    border: 2px solid #0c9c9f; /* Cor da borda */
    border-radius: 25px; /* Cantos arredondados */
    padding: 10px 20px; /* Espaçamento interno */
    font-size: 16px; /* Tamanho da fonte */
    width: 300px; /* Largura do input */
    transition: border-color 0.3s; /* Transição suave para a cor da borda */
}

.search-input:focus {
    border-color: #0c9c9f; /* Cor da borda ao focar */
    outline: none; /* Remove a borda padrão do foco */
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Sombra ao focar */
}

.search-button {
    background-color: #0c9c9f; /* Cor de fundo */
    color: white; /* Cor do texto */
    border: none; /* Remove a borda padrão */
    border-radius: 25px; /* Cantos arredondados */
    padding: 10px 20px; /* Espaçamento interno */
    margin-left: 10px; /* Espaço entre input e botão */
    cursor: pointer; /* Muda o cursor para indicar clicável */
    transition: background-color 0.3s; /* Transição suave para a cor de fundo */
}

.search-button:hover {
    background-color: #469a81; /* Cor de fundo ao passar o mouse */
}
.btn-outline-dark {
        border-color: #0c9c9f;
        color: #0c9c9f;
    }

    .bi-bag-heart-fill {
        color: #0c9c9f;
    }

    .badge {
        background-color: #0c9c9f;
        color: #ffffff;
    }

        </style>
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <!-- Logo e nome da marca -->
        <img src="assets/logo.png" alt="FarmaNet Logo" width="50" height="50" class="d-inline-block align-text-top me-3">
        <a class="navbar-brand">FarmaNet</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Menu de navegação à esquerda -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page">Menu</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Sair</a></li>
            </ul>
            
            <!-- Campo de filtro centralizado -->
            <form method="get" action="index2.php" class="search-form d-flex">
    <input type="text" name="nomefiltrar" class="search-input" placeholder="Medicamento procurado" aria-label="Pesquisar Medicamento" autofocus>
    <button type="submit" class="search-button" aria-label="Pesquisar">
        <i class="bi bi-search"></i> <!-- Ícone de lupa -->
    </button>
</form>


            <!-- Sacola à direita -->
            <form class="d-flex ms-auto">
                <button class="btn btn-outline-dark" type="button">
                    <i class="bi-bag-heart-fill me-1"></i>
                    Sacola
                    <span class=" text-dark ms-1 rounded-pill">0</span>
                </button>
            </form>
        </div>
    </div>
</nav>

        <!-- Header-->
        <header class="py-5" style="background-color:#F8F8FF;">
            <div class="container px-4 px-lg-5 my-5">
                <!-- Conteúdo do cabeçalho -->
                <H1 class="text-center" style="color:black; font-family:Arial, Helvetica, sans-serif; font-weight: bolder;">FARMANET</H1>
                <p class="text-center" style="color:black; font-family:Arial, Helvetica, sans-serif; font-weight: bolder;">Medicamentos gratuitos para cuidar da sua saúde com dignidade.</p>
            </div>
        </header>
        <!-- Section-->
       
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                
                <?php
                include_once("conexao.php");
                
                if(isset($_GET['nomefiltrar'])){
                    $sql = "SELECT * FROM tbmedicamentos where Mnome like '%".$_GET['nomefiltrar']."%';";
                }else{
                    $sql = "SELECT * FROM tbmedicamentos;";
                }
                   
                $resultado = mysqli_query($conexao, $sql);

                if (mysqli_num_rows($resultado) > 0) {
                    while ($m = mysqli_fetch_assoc($resultado)) {
                        echo '
                        <div class="col mb-5">
                        <form method="get" action="reservar.php">
                            <h6 class="text-center">' . htmlspecialchars($m['Mcategoria']) . '</h6>
                            <div class="card h-100">
                                <!-- Product image-->
                                <img class="card-img-top" src="medicamentos/uploads/' . htmlspecialchars($m['Mfoto']) . '" alt="Imagem do produto" />
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-semibold" style="color:black; font-family:Arial, Helvetica, sans-serif;">' . htmlspecialchars($m['Mnome']) . '</h5>
                                        
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent text-center">
                                    <button class="btn btn-danger" >Reservar</button>
                                    <!-- You can add action buttons here, if needed -->
                                </div>
                            </div>
                        </div>';
                    }
                } else {
                    echo "<p class='text-center'>Nenhum medicamento encontrado.</p>";
                }
                // mysqli_close($conexao);
                ?>

            </div>
        </div>
    </section>

    <!-- Footer-->
    <footer class="py-4 Rodapestyle " style="background-color: #F8F8FF;">
        <div class="container px-4 px-lg-5 my-5">
            <p class="text-center" style="color:black; font-family:Arial, Helvetica, sans-serif; font-weight: bolder;">Farmácia Municipal de Matão</p>
            <p class="text-center" style="color:black; font-family:Arial, Helvetica, sans-serif; font-weight: bolder;">Rua José Bonifácio, 885 - Centro, Matão - SP, 15990-040</p>
        </div>
    </footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html>