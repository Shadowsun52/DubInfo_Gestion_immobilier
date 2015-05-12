<?php
    use DubInfo_gestion_immobilier\business\ChambreCRUD;
    use DubInfo_gestion_immobilier\model\Maison;
?>
<h2>Liste des Locations</h2>
<div id="table_of_item">
    <div id="filter">
        <div>
            <p><label>Recherche : </label></p>
            <p><input class="search filter_option"/></p>
        </div>
    </div>
    <table id="locataire-list">
        <thead>
            <tr>
                <th class="sort" data-sort="titre">Maison</th>
                <th class="sort" data-sort="chambre">Chambre</th>
                <th class="sort" data-sort="prix">Prix</th>
                <th class="sort" data-sort="charges">Charges</th>
                <th class="sort" data-sort="prix_charges">Prix avec charges</th>
                <th class="sort" data-sort="remarques">Remarques</th>
            </tr>
        </thead>
    
        <tbody  class="list">
        <?php
//            //On remplie le tableau avec les locations
//            $business = new LocationCRUD();
//            
//            foreach ($business->readAll() as $location) {
//                echo '<tr>';
//                echo '<td class="maison">' . $location->getChambre()->getMaison()
//                        ->getTitre(Maison::LANGUAGE_FR) . '</td>';
//                echo '<td class="chambre">' . $location->getChambre()->getNumero()
//                        . (($location->getChambre()->getEtage() === NULL) ? '' :
//                        ' (' . $location->getChambre()->getEtage(). ')') 
//                        . '</td>';
//                echo '</tr>';
//            }
        ?>
        </tbody>
    </table>
</div>
<script src="./js/liste.js"></script>