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
            console.log($('#select_id').val());
            /* On regarde si c'est un ajout ou une édition
             * pour déterminer quel fichier php appeler
             */
            if($('select_id').val() === undefined) {
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
                        $('#' + form_name)[0].reset();
                    }
                    else
                    {
                        /* On regarde si on a rencontré un problème de doublon 
                         * ou si on a rencontré une erreur
                         */
                        if(data.cause) {
                            /* Si c'est un problème de doublon on demande si 
                             * l'utilisateur veut quand même ajouter l'utilisateur
                             */
                            if(confirm(data.message)) {
                                alert('NOPE');  
                            }
                        }
                        else
                        {
                            alert(data.erreur);  
                        }
                        
                    }
                }
            });
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