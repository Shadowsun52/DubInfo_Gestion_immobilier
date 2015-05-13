<?php
    use DubInfo_gestion_immobilier\business\PaiementLoyerCRUD;
    use DubInfo_gestion_immobilier\model\Maison;
    use DubInfo_gestion_immobilier\model\Paiement;
    
    define('MIN_YEAR', 2013);
?>
<h2>Liste des paiements de loyer</h2>
<div id="table_of_item">
    <div id="filter">
        <div>
            <p><label>Recherche : </label></p>
            <p><input class="search filter_option"/></p>
        </div>
        <div>
            <p><label>Mois : </label></p>
            <p>
                <select id="select_mois" class="filter_option">
                    <option value="">- Filtrer les mois -</option>
                <?php
                    foreach (Paiement::getNomsMois() as $mois) {
                        echo '<option value="'. $mois .'">' . $mois . '</option>';
                    }
                ?>
                </select>
            </p>
        </div>
        <div>
            <p><label>Année : </label></p>
            <p>
                <select id="select_annee" class="filter_option">
                    <option value="">- Filtrer les années -</option>
                <?php
                    for ($year = MIN_YEAR; $year <= (date('Y')+1); $year++) {
                        echo '<option value="'. $year .'">' . $year . '</option>';
                    }
                ?>
                </select>
            </p>
        </div>
        <div>
            <p><label>Loyer : </label></p>
            <p>
                <span class="low_size">min: </span>
                <input id="min_loyer" type="number" class="filter_option"/>
                <span class="low_size">max: </span> 
                <input id="max_loyer" type="number" class="filter_option"/>
            </p> 
        </div>
        <div>
            <p><label>loyer payé : </label></p>
            <p>
                <span class="low_size">Oui </span>
                <input type="checkbox" name="loyer_paye" value="oui"
                       class="filter_option"/>
                <span class="low_size">Non </span> 
                <input type="checkbox" name="loyer_paye" value="non" 
                       class="filter_option"/>
            </p> 
        </div>
    </div>
    <table id="liste">
        <thead>
            <tr>
                <th class="sort" data-sort="maison">Maison</th>
                <th class="sort" data-sort="chambre">Chambre</th>
                <th class="sort" data-sort="locataire">Locataire</th>
                <th class="sort" data-sort="loyer">Loyer</th>
                <th class="sort" data-sort="Loyer_paye">Loyer payé</th>
                <th class="sort" data-sort="mois">Mois</th>
                <th class="sort" data-sort="annee">Année</th>
            </tr>
        </thead>
    
        <tbody  class="list">
        <?php
            //On remplie le tableau avec les paiements
            $business = new PaiementLoyerCRUD();
            
            foreach ($business->readAll() as $paiement) {
                echo '<tr>';
                echo '<td class="maison">' . $paiement->getLocation()->getChambre()
                        ->getMaison()->getTitre(Maison::LANGUAGE_FR) . '</td>';
                echo '<td class="chambre">N°' . $paiement->getLocation()->getChambre()
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
    <a id="generate_excel">Générer excel</a>
    <div id="doc_excel"></div>
</div>
<script src="./js/liste.js"></script>