<?php
// $questions_answers
?>
<h1>Resultados Finales</h1>

<section class="question-resume">
<ul>
    <li><span>Total respuestas test:</span><strong id="total-qty">0</strong></li>
    <li><span>Preguntas contestadas:</span><strong id="total-answered">0</strong></li>
    <li><span>Preguntas sin contestar:</span><strong id="total-not-answered">0</strong></li>
    <li><span>Número de aciertos:</span><strong id="total-correct">0</strong></li>
    <li><span>Número de fallos:</span><strong id="total-incorrect">0</strong></li>
    <li><span>Nota final:</span><strong id="final-result">0</strong></li>
</ul>
</section>

<h2>Respuestas</h2>

<section class="questions-container" data-page="<?= $page ?>">
    <ul class="questions">
    <?php foreach ($questions_answers as $question): ?>
        <li class="question" id="<?= $question['id'] ?>">
            <div class="question-text">
                <?= $question['questiontext'] ?>
            </div>
            <div class="answers-container">
                <ul class="answers">
                <?php foreach ($question['answers'] as $answer): ?>
                    <li>
                        <input type="radio" id="<?= $answer['id'] ?>" name="<?= $question['id'] ?>[]" disabled data-fraction="<?= $answer['fraction'] ?>">
                        <label for="<?= $answer['id'] ?>"><?= $answer['answer'] ?></label>
                    </li>
                <?php endforeach; ?>
                </ul>
            </div>
        </li>
    <?php endforeach; ?>
    </ul>

</section>
