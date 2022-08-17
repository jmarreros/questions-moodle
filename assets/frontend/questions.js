(function( $ ) {
	'use strict';

    const STORAGE = 'dcmsAnswers';

    $(".questions-container input[type=radio]").change( function(){
        const idQuestion = $(this).attr('name').replace(/\D/g, "");
        const idAnswer = $(this).attr('id');

        let data = JSON.parse(localStorage.getItem(STORAGE))??new Object;
        data[idQuestion] = idAnswer;
        localStorage.setItem(STORAGE, JSON.stringify(data));
    });

    $( document ).ready(function() {
        const data = JSON.parse(localStorage.getItem(STORAGE));

        if (data){
            for(const idQuestion in data){
                const idAnswer = data[idQuestion];
                $('#' + idAnswer).prop('checked', true);
            }
        }

        if (is_finish_page()) validate_results(data);
        
    });

    // Validate results with Ajax response
    function validate_results(data){
        const totalQuestions = $('.questions-container .questions > li').length;
        const totalAnswered = $('.questions-container .questions').find('.answers input[type=radio]:checked').length;
        const totalNotAnswered = totalQuestions - totalAnswered;
     
        $('#total-qty').text(totalQuestions);
        $('#total-answered').text(totalAnswered);
        $('#total-not-answered').text(totalNotAnswered);
    }

})( jQuery );

// To detect finish page with parameter
function is_finish_page(){
    const url = new URL(window.location.href);
    const params = new URLSearchParams(url.search);
    return params.get('finish');
}