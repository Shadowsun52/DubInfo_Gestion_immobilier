//Fonction permettant d'ajout les écouteurs d'événement au liste des adresses
function addAdresseListListener() {
    //écouteur d'événement sur la liste pays pour générer la liste des codes postaux
    $('#select_pays').bind('change', function(e) {
        if($("#select_pays").val() === 'Autre') {
            //TODO le choix autre 
            console.log("autre");
        } 
        else {
            $("#select_cp").empty();
            $("#select_cp").append($("<option/>").val("").html("- choisissez un code postal -"));
            
            //on vide la liste des pays
            $("#select_villes").empty();
            $("#select_villes").append($("<option/>").val("").html("- choisissez une ville -"));
            $("#select_villes").attr("disabled",true);
            $("#label_villes").addClass("disabled");
            
            //on regarde si on a sélectionner un pays ou non
            if($("#select_pays").val() === '') {
                $("#select_cp").attr("disabled",true);
                $("#label_cp").addClass("disabled");
            }
            else {
                $("#select_cp").removeAttr("disabled");
                $("#label_cp").removeClass("disabled");
                pays_id = $("#select_pays option:selected").index();
                
                $.ajax({
                    type: 'post',
                    url: 'controller/gestion_ajax.php',
                    data: "action=read&item=CodesPostaux&pays_id=" + pays_id,
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
    
    $('#select_cp').bind('change', function(e) {
        $("#select_villes").empty();
        $("#select_villes").append($("<option/>").val("").html("- choisissez une ville -"));
        //on regarde si on a sélectionner un code postal ou non
        if($("#select_cp").val() === '') {
            $("#select_villes").attr("disabled",true);
            $("#label_villes").addClass("disabled");
        }
        else {
            $("#select_villes").removeAttr("disabled");
            $("#label_villes").removeClass("disabled");
            cp_id = $("#select_cp").val();
            
            $.ajax({
                type: 'post',
                url: 'controller/gestion_ajax.php',
                data: "action=read&item=villes&cp_id=" + cp_id,
                dataType: 'json',
                success: function(retour_php)
                {
                    console.log(retour_php);
                    $.each(retour_php, function(idx, cont) //parcours du retour php qui est au format json
                    {
                        $("#select_villes").append($('<option/>').val(cont).html(cont));    
                    });
                },
                error: function(retour_php)
                {
                    alert("Erreur avec la communication serveur.");
                } 
            });
        }
    });
}