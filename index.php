<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta name="author" content="" />
    <title>FarmaNet</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/logo.png" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-6 px-lg-7">
        <img src="assets/logo.png" alt="FarmaNet Logo" width="50" height="50" class="d-inline-block align-text-top me-3">
            <a class="navbar-brand">FarmaNet</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page">Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Entrar</a></li>
                    </ul>
                    <form class="d-flex">
                        <button class="btn btn-outline-dark" type="button">
                        <i class="bi-bag-heart-fill me-1"></i>
                            Sacola
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </button>
                    </form>
            </div>
        </div>
    </nav>

    <!-- Header-->
    <header class="py-5" style="background-color:#F8F8FF;">
        <div class="container px-4 px-lg-5 my-5">
            <h1 class="text-center" style="color: black; font-family:Arial, Helvetica, sans-serif; font-weight: bolder;">FARMANET</h1>
            <p class="text-center" style="color:black; font-family:Arial, Helvetica, sans-serif; font-weight: bolder;">Medicamentos gratuitos para cuidar da sua saúde com dignidade.</p>
        </div>
    </header>

    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                
                <?php
                include_once("conexao.php");

                $sql = "SELECT * FROM tbmedicamentos;";
                $resultado = mysqli_query($conexao, $sql);

                if (mysqli_num_rows($resultado) > 0) {
                    while ($m = mysqli_fetch_assoc($resultado)) {
                        echo '
                        <div class="col mb-5">
                            <h6 class="text-center">' . htmlspecialchars($m['Mcategoria']) . '</h6>
                            <div class="card h-100" >
                                <!-- Product image-->
                                <img class="card-img-top" src="medicamentos/uploads/' . htmlspecialchars($m['Mfoto']) . '" alt="Imagem do produto" />
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-semibold" style="color:black; font-family:Arial, Helvetica, sans-serif;">' . htmlspecialchars($m['Mnome']) . '</h5>
                                        <h6 class="fw-bolder" style="color:black;"> Quantidade: ' . htmlspecialchars($m['Mqtd']) . '</h6>
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
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
    <footer class="py-4 fixarRodape" style="background-color: #F8F8FF;">
        <div class="container px-4 px-lg-5 my-5">
            <p class="text-center" style="color:#696969; font-family:Arial, Helvetica, sans-serif; font-weight: bolder;">Farmácia Municipal de Matão</p>
            <p class="text-center" style="color:#696969; font-family:Arial, Helvetica, sans-serif; font-weight: bolder;">Rua José Bonifácio, 885 - Centro, Matão - SP, 15990-040</p>
        </div>
    </footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html>