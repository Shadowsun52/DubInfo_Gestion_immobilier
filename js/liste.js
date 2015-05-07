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

function addBorneFilter(field_name) {
    $('#min_' + field_name).change(function () {
    var selection = this.value; 

    // filter items in the list
    itemList.filter(function (item) {
        if(selection === ''){
            return true;
        } else {
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
        case 'locataire':
            return ['nom', 'etat', 'num_tel', 'num_gsm', 'mail', 'budget', 'remarques'];
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