<h3>Questions category: <?= $category['name']?></h3>

<?php foreach ($questions as $question): ?>
<section class="question-container" data-id="<?= $question['id'] ?>">
    <div class="question-text">
        <?= $question['questiontext'] ?>
    </div>
    <ul class="question-answers">
        <?php foreach ($question['answers'] as $answer): ?>
            <?php $css = floatval($answer['fraction']) >= 1 ? 'correct' : ''; ?>
            <li class="<?= $css ?>"><?= $answer['answer'] ?></li>
        <?php endforeach; ?>
    </ul>
</section>
<?php endforeach;

