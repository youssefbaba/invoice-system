function total_montant() {
    var total_montant_debours = 0;
    $('.montant_debours_class').each(function () {
        var total_montantht_debours = $(this).val() - 0;
        total_montant_debours += total_montantht_debours;
    });
    $('#total_debours').val(total_montant_debours);
};
//Event Bubbling.
document.addEventListener('change', function (event) {
    if (event.target.classList.contains('montant_debours_class')) {
        total_montant();
    }
}, true);
total_montant();
$(function () {
    //start the debours control
    $(document).on('click','.delete_debours',function(){

            $(this).parent().parent().parent().remove();
            total_montant();
            var totalhtf1 = $('#totalht_final').val();
            var tvafinal1 = $('#tva_final').val();
            var deboursf1 = $('#total_debours').val();
            var collect = Number(totalhtf1) + Number(tvafinal1) + Number(deboursf1);
            $('#total_total').val(collect.toFixed(2));
    });
    $('#ajout_debours').on('click',function(){
        var debo = '<div id="contain_debours2" class="contain_debours_count">'+
                    '<div class="row">'+
                       '<div class="col-md-5">'+
                            '<div class="form-group">'+
                                '<input type="text" name="references[]" placeholder="References de la facture" '+
                                   ' class="form-control" > ' +
                           ' </div>'+
                        '</div>'+
                        '<div class="col-md-5">'+
                            '<div class="form-group">'+
                                '<input type="number" name="montant_ht[]" placeholder="Montant HT" id="montant_debours"'+
                                    'class="form-control montant_debours_class" >'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-2 form-group">'+
                            '<button type="button" class="btn btn-danger btn-sm delete_debours form-control" '+
                               ' onclick="delete_row(this)" id="delete_debo"><i class="far fa-trash-alt"></i></button>'+
                        '</div>'+
                    '</div>'+
                    '<div class="row">'+
                        '<div class="col-md-12">'+
                            '<div class="form-group">'+
                                '<textarea type="text" name="descriptiond[]" id="descriptiond" '+
                                    'class="form-control description_debours" '+
                                    'placeholder="Description"></textarea>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>';
            $('#contain_debours').append(debo);

    });



    //end debours control
    /*start devis controle*/
    $('.spn_devis').html($('#devis').val());
    $('#devis').on('change',function(){
        $('.spn_devis').html($(this).val());
    });
    //end devis controle
    $('.clé').select2({
        tags: true
    });
    //duplicate article button
    $(".duplicate").on('click', function () {
        var ele = $(this).closest('.containe_article').clone(true);
        $(this).closest('.containe_article').after(ele);
        $('.deleteclass').prop('disabled', false);
        total_ht();
        var totalhtf1 = $('#totalht_final').val();
        var tvafinal1 = $('#tva_final').val();
        var deboursf1 = $('#total_debours').val();
        var collect = Number(totalhtf1) + Number(tvafinal1) + Number(deboursf1);
        $('#total_total').val(collect.toFixed(2));
    });

    //remove article button
    $(".deleteclass").on('click', function () {
        var last = $('.containe_article').length;
        if (last == 1) {
            $(this).prop('disabled', true);
        } else {
            $(this).parent().parent().parent().remove();

        }
        total_ht();
        var totalhtf1 = $('#totalht_final').val();
        var tvafinal1 = $('#tva_final').val();
        var deboursf1 = $('#total_debours').val();
        var collect = Number(totalhtf1) + Number(tvafinal1) + Number(deboursf1);
        $('#total_total').val(collect.toFixed(2));
    });

    $('.containe_article').delegate('.quantité,.prixht,.reduction', 'change', function () {
        var tr = $(this).parent().parent().parent().parent();
        var quan = tr.find('.quantité').val();
        var pht = tr.find('.prixht').val();
        var tv = tr.find('.tva').val();
        var redu = tr.find('.reduction').val();
        var ress = (quan * pht);
        tr.find('.totalht').val((ress - (ress * redu / 100)).toFixed(2)).val();
        var tttc = ress * (1 + tv / 100);
        tr.find('.totalttc').val((tttc - (tttc * redu / 100)).toFixed(1));
        total_ht();
    });

    function total_ht() {
        var remise = $('#remise').val();
        var total = 0;
        $('.totalht').each(function () {
            var total_ht = $(this).val() - 0;
            total += total_ht;
        });

        $('#total_ht').val(total.toFixed(2));
        var remiseafter = total * (remise / 100);
        $('#remise_general').val(remiseafter.toFixed(2));
        var totalht_final = total - remiseafter;
        $('#totalht_final').val(totalht_final.toFixed(2));
        var tvatota = 0;
        $('.tva').each(function () {
            var total_tva = $(this).val() - 0;
            tvatota = total_tva;
        });
        var tvafinal = totalht_final * (tvatota / 100);
        $('#tva_final').val(tvafinal.toFixed(2));
    }
    $('.containe_article').delegate('.tva', 'change', function () {
        var tr = $(this).parent().parent().parent().parent();
        var tht = tr.find('.totalht').val();
        var tv = tr.find('.tva').val();
        tr.find('.totalttc').val((tht * (1 + tv / 100)).toFixed(1));
        total_ht();
    });
    $('#remise').on('change', function () {
        total_ht();
    });
    $('.containe_article').delegate('.totalttc', 'change', function () {
        var tr = $(this).parent().parent().parent().parent();
        var tttc = tr.find('.totalttc').val();
        var tv = tr.find('.tva').val();
        var quan = tr.find('.quantité').val();

        var res = tr.find('.totalht').val((tttc / (1 + tv / 100)).toFixed(2));
        tr.find('.prixht').val(((tttc / (1 + tv / 100)) / quan).toFixed(3));
        total_ht();
    });

    $('.containe_article, .contain_debours, .contain_total').delegate(
        '.quantité,.prixht,.reduction,.tva,.totalttc,.remise_class,.montant_debours_class', 'change',
        function () {

            var totalhtf1 = $('#totalht_final').val();
            var tvafinal1 = $('#tva_final').val();
            var deboursf1 = $('#total_debours').val();
            var collect = Number(totalhtf1) + Number(tvafinal1) + Number(deboursf1);

            $('#total_total').val(collect);
        });
});
