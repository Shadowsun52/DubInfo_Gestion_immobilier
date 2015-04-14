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
            $.ajax({
                'url': 'controller/add_ajax.php',   //appel de l'ajax d'ajout
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
                        alert(data.message);
                    }
                }
            });
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