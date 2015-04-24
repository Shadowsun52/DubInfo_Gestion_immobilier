/**
 * Fonction qui ajout un écouteur d'événement pour une liste d'item pour 
 * récupérer ses visites
 * @param {string} field_name Le nom du champs auquel lié le Listener
 */
function choosenVisiteItemListener(field_name) {
    $('#' + field_name).bind('change', function(e) {
        id_invest = $('#' + field_name).val();
        
        if(id_invest === '') {
            disabledSelectVisite();
        }
        else {
            activeSelectVisite(field_name);
        }
    });
}
/**
 * Fonction qui active le select des visites
 * @param {string} field_name Le nom du champs auquel lié le Listener
 */
function activeSelectVisite(field_name) {
    url_param = getParamsUrl();
    $('#select_id').removeAttr("disabled");
    $('#select_id').removeClass("disabled");
    $('#label_id').removeClass("disabled");
    refreshList(url_param['item'], field_name);
}

/**
 * Fonction qui désactive le select des visites
 */
function disabledSelectVisite() {
    $("#select_id").val('');
    $("#select_id").change();
    $('#select_id').attr("disabled","disabled");
    $('#select_id').addClass("disabled");
    $('#label_id').addClass("disabled");
}