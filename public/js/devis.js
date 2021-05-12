$(function(){
    /*start devis controle*/
        $('.spn_devis').html($('#devis').val());
        $('#devis').on('change',function(){
            $('.spn_devis').html($(this).val());
        });
    //end devis controle
    //duplicate article button
    $(".duplicate").on('click', function(){
      var ele = $(this).closest('.containe_article').clone(true);
      $(this).closest('.containe_article').after(ele);
      $('.deleteclass').prop('disabled', false);
      total_ht();
      var totalhtf1 = $('#totalht_final').val();
      var tvafinal1 = $('#tva_final').val();
      var collect = Number(totalhtf1) + Number(tvafinal1);
      $('#total_totald').val(collect.toFixed(2));
    });

    //remove article button
    $(".deleteclass").on('click', function(){
        var last = $('.containe_article').length;
        if(last == 1)
        {
            $(this).prop('disabled', true);
        }
        else
        {
            $(this).parent().parent().parent().remove();
        }
            total_ht();
            var totalhtf1 = $('#totalht_final').val();
            var tvafinal1 = $('#tva_final').val();
            var collect = Number(totalhtf1) + Number(tvafinal1);

            $('#total_totald').val(collect.toFixed(2));
    });

    $('.duplicate_debours').click(function(){
        var debours = $('#contain_debours2').clone();
        $('#delete_debo').attr('disabled',false);
        debours.find('.delete_debours').attr('disabled',false);
        $('.contain_debours').append(debours);
    });


    $('.containe_article').delegate('.quantité,.prixht,.reduction','change',function(){
        var tr= $(this).parent().parent().parent().parent();
        var quan = tr.find('.quantité').val();
        var pht = tr.find('.prixht').val();
        var tv = tr.find('.tva').val();
        var redu = tr.find('.reduction').val();
        var ress = (quan * pht);
        tr.find('.totalht').val((ress - (ress * redu /100)).toFixed(2)).val();
        var tttc = ress * (1 + tv/100);
        tr.find('.totalttc').val((tttc - (tttc * redu /100)).toFixed(1));
        total_ht();

    });
    function total_ht(){
        var remise = $('#remise').val();
        var total = 0;
        $('.totalht').each(function(){
            var total_ht =$(this).val()-0;
            total += total_ht;
        });

        $('#total_ht').val(total.toFixed(2));
        var remiseafter = total*(remise/100);
        $('#remise_general').val(remiseafter.toFixed(2));
        var totalht_final = total - remiseafter;
        $('#totalht_final').val(totalht_final.toFixed(2));


        var tvatota = 0;
        $('.tva').each(function(){
            var total_tva = $(this).val()-0;
            tvatota = total_tva;

        });
        var tvafinal = totalht_final * (tvatota /100);
        $('#tva_final').val(tvafinal.toFixed(2));



    }
    $('.containe_article').delegate('.tva','change',function(){
        var tr= $(this).parent().parent().parent().parent();
        var tht = tr.find('.totalht').val();
        var tv = tr.find('.tva').val();
        tr.find('.totalttc').val((tht * (1 + tv/100)).toFixed(1));
        total_ht();
    });
    $('#remise').on('change',function(){
        total_ht();
    });
    $('.containe_article').delegate('.totalttc','change',function(){
        var tr= $(this).parent().parent().parent().parent();
        var tttc = tr.find('.totalttc').val();
        var tv = tr.find('.tva').val();
        var quan = tr.find('.quantité').val();

        var res = tr.find('.totalht').val((tttc / (1+tv/100)).toFixed(2));
        tr.find('.prixht').val(((tttc / (1+tv/100))/quan).toFixed(2));
        total_ht();
    });

    $('.containe_article, .contain_total').delegate('.quantité,.prixht,.reduction,.tva,.totalttc,.remise_class,.montant_debours_class','change',function(){

        var totalhtf1 = $('#totalht_final').val();
        var tvafinal1 = $('#tva_final').val();
        var collect = Number(totalhtf1) + Number(tvafinal1);

        $('#total_totald').val(collect.toFixed(2));
    });
});
