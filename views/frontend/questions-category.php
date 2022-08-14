<?php error_log(print_r($questions, true)); ?>

<?php error_log(print_r(get_permalink(), true)); ?>

<section class="questions-container" data-page="<?= $page ?>">
<ul class="questions">
<?php foreach ($questions as $question): ?>
    <li class="question" id="<?= $question['id'] ?>">
        <div class="question-text">
            <?= $question['questiontext'] ?>
        </div>
        <div class="answers-container">
            <ul class="answers">
            <?php foreach ($question['answers'] as $answer): ?>
                <li>
                    <input type="radio" name="answer-<?= $question['id'] ?>[]" id="<?= $answer['id'] ?>">
                    <label for="<?= $answer['id'] ?>"><?= $answer['answer'] ?></label>
                </li>
            <?php endforeach; ?>
            </ul>
        </div>
    </li>
<?php endforeach; ?>
</ul>

<footer class="pagination-link">
    <a href="<?= get_permalink().'?qpage='. ($page + 1) ?>">Siguiente</a>
</footer>

</section>
