$(function() {
   var offres = $('.block-main .step .liste-pack').children();
   console.log('eee');
    offres.each(function() {
        $(this).click(function(e) {
            e.preventDefault();
            $(this).each(function() {

                if ($(this).siblings().hasClass('select')){
                    $(this).siblings().toggleClass('select');
                    $(this).toggleClass('select');

                }else{
                    $(this).toggleClass('select');

                }

                if ($(this).hasClass('generique')){
                    $('.block-main').find('#generique').toggleClass('hide');
                    $('.block-main').find('#specifique').toggleClass('hide');
                }else{
                    $('.block-main').find('#generique').toggleClass('hide');
                    $('.block-main').find('#specifique').toggleClass('hide');
                }

            })
        });
    });
    var valPrice = $("#price").val();
    var valCheque = $("#nb_cheque").val();
    var total = valPrice * valCheque;

        $("#price").after('<output id="output1"></output>');
        $("#price").change( function(){
             valPrice = $(this).val();
             total = valPrice * valCheque;

            $('#output1').text(valPrice);
            $('.next .price').text("Prix total : " + total);
        });



    $("#nb_cheque").after('<output  id="output2"></output>');
    $("#nb_cheque").change( function(){
         valCheque = $(this).val();
        total = valPrice * valCheque;

        $('#output2').text(valCheque);
        $('.next .price').text("Prix total : " + total);

    });
});
