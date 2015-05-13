var itemList;

/**
 * 
 * Fonction qui initialise le système de filtre et le search pour un tableau de 
 * liste
 */
function initFilter() {
    url_param = getParamsUrl();
    options = {
        valueNames: initValueNames(url_param['item'])
    };
    itemList = new List('table_of_item', options);
    initListenerFilter(url_param['item']);
    initDatePicker(url_param['item']);
}

/**
 * Fonction qui retourne la liste des noms des champs d'un tableau en fonction
 * de l'item de la liste
 * @param {string} item_name le nom de l'item de la liste
 * @returns {Array}
 */
function initValueNames(item_name) {
    switch (item_name) {
        case 'investisseur':
        case 'locataire':
            return ['nom', 'etat', 'num_tel', 'num_gsm', 'mail', 'budget', 'remarques'];
        case 'location':
            return ['locataire', 'maison', 'chambre', 'bail', 'etat_lieu', 'charte',
                'garantie_totale', 'garantie_payee'];
        case 'rencontreInvestisseur':
            return ['nom', 'etat', 'date', 'budget', 'rapport'];
        case 'paiementLoyer':
            return ['maison', 'chambre', 'locataire', 'loyer', 'loyer_paye', 
                'mois', 'annee'];
        case 'visiteMaisonInvestisseur': 
            return ['nom', 'etat', 'maison', 'date', 'rapport'];
        case 'projet':
            return ['nom', 'etat', 'maison', 'compromis', 'acte', 'plan_metre',
                'devis', 'selection_materiaux', 'remarques'];
        case 'maison':
            return ['titre', 'etat', 'rue', 'numero', 'commune', 'contact', 
                'prix', 'prix_conseille', 'prix_m2', 'cout_travaux', 'cout_total', 
                'chambres', 'sdb', 'rendement', 'localisation', 
                'localisation_indice', 'qualite', 'qualite_indice', 'remarques'];
        case 'chambre':
            return ['maison', 'chambre', 'prix', 'charges', 'prix_charges',
                'remarques'];
        default:
            return [];    
    }
}

/**
 * Fonction qui ajout un listener sur chaque élément de filtre de la page 
 * @param {string} item_name le nom de l'item de la liste
 */
function initListenerFilter(item_name) {
    $(".filter_option").change(function () {
        listenerFilter(item_name);
    });
}

/**
 * Fonction qui initialise les datepickers et leur listener en fonction de l'item
 * de la page
 * @param {string} item_name le nom de l'item de la liste
 */
function initDatePicker(item_name) {
    switch (item_name) {
        case 'visiteMaisonInvestisseur' :
        case 'rencontreInvestisseur' :
            addDatePicker(item_name, "date");
            break;
        case 'projet' :
            addDatePicker(item_name, "compromis");
            addDatePicker(item_name, "acte");
            break;
    }
}

/**
 * Fonction qui ajout les listes min et max pour les date selon un nom de champ donné
 * @param {string} item_name le nom de l'item de la liste
 * @param {string} field_name le nom du champ de la valeur
 */
function addDatePicker(item_name, field_name) {
    $("#min_" + field_name).Zebra_DatePicker({ 
        format: 'Y/m/d',
        onSelect: function() {
           listenerFilter(item_name);
        },
        onClear: function() {
           listenerFilter(item_name);
        }
    });
    
    $("#max_" + field_name).Zebra_DatePicker({ 
        format: 'Y/m/d',
        onSelect: function() {
           listenerFilter(item_name);
        },
        onClear: function() {
           listenerFilter(item_name);
        }
    });
}

/**
 * Fonction à appeler sur les listeners pour les filtres
 * @param {string} item_name le nom de l'item de la liste
 */
function listenerFilter(item_name) {
    itemList.filter(function (item) {
        if(checkFilter(item_name, item.values())) {
            return true;
        }
        else {
            return false;
        }
    });
}

/**
 * Fonction qui check si un item passe tout les filtres
 * @param {string} item_name le nom de l'item de la liste
 * @param {type} values les valeurs de l'item testé
 * @returns {boolean}
 */
function checkFilter(item_name, values) {
    switch (item_name) {
        case 'investisseur':
        case 'locataire' : 
            return filterSelect("etat", values) && filterBorne("budget", values);
        case 'location' :
            return filterBorne("garantie_totale", values) 
                    && filterYesNo("bail", values) 
                    && filterYesNo("charte", values)
                    && filterYesNo("etat_lieu", values)
                    && filterAllIsPaid("garantie_payee", "garantie_totale", values);
        case 'rencontreInvestisseur' :
            return filterSelect("etat", values) && filterBorne("budget", values) 
                    && filterBorneDate("date", values);
        case 'paiementLoyer' :
            return filterSelect("mois", values) && filterSelect("annee", values)
                    && filterBorne("loyer", values) 
                    && filterAllIsPaid("loyer_paye", "loyer", values);
        case 'visiteMaisonInvestisseur' :
            return filterSelect("etat", values) && filterBorneDate("date", values);
        case 'projet':
            return filterSelect("etat", values) && filterBorneDate("compromis", values)
                    && filterBorneDate("acte", values) 
                    && filterYesNo("plan_metre", values) && filterYesNo("devis", values) 
                    && filterYesNo("selection_materiaux", values);
        case 'maison' :
            return filterSelect("etat", values) && filterSelect("commune", values)
                    && filterSelect("chambres", values) && filterSelect("sdb", values)
                    && filterSelect("localisation_indice", values) 
                    && filterSelect("qualite_indice", values) 
                    && filterBorne("rendement", values) 
                    && filterBorne("prix_conseille", values);
        case 'chambre' :
            return filterBorne("prix", values) && filterBorne("charges", values);
        default:
            return true;
    }
}

/**
 * Fonction qui vérifie si l'item correspond au filtre sur l'état
 * @param {string} field_name le nom du champs/valeurs à tester
 * @param {type} values les valeurs de l'item testé
 * @returns {boolean}
 */
function filterSelect(field_name, values) {
    selection = $("#select_" + field_name).val();
    if(selection === '') {
        return true;
    }
    else {
        return (values[field_name] === selection);
    }
}

/**
 * Fonction qui vérifie que une valeur numérique de l'item est comprise entre 
 * deux borne de filtre
 * @param {string} field_name le nom du champs/valeurs à tester
 * @param {type} values les valeurs de l'item testé
 * @returns {Boolean}
 */
function filterBorne(field_name, values) {
    //les champs vide sont remplacé par 0
    if(values[field_name] === '') {
        var valeur = 0;
    }
    else {
        var valeur = parseFloat(values[field_name]);
    }
    
    //on vérifie que la condition sur la valeur minimum est respectée
    min_borne = $('#min_' + field_name).val();
    
    if(min_borne === ''){
        result = true;
    } else {
        min_borne = parseInt(min_borne);
        result = valeur >= min_borne;
    }
    
    //si la condition sur le minimum est passé on test celle sur le maximum
    if(result) {
        max_borne = $('#max_' + field_name).val();
        if(max_borne !== ''){
            max_borne = parseInt(max_borne);
            return valeur <= max_borne;
        }
    }
    
    return result;
}

/**
 * Fonction qui vérifie que une valeur (oui/non) est dans le ou les bons état choisi
 * @param {string} field_name le nom du champs/valeurs à tester
 * @param {type} values les valeurs de l'item testé
 * @returns {Boolean}
 */
function filterYesNo(field_name, values) {
    var value_accepted = [];
    if($('input[name="'+ field_name + '"][value="oui"]').is(':checked')) {
        value_accepted.push('Oui');
    }
    if($('input[name="'+ field_name + '"][value="non"]').is(':checked')) {
        value_accepted.push('Non');
    }
    if(value_accepted.length === 0) {
        value_accepted = ['Oui', 'Non'];
    }
    
    return $.inArray(values[field_name], value_accepted ) !== -1;
}


function filterAllIsPaid(field_name, field_total, values) {
    var value_accepted = "all";
    if($('input[name="'+ field_name + '"][value="oui"]').is(':checked')) {
        value_accepted = "oui";
    }
    if($('input[name="'+ field_name + '"][value="non"]').is(':checked')) {
        if(value_accepted === "oui") {
            value_accepted = "all";
        }
        else {
           value_accepted = "non"; 
        } 
    }
    
    if(value_accepted === 'all') {
        return true;
    }
    else {
        if(value_accepted === 'oui') {
            response = true;
        }
        else {
            response = false;
        }

        if (parseInt(values[field_name]) >= values[field_total]) {
            return response;
        } else {
            return !response;
        }
    }
}

/**
 * Fonction qui vérifie que une valeur date de l'item est comprise entre 
 * deux borne de filtre
 * @param {string} field_name le nom du champs/valeurs à tester
 * @param {type} values les valeurs de l'item testé
 * @returns {Boolean}
 */
function filterBorneDate(field_name, values) {
    //les champs vide sont remplacé par 0
    if(values[field_name] === '') {
        return false;
    }
    
    //on vérifie que la condition sur la valeur minimum est respectée
    min_borne = $('#min_' + field_name).val();
    
    if(min_borne === ''){
        result = true;
    } else {
        result = values[field_name] >= min_borne;
    }
    
    //si la condition sur le minimum est passé on test celle sur le maximum
    if(result) {
        max_borne = $('#max_' + field_name).val();
        if(max_borne !== ''){
            return values[field_name] <= max_borne;
        }
    }
    
    return result;
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

initFilter();

$("#generate_excel").click(function () {
    url_param = getParamsUrl();
    var data = Array();
    $.each(itemList.visibleItems, function(idx, cont)
    {
        data.push(cont.values()); 
    });
    
    $.ajax({
        type: 'post',
        url: 'controller/excel_ajax.php',
        data: "item=" + url_param['item'] + "&data=" + JSON.stringify(data),
        dataType: 'json',
        success: function(data)
        {
            alert("ok");
        },
        error: function(data)
        {
            alert("Erreur avec la communication serveur.");
        } 
    });
});