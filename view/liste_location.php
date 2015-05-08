<?php
    use DubInfo_gestion_immobilier\business\LocationCRUD;
    use DubInfo_gestion_immobilier\model\Maison;
?>
<h2>Liste des Locations</h2>
<div id="table_of_item">
    <div id="filter">
        <div>
            <p><label>Recherche : </label></p>
            <p><input class="search filter_option"/></p>
        </div>
        <div>
            <p><label>Garantie à payer : </label></p>
            <p>
                <span class="low_size">min: </span>
                <input id="min_garantie_totale" type="number" class="filter_option"/>
                <span class="low_size">max: </span> 
                <input id="max_garantie_totale" type="number" class="filter_option"/>
            </p> 
        </div>
        <div>
            <p><label>Garantie totalement payée : </label></p>
            <p>
                <span class="low_size">Oui </span>
                <input type="checkbox" name="garantie_payee" value="oui"
                       class="filter_option radio_garantie_paye"/>
                <span class="low_size">Non </span> 
                <input type="checkbox" name="garantie_payee" value="non" 
                       class="filter_option radio_garantie_paye"/>
            </p> 
        </div>
    </div>
    <table id="locataire-list">
        <thead>
            <tr>
                <th class="sort" data-sort="locataire">Locataire</th>
                <th class="sort" data-sort="maison">Maison</th>
                <th class="sort" data-sort="chambre">Chambre</th>
                <th class="sort" data-sort="bail">Bail</th>
                <th class="sort" data-sort="etat_lieu">Etat lieu</th>
                <th class="sort" data-sort="charte">Charte</th>
                <th class="sort" data-sort="garantie_totale">Garantie à payer</th>
                <th class="sort" data-sort="garantie_payee">Garantie payée</th>
            </tr>
        </thead>
    
        <tbody  class="list">
        <?php
            //On remplie le tableau avec les locations
            $business = new LocationCRUD();
            
            foreach ($business->readAll() as $location) {
                echo '<tr>';
                echo '<td class="locataire">' . $location->getLocataire()->getNom() 
                        . ' ' . $location->getLocataire()->getPrenom() . '</td>';
                echo '<td class="maison">' . $location->getChambre()->getMaison()
                        ->getTitre(Maison::LANGUAGE_FR) . '</td>';
                echo '<td class="chambre">' . $location->getChambre()->getNumero()
                        . (($location->getChambre()->getEtage() === NULL) ? '' :
                        ' (' . $location->getChambre()->getEtage(). ')') 
                        . '</td>';
                echo '<td class="bail center">' 
                        . (($location->getBailSigne()) ? 'Oui' : 'Non') . '</td>';
                echo '<td class="etat_lieu center">' 
                        . (($location->getEtatLieuSigne()) ? 'Oui' : 'Non') . '</td>';
                echo '<td class="charte center">' 
                        . (($location->getCharteSignee()) ? 'Oui' : 'Non') . '</td>';
                echo '<td class="garantie_totale center">' 
                        . $location->getGarantieLocativeTotal() . '</td>';
                echo '<td class="garantie_payee center">' 
                        . $location->getGarantieLocativePayee() . '</td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>
</div>
<script src="./js/liste.js"></script>
<script type="text/javascript">
    addBorneFilter("garantie_totale");
    addAllIsPaid("garantie_payee", "garantie_totale");
</script>