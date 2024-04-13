<?php

$dados = $_SESSION['dados'];

$questaoAtual = intval($_SESSION['jogo']['questaoAtual']);

if (isset($_GET['answer'])) {

    $alternativaEscolhidaUsuario = $_GET['answer'];
    if ($dados[$questaoAtual]['alternativas'][$alternativaEscolhidaUsuario] === $dados[$questaoAtual]['respostaCorreta']) {
        $_SESSION['jogo']['corretas'] += 1;
    } else {
        $_SESSION['jogo']['erradas'] += 1;
    }

    $_SESSION['jogo']['questaoAtual'] += 1;

    if (intval($_SESSION['jogo']['questaoAtual']) === intval($_SESSION['jogo']['totalQuestoes'])) {
        header('Location: index.php?route=gameover');
        exit();
    } else {
        header('Location: index.php?route=game');
        exit();
    }
}

$paisAtual = $dados[$questaoAtual]['questao'];
$alternativas = $dados[$questaoAtual]['alternativas'];

?>

<div class="container mt-5 text-center col-md-6">
    <div class="card p-5">
        <h2>Capitais Game</h2>
        <hr>

        <div class="d-flex justify-content-between">
            <span>Questão n° <span class="text-primary"> <?= $questaoAtual + 1 . "/" . $_SESSION['jogo']['totalQuestoes'] ?> </span> </span>
            <span>Corretas: <span class="text-succes"> <?= $_SESSION['jogo']['corretas'] ?> </span> | Erradas: <span class="text-danger"> <?= $_SESSION['jogo']['erradas'] ?> </span> </span>
        </div>
        <hr>

        <div>
            <span>
                <p>Qual a capital do seguinte país: <span class="text-primary"> <?= $paisAtual ?> </span></p>
            </span>
        </div>

        <div>
            <h4 role='button' class="p-2 text-black border border-1 cursor-pointer" id="resposta-0"> <?= $capitais[$alternativas[0]][1] ?> </h4>
            <h4 role='button' class="p-2 text-black border border-1 cursor-pointer" id="resposta-1"> <?= $capitais[$alternativas[1]][1] ?> </h4>
            <h4 role='button' class="p-2 text-black border border-1 cursor-pointer" id="resposta-2"> <?= $capitais[$alternativas[2]][1] ?> </h4>
            <h4 role='button' class="p-2 text-black border border-1 cursor-pointer" id="resposta-3"> <?= $capitais[$alternativas[3]][1] ?> </h4>
        </div>
    </div>
</div>

<script>
    let alternativas = document.querySelectorAll("[id^='resposta']").forEach(element => {

        element.addEventListener('click', (e) => {
            let id = element.id.split('-')[1];

            window.location.href = `index.php?route=game&answer=${id}`;
        })
    });
</script>