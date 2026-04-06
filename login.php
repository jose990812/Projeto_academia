<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>ZENET</title>
<link rel="stylesheet" href="login.css">
</head>

<body>



    <!-- sistema de login -->
<?php
    session_start();
    include("conexao.php");

    $erro = "";

    if(isset($_POST["usuario"]) && isset($_POST["senha"])){

        $cpf = $_POST["usuario"];
        $senha = $_POST["senha"];

        // Login fixo do professor
        if($cpf == "Professor" && $senha == "1234"){
            header("Location: pgprof.php");
            exit();
        }

        // Consulta no banco
        $sql = "SELECT * FROM login2 WHERE cpf = '$cpf'"; //SELECT * pega todas as colunas ,FROM login2 serve para indicar qual o nome da tabela , WHERE cpf = '$cpf' procura na coluna CPF o cpf digitado
        
        
        $resultado = mysqli_query($conexao, $sql); // mysqli_query() → envia a pergunta, $resultado → resposta do banco




        if(mysqli_num_rows($resultado) > 0){ //mysqli_num_rows() → conta quantas linhas vieram,> 0 → significa que encontrou pelo menos 1 usuário

            $usuario = mysqli_fetch_assoc($resultado);// pega a linha encontrada e transforma em um "array associativo" ou uma lista 

        
            if($senha == $usuario["senha"]){ // pega a senha digitada e verifica se está igual ao array gerado anteriormente
                $_SESSION["cpf"] = $cpf;
                header("Location: pgaluno.php"); // página do aluno
                exit();
            } else {
                $erro = "Senha incorreta";
            }

        } else {
            $erro = "Usuário não encontrado";
        }
    }
?>

    <div class = img1>
        <img src="img/semfundo.png" alt="Imagem">
    </div>
    
    <!--Div "Caixa" do meio da tela de login-->
    <div class="caixa">

    <!--Formulário responsável pelo envio das informações digitadas pelo usuário-->
        <form method="post"  >

            <h1>Login</h1>

            <!-- Caixas de digitação do usuário-->

            <input type="text" name="usuario"  maxlength="11" placeholder="Digite seu CPF"required><br><br>
            <input type="password" name="senha" placeholder="Senha "required><br><br>
            <!--Botão com função para enviar os dados digitados-->
            <button type="submit"><b>Logar</b></button><br>
            <p class = "erro"><?php echo $erro; ?></p>
            <!--Link/botão para ir para a tela de cadastro-->
            <p class = "cadastro">Não tem uma conta?  <a href="/login/cadastro.php">Cadastre-se</a></p>

        </form>

    </div>



</body>
</html>