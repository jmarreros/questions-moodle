<h2>Shortcode</h2>

<ul class="question-docs">
<li>
    Puedes usar el siguiente shortcode asociado al ID de la categoría:
    <br>
    <strong>[<?= DCMS_SHORTCODE_QUESTIONS_NAME  ?> category="123"]</strong>
</li>

<li>
    Puedes usar más de una categoría como parte del shortcode, separándola con una coma
    <br>
    <strong>[<?= DCMS_SHORTCODE_QUESTIONS_NAME ?> category="123, 124"]</strong>
</li>

<li>
    Puedes establecer la cantidad de preguntas por página que se mostrarán usando perpage,
    la cantidad por defecto es 10 si es que no usas este parámetro.
    <br>
    <strong>[<?= DCMS_SHORTCODE_QUESTIONS_NAME ?> category="123" perpage="15"]</strong>
</li>


<li>
    Puedes establecer el límite de preguntas con el parámetro límit, si limit es cero
    o excede la cantidad de preguntas de las categorías, entonces se tomará el total de las preguntas de las categorías.
    <br>
    <strong>[<?= DCMS_SHORTCODE_QUESTIONS_NAME ?> category="123, 124" perpage="15" limit="50"]</strong>
</li>



<li>
    Puedes establecer si las respuestas se mostrarán de manera aleatoria con el parámetro rand_answers, puede ser establecido a "1" o "0"
    por defecto esta establecido a 1, es decir por defecto las respuestas se muestran de manera aleatoria.
    <br>
    <strong>[<?= DCMS_SHORTCODE_QUESTIONS_NAME ?> category="123, 124" perpage="15" limit="50" rand_answers="1"]</strong>
</li>

</ul>

