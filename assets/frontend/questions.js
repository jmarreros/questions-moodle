(function( $ ) {
	'use strict';

    const STORAGE = 'dcmsAnswers';

    $(".questions-container input[type=radio]").change( function(){
        const idQuestion = $(this).attr('name').replace(/\D/g, "");
        const idAnswer = $(this).attr('id');
        
        let data = new Object;
        const storage = localStorage.getItem(STORAGE);
        if ( storage && storage !== '' ) data = JSON.parse(storage);
        
        data[idQuestion] = idAnswer;
        localStorage.setItem(STORAGE, JSON.stringify(data));
    });

    $( document ).ready(function() {
        const storage = localStorage.getItem(STORAGE)??'';

        if (  storage ) {
            const data = JSON.parse(storage);
            if (data){
                for(const idQuestion in data){
                    const idAnswer = data[idQuestion];
                    $('#' + idAnswer).prop('checked', true);
                }
            }    
        }

        if (is_finish_page()) show_results();
    });

    // Validate results with Ajax response
    function show_results(){
        const totalQuestions = $('.questions-container .questions > li').length;
        const totalAnswered = $('.questions-container .questions').find('.answers input[type=radio]:checked').length;
        const totalNotAnswered = totalQuestions - totalAnswered;
        let correct = 0;
        let wrong = 0;

        $.each($('input[type=radio]'), function(){

            if ( Number($(this).data('fraction')) >= 1 ) {
                $(this).parent().addClass('correct');
            } 

            if ( $(this).is(':checked') ){
                if ( Number($(this).data('fraction')) === 0 ) {
                    wrong++
                    $(this).parent().addClass('sel-wrong').parent().addClass('wrong');
                } else {
                    correct++;
                    $(this).parent().addClass('sel-correct').parent().addClass('correct');
                }
            }

        });

        // Print results
        $('#total-qty').text(totalQuestions);
        $('#total-answered').text(totalAnswered);
        $('#total-not-answered').text(totalNotAnswered);
        $('#total-correct').text(correct);
        $('#total-wrong').text(wrong);
        $('#final-result').text( Math.round( (correct*10*100/totalQuestions) ) / 100 );
    }


    $('.options-link a').click(function(e){
        e.preventDefault();
        localStorage.setItem(STORAGE, '');
        window.location.replace( $(this).attr('href'));
    });

})( jQuery );

// To detect finish page with parameter
function is_finish_page(){
    const url = new URL(window.location.href);
    const params = new URLSearchParams(url.search);
    return params.get('finish');
}