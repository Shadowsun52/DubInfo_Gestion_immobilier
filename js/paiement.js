$('#select_locataire').addClass('select_sub_item_2');
/**
 * Ajout d'un écouteur d'événement pour la liste de maison afin de génerer 
 * la liste des chambres
 */
$('#select_locataire').bind('change', function(e) {
    id_locataire = $('#select_locataire').val();

    if(id_locataire === '') {
        disabledSelectLocation();
    }
    else {
        loadLocationForLocataire(id_locataire);
        activeSelectLocation();
    }
});

/**
 * Fonction qui charge la liste des locations d'un locataire
 * @param {int} id_locataire L'identifiant du locataire
 */
function loadLocationForLocataire(id_locataire) {
    $.ajax({
        'url': 'controller/gestion_ajax.php',
        'type': 'post',
        'async': false,
        'data': 'action=readList&item=location&id=' + id_locataire,
        'dataType': 'json',
        success: function(retour_php)
        {
            if(retour_php.erreur === undefined) {
                $("#select_location").empty();
                $("#select_location").append($('<option/>').val('')
                            .html('- Choisissez une location -'));
                $.each(retour_php, function(idx, cont)
                {
                    $("#select_location").append($('<option/>').val(cont.id)
                            .html(cont.chambre.maison.titre + ' (' 
                            + cont.chambre.maison.commune.libelle + ') ' 
                            + cont.toString));    
                });
            }
            else {
                alert(retour_php.erreur);
            }
        },
        error: function(retour_php)
        {
            alert("Erreur avec la communication serveur.");
        }
    });
}

/**
 * Fonction qui active le select des locations
 */
function activeSelectLocation() {
    $('#select_location').removeAttr("disabled");
    $('#select_location').removeClass("disabled");
    $('#label_location').removeClass("disabled");
}

/**
 * Fonction qui désactive le select des locations
 */
function disabledSelectLocation() {
    $("#select_location").val('');
    $("#select_location").change();
    $('#select_location').attr("disabled","disabled");
    $('#select_location').addClass("disabled");
    $('#label_location').addClass("disabled");
}