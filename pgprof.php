<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pagina do Professor</title>
    <link rel="stylesheet" href="pgprof.css">
</head>
<body>



    <?php

    include("conexao.php");




    //Consultar CPF
    $positivo = "";
    $erros = "";
    $cpf = "";
    $nome1 = "";

    if(isset($_POST["buscar"])){

        $cpf = $_POST["cpf"];

        $sql = "SELECT nome FROM login2 WHERE cpf = '$cpf'";
        $resultado = mysqli_query($conexao, $sql);

        if(mysqli_num_rows($resultado) > 0){
            $linha = mysqli_fetch_assoc($resultado);
            $nome1 = $linha["nome"];
        } else {
            $erros = "Nenhum aluno foi encontrado com esse CPF";
        }
    }

    // ---------------------------------------------------------------------------

    //Salvar treino

if(isset($_POST["salvar"])){

    $cpf = $_POST["cpf"];
    $dia = $_POST["dia"];

    if(empty($cpf)){
        $erros = "Digite o CPF!";
    }
    else if(empty($dia)){
        $erros = "Selecione o dia!";
    }
    else if(isset($_POST["exercicios"])){

        $resultado_final = [];

        foreach($_POST["exercicios"] as $exercicio){

            $serie = $_POST["serie"][$exercicio] ?? "";
            $rep = $_POST["rep"][$exercicio] ?? "";

            // verifica se é cardio (não tem rep)
            if(empty($rep)){
                // formato para tempo
                $resultado_final[] = "$exercicio ({$serie} hs)";
            } else {
                // formato normal
                $resultado_final[] = "$exercicio ({$serie}x{$rep})";
            }
        }

        //  NOVO: pega o que já existe no banco
        $sql = "SELECT $dia FROM login2 WHERE cpf = '$cpf'";
        $res = mysqli_query($conexao, $sql);
        $linha = mysqli_fetch_assoc($res);

        $existente = $linha[$dia] ?? "";

        //  junta com os novos
        if(!empty($existente)){
            $texto = $existente . ", " . implode(", ", $resultado_final);
        } else {
            $texto = implode(", ", $resultado_final);
        }

        // salva tudo junto
        $sql = "UPDATE login2 SET $dia = '$texto' WHERE cpf = '$cpf'";
        mysqli_query($conexao, $sql);

        $positivo = "Treino adicionado com sucesso!";
    }
    else{
        $erros = "Selecione exercícios!";
    }
}

    // ------------------------------------------------------------------------------------



    //EXCLUIR TREINO

    if(isset($_POST["excluir"])){

        $cpf = $_POST["cpf"];
        $dia = $_POST["dia"]; //  IMPORTANTE

        if(empty($cpf)){
            $erros =  "Digite o CPF!";
        }
        else if(empty($dia)){
            $erros =  "Selecione o dia!";
        }
        else if(isset($_POST["exercicios"])){

            $remover = $_POST["exercicios"];

            // pega os exercícios do dia certo
            $sql = "SELECT $dia FROM login2 WHERE cpf = '$cpf'";
            $resultado = mysqli_query($conexao, $sql);

            if(mysqli_num_rows($resultado) > 0){

                $linha = mysqli_fetch_assoc($resultado);
                $lista = $linha[$dia];

                $array = explode(", ", $lista);

                $nova_lista = [];

                foreach($array as $item){

                    $remover_item = false;

                    foreach($remover as $exercicio){

                        // verifica se o nome está dentro do texto (ignora 3x10)
                        if(strpos($item, $exercicio) !== false){
                            $remover_item = true;
                            break;
                        }
                    }

                    if(!$remover_item){
                        $nova_lista[] = $item;
                    }
                }

                $texto_final = implode(", ", $nova_lista);

                $texto_final = implode(", ", $nova_lista);

                // atualiza no banco no DIA CERTO
                $sql = "UPDATE login2 SET $dia = '$texto_final' WHERE cpf = '$cpf'";
                mysqli_query($conexao, $sql);

                $positivo =  "Exercícios removidos com sucesso!";
            }

        } else {
            $erros =  "Selecione exercícios para excluir!";
        }
    }
    //-------------------------------------------------------------------------------------------

    $segunda = "";

    if(isset($_POST["buscar"])){

        $cpf = $_POST["cpf"];

        $sql = "SELECT exercicios1 FROM login2 WHERE cpf = '$cpf'";
        $resultado = mysqli_query($conexao, $sql);

        if(mysqli_num_rows($resultado) > 0){
            $linha = mysqli_fetch_assoc($resultado);
            $segunda = $linha["exercicios1"];
        } else {
            $segunda = "";
        }
    }

    $terca = "";

    if(isset($_POST["buscar"])){

        $cpf = $_POST["cpf"];

        $sql = "SELECT exercicios2 FROM login2 WHERE cpf = '$cpf'";
        $resultado = mysqli_query($conexao, $sql);

        if(mysqli_num_rows($resultado) > 0){
            $linha = mysqli_fetch_assoc($resultado);
            $terca = $linha["exercicios2"];
        } else {
            $terca = "";
        }
    }

    $quarta = "";

    if(isset($_POST["buscar"])){

        $cpf = $_POST["cpf"];

        $sql = "SELECT exercicios3 FROM login2 WHERE cpf = '$cpf'";
        $resultado = mysqli_query($conexao, $sql);

        if(mysqli_num_rows($resultado) > 0){
            $linha = mysqli_fetch_assoc($resultado);
            $quarta = $linha["exercicios3"];
        } else {
            $quarta = "";
        }
    }
    $quinta = "";

    if(isset($_POST["buscar"])){

        $cpf = $_POST["cpf"];

        $sql = "SELECT exercicios4 FROM login2 WHERE cpf = '$cpf'";
        $resultado = mysqli_query($conexao, $sql);

        if(mysqli_num_rows($resultado) > 0){
            $linha = mysqli_fetch_assoc($resultado);
            $quinta = $linha["exercicios4"];
        } else {
            $quinta = "";
        }
    }

    $sexta = "";

    if(isset($_POST["buscar"])){

        $cpf = $_POST["cpf"];

        $sql = "SELECT exercicios5 FROM login2 WHERE cpf = '$cpf'";
        $resultado = mysqli_query($conexao, $sql);

        if(mysqli_num_rows($resultado) > 0){
            $linha = mysqli_fetch_assoc($resultado);
            $sexta = $linha["exercicios5"];
        } else {
            $sexta = "";
        }
    }

    $sabado = "";

    if(isset($_POST["buscar"])){

        $cpf = $_POST["cpf"];

        $sql = "SELECT exercicios6 FROM login2 WHERE cpf = '$cpf'";
        $resultado = mysqli_query($conexao, $sql);

        if(mysqli_num_rows($resultado) > 0){
            $linha = mysqli_fetch_assoc($resultado);
            $sabado = $linha["exercicios6"];
        } else {
            $sabado = "";
        }
    }

    $domingo = "";

    if(isset($_POST["buscar"])){

        $cpf = $_POST["cpf"];

        $sql = "SELECT exercicios7 FROM login2 WHERE cpf = '$cpf'";
        $resultado = mysqli_query($conexao, $sql);

        if(mysqli_num_rows($resultado) > 0){
            $linha = mysqli_fetch_assoc($resultado);
            $domingo = $linha["exercicios7"];
        } else {
            $domingo = "";
        }
    }
    ?>




    <div class = img1>
        <img src="img/semfundo.png" alt="Imagem">
    </div>

    <form method="post">
        <div class= "aluno">
            
            <input class = "inp" type="text" name="cpf" placeholder="CPF do Aluno" maxlength="11" minlength="11" value="<?php echo $cpf; ?>" required >
            <button class = "pesquisar"type="submit" name = "buscar">🔍</button>
            
        </div>
   
        <div class = "nome">
            <h2><?php echo $nome1?></h2>
        </div>

        <p class = "erros"><b><?php echo $erros?></b></p>
        <p class = "posi"><b><?php echo $positivo?></b></p>


        <select name="dia" >
            <option value=""><b>Selecione o dia</b></option>
            <option value="exercicios1"><b>Segunda</b></option>
            <option value="exercicios2"><b>Terça</b></option>
            <option value="exercicios3"><b>Quarta</b></option>
            <option value="exercicios4"><b>Quinta</b></option>
            <option value="exercicios5"><b>Sexta</b></option>
            <option value="exercicios6"><b>Sábado</b></option>
            <option value="exercicios7"><b>Domingo</b></option>
        </select>

        <button class = "salvar"type="submit" name = "salvar"><b>Salvar</b></button>
        <button class = "excluir"type="submit" name="excluir"><b>Excluir</b></button>
        



            <div class = "caixas">
            
                <div class = "caixa1">

                    <div class = "segunda">
                        <h2>SEGUNDA</h2>
                        <p><?php echo str_replace(", ", "<br><br>", $segunda); ?></p>
                    </div>

                    <div class = "terça">
                        <h2>TERÇA</h2>
                        <p><?php echo str_replace(", ", "<br><br>", $terca); ?></p>
                    </div>

                    <div class = "quarta">
                        <h2>QUARTA</h2>
                        <p><?php echo str_replace(", ", "<br><br>", $quarta); ?></p>
                    </div>

                    <div class = "quinta">
                        <h2>QUINTA</h2>
                        <p><?php echo str_replace(", ", "<br><br>", $quinta); ?></p>
                    </div>

                    <div class = "sexta">
                        <h2>SEXTA</h2>
                        <p><?php echo str_replace(", ", "<br><br>", $sexta); ?></p>
                    </div>

                    <div class = "sabado">
                        <h2>SÁBADO</h2>
                        <p><?php echo str_replace(", ", "<br><br>", $sabado); ?></p>
                    </div>

                </div>

                <div class= "caixa2">
                    


                        
                    <div class =div1>
                        <label class = "label1"><b>Peito</b></label><br>
                        <br>
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value="Supino Reto">
                                <b>Supino Reto</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class="serie" type="number" name="serie[Supino Reto]">
                                </label>

                                <label><b>Rep</b>
                                    <input class="serie" type="number" name="rep[Supino Reto]">
                                </label>
                            </div>

                        </div>
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Supino inclinado">
                                <B>Supino inclinado.</B></label>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Supino inclinado]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Supino inclinado]" >
                                </label>
                            </div>

                        </div>

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Supino declinado">
                                <B>Supino declinado.</B></label>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Supino declinado]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Supino declinado]" >
                                </label>
                            </div>

                        </div>

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Crucifixo reto">
                                <B>Crucifixo reto.</B></label>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Crucifixo reto]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Crucifixo reto]" >
                                </label>
                            </div>

                        </div>

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Cross over (cabo)">
                                <B>Cross over (cabo).</B></label>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Cross over (cabo)]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Cross over (cabo)]" >
                                </label>
                            </div>

                        </div>
                        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Peck deck (máquina)">
                                <B>Peck deck (máquina).</B></label>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Peck deck (máquina)]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Peck deck (máquina)]" >
                                </label>
                            </div>

                        </div>

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Flexão de braço (tradicional)">
                                <B>Flexão de braço (tradicional).</B></label>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Flexão de braço (tradicional)]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Flexão de braço (tradicional)]" >
                                </label>
                            </div>

                        </div>

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Flexão inclinada">
                                <B>Flexão inclinada.</B></label>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Flexão inclinada]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Flexão inclinada]" >
                                </label>
                            </div>

                        </div>

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Flexão declinada">
                                <B>Flexão declinada.</B></label>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Flexão declinada]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Flexão declinada]" >
                                </label>
                            </div>

                        </div>

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Flexão diamante">
                                <B>Flexão diamante.</B></label>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Flexão diamante]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Flexão diamante]" >
                                </label>
                            </div>

                        </div>

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Supino com halteres">
                                <B>Supino com halteres.</B></label>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Supino com halteres]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Supino com halteres]" >
                                </label>
                            </div>

                        </div>
                    
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Pullover com halter">
                                <B>Pullover com halter.</B></label>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Pullover com halter]">
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Pullover com halter]">
                                </label>
                            </div>

                        </div>
                        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Cross over baixo">
                                <B>Cross over baixo.</B></label>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Cross over baixo]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Cross over baixo]" >
                                </label>
                            </div>

                        </div>
                    
                    


                
                        <label class = "label1"><b>Costa</b></label><br>
                        <br>

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Puxada na frente (pulldown)">
                                <b>Puxada na frente (pulldown)</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Puxada na frente (pulldown)]">
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Puxada na frente (pulldown)]" >
                                </label>
                            </div>

                        </div>
                        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Puxada atrás">
                                <b>Puxada atrás</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Puxada atrás]">
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Puxada atrás]">
                                </label>
                            </div>

                        </div>
                        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Remada baixa (cabo)">
                                <b>Remada baixa (cabo)</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Remada baixa (cabo)]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Remada baixa (cabo)]" >
                                </label>
                            </div>

                        </div>

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Remada curvada (barra)">
                                <b>Remada curvada (barra)</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Remada curvada (barra)]">
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Remada curvada (barra)]" >
                                </label>
                            </div>

                        </div>
                        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Remada unilateral (halter)">
                                <b>Remada unilateral (halter)</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Remada unilateral (halter]">
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Remada unilateral (halter]" >
                                </label>
                            </div>

                        </div>
                        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Barra fixa">
                                <b>Barra fixa</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Barra fixa]">
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Barra fixa]" >
                                </label>
                            </div>

                        </div>
                        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Barra fixa com pegada aberta">
                                <b>Barra fixa com pegada aberta</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Barra fixa com pegada aberta]">
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Barra fixa com pegada aberta]" >
                                </label>
                            </div>

                        </div>

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Remada na máquina">
                                <b>Remada na máquina</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Remada na máquina]">
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Remada na máquina]" >
                                </label>
                            </div>

                        </div>                        

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Puxada com triângulo">
                                <b>Puxada com triângulo</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Puxada com triângulo]">
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Puxada com triângulo]" >
                                </label>
                            </div>

                        </div>   

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Pullover na máquina">
                                <b>Pullover na máquina</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Pullover na máquina]">
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Pullover na máquina]" >
                                </label>
                            </div>

                        </div> 
                        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Levantamento terra">
                                <b>Levantamento terra</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Levantamento terra]">
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Levantamento terra]" >
                                </label>
                            </div>

                        </div> 

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Remada invertida">
                                <b>Remada invertida</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Remada invertida]">
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Remada invertida]" >
                                </label>
                            </div>

                        </div>  

                    


                    
                        <label class = "label1"><b>Pernas</b></label> <br>
                        <br>

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Agachamento livre">
                                <b>Agachamento livre</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Agachamento livre]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Agachamento livre]" >
                                </label>
                            </div>

                        </div>  
                        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Agachamento no Smith">
                                <b>Agachamento no Smith</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Agachamento no Smith]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Agachamento no Smith]" >
                                </label>
                            </div>

                        </div>  
                        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Leg press">
                                <b>Leg press</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Leg press]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Leg press]" >
                                </label>
                            </div>

                        </div>  
                        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Cadeira extensora">
                                <b>Cadeira extensora</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Cadeira extensora]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Cadeira extensora]" >
                                </label>
                            </div>

                        </div>  
        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Afundo (passada)">
                                <b>Afundo (passada)</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Afundo (passada)]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Afundo (passada)]" >
                                </label>
                            </div>

                        </div>  
                        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Hack machine">
                                <b>Hack machine</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Hack machine]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Hack machine]" >
                                </label>
                            </div>

                        </div>  
                        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Sissy squat">
                                <b>Sissy squat</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Sissy squat]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Sissy squat]" >
                                </label>
                            </div>

                        </div> 
                        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Elevação de quadril (hip thrust)">
                                <b>Elevação de quadril (hip thrust)</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Elevação de quadril (hip thrust)]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Elevação de quadril (hip thrust)]" >
                                </label>
                            </div>

                        </div> 

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Glúteo no cabo">
                                <b>Glúteo no cabo</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Glúteo no cabo]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Glúteo no cabo]" >
                                </label>
                            </div>

                        </div> 

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Glúteo na máquina">
                                <b>Glúteo na máquina</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Glúteo na máquina]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Glúteo na máquina]" >
                                </label>
                            </div>

                        </div> 

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Agachamento sumô">
                                <b>Agachamento sumô</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Agachamento sumô]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Agachamento sumô]" >
                                </label>
                            </div>

                        </div> 
                        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Step-up (subida no banco)">
                                <b>Step-up (subida no banco)</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Step-up (subida no banco)]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Step-up (subida no banco)]" >
                                </label>
                            </div>

                        </div> 

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Mesa flexora">
                                <b>Mesa flexora</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Mesa flexora]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Mesa flexora]" >
                                </label>
                            </div>

                        </div> 

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Cadeira flexora">
                                <b>Cadeira flexora</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Cadeira flexora]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Cadeira flexora]" >
                                </label>
                            </div>

                        </div> 

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Stiff (levantamento terra romeno)">
                                <b>Stiff (levantamento terra romeno)</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Stiff (levantamento terra romeno)]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Stiff (levantamento terra romeno)]" >
                                </label>
                            </div>

                        </div> 
                        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Good morning">
                                <b>Good morning</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Good morning]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Good morning]" >
                                </label>
                            </div>

                        </div> 

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Levantamento terra">
                                <b>Levantamento terra</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Levantamento terra]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Levantamento terra]" >
                                </label>
                            </div>

                        </div> 

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Panturrilha em pé">
                                <b>Panturrilha em pé</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Panturrilha em pé]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Panturrilha em pé]" >
                                </label>
                            </div>

                        </div> 
                        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Panturrilha sentado">
                                <b>Panturrilha sentado</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Panturrilha sentado]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Panturrilha sentado]" >
                                </label>
                            </div>

                        </div> 

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Panturrilha no leg press">
                                <b>Panturrilha no leg press</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Panturrilha no leg press]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Panturrilha no leg press]" >
                                </label>
                            </div>

                        </div> 

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Panturrilha unilateral">
                                <b>Panturrilha unilateral</b>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Panturrilha unilateral]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Panturrilha unilateral]" >
                                </label>
                            </div>

                        </div> 
                        
                    

                    
                        <label class = "label1"><b>Bíceps</b></label><br>
                        <br>

                        <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Rosca direta com barra">
                                <b>Rosca direta com barra</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Rosca direta com barra]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Rosca direta com barra]" >
                                </label>
                            </div>

                        </div> 
                        
                        <div class="caixa24">
                            <div class="lado-esquerdo">
                                 <input type="checkbox" name="exercicios[]" value = "Rosca direta com barra W">
                                 <b>Rosca direta com barra W</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Rosca direta com barra W]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Rosca direta com barra W]" >
                                </label>
                            </div>

                        </div> 
                       
                        <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Rosca alternada com halteres">
                                <b>Rosca alternada com halteres</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Rosca alternada com halteres]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Rosca alternada com halteres]" >
                                </label>
                            </div>

                        </div> 
                        
                        <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Rosca concentrada">
                                <b>Rosca concentrada</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Rosca concentrada]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Rosca concentrada]" >
                                </label>
                            </div>

                        </div> 
                        
                        <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Rosca Scott (na máquina)">
                                <b>Rosca Scott (na máquina)</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Rosca Scott (na máquina)]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Rosca Scott (na máquina)]" >
                                </label>
                            </div>

                        </div> 
                        
                        <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Rosca martelo">
                                <b>Rosca martelo</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Rosca martelo]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Rosca martelo]" >
                                </label>
                            </div>

                        </div> 
                        
                        <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Rosca martelo alternada">
                                <b>Rosca martelo alternada</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Rosca martelo alternada]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Rosca martelo alternada]" >
                                </label>
                            </div>

                        </div> 
                        
                        <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Rosca 21">
                                <b>Rosca 21</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Rosca 21]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Rosca 21]" >
                                </label>
                            </div>

                        </div> 
                        
                        <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Rosca no cabo (polia baixa)">
                                <b>Rosca no cabo (polia baixa)</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Rosca no cabo (polia baixa)]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Rosca no cabo (polia baixa)]" >
                                </label>
                            </div>

                        </div>

                        <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Rosca inversa">
                                <b>Rosca inversa</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Rosca inversa]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Rosca inversa]" >
                                </label>
                            </div>

                        </div>

                        <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Rosca unilateral no cabo">
                                <b>Rosca unilateral no cabo</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Rosca unilateral no cabo]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Rosca unilateral no cabo]" >
                                </label>
                            </div>

                        </div>

                        <div class="caixa24">
                            <div class="lado-esquerdo">
                               <input type="checkbox" name="exercicios[]" value = "Rosca inclinada com halteres">
                               <b>Rosca inclinada com halteres</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Rosca inclinada com halteres]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Rosca inclinada com halteres]" >
                                </label>
                            </div>

                        </div>
                        
                        <div class="caixa24">
                            <div class="lado-esquerdo">
                              <input type="checkbox" name="exercicios[]" value = "Rosca spider">
                              <b>Rosca spider</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Rosca spider]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Rosca spider]" >
                                </label>
                            </div>

                        </div>

                        <div class="caixa24">
                            <div class="lado-esquerdo">
                              <input type="checkbox" name="exercicios[]" value = "Rosca Zottman">
                              <b>Rosca Zottman</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Rosca Zottman]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Rosca Zottman]" >
                                </label>
                            </div>

                        </div>
                        
                        
                    

                    
                        <label class = "label1"><b>Tríceps</b></label><br>
                        <br>

                        <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Tríceps testa (barra ou halter)">
                                <b>Tríceps testa (barra ou halter)</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="Tríceps testa (barra ou halter)" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="Tríceps testa (barra ou halter)" >
                                </label>
                            </div>

                        </div> 
                        
                       <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Tríceps corda na polia">
                                <b>Tríceps corda na polia</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Tríceps corda na polia]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Tríceps corda na polia]" >
                                </label>
                            </div>

                        </div> 
                        
                       <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Tríceps na barra reta (pulley)">
                                <b>Tríceps na barra reta (pulley)</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Tríceps na barra reta (pulley)]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Tríceps na barra reta (pulley)]" >
                                </label>
                            </div>

                        </div> 
                        
                       <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Mergulho em banco">
                                <b>Mergulho em banco</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Mergulho em banco]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Mergulho em banco]" >
                                </label>
                            </div>

                        </div> 
                        
                       <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Paralelas">
                                <b>Paralelas</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Paralelas]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Paralelas]" >
                                </label>
                            </div>

                        </div> 
                        
                       <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Tríceps francês ">
                                <b>Tríceps francês </b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Tríceps francês ]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Tríceps francês ]" >
                                </label>
                            </div>

                        </div> 
                        
                       <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Tríceps coice (kickback)">
                                <b>Tríceps coice (kickback)</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Tríceps coice (kickback)]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Tríceps coice (kickback)]" >
                                </label>
                            </div>

                        </div> 
                        
                       <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Supino fechado">
                                <b>Supino fechado</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Supino fechado]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Supino fechado]" >
                                </label>
                            </div>

                        </div> 
                        
                       <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Tríceps unilateral na polia">
                                <b>Tríceps unilateral na polia</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Tríceps unilateral na polia]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Tríceps unilateral na polia]" >
                                </label>
                            </div>

                        </div> 
                        
                       <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Tríceps máquina">
                                <b>Tríceps máquina</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Tríceps máquina]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Tríceps máquina]" >
                                </label>
                            </div>

                        </div> 
                        
                       <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Extensão de tríceps">
                                <b>Extensão de tríceps</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Extensão de tríceps]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Extensão de tríceps]" >
                                </label>
                            </div>

                        </div> 
                        
                       <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Tríceps no cross (duas polias)">
                                <b>Tríceps no cross (duas polias)</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Tríceps no cross (duas polias)]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Tríceps no cross (duas polias)]" >
                                </label>
                            </div>

                        </div> 
                        
                   

                    
                        <label class = "label1"><b>Antebraço</b></label><br>
                        <br>

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Rosca de punho (wrist curl)">
                                <b>Rosca de punho (wrist curl)</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Rosca de punho (wrist curl)]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Rosca de punho (wrist curl)]" >
                                </label>
                            </div>

                        </div>
                    
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Rosca de punho invertida">
                                <b>Rosca de punho invertida</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Rosca de punho invertida]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Rosca de punho invertida]" >
                                </label>
                            </div>

                        </div>
                        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Rosca inversa com barra">
                                <b>Rosca inversa com barra</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Rosca inversa com barra]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Rosca inversa com barra]" >
                                </label>
                            </div>

                        </div>
                        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Rosca martelo ">
                                <b>Rosca martelo </b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Rosca martelo]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Rosca martelo]" >
                                </label>
                            </div>

                        </div>
                        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Farmer’s walk ">
                                <b>Farmer’s walk </b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Farmer’s walk]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Farmer’s walk]" >
                                </label>
                            </div>

                        </div>
                        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Segurar barra (dead hang)">
                                <b>Segurar barra (dead hang)</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Segurar barra (dead hang)]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Segurar barra (dead hang)]" >
                                </label>
                            </div>

                        </div>
                        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Flexão de punho com halter">
                                <b>Flexão de punho com halter </b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Flexão de punho com halter]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Flexão de punho com halter]" >
                                </label>
                            </div>

                        </div>
                        
                        <div class="caixa24">
                    
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Extensão de punho com halter">
                                <b>Extensão de punho com halter</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Extensão de punho com halter]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Extensão de punho com halter]" >
                                </label>
                            </div>

                        </div>
                        

                        <div class="caixa24">
                    
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Pegada com hand grip">
                                <b>Pegada com hand grip</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Pegada com hand grip]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Pegada com hand grip]" >
                                </label>
                            </div>

                        </div>
                        
                        <div class="caixa24">
                    
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Rosca punho no cabo">
                                <b>Rosca punho no cabo</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Rosca punho no cabo]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Rosca punho no cabo]" >
                                </label>
                            </div>

                        </div>
                        
                        <div class="caixa24">
                    
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Pronação e supinação com halter">
                                <b>Pronação e supinação com halter</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Pronação e supinação com halter]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Pronação e supinação com halter]" >
                                </label>
                            </div>

                        </div>
                        
                        <div class="caixa24">
                    
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Rolamento de punho ">
                                <b>Rolamento de punho </b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Rolamento de punho]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Rolamento de punho]" >
                                </label>
                            </div>

                        </div>
                        
                    
                    
                        <label class = "label1"><b>Ombro</b></label><br>
                        <br>

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Desenvolvimento com halteres">
                                <b>Desenvolvimento com halteres</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Desenvolvimento com halteres]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Desenvolvimento com halteres]" >
                                </label>
                            </div>

                        </div>
                    
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Desenvolvimento com barra">
                                <b>Desenvolvimento com barra</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Desenvolvimento com barra]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Desenvolvimento com barra]" >
                                </label>
                            </div>

                        </div>

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Elevação lateral">
                                <b>Elevação lateral</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Elevação lateral]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Elevação lateral]" >
                                </label>
                            </div>

                        </div>
                        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Elevação frontal">
                                <b>Elevação frontal</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Elevação frontal]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Elevação frontal]" >
                                </label>
                            </div>

                        </div>
                        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Elevação lateral no cabo">
                                <b>Elevação lateral no cabo</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Elevação lateral no cabo]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Elevação lateral no cabo]" >
                                </label>
                            </div>

                        </div>
                        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Elevação frontal com anilha">
                                <b>Elevação frontal com anilha</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Elevação frontal com anilha]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Elevação frontal com anilha]" >
                                </label>
                            </div>

                        </div>
                        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Crucifixo inverso (posterior)">
                                <b>Crucifixo inverso (posterior)</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Crucifixo inverso (posterior)]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Crucifixo inverso (posterior)]" >
                                </label>
                            </div>

                        </div>

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                               <input type="checkbox" name="exercicios[]" value = "Peck deck inverso">
                               <b>Peck deck inverso</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Peck deck inverso]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Peck deck inverso]" >
                                </label>
                            </div>

                        </div>
                        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                               <input type="checkbox" name="exercicios[]" value = "Remada alta">
                               <b>Remada alta</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Remada alta]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Remada alta]" >
                                </label>
                            </div>

                        </div>

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                               <input type="checkbox" name="exercicios[]" value = "Arnold press">
                               <b>Arnold press</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Arnold press]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Arnold press]" >
                                </label>
                            </div>

                        </div>

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                               <input type="checkbox" name="exercicios[]" value = "Face pull">
                               <b>Face pull</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Face pull]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Face pull]" >
                                </label>
                            </div>

                        </div>
                        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                               <input type="checkbox" name="exercicios[]" value = "Desenvolvimento na máquina">
                               <b>Desenvolvimento na máquina</b><br>
                            </div>

                            <div class="lado-direito">
                                <label><b>Série</b>
                                    <input class= "serie" type="number"name="serie[Desenvolvimento na máquina]" >
                                </label>

                                <label><b>Rep</b>
                                    <input class= "serie" type="number"name="rep[Desenvolvimento na máquina]" >
                                </label>
                            </div>

                        </div>
                        
                    

                    
                        <label class = "label1"><b>Cardio</b></label><br>
                        <br>

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Corrida na esteira"  >
                                <b>Corrida na esteira</b><br>
                            </div>

                            <div class="lado-direito2">
                                <label><b>Tempo</b>
                                    <input class= "serie" type="time" name="serie[Corrida na esteira]" >
                                </label>

                            </div>

                        </div>

                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Caminhada rápida">
                                <b>Caminhada rápida</b><br>
                            </div>

                            <div class="lado-direito2">
                                <label><b>Tempo</b>
                                    <input class= "serie" type="time"name="serie[Caminhada rápida]" >
                                </label>

                            </div>

                        </div>
                        
                        <div class="caixa24">

                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Bicicleta ergométrica">
                                <b>Bicicleta ergométrica</b><br>
                            </div>

                            <div class="lado-direito2">
                                <label><b>Tempo</b>
                                    <input class= "serie" type="time"name="serie[Bicicleta ergométrica]" >
                                </label>

                            </div>

                        </div>
                        
                        <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Pular corda">
                                <b>Pular corda</b><br>
                            </div>

                            <div class="lado-direito2">
                                <label><b>Tempo</b>
                                    <input class= "serie" type="time"name="serie[Pular corda]" >
                                </label>

                            </div>

                        </div>
                        
                        <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "HIIT (treino intervalado)">
                                <b>HIIT (treino intervalado)</b><br>
                            </div>

                            <div class="lado-direito2">
                                <label><b>Tempo</b>
                                    <input class= "serie" type="time"name="serie[HIIT (treino intervalado)]" >
                                </label>

                            </div>

                        </div>
                        
                        <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Subir escada">
                                <b>Subir escada</b><br>
                            </div>

                            <div class="lado-direito2">
                                <label><b>Tempo</b>
                                    <input class= "serie" type="time"name="serie[Subir escada]" >
                                </label>

                            </div>

                        </div>
                        
                        <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Escada (step machine)">
                                <b>Escada (step machine)</b><br>
                            </div>

                            <div class="lado-direito2">
                                <label><b>Tempo</b>
                                    <input class= "serie" type="time"name="serie[Escada (step machine)]" >
                                </label>

                            </div>

                        </div>
                        
                        <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Natação">
                                <b>Natação</b><br>
                            </div>

                            <div class="lado-direito2">
                                <label><b>Tempo</b>
                                    <input class= "serie" type="time"name="serie[Natação]" >
                                </label>

                            </div>

                        </div>
                        
                        <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Corrida ao ar livre">
                                <b>Corrida ao ar livre</b><br>
                            </div>

                            <div class="lado-direito2">
                                <label><b>Tempo</b>
                                    <input class= "serie" type="time"name="serie[Corrida ao ar livre]" >
                                </label>

                            </div>

                        </div>
                        
                        <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Dança (zumba,)">
                                <b>Dança (zumba)</b><br>
                            </div>

                            <div class="lado-direito2">
                                <label><b>Tempo</b>
                                    <input class= "serie" type="time"name="serie[Dança (zumba)]" >
                                </label>

                            </div>

                        </div>
                        
                        <div class="caixa24">
                            <div class="lado-esquerdo">
                                <input type="checkbox" name="exercicios[]" value = "Circuito funcional">
                                <b>Circuito funcional</b><br>
                            </div>

                            <div class="lado-direito2">
                                <label><b>Tempo</b>
                                    <input class= "serie" type="time"name="serie[Circuito funcional]" >
                                </label>

                            </div>

                        </div>
                        
                    </div>

                    
                </div>



            </div>
    </form>

</body>
</html>