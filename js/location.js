/**
 * Ajout d'un écouteur d'événement pour la liste de maison afin de génerer 
 * la liste des chambres
 */
$('#select_maison').bind('change', function(e) {
    id_maison = $('#select_maison').val();

    if(id_maison === '') {
        disabledSelectChambres();
    }
    else {
        loadChambresForHouse(id_maison);
        activeSelectChambres();
    }
});

/**
 * Fonction qui active le select des chambres
 */
function activeSelectChambres() {
    $('#select_chambres').removeAttr("disabled");
    $('#select_chambres').removeClass("disabled");
    $('#label_chambres').removeClass("disabled");
}

/**
 * Fonction qui charge la liste des chambres d'une maison
 * @param {int} id_maison L'identifiant de la maison
 */
function loadChambresForHouse(id_maison) {
    $.ajax({
        'url': 'controller/gestion_ajax.php',
        'type': 'post',
        'async': false,
        'data': 'action=readList&item=chambre&id=' + id_maison,
        'dataType': 'json',
        success: function(retour_php)
        {
            if(retour_php.erreur === undefined) {
                $("#select_chambres").empty();
                $("#select_chambres").append($('<option/>').val('')
                            .html('- Choisissez une chambre -'));
                $.each(retour_php, function(idx, cont)
                {
                    $("#select_chambres").append($('<option/>').val(cont.id)
                            .html(cont.toString));    
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
 * Fonction qui désactive le select des chambres
 */
function disabledSelectChambres() {
    $("#select_chambres").val('');
    $('#select_chambres').attr("disabled","disabled");
    $('#select_chambres').addClass("disabled");
    $('#label_chambres').addClass("disabled");
}

/**
 * Ajout d'un écouteur d'événement pour la liste des chambres afin de récuperer 
 * le prix et les charges
 */
$('#select_chambres').bind('change', function(e) {
    id_chambre = $('#select_chambres').val();

    if(id_chambre !== '') {
        $.ajax({
        'url': 'controller/gestion_ajax.php',
        'type': 'post',
        'data': 'action=read&item=chambre&id=' + id_chambre,
        'dataType': 'json',
        success: function(retour_php)
        {
            if(retour_php.erreur === undefined) {
                $('#loyer').val(retour_php.prix);
                $('#charges').val(retour_php.charges);
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
});
