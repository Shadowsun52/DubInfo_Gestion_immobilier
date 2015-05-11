<?php
    use DubInfo_gestion_immobilier\business\PaiementLoyerCRUD;
    use DubInfo_gestion_immobilier\model\Maison;
    use DubInfo_gestion_immobilier\model\Paiement;
?>
<h2>Liste des rencontres avec les investisseurs</h2>
<div id="table_of_item">
    <div id="filter">
        <div>
            <p><label>Recherche : </label></p>
            <p><input class="search filter_option"/></p>
        </div>
<!--        <div>
            <p><label>Date : </label></p>
            <p>
                <span class="low_size">min: </span>
                <input id="min_date" type="text" class="filter_option"/>
                <span class="low_size">max: </span> 
                <input id="max_date" type="text" class="filter_option"/>
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
        </div>
    </div>-->
    <table id="liste">
        <thead>
            <tr>
                <th class="sort" data-sort="maison">Maison</th>
                <th class="sort" data-sort="chambre">Chambre</th>
                <th class="sort" data-sort="locataire">Locataire</th>
                <th class="sort" data-sort="loyer">Loyer</th>
                <th class="sort" data-sort="Loyer_paye">Loyer payé</th>
                <th class="sort" data-sort="mois">Mois</th>
                <th class="sort" data-sort="année">Année</th>
            </tr>
        </thead>
    
        <tbody  class="list">
        <?php
            //On remplie le tableau avec les paiements
            $business = new PaiementLoyerCRUD();
            
            foreach ($business->readAll() as $paiement) {
                echo '<tr>';
                echo '<td class="nom">' . $paiement->getLocation()->getChambre()
                        ->getMaison()->getTitre(Maison::LANGUAGE_FR) . '</td>';
                echo '<td class="chambre">' . $paiement->getLocation()->getChambre()
                        ->getNumero() . (($paiement->getLocation()->getChambre()
                        ->getEtage() === NULL) ? '' :
                        ' (' . $paiement->getLocation()->getChambre()
                                ->getEtage(). ')'). '</td>';
                echo '<td class="locataire">' . $paiement->getLocation()
                        ->getLocataire()->getNom() . ' ' . 
                        $paiement->getLocation()->getLocataire()->getPrenom() . '</td>';
                echo '<td class="loyer center">' 
                    . $paiement->getLocation()->getLoyer() . '</td>';
                echo '<td class="loyer_paye center">' 
                    . $paiement->getLoyerPaye() . '</td>';
                echo '<td class="mois center">' 
                    . Paiement::getNomMois($paiement->getMois()) . '</td>';
                echo '<td class="annee center">' . $paiement->getAnnee() . '</td>';
                echo '</tr>';          
            }
        ?>
        </tbody>
    </table>
</div>
<script src="./js/liste.js"></script>