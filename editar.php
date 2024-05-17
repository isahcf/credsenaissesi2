<?php
    include_once "conexao.php";
    include_onCE "funcoes.php";

    if(isset($_GET['id']) && $_GET['id'] > 0){
        $id = $_GET['id'];

        $conexaoComBanco = abrirBanco();


        $pegarDados = $conexaoComBanco->prepare("SELECT * FROM pessoas WHERE id= ?");
        $pegarDados->bind_param("i", $id);
        $pegarDados->execute();
        $result = $pegarDados->get_result();


        if($result->num_rows == 1){
            $registro = $result->fetch_assoc();


        }

    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){


        $id = $_POST['id'];
        $nome = $_POST ['nome'];
        $sobrenome = $_POST ['sobrenome'];
        $nascimento = $_POST ['nascimento'];
        $endereco = $_POST ['endereco'];
        $telefone = $_POST ['telefone'];
        $estado_civil = $_POST ['estado_civil'];
        $cpf = $_POST ['cpf'];
        $email = $_POST ['email'];


        $conexaoComBanco = abrirBanco();

        $sql = "UPDATE pessoas SET nome = '$nome', sobrenome = '$sobrenome', nascimento = '$nascimento', endereco = '$endereco', 
        telefone = '$telefone', estado_civil = '$estado_civil', cpf = '$cpf', email = '$email' WHERE id = $id";
       
           
         if($conexaoComBanco->query($sql) === TRUE)   {
            echo "Contato atualizado com sucesso no banco de dados";
         } else{
            echo ":(Erro ao salvar no banco de dados" . $conexaoComBanco->error;
         }
          
         fecharBanco($conexaoComBanco);
                
        }
?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de pessoas</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <header>
        <h1>Agenda de Contatos</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="cadastrar.php">Cadastrar</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <h2>Cadastro de contato</h2>
        <form action="" method="POST">
       
        <label for="nome">Nome</label>
        <input type="text" name="nome" value="<?= $registro['nome']?>" require>
       
        <label for="sobrrenome">Sobrenome</label>
        <input type="text" name="sobrenome" value="<?= $registro['sobrenome']?>" require>
      
        <label for="nascimento">Nascimento</label>
        <input type="date" name="nascimento" value="<?= $registro['nascimento']?>" require>

        <label for="endeco">Endereço</label>
        <input type="text" name="endereco" value="<?= $registro['endereco']?>" require>

        <label for="telefone">Telefone</label>
        <input type="text" name="telefone" value="<?= $registro['telefone']?>" require>

        <label for="estado_civil">Estado Civil</label>
        <input type="text" name="estado_civil" value="<?= $registro['estado_civil']?>" require>

        <label for="cpf">Cpf</label>
        <input type="text" name="cpf" value="<?= $registro['cpf']?>" require>

        <label for="email">Email</label>
        <input type="text" name="email" value="<?= $registro['email']?>" require>


        <input type="hidden" name="id" value="<?= $registro['id']?>">


        <button type="submit">Atualizar Contato</button>

        </form>
    </section>
</body>
</html>