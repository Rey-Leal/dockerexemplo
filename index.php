<head>
</head>

<body>
    <h4>PHP & Docker</h4>

    <?php
    // Referenciando conexao
    echo ("Container PHP + Apache executado com sucesso!<br>");
    echo ("Conectando ao mySQL...<br>");
    $conexao = mysqli_connect('db', 'root', 'root', 'testes') or die($erro = mysqli_connect_error());
    echo ("mySQL conectado!<br>");

    echo ("<br>");

    // Criando banco de dados e tabelas
    $sql = "DROP TABLE cliente";
    mysqli_query($conexao, $sql);

    $sql = "CREATE TABLE IF NOT EXISTS cliente 
			(idPessoa BIGINT NOT NULL, 
			nome VARCHAR(80) NOT NULL, 
			status TINYINT(1) NOT NULL, 
			PRIMARY KEY (idPessoa));";
    if (mysqli_query($conexao, $sql)) {
        echo ("Tabela Clientes criada com sucesso!<br>");
    } else {
        echo (mysqli_error($conexao) . "<br>");
    }

    $sql = "INSERT INTO cliente (idPessoa, nome, status) 
            VALUES 
            (1, 'Rey Leal', 1), 
            (2, 'Ana Clara', 1), 
            (3, 'Joseph Climmber', 0), 
            (4, 'Mario Silva', 1);";
    if (mysqli_query($conexao, $sql)) {
        $registros = mysqli_affected_rows($conexao);
        echo ("Linhas executadas: " . $registros . "<br>");
    } else {
        echo (mysqli_error($conexao) . "<br>");
    }

    echo ("<br>");

    // Acessando dados
    $sql = "SELECT * FROM cliente;";
    $resultado = $conexao->query($sql);
    if ($resultado->num_rows > 0) {
        while ($linha = $resultado->fetch_assoc()) {
            echo ($linha["id"] . " " . $linha["nome"] . "<br>");
        }
    } else {
        echo ("Nenhum registro encontrado!");
    }

    $conexao->close();
    ?>
    <br>
</body>