var options = {
        valueNames: initValueNames()
    };
var itemList = new List('table_of_item', options);

$('#select_etat').change(function () {
    var selection = this.value; 

    // filter items in the list
    itemList.filter(function (item) {
        if(selection === ''){
            return true;
        } else {
            if (item.values().etat === selection) {
                return true;
            } else {
                return false;
            }
        }
    });
});

/**
 * Méthodes qui ajoute des listener pour gérer un filtre permettant de savoir 
 * si un champs est oui ou non
 * @param {string} field_name le nom du champs 
 */
function addIsYesOrNoFilter(field_name) {
    $('input[name="'+ field_name + '"]').change(function () {
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
        
        // filter items in the list
        itemList.filter(function (item) {
            if ($.inArray(item.values()[field_name], value_accepted ) !== -1) {
                return true;
            } else {
                return false;
            }
        });
    });
}

/**
 * Méthodes qui ajoute des listener pour gérer un filtre permettant de savoir 
 * si tout est payé (en comparant 2 champs)
 * @param {string} field_name le nom du champs contenant la valeur payée
 * @param {string} field_total le nom du champs contenant la valeur totale
 */
function addAllIsPaid(field_name, field_total) {
    $('input[name="'+ field_name + '"]').change(function () {
        //on regarde qu'elle check sont coché oui, non ou les deux
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
        
        // filter items in the list
        itemList.filter(function (item) {
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
                
                if (parseInt(item.values()[field_name]) >= item.values()[field_total]) {
                    return response;
                } else {
                    return !response;
                }
            }
        });
    });
}

/**
 * Méthodes qui ajoute des listener pour gérer un filtre min - max
 * @param {string} field_name le nom des champs auquel attacher les listeners
 */
function addBorneFilter(field_name) {
    $('#min_' + field_name).change(function () {
        var selection = this.value; 

        // filter items in the list
        itemList.filter(function (item) {
            if(selection === ''){
                return true;
            } else {
                selection = parseInt(selection);
                if (item.values()[field_name] !== '' 
                        && item.values()[field_name] >= selection) {
                    return true;
                } else {
                    return false;
                }
            }
        });
    });

    $('#max_' + field_name).change(function () {
        var selection = this.value; 

        // filter items in the list
        itemList.filter(function (item) {
            if(selection === ''){
                return true;
            } else {
                selection = parseInt(selection);
                if (item.values()[field_name] !== '' 
                        &&item.values()[field_name] <= selection) {
                    return true;
                } else {
                    return false;
                }
            }
        });
    });
}

/**
 * Fonction qui retourne la liste des noms des champs d'un tableau en fonction
 * de la page ou le script est appelé
 * @returns {Array}
 */
function initValueNames() {
    url_param = getParamsUrl();
    switch (url_param['item']) {
        case 'investisseur':
        case 'locataire':
            return ['nom', 'etat', 'num_tel', 'num_gsm', 'mail', 'budget', 'remarques'];
        case 'location':
            return ['locataire', 'maison', 'chambre', 'bail', 'etat_lieu', 'charte',
                'garantie_totale', 'garantie_payee'];
        case 'rencontreInvestisseur':
            return ['nom', 'etat', 'date', 'budget', 'rapport'];
        default:
            return [];    
    }
    var options = {
        valueNames: ['nom', 'etat', 'num_tel', 'num_gsm', 'mail', 'budget', 'remarques']
    };

    
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