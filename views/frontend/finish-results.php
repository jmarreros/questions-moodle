<?php
// $questions_answers
?>
<h2>Resultados Finales</h2>

<section class="question-resume">
<ul>
    <li><span>Total respuestas test:</span><strong id="total-qty">0</strong></li>
    <li><span>Preguntas contestadas:</span><strong id="total-answered">0</strong></li>
    <li><span>Preguntas sin contestar:</span><strong id="total-not-answered">0</strong></li>
    <li><span>Número de aciertos:</span><strong id="total-correct">0</strong></li>
    <li><span>Número de fallos:</span><strong id="total-wrong">0</strong></li>
    <li><span>Nota final:</span><strong id="final-result">0</strong></li>
</ul>
</section>


<section class="options-link">
    <a href="<?= get_permalink() ?>">Realizar otra vez el cuestionario</a>
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

                        <?php if ( (float)$answer['fraction'] > 0 ): ?>
                            <img src="<?= DCMS_QUESTIONS_URL."/assets/frontend/img/checked.svg" ?>" width="25" height="25" alt="Respuesta correcta" class="img-correct">
                        <?php else: ?>
                            <img src="<?= DCMS_QUESTIONS_URL."/assets/frontend/img/unchecked.svg" ?>" width="25" height="25" alt="Respuesta incorrecta" class="img-wrong">
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
                </ul>
            </div>
        </li>
    <?php endforeach; ?>
    </ul>

</section>
