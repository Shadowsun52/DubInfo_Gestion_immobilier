//ici on ajout un script qui réagir au clique du bouton submit
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
                'url': 'ajax/' + url_param['action'] + '_' + url_param['item'] + '.php',
                'type': 'post',
                'data': $form.serialize(),
                'success': function(data) {
                    alert(data);
                    $('#' + form_name)[0].reset();
                }
            });
        }
    });
}

$('#btnsubmit').bind('click', function(e) {
    
    e.preventDefault();
    alert("pierre");
    //on récupere le formulaire
    var $form = $('form'),
    //on lis les data du formulaire que l'on stocke dans une variable
    $zf = $form.data('Zebra_Form');
    //on vérifie que tout les champs sont bons
    if ($zf.validate()) {

        $.ajax({
            //$form.attr('action') -> retourne l'action du form, avec son utilisation on pourrait generaliser la fonction d'appel ajax
            'url': 'partAjax.php',
            'type': 'post',
            //contenu seiralize du formulaire
            'data': $form.serialize(),
            'success': function(data) {
                alert(data);

                //ici on simule le click sur le bouton reset pour nettoyer le
                //formulaire
                $("form")[0].reset();
            }
        });
    }
});

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