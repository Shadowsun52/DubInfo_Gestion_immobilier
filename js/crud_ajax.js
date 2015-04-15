//ici on ajout un script qui réagit au clique du bouton submit
function addAjaxListener(btn_name, form_name) {
    url_param = getParamsUrl();
    var form_name = form_name || "form_" + url_param['item'];
    $('#' + btn_name).bind('click', function(e) {
        e.preventDefault();
        //on récupere le formulaire
        var $form = $('#' + form_name),
        //on lis les data du formulaire que l'on stocke dans une variable
        $zf = $form.data('Zebra_Form');
        //on vérifie que tout les champs sont bons
        if ($zf.validate()) {
            /* On regarde si c'est un ajout ou une édition
             * pour déterminer quel fichier php appeler
             */
            if($('#select_id').val() === '') {
                var action = 'add';
            }
            else {
                var action = 'edit';
            }
            
            $.ajax({
                'url': 'controller/gestion_ajax.php',
                'type': 'post',
                //on retour le type de l'item et le contenu du form
                'data': 'action=' +  action +'&item=' + url_param['item'] +'&' + $form.serialize(),
                'dataType': 'json',
                'success': function(data) {
                    if(data.success) {
                        alert(data.message);
                        //si c'est un ajout on met à jour la liste
                        id = $("#select_id").val();
                        console.log(id);
                        refreshList(url_param['item'], false);
                        $("#select_id").val(id);
                        if(action === 'add') {
                            $('#' + form_name)[0].reset();
                        }
                    }
                    else
                    {
//                        /* On regarde si on a rencontré un problème de doublon 
//                         * ou si on a rencontré une erreur
//                         */
//                        if(data.cause) {
//                            /* Si c'est un problème de doublon on demande si 
//                             * l'utilisateur veut quand même ajouter l'utilisateur
//                             */
//                            if(confirm(data.message)) {
//                                alert('NOPE');  
//                            }
//                        }
//                        else
//                        {
                            alert(data.erreur);  
//                        }
                    }
                }
            });
        }
    });
}

/* fonction qui lie un listener 'change' sur une liste pour savoir quand 
 * actualiser le formulaire
 */
function changeAjaxListener(select_name) {
    $('#' + select_name).bind('change', function(e) {
        //on regarde si on a choisi un élement ou l'option d'ajout
        if($('#select_id').val() === '') {
            //on change le text du bouton submit
            $("#btnsubmit").val("Ajouter");
            
            //On retire le bouton de suppression
            $("#deleting").remove();
            
            //on vide le formulaire
            url_param = getParamsUrl();
            $('#form_' + url_param['item'])[0].reset();
        }
        else {
            //on change le text du bouton submit
            $("#btnsubmit").val("Editer");
            
            //ajout du bouton de suppression
            $("#btnsubmit").parent().after('<div id="deleting" class="cell"/>');
            $("#deleting").append('<button id="btn_delete" class="submit">Supprimer</button>');
            
            //on remplie le formulaire avec les informations de l'élement
            feedForm();
        }
    });
}

//appel en ajax de l'ajout de manière forcé, c-a-d sans vérification de doublons
function addAjaxForced($form, url_param) {
    $.ajax({
        'url': 'controller/add_ajax_forced.php',
        'type': 'post',
        //on retour le type de l'item et le contenu du form
        'data': 'item=' + url_param['item'] +'&' + $form.serialize(),
        'dataType': 'json',
        'success': function(data) {
            if(data.success) {
                alert(data.message); 
                $('#' + form_name)[0].reset();
            }
            else
            {
                alert(data.erreur);
            }
        }
    });
}

//fonction ajax qui met à jour la liste d'item du formulaire
function refreshList(item) {
    $.ajax({
        type: 'post',
        url: 'controller/gestion_ajax.php',
        data: "action=readList&item=" + item,
        async: false,
        dataType: 'json',
        success: function(retour_php)
        {
            $("#select_id").empty();  //on vide la liste
            $("#select_id").append($('<option/>').val('').html('- Nouveau -')); //première valeur de la liste déroulante
            $.each(retour_php, function(idx, cont) //parcours du retour php qui est au format json
            {
                $("#select_id").append($('<option/>').val(cont.id).html(cont.nom + ' ' + cont.prenom ));    
            });
        },
        error: function(retour_php)
        {
            alert("Erreur avec la communication serveur.");
        } 
    });
}

// read a current page's GET URL variables and return them as an associative array.
function getParamsUrl() {
    var url = location.href;
    var parameters = url.substring(url.indexOf("?") + 1);
    var vars = [], hash;
    var hashes = parameters.split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
};

//Fonctions pour remplir des formulaires lors du choix de l'édition
/*
 * Fonction générique pour remplir les formulaires lors de l'édition
 */
function feedForm() {
    url_param = getParamsUrl();
    //on récupere l'id de l'élément
    id = $("#select_id").val();
    
    //on récupere l'object en format json
    $.ajax({
        type: 'post',
        url: 'controller/gestion_ajax.php',
        data: "action=read&item=" + url_param['item'] + '&id=' + id ,
        dataType: 'json',
        success: function(retour_php)
        {
            if(retour_php.success === false)
            {
                alert(retour_php.error);
            }
            else
            {
                //pour mettre la premier lettre en majuscule
                item = url_param['item'].replace(/^\w/, 
                    function($0) { return $0.toUpperCase(); });

                //on appel la bonne fonction pour remplir le formulaire 
                window['feed' + item + 'Form'](retour_php);
            }
        },
        error: function(retour_php)
        {
            alert("Erreur avec la communication serveur.");
        } 
    });
}


/* 
 * Fonctions pour remplir les champs lié au personne 
 * c'est à dire les parties commune à Investisseur, Locataire et Professionnel
 * - data : les valeurs en json
 */
function feedPersonForm(data) {
    $("#nom").val(data.nom);
    $("#prenom").val(data.prenom);
    $("#rue").val(data.adresse.rue);
    $("#numero").val(data.adresse.numero);
    $("#boite").val(data.adresse.boite);
    ///////////////////////////////TODO gestion liste///////////////////////////////
    $("#select_pays").val(data.adresse.ville.pays);
    
    $("#num_tel").val(data.num_tel);
    $("#num_gsm").val(data.num_gsm);
    $("#mail").val(data.mail);
    $("#remarque").val(data.commentaire);
}

/*
 * Fonction pour remplir les champs du formulaire d'un investisseur selectionner
 */
function feedInvestisseurForm(data) {
    //on remplie les parties commune au Personne
    feedPersonForm(data);
    
    //partie ne consernant que l'investisseur
    $("#num_tva").val(data.num_tva);
    $("#select_etat").val(data.etat.id);
}