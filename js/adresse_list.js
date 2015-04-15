//Fonction permettant d'ajout l'écouteurs d'événement pour la liste des pays
function addListCountryListener() {
    //écouteur d'événement sur la liste pays pour générer la liste des codes postaux
    $('#select_pays').bind('change', function(e) {
        if($("#select_pays").val() === 'Autre') {
            putFormOtherAddress();
        } 
        else {
            putFormListAddress();
            
            //on regarde si on a sélectionner un pays ou non
            if($("#select_pays").val() !== '') {
                pays_id = $("#select_pays option:selected").index();
                
                $.ajax({
                    type: 'post',
                    url: 'controller/gestion_ajax.php',
                    data: "action=read&item=CodesPostaux&pays_id=" + pays_id,
                    async: false,
                    dataType: 'json',
                    success: function(retour_php)
                    {
                        $.each(retour_php, function(idx, cont) //parcours du retour php qui est au format json
                        {
                            $("#select_cp").append($('<option/>').val(cont).html(cont));    
                        });
                    },
                    error: function(retour_php)
                    {
                        alert("Erreur avec la communication serveur.");
                    } 
                });
            }
        }
    });
}

//Fonction permettant d'ajout l'écouteurs d'événement pour la liste des codes postaux
function addListPostalCodeListener() { 
    $('#select_cp').bind('change', function(e) {
        //on vide la liste des villes 
        $("#select_villes").empty();
        //on ajout la valeur par défault
        $("#select_villes").append($("<option/>").val("").html("- choisissez une ville -"));
        
        //on regarde si on a sélectionner un code postal ou non
        if($("#select_cp").val() !== '')
            $.ajax({
                type: 'post',
                url: 'controller/gestion_ajax.php',
                data: "action=read&item=villes&cp_id=" + $("#select_cp").val(),
                async: false,
                dataType: 'json',
                success: function(retour_php)
                {
                    if(retour_php !== null) {
                        $.each(retour_php, function(idx, cont) //parcours du retour php qui est au format json
                        {
                            $("#select_villes").append($('<option/>').val(cont).html(cont));    
                        });
                    }
                },
                error: function(retour_php)
                {
                    alert("Erreur avec la communication serveur.");
                } 
            });
    });
}

/*
 * Cette fonction permet de modifier le formulaire pour le cas ou l'option
 * autre pays a été sélectionner
 */
function putFormOtherAddress() {
    $("#select_pays").parent().after('<div id="other_country" class="cell"/>');
    $("#select_pays").attr("name","_pays");
    $("#other_country").append('<label style="font-size:0;">autre pays</label>');
    $("#other_country").append(
            '<input id="pays" name="select_pays" type="text" class="control text"/>');
    $("#select_cp").replaceWith(
            '<input id="select_cp" name="select_cp" type="text" class="control text"/>');
    $("#select_villes").replaceWith(
            '<input id="select_villes" name="select_villes" type="text" class="control text"/>');
}

/**
 * Cette fonction permet de modifier le formulaire pour l'utilisation normale 
 * de l'adresse avec des listes
 */
function putFormListAddress() {
    //on remet le bonne id à la liste 
    $('#other_country').remove();
    $("#select_pays").attr("name","select_pays");
    
    //on transforme en liste
    $("#select_cp").replaceWith('<select id="select_cp" class="control" name="select_cp"/>');
    
    //On ajout la valeur par défault
    $("#select_cp").append($("<option/>").val("").html("- choisissez un code postal -"));
    
    //On ajout l'écouteur d'événement de la liste code postal
    addListPostalCodeListener();
    
    //Creation de l'élément liste pays
    $("#select_villes").replaceWith('<select id="select_villes" class="control" name="select_villes"/>');
    $("#select_villes").append($("<option/>").val("").html("- choisissez une ville -"));
}