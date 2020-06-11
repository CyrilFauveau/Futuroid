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
});
