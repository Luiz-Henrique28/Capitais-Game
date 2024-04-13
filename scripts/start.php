<?php

    if(isset($_POST['qtdQuestoes'])){
        $quantidadeQuestoes = floatval($_POST['qtdQuestoes']);
        
        prepararJogo($quantidadeQuestoes);

        header('Location: index.php?route=game');
        exit;
    }
    
    function prepararJogo($quantidadeQuestoes){
        
        global $capitais;
        $ids = [];
        while(count($ids)<$quantidadeQuestoes){
            $id = rand(0, count($capitais) - 1);
            if (!in_array($id, $ids)) {
                array_push($ids, $id);
            }
        }

        foreach ($ids as $id) {
            $alternativas = [];
            $alternativas[] = $id;

            for ($i=0; $i < 3; $i++) { 
                $temp = rand(0, count($capitais)-1);
                if (!in_array($temp, $alternativas)) {
                    array_push($alternativas, $temp);
                }
            }

            shuffle($alternativas);

            $questoes[] = [
                'questao' => $capitais[$id][0],
                'alternativas' => $alternativas,
                'respostaCorreta' => $id
            ];
        }

        $_SESSION['dados'] = $questoes;
        $_SESSION['jogo'] = [
            'totalQuestoes' => $quantidadeQuestoes,
            'ultimaQuestaoRespondida' => -1,
            'questaoAtual' => 0,
            'corretas' => 0,
            'erradas' => 0
        ];
    }
?>

<div class="container mt-5 text-center col-md-5">
    <div class="card p-5">
        <h2>Capitais Game</h2>
        <hr>
        <div>
            <form action="index.php?route=start" method="post" class="justify-content-center">
                <div class="row justify-content-center">
                    <label for="qtdQuestoes">Número de questões:</label>
                    <input id="qtdQuestoes" type="number" value="10" class="text-center form-control w-25" name="qtdQuestoes">
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-success col-sm-5 col-lg-3">Iniciar</button>
                </div>
            </form>
        </div>
    </div>
</div>