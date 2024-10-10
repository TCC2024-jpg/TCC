<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Medicamentos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Cadastro de Medicamentos</h1>
        <form action="processa_cadastro.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="Mqtd">Quantidade</label>
                <input type="number" name="Mqtd" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="Mmarca">Marca</label>
                <input type="text" name="Mmarca" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="Mnome">Nome</label>
                <input type="text" name="Mnome" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="Mcategoria">Categoria</label>
                <input type="text" name="Mcategoria" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="Mfoto">Foto</label>
                <input type="file" name="Mfoto" class="form-control-file" required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
</body>
</html>
