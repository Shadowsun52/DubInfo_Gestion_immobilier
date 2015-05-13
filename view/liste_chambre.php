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
        <div>
            <p><label>Prix : </label></p>
            <p>
                <span class="low_size">min: </span>
                <input id="min_prix" type="number" class="filter_option"/>
                <span class="low_size">max: </span> 
                <input id="max_prix" type="number" class="filter_option"/>
            </p> 
        </div>
        <div>
            <p><label>Charges : </label></p>
            <p>
                <span class="low_size">min: </span>
                <input id="min_charges" type="number" class="filter_option"/>
                <span class="low_size">max: </span> 
                <input id="max_charges" type="number" class="filter_option"/>
            </p> 
        </div>
    </div>
    <table id="locataire-list">
        <thead>
            <tr>
                <th class="sort" data-sort="maison">Maison</th>
                <th class="sort" data-sort="chambre">Chambre</th>
                <th class="sort" data-sort="prix">Prix</th>
                <th class="sort" data-sort="charges">Charges</th>
                <th class="sort" data-sort="prix_charges">Prix avec charges</th>
                <th class="sort" data-sort="remarques">Remarques</th>
            </tr>
        </thead>
    
        <tbody  class="list">
        <?php
            //On remplie le tableau avec les locations
            $business = new ChambreCRUD();
            
            foreach ($business->readAll() as $chambre) {
                echo '<tr>';
                echo '<td class="maison">' . $chambre->getMaison()
                        ->getTitre(Maison::LANGUAGE_FR) . '</td>';
                echo '<td class="chambre">N°' . $chambre->getNumero()
                        . (($chambre->getEtage() === NULL) ? '' :
                        ' (' . $chambre->getEtage(). ')') . '</td>';
                echo '<td class="prix center">' . $chambre->getPrix() . '</td>';
                echo '<td class="charges center">' . $chambre->getCharges() 
                        . '</td>';
                echo '<td class="prix_charges center">' 
                        . ($chambre->getPrix() + $chambre->getCharges()) . '</td>';
                echo '<td class="remarques">' 
                        . $chambre->getMaison()->getCommentaire() . '</td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>
    <a id="generate_excel">Générer excel</a>
    <div id="doc_excel"></div>
</div>
<script src="./js/liste.js"></script>