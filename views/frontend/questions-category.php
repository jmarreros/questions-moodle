<?php
/* @var int $page */
/* @var array $questions */
/* @var bool $show_finish */
?>
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
                        <input type="radio" id="<?= $answer['id'] ?>" name="<?= $question['id'] ?>[]">
                        <label for="<?= $answer['id'] ?>"><?= $answer['answer'] ?></label>
                    </li>
                <?php endforeach; ?>
                </ul>
            </div>
        </li>
    <?php endforeach; ?>
    </ul>

    <footer class="pagination-link">
        <?php if ( $page > 0): ?>
            <a href="<?= get_permalink().'?qpage='. ($page - 1) ?>" class="prev-link qlink">Anterior</a>
        <?php endif; ?>

        <?php if ( ! $show_finish ): ?>
            <a href="<?= get_permalink().'?qpage='. ($page + 1) ?>" class="next-link qlink">Siguiente</a>
        <?php else: ?>
            <a href="<?= get_permalink().'?finish=1' ?>" class="finish-link qlink">Ver resultados</a>
        <?php endif; ?>    
    </footer>

</section>
