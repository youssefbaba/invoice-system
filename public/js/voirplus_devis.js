$(document).ready(function(){
    $(document).on('click', function(e) {
        if (e.target.id == 'absolute_voirplus') {
            alert('Div Clicked !!');
        } else {
            $('#absolute_voirplus').hide();
        }
    });
$('.options_voirplus').on('click',function(){
    var test = $(this).parent().parent().parent().children("#absolute_voirplus");
    test.toggleClass('show1');
});
});
