
function random_bg_color() {

    var cles = document.getElementsByClassName('mot_cles_link');
    for(var i = 0; i<cles.length ; i++)
    {
        var x = Math.floor(Math.random() * 256);
        var y = Math.floor(Math.random() * 256);
        var z = Math.floor(Math.random() * 256);

        var bgColor = "rgb(" + x + "," + y + "," + z + ")";
        cles[i].style.background = bgColor;
    }
}
random_bg_color();
$(document).ready(function(){
    $(document).click(function(){
        $('.absolute').removeClass('show1');
    });
    $('.options').on('click',function(event){
        if($('.absolute').hasClass("show1") )
        {
            $('.absolute').removeClass('show1');
            var test = $(this).parent().parent().parent().children(".absolute");
            test.toggleClass("show1").slideDown();
            event.stopPropagation();
        }
        else
        {
            var test = $(this).parent().parent().parent().children(".absolute");
            test.toggleClass("show1").slideDown();
            event.stopPropagation();
        }
    });
});
