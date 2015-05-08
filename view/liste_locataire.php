<?php
    use DubInfo_gestion_immobilier\business\LocataireCRUD;
?>
<h2>Liste des Locataires</h2>
<div id="table_of_item">
    <div id="filter">
        <p id="nom_Filter"></p>
        <p id="etat_Filter"></p>
        <p id="tel_Filter"></p>
        <p id="gsm_Filter"></p>
        <p id="mail_Filter"></p>
        <p id="budget_Filter"></p>
        <p id="remarque_Filter"></p>
<!--        <div>
            <p><label>Recherche : </label></p>
            <p><input class="search filter_option"/></p>
        </div>
        <div>
            <p><label>Etat : </label></p>
            <p>
                <select id="select_etat" class="filter_option">
                    <option value="">- Filtrer les états -</option>
                    <option value="Potentiel">Potentiel</option>
                    <option value="Actif">Actif</option>
                    <option value="Locataire en cours">Locataire en cours</option>
                    <option value="Locataire confirmé">Locataire confirmé</option>
                    <option value="Abandonné">Abandonné</option>
                </select>
            </p>
        </div>
        <div>
            <p><label>Budget : </label></p>
            <p>
                <span class="low_size">min: </span>
                <input id="min_budget" type="number" class="filter_option"/>
                <span class="low_size">max: </span> 
                <input id="max_budget" type="number" class="filter_option"/>
            </p> 
        </div>-->
    </div>
    <table id="example" class="display">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Etat</th>
                <th>Téléphone</th>
                <th>Gsm</th>
                <th>Mail</th>
                <th>Budget</th>
                <th>Remarques</th>
            </tr>
        </thead>
        
        <tfoot>
            <tr>
                <th >Nom</th>
                <th >Etat</th>
                <th >Téléphone</th>
                <th >Gsm</th>
                <th >Mail</th>
                <th >Budget</th>
                <th >Remarques</th>
            </tr>
        </tfoot>
        
        <tbody  class="list">
        <?php
            //On remplie le tableau avec les locataires
            $business = new LocataireCRUD();
            
            foreach ($business->readAll() as $locataire) {
                echo '<tr>';
                echo '<td class="nom">' . $locataire->getNom() . ' ' 
                        . $locataire->getPrenom() . '</td>';
                echo '<td class="etat">' . $locataire->getEtat()->getLibelle() 
                        . '</td>';
                echo '<td class="num_tel">' . $locataire->getNumTelephone() . '</td>';
                echo '<td class="num_gsm">' . $locataire->getNumGsm() . '</td>';
                echo '<td class="mail">' . $locataire->getMail() . '</td>';
                echo '<td class="budget center">' . $locataire->getBudget() . '</td>';
                echo '<td class="remarques">' . $locataire->getCommentaire() . '</td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $(document).ready( function () {
		$('#example').dataTable( {
                    'paging': false,
                    'language': {
                        "zeroRecords": "Rien n'a été trouvé",
                        "info": "Résultats affichés _END_ sur _MAX_",
                        "infoFiltered": "",
                        "search": "Recherche:",
                        "emptyTable": "Aucune données dans le tableau"
                    }
                }).columnFilter({
                    aoColumns: [
                        { sSelector: "#nom_Filter", type: "text" }
                    ]
                });
    });
</script>
<!--<script src="./js/liste.js"></script>
<script type="text/javascript">
    addBorneFilter("budget");
</script>-->