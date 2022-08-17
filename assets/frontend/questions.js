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
    });



})( jQuery );
