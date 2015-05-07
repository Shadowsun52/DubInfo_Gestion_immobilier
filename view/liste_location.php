<?php
    use DubInfo_gestion_immobilier\business\LocationCRUD;
?>
<h2>Liste des Locations</h2>
<div id="table_of_item">
    <div id="filter">
        <div>
            
        </div>
        <div>
            <p><label>Recherche : </label></p>
            <p><input class="search filter_option"/></p>
        </div>
    </div>
    <table id="locataire-list">
        <thead>
            <tr>
                <th class="sort" data-sort="locataire">Locataire</th>
                <th class="sort" data-sort="maison">Maison</th>
                <th class="sort" data-sort="chambre">Chambre</th>
                <th class="sort" data-sort="bail">Bail</th>
                <th class="sort" data-sort="etat lieu">Etat lieu</th>
                <th class="sort" data-sort="charte">Charte</th>
                <th class="sort" data-sort="Garantie_totale">Garantie à payer</th>
                <th class="sort" data-sort="Garantie_payee">Garantie payée</th>
            </tr>
        </thead>
    
        <tbody  class="list">
        </tbody>
    </table>
</div>
<script src="./js/liste.js"></script>
<script type="text/javascript">
//    addBorneFilter("budget");
</script>