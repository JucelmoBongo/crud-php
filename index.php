<?php
include "classeMain.php";

if (isset($_POST['nome'])) {
    $nome = htmlspecialchars(trim($_POST['nome']));
    $telefone = htmlspecialchars($_POST['telefone']);
    $email = htmlspecialchars($_POST['email']);

    if (!empty($nome) && !empty($telefone) && !empty($email)) {
        
        $teste = $conexao->addUsuario($nome, $telefone, $email);
        header("Location: index.php");
        
    } else {
        echo "Preencha todos os campos";
    }
}

if(isset($_GET['id_delete'])) {
    $id = $_GET['id_delete'];
    $conexao->apagarUsuario($id);
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    	if(isset($_GET['id_update'])) {
            $id = $_GET['id_update'];
            
        }

    ?>



    <div id="tabela">
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Acções</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $dados = $conexao->listarUsuarios();
                    
                    if(count($dados) > 0) {
                        for($i = 0; $i < count($dados); $i++) {
                            echo "<tr>";
                            foreach ($dados[$i] as $key => $value) {
                                if($key != 'id')
                                    echo "<td>" . $value . "</td>";
                            } //fecha foreach
                            ?>
                            <td><a href="index.php?id_update=<?php echo $dados[$i]['id']; ?>" class="botao editar">Editar</a> <a href="index.php?id_delete=<?php echo $dados[$i]['id']; ?>" class="botao apagar">Apagar</a></td>
                            <?php
                            echo "</tr>";
                        }
                    }
                ?>

            </tbody>
        </table>
    </div>

    <div id="formulario">
        <form action="index.php" method="POST">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" required>

            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" id="telefone" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email">

            <input type="submit" value="Cadastrar">


        </form>
    </div>


</body>

</html>