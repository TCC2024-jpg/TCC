<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Mqtd = $_POST['Mqtd'];
    $Mmarca = $_POST['Mmarca'];
    $Mnome = $_POST['Mnome'];
    $Mcategoria = $_POST['Mcategoria'];

    // Processa o upload da foto
    if (isset($_FILES['Mfoto']) && $_FILES['Mfoto']['error'] == UPLOAD_ERR_OK) {
        $extensao = pathinfo($_FILES['Mfoto']['name'], PATHINFO_EXTENSION);
        $nomeAleatorio = uniqid() . '.' . $extensao; // Gera um nome aleatório
        $caminhoDestino = 'img/' . $nomeAleatorio;

        // Move o arquivo para a pasta img
        if (move_uploaded_file($_FILES['Mfoto']['tmp_name'], $caminhoDestino)) {
            // Conecte-se ao banco de dados e insira os dados
            include_once("conexao.php");

            if ($conexao->connect_error) {
                die("Conexão falhou: " . $conexao->connect_error);
            }

            $stmt = $conexao->prepare("INSERT INTO tbmedicamentos (Mqtd, Mmarca, Mnome, Mcategoria, Mfoto) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issss", $Mqtd, $Mmarca, $Mnome, $Mcategoria, $nomeAleatorio);

            if ($stmt->execute()) {
                echo "Medicamento cadastrado com sucesso!";
            } else {
                echo "Erro: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();
        } else {
            echo "Erro ao mover o arquivo para a pasta.";
        }
    } else {
        echo "Erro no upload do arquivo.";
    }
} else {
    echo "Método não permitido.";
}
?>
