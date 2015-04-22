function listenerContact(pos) {
    var MAX_CONTACT = 4
    console.log(pos);
    $('#select_contact' + pos).bind('change', function(e) {
        if($("#select_contact" + pos).val() !== '') {
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
                    $("#select_contact" + i).attr("name","select_contact" + (i-1));
                    $("#select_contact" + i).attr("id","select_contact" + (i-1));
                    //on rattache un bon listener
                    listenerContact(i-1);
                }
            }
        }
    });
}

listenerContact(1);