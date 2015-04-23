function listenerContact(pos) {
    var MAX_CONTACT = 4
    $('#select_contact' + pos).bind('change', function(e) {
        if($("#select_contact" + pos).val() !== '') {
            
            //on ajoute le formulaire pour le contact
            createFormAddContact(pos);
            //c'est c'est un contact existant on récupérer ses données dans la DB
            if($("#select_contact" + pos).val() !== '@Autre@') {
                ReadContact(pos);
            }
                
            new_pos = pos+1;
            /* on regarde si le choix du contacts suivant existe déjà et qu'on 
             * en dépasse pas le nombre maximun de contact
             */
            if(pos < MAX_CONTACT && !$("#select_contact" + new_pos).length) {
                //création du select suivant
                $("#select_contact" + pos).parent().parent()
                        .append('<div id="contact' + new_pos + '"/>');
                $("#select_contact" + pos).clone().attr("id","select_contact" + new_pos)
                        .attr('name','select_contact' + new_pos)
                        .appendTo($("#contact" + new_pos));
                //ajout du listener pour le nouveau select
                listenerContact(new_pos);
            }
        }
        else {
            //on regarde si ce n'est pas le dernier select
            if($("#contact" + (pos+1)).length) {
                $("#contact" + pos).remove();

                //on décale les autres select existant
                for(i = pos+1; $("#contact" + i).length !== 0; i++){
                    $("#contact" + i).attr("id","contact" + (i-1));
                    $("#select_contact" + i).off();
                    $("#select_contact" + i).attr("name","select_contact" + (i-1));
                    $("#select_contact" + i).attr("id","select_contact" + (i-1));
                    if($("#new_contact" + i).length) {
                        decalageFormAddContact(i);
                    }
                    //on rattache un bon listener
                    
                    listenerContact(i-1);
                }
            }
            else {
                $("#new_contact" + pos).remove();
            }
        }
    });
}

/*
 * Méthode qui créer le formulaire d'ajout d'un contact pour une maison
 */
function createFormAddContact(pos) {
    $("#new_contact" + pos).remove();
    //on créer le bloc principale contenant le formulaire d'ajout d'un contact
    $("#select_contact" + pos).after('<div id="new_contact' + pos + '" class="new_contact"/>');
    //On créer les différents bloque ( Utile pour la mise en forme)
    $("#new_contact" + pos).append('<div class="contact_nom"/>')
                           .append('<div class="contact_prenom"/>')
                           .append('<div class="contact_num_tel"/>')
                           .append('<div class="contact_num_gsm"/>')
                           .append('<div class="contact_mail"/>')
                           .append('<div class="contact_remarque"/>');
    //ajout des éléments du formulaire d'ajout d'un contact
    $("#new_contact" + pos + " .contact_nom").append('<label>Nom</label>')
            .append('<input name="contact_nom' + pos + '" type="text" class="text"/>');
    $("#new_contact" + pos + " .contact_prenom").append('<label>Prénom</label>')
            .append('<input name="contact_prenom' + pos + '" type="text" class="text"/>');
    $("#new_contact" + pos + " .contact_num_tel").append('<label>Numéro de téléphone</label>')
            .append('<input name="contact_num_tel' + pos + '" type="text" class="text"/>');
    $("#new_contact" + pos + " .contact_num_gsm").append('<label>Numéro de Gsm</label>')
            .append('<input name="contact_num_gsm' + pos + '" type="text" class="text"/>');
    $("#new_contact" + pos + " .contact_mail").append('<label>Adresse email</label>')
            .append('<input name="contact_mail' + pos + '" type="text" class="text"/>');
    $("#new_contact" + pos + " .contact_remarque").append('<label>Remarque</label>')
            .append('<textarea name="contact_remarque' + pos + '" maxlength="500" cols="80" rows="3"/>');
}

/**
 * Fonction qui décale la position des contacts suivant un autres
 * @param {integer} pos
 */
function decalageFormAddContact(pos) {
    new_pos = pos - 1;
    $("#new_contact" + pos).attr("id","new_contact" + new_pos);
    $("contact_nom" + pos).attr("name","contact_nom" + new_pos);
}

/**
 * Fonction qui remet la partie du formulaire qui gérer les contacts à zero
 */
function cleanSelectsContact() {
    for(i = 2; $("#contact" + i).length !== 0; i++){
        $("#contact" + i).remove();
    }
    
    $("#new_contact1").remove();
}

/**
 * Fonction qui remplie le formulaire d'un contact avec ses données récupérer 
 * dans la DB via AJAX
 * @param {integer} pos
 */
function ReadContact(pos) {
    $.ajax({
        type: 'post',
        url: 'controller/gestion_ajax.php',
        data: "action=read&item=contact&id=" + $("#select_contact" + pos).val(),
        dataType: 'json',
        success: function(retour_php)
        {
            if(retour_php.success === false)
            {
                alert(retour_php.erreur);
            }
            else
            {
               $("input[name=contact_nom" + pos + "]").val(retour_php.nom);
               $("input[name=contact_prenom" + pos + "]").val(retour_php.prenom);
               $("input[name=contact_num_tel" + pos + "]").val(retour_php.num_tel);
               $("input[name=contact_num_gsm" + pos + "]").val(retour_php.num_gsm);
               $("input[name=contact_mail" + pos + "]").val(retour_php.mail);
               $("textarea[name=contact_remarque" + pos + "]").val(retour_php.commentaire);
            }
        },
        error: function(retour_php)
        {
            alert("Erreur avec la communication serveur.");
        } 
    });
}

function refreshContact() {
    $.ajax({
        type: 'post',
        url: 'controller/gestion_ajax.php',
        data: "action=readList&item=contact",
        async: false,
        dataType: 'json',
        success: function(retour_php)
        {
            $("#select_contact1").empty();  //on vide la liste
            $("#select_contact1").append($('<option/>').val('').html('- Choississez un contact -')); //première valeur de la liste déroulante
            $.each(retour_php, function(idx, cont) //parcours du retour php qui est au format json
            {
                $("#select_id").append($('<option/>').val(cont.id).html(cont.toString ));    
            });
        },
        error: function(retour_php)
        {
            alert("Erreur avec la communication serveur.");
        } 
    });
}

listenerContact(1);