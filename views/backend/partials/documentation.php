<h2>Shortcode</h2>

<p>
    Puedes usar el siguiente shortcode asociado al ID de la categoría:
    <br>
    <strong>[<?= DCMS_SHORTCODE_QUESTIONS_NAME  ?> category="xxx"]</strong>
</p>
<p>
    Puedes usar más de una categoría como parte del shortcode, separándola con una coma
    <br>
    <strong>[<?= DCMS_SHORTCODE_QUESTIONS_NAME ?> category="xxx, yyy"]</strong>    
</p>

<p>
    Puedes establecer la cantidad de preguntas por página que se mostrarán usando perpage,
    la cantidad por defecto es 10 si es que no usas este parámetro.
    <br>
    <strong>[<?= DCMS_SHORTCODE_QUESTIONS_NAME ?> category="xxx" perpage="15"]</strong>    
</p>



